EduEnroll

A full-stack school course management platform built with Laravel 12, Blade, and MySQL.

Admins set up a school hierarchy — schools, classes, students, and course content — then assign courses to classes. Students register into a class and automatically get access to every course assigned to it. Every architectural decision in this project was made deliberately and is documented below.

What It Does

Admin flow School → Class → Assign Courses to Class → Add Students → Manage Course Content

Student flow Register (select class) → Browse courses → Dashboard shows class courses → View content

Tech Stack
Layer	Choice
Backend	Laravel 12 + PHP
Views	Blade templates
Database	MySQL 8
Auth	Laravel Breeze
Styling	Bootstrap 5.3 + custom CSS (dark/orange design system)
Dev environment	php artisan serve
Database Schema
has many
has many students
assigned viaCLASS_COURSE
has many
SCHOOLS
uuid
id
PK
varchar
name
UK
globally unique
text
address
varchar
phone
varchar — preserves +20 and leading zeros
SCHOOL_CLASSES
uuid
id
PK
uuid
school_id
FK
varchar
name
unique per school
varchar
grade_level
USERS
uuid
id
PK
uuid
class_id
FK
nullable — admin has no class
varchar
name
varchar
email
UK
varchar
password
bcrypt
boolean
is_admin
COURSES
uuid
id
PK
varchar
title
not unique — same title allowed across groups
text
description
varchar
instructor_name
int
max_students
nullable — null means unlimited
COURSE_CONTENTS
uuid
id
PK
uuid
course_id
FK
varchar
title
unique per course
enum
type
video, pdf, text
text
content_url_or_text
int
order
controls display sequence
CLASS_COURSE
uuid
class_id
FK
uuid
course_id
FK
Architecture
Route → Middleware → Controller → Service → Model → DB

Three route tiers:

Public — course listing and course detail, no auth required
Student — dashboard and content view; protected by auth middleware
Admin — full CRUD on all entities; protected by auth + IsAdmin middleware

Every admin entity follows the same layered pattern:

Controller — receives the HTTP request, delegates immediately, returns a response. Never touches the database directly.
Service — owns all business logic and database interaction.
Form Request — validates input before it reaches the controller. One class per action.
Model — Eloquent relationships and nothing else.
Enrollment Model

Students do not enroll in courses individually. A student belongs to a class, and a class is assigned a set of courses. Every student in that class automatically has access to every course assigned to it.

This reflects how schools actually work — a curriculum is assigned to a class, not chosen by individual students. The pivot table is class_course, a belongsToMany between SchoolClass and Course. Course access is determined by checking whether the student's class has that course assigned.

Key Decisions

UUID primary keys on all tables Auto-increment integer IDs expose the size of your dataset and make records trivially enumerable from the URL. UUIDs are random — /courses/550e8400-e29b-41d4-a716-446655440000 tells an attacker nothing.

Class-based course access The original design had students enrolling in courses individually. This was replaced because a class-based model matches the real-world mental model of a school — the admin assigns a curriculum to a class once, and every student in that class gets access automatically. The enrollments table was dropped and replaced with a class_course pivot.

Composite unique constraints at the database level Unique constraints live in the database, not just in Laravel validation. Laravel validation can be bypassed — the database cannot. Class names are unique per school (school_id, name). Content titles are unique per course (course_id, title). Class-course assignments are unique per pair (class_id, course_id).

Explicit cascade and nullOnDelete on every foreign key Every relationship defines its deletion behavior at the database level. Delete a school — its classes cascade. The students in those classes are not deleted; their class_id is set to null. Delete a course — its contents cascade and the class-course pivot rows cascade. Nothing relies on application logic to clean up after a delete.

Service layer A controller that touches the database directly cannot be tested without hitting the database, and its logic cannot be reused. The service layer owns all business logic. Controllers are thin request handlers.

Form Request classes Inline $request->validate() in controllers mixes validation with request handling. Each action has its own Form Request class — StoreSchoolRequest, UpdateCourseRequest, and so on. Validation is separated, reusable, and testable.

users table as the student entity Laravel Breeze scaffolds authentication against a users table. Maintaining a separate students table alongside it means duplicating auth logic or building a bridge between them. The is_admin flag on users is enough to distinguish the seeded admin from students. The class_id is nullable to accommodate the admin who belongs to no class.

Dedicated database user The application connects to MySQL with a dedicated user scoped to the edu_enroll database — not root. Root with no password is the XAMPP default and fine for a terminal session, but an application should never connect as root.

No indexes on foreign key columns The admin navigates hierarchically — always scoped to one school at a time, never querying all students system-wide. The largest realistic single query is one school's students, which MySQL handles with a full table scan in negligible time at this scale. Indexes on FK columns are the correct addition if cross-school reporting or system-wide filtering is added.

CSS in public/css/app.css Styles live in one file, not scattered across Blade templates as inline styles. One place to change a color, one place to update spacing. The design system — edu-card, edu-table, btn-accent, hero banners, icon boxes — is defined once and used everywhere.

Known Limitations

These are deliberate scope decisions matching the project brief, not oversights.

Open registration Any person can register and select any class with no verification. A production system would require admin-created accounts or invite tokens tied to a specific class.

No grade-level enforcement The course catalog is open — any class can be assigned any course regardless of grade level. A production system would restrict course assignment to matching grade levels.

max_students not enforced The column exists and displays in the UI but is not enforced in the class-based model — access is determined by class assignment, not a seat count. In a production system this would either be removed or repurposed as a cap on how many classes can be assigned a course simultaneously.

Single-tenant Each deployment serves one organisation (a school group managing 2–5 schools). The mental model is: one school group runs one instance, manages multiple schools, each with classes and students. A multi-tenant architecture with row-level scoping or database-per-tenant isolation is the natural next step for a SaaS version.

How to Run Locally

Requirements

PHP 8.2+
Composer
MySQL (XAMPP or standalone)
Node.js

Setup

bash
git clone https://github.com/yourusername/EduEnroll.git
cd EduEnroll
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate

Configure .env:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edu_enroll
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

Also set the admin seed credentials in .env:

env
ADMIN_NAME="Admin"
ADMIN_EMAIL="admin@eduentroll.com"
ADMIN_PASSWORD="your_admin_password"

Run migrations and seed:

bash
php artisan migrate --seed
php artisan serve

Open http://localhost:8000

Admin login Use the credentials you set in .env above.

Student login Register via /register and select your class from the dropdown.

Project Structure
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # SchoolController, ClassController,
│   │   │                   # StudentController, CourseController,
│   │   │                   # CourseContentController
│   │   └── Student/        # CourseController
│   ├── Middleware/
│   │   └── IsAdmin.php
│   └── Requests/           # Form Request classes per action
├── Models/                 # User, School, SchoolClass, Course,
│                           # CourseContent
└── Services/               # Business logic layer per entity

resources/views/
├── layouts/
│   └── app.blade.php       # Shared shell — navbar, flash, @yield
├── admin/                  # All admin views
└── student/                # All student views

public/css/    
└── app.css                 # Full design system