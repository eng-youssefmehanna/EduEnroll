<?php

use App\Models\School;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseContent;
use App\Models\Enrollment;
use Illuminate\Database\UniqueConstraintViolationException;

$passed = 0;
$failed = 0;

function test(string $description, callable $fn): void {
    global $passed, $failed;
    try {
        $fn();
        echo "PASS — {$description}\n";
        $passed++;
    } catch (\Throwable $e) {
        echo "FAIL — {$description}\n";
        echo "   " . $e->getMessage() . "\n";
        $failed++;
    }
}

function shouldFail(string $description, callable $fn): void {
    global $passed, $failed;
    try {
        $fn();
        echo "FAIL — {$description} (expected exception, got none)\n";
        $failed++;
    } catch (UniqueConstraintViolationException $e) {
        echo "PASS — {$description}\n";
        $passed++;
    } catch (\Throwable $e) {
        echo "FAIL — {$description} (wrong exception: " . $e->getMessage() . ")\n";
        $failed++;
    }
}

// =============================
// SETUP — seed test data
// =============================

$school1 = School::create(['name' => 'Nile Academy', 'address' => '123 Cairo St', 'phone' => '+201234567890']);
$school2 = School::create(['name' => 'Cairo Academy', 'address' => '456 Giza St', 'phone' => '+201111111111']);

$class1 = SchoolClass::create(['school_id' => $school1->id, 'name' => 'Class A', 'grade_level' => 'Grade 1']);
$class2 = SchoolClass::create(['school_id' => $school2->id, 'name' => 'Class A', 'grade_level' => 'Grade 1']);

$student1 = User::create(['name' => 'Ahmed Ali', 'email' => 'ahmed@test.com', 'password' => bcrypt('password'), 'class_id' => $class1->id, 'is_admin' => false]);
$student2 = User::create(['name' => 'Mohamed Ali', 'email' => 'mohamed@test.com', 'password' => bcrypt('password'), 'class_id' => $class2->id, 'is_admin' => false]);

$course = Course::create(['title' => 'Math 101', 'description' => 'Basic Math', 'instructor_name' => 'Mr. Eyad', 'max_students' => 30]);

$content1 = CourseContent::create(['course_id' => $course->id, 'title' => 'Introduction', 'type' => 'video', 'content_url_or_text' => 'https://youtube.com/test', 'order' => 1]);

$enrollment = Enrollment::create(['student_id' => $student1->id, 'course_id' => $course->id, 'enrolled_at' => now()]);

echo "\n=== CONSTRAINT TESTS ===\n\n";

shouldFail('Duplicate school name fails', function() {
    School::create(['name' => 'Nile Academy', 'address' => 'Other St', 'phone' => '+209999999999']);
});

shouldFail('Duplicate class name in same school fails', function() use ($school1) {
    SchoolClass::create(['school_id' => $school1->id, 'name' => 'Class A', 'grade_level' => 'Grade 2']);
});

test('Same class name in different school succeeds', function() use ($school2) {
    SchoolClass::create(['school_id' => $school2->id, 'name' => 'Class B', 'grade_level' => 'Grade 2']);
});

shouldFail('Duplicate email fails', function() use ($class1) {
    User::create(['name' => 'Ali Ahmed', 'email' => 'ahmed@test.com', 'password' => bcrypt('password'), 'class_id' => $class1->id, 'is_admin' => false]);
});

shouldFail('Duplicate enrollment fails', function() use ($student1, $course) {
    Enrollment::create(['student_id' => $student1->id, 'course_id' => $course->id, 'enrolled_at' => now()]);
});

shouldFail('Duplicate content title in same course fails', function() use ($course) {
    CourseContent::create(['course_id' => $course->id, 'title' => 'Introduction', 'type' => 'pdf', 'content_url_or_text' => 'https://test.com', 'order' => 2]);
});

echo "\n=== CASCADE / NULLONDELETE TESTS ===\n\n";

test('Delete school cascades to classes, students survive with null class_id', function() use ($school1, $student1) {
    $school1->delete();
    $classGone = SchoolClass::find($class1->id ?? $school1->id) === null;
    $student = User::find($student1->id);
    if (!$classGone) throw new \Exception('Classes not deleted');
    if ($student === null) throw new \Exception('Student was deleted — should have survived');
    if ($student->class_id !== null) throw new \Exception('Student class_id not set to null');
});

test('Delete class sets student class_id to null', function() use ($class2, $student2) {
    $class2->delete();
    $student = User::find($student2->id);
    if ($student === null) throw new \Exception('Student was deleted — should have survived');
    if ($student->class_id !== null) throw new \Exception('Student class_id not set to null');
});

test('Delete student cascades enrollments, course survives', function() use ($student1, $course) {
    $student1->delete();
    $enrollmentGone = Enrollment::where('student_id', $student1->id)->count() === 0;
    $courseExists = Course::find($course->id) !== null;
    if (!$enrollmentGone) throw new \Exception('Enrollments not deleted');
    if (!$courseExists) throw new \Exception('Course was deleted — should have survived');
});

test('Delete course cascades contents and enrollments, students survive', function() use ($course, $student2) {
    $course->delete();
    $contentsGone = CourseContent::where('course_id', $course->id)->count() === 0;
    $enrollmentsGone = Enrollment::where('course_id', $course->id)->count() === 0;
    $studentExists = User::find($student2->id) !== null;
    if (!$contentsGone) throw new \Exception('Contents not deleted');
    if (!$enrollmentsGone) throw new \Exception('Enrollments not deleted');
    if (!$studentExists) throw new \Exception('Student was deleted — should have survived');
});

echo "\n=== RELATIONSHIP TESTS ===\n\n";

$school3 = School::create(['name' => 'Test School', 'address' => '789 St', 'phone' => '+202222222222']);
$class3 = SchoolClass::create(['school_id' => $school3->id, 'name' => 'Class C', 'grade_level' => 'Grade 3']);
$student3 = User::create(['name' => 'Sara Ahmed', 'email' => 'sara@test.com', 'password' => bcrypt('password'), 'class_id' => $class3->id, 'is_admin' => false]);
$course2 = Course::create(['title' => 'Science 101', 'description' => 'Basic Science', 'instructor_name' => 'Mr. Ali', 'max_students' => null]);
$content2 = CourseContent::create(['course_id' => $course2->id, 'title' => 'Chapter 1', 'type' => 'pdf', 'content_url_or_text' => 'https://test.com/ch1', 'order' => 1]);
$content3 = CourseContent::create(['course_id' => $course2->id, 'title' => 'Chapter 2', 'type' => 'text', 'content_url_or_text' => 'Some text here', 'order' => 2]);
$enrollment2 = Enrollment::create(['student_id' => $student3->id, 'course_id' => $course2->id, 'enrolled_at' => now()]);

test('School hasMany classes', function() use ($school3, $class3) {
    $fresh = School::find($school3->id);
    $classes = $fresh->classes;
    if ($classes->count() != 1) throw new \Exception('Expected 1 class, got ' . $classes->count());
    if ($classes->first()->id != $class3->id) throw new \Exception('Wrong class returned');
});

test('SchoolClass hasMany students', function() use ($class3, $student3) {
    $fresh = SchoolClass::find($class3->id);
    $students = $fresh->students;
    if ($students->count() != 1) throw new \Exception('Expected 1 student, got ' . $students->count());
    if ($students->first()->id != $student3->id) throw new \Exception('Wrong student returned');
});

test('Course hasMany contents in order', function() use ($course2, $content2, $content3) {
    $fresh = Course::find($course2->id);
    $contents = $fresh->contents;
    if ($contents->count() != 2) throw new \Exception('Expected 2 contents, got ' . $contents->count());
    if ($contents->first()->id != $content2->id) throw new \Exception('Wrong order — first item incorrect');
    if ($contents->last()->id != $content3->id) throw new \Exception('Wrong order — last item incorrect');
});

test('User belongsToMany courses via enrollments', function() use ($student3, $course2) {
    $fresh = User::find($student3->id);
    $courses = $fresh->courses;
    if ($courses->count() != 1) throw new \Exception('Expected 1 course, got ' . $courses->count());
    if ($courses->first()->id != $course2->id) throw new \Exception('Wrong course returned');
});

test('Enrollment resolves student and course', function() use ($enrollment2, $student3, $course2) {
    $fresh = Enrollment::find($enrollment2->id);
    if ($fresh->student->id != $student3->id) throw new \Exception('Wrong student on enrollment');
    if ($fresh->course->id != $course2->id) throw new \Exception('Wrong course on enrollment');
});

echo "\n=== RESULTS ===\n\n";
echo "Passed: {$passed}\n";
echo "Failed: {$failed}\n\n";