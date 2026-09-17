# Overview 
 - used uuid across all ids in order to avoid someone enumerating the bigint incremented ids 
 - Admin is seeded
 - This is a single tenant system where each tenant(system adopter) hase its own isolated database 
     mental model:  Higher authority (private school grp usually frokm 2 tio 5 schols)
    → runs one instance
        → manages multiple schools
            → each school has classes
                → each class has students   

- indexes fpr foreign keys not needed , explained through the file

## Known Limitations & Scope Decisions

The following limitations are deliberate — they reflect what the 
project brief specified, not oversights.

__Open registration__
- Any person can register as a student with no verification that 
  they actually belong to the school
- A real system would require the admin to create student accounts 
  directly, or use an invite code / registration token tied to a 
  specific school
- The brief specified open registration — this limitation is accepted 
  for this scope

__No grade-level enforcement on enrollment__
- A student can enroll in any course regardless of their class or 
  grade level
- Courses have no `class_id` or `grade_level` constraint — they are 
  a standalone catalog any student can access
- A real system would link courses to grade levels or classes, 
  restricting enrollment to students of the matching level
- The brief specified open enrollment — this limitation is accepted 
  for this scope

__No enrollment approval flow__
- Enrollment is instant — one click and the student is enrolled
- A real system would have an admin approval step before enrollment 
  is confirmed
- The brief specified instant enrollment — this limitation is 
  accepted for this scope  

  
 # Database Schema

__users__
- Serves as both the student entity and the authentication principal
- Rather than maintaining a separate `students` table alongside a `users` table, the two are merged into one — Laravel Breeze scaffolds authentication against a `users` table and fighting that default would waste significant development time
- `is_admin` flag distinguishes the seeded admin account from regular students
- `class_id` is nullable to accommodate the admin who belongs to no class
- `email` is globally unique since it is the login credential — two accounts on the same email would create an unresolvable login ambiguity
- Family email sharing is deliberately not supported — in production the solution would be requiring each student to have their own email, which is standard for any authentication system

__schools__
- `name` is globally unique — within a single-tenant deployment, duplicate school names are considered data errors
- `phone` is stored as `varchar` not `int` — preserves leading zeros and special characters such as `+20` country codes

__classes__
- `name` is composite unique on `(school_id, name)` — the same class name can exist across different schools but not within the same school
- `grade_level` is stored as `varchar` — no enum constraint, keeps the field flexible without requiring a migration for every new grade format

__courses__
- `title` is not unique — different instructors can teach a course with the same title

__course_contents__
- `title` is composite unique on `(course_id, title)` — two courses can each have an "Introduction" content item, but not within the same course
- `order` column defines the display sequence of content items within a course

__enrollments__
- Composite unique on `(student_id, course_id)` enforced at the database level — not just application level — so even a race condition from two simultaneous enrollment clicks cannot create a duplicate
- `enrolled_at` timestamp serves as an audit field recording exactly when each enrollment occurred


# deletions 

## Deletion Behavior

All foreign keys use `onDelete('cascade')` — deleting a parent automatically deletes all its children at the database level.

Before confirming a destructive delete, the admin is shown a summary of what will be lost and must type "DELETE" to confirm:

- **School** — shows count of classes, students, and enrollments that will be deleted
- **Class** — shows count of students and enrollments that will be deleted
- **Course** — shows count of content items and enrollments that will be deleted

Simpler confirmation modal (just "are you sure?") for:

- **Student** — shows count of enrollments that will be deleted
- **Course content** — no children, straightforward confirm


# Indexes

- Foreign key columns do not carry explicit indexes beyond what the composite 
unique constraints already create.

- The app's navigation is hierarchically scoped — the admin always enters through 
a school, then a class, never querying all students system-wide at once. The 
largest realistic single query is one school's students (~1,500 rows), which 
MySQL handles with a full table scan in negligible time at this scale.

- Indexes on FK columns would be the correct addition if query patterns changed 
- for example, a cross-school reporting dashboard filtering all 7,500 students 
by grade level. That feature does not exist in this version.
