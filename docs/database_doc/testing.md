# Database Testing

Tested via `php artisan tinker` against the live `edu_enroll` database.
All tests run before any controller or view is written — schema must be 
airtight before building on top of it.

---

# Constraint Correctness

Verify that the database enforces what the schema promises — not just that 
Laravel validates it, but that the DB itself rejects bad data.

__Unique constraints__
- Insert two schools with the same name → should fail at DB level
- Insert two classes with the same name in the same school → should fail
- Insert two classes with the same name in different schools → should succeed
- Insert two enrollments for the same student and course → should fail
- Insert two course content items with the same title in the same course → should fail
- Insert two users with the same email → should fail

---

# Cascade / nullOnDelete Behavior

Verify that deletion propagates correctly at the database level — nothing 
relies on application logic to clean up.

- Delete a school → its classes must be gone, its students must survive with `class_id = null`
- Delete a class → its students must survive with `class_id = null`
- Delete a student → their enrollments must be gone, courses untouched
- Delete a course → its contents must be gone, its enrollments must be gone, students untouched
- Delete a course content item → nothing else affected

---

# Relationship Correctness

Verify that Eloquent returns what the schema promises.

- `School::find(id)->classes` → returns correct SchoolClass records
- `SchoolClass::find(id)->users` → returns correct student records
- `Course::find(id)->contents` → returns items in correct order
- `User::find(id)->courses` → returns correct courses via enrollments pivot
- Enrollment record → both `student` and `course` resolve correctly