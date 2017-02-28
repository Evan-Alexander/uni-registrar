<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";
    require_once "src/Course.php";

    $server = 'mysql:host=localhost:8889;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class studentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();

        }

        function test_setStudentName()
        {
            $student_name = "Fester";
            $major = "Math";
            $id = 1;
            $new_name = new Student($student_name, $major, $id);
            $new_student_name = "Derrick";

            $new_name->setStudentName($new_student_name);
            $result = $new_name->getStudentName();

            $this->assertEquals($new_student_name, $result);
        }
        function test_getStudentName()
        {
            $student_name = "Fester";
            $major = "Math";
            $id = 1;
            $new_name = new Student($student_name, $major, $id);

            $result = $new_name->getStudentName();

            $this->assertEquals($student_name, $result);
        }

        function test_getId()
        {
            $student_name = "Fred";
            $id =1;
            $major = "Math";
            $test_student = new Student($student_name, $major, $id);

            $result = $test_student->getId();


            $this->assertEquals(1, $result);
        }

        function test_Save()
        {
            $student_name = "Dan";
            $major = "Math";
            $test_student = new Student($student_name, $major);
            $test_student->save();

            $result = Student::getAll();

            $this->assertEquals($test_student, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $student_name = "Bob";
            $major = "Math";
            $id = 1;
            $test_student = new Student($student_name, $major, $id);
            $test_student->save();

            $student_name2 = "Roy";
            $major2 = "Math";
            $id = 2;
            $test_student2 = new Student($student_name2, $major2, $id);
            $test_student2->save();
            //Act
            $result = Student::getAll();
            //Assert
            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function test_deleteAll()
        {
            $student_name = "Frank";
            $major = "Math";
            $test_student = new Student($student_name, $major);
            $test_student->save();
            $student_name2 = "Hank";
            $major2 = "Math";
            $test_student2 = new Student($student_name2, $major2);
            $test_student->save();

            Student::deleteAll();
            $result = Student::getAll();

            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $name = "Marsha";
            $major = "Math";
            $test_student = new Student($name, $major);

            $test_student->save();

            $result = Student::find($test_student->getId());

            $this->assertEquals($test_student, $result);
        }

        function test_update()
        {
            $student_name = "Jaime";
            $major = "Math";
            $test_student = new Student($student_name, $major);
            $test_student->save();
            $replacement_name = "Margie";

            $test_student->update($replacement_name);
            $result = $test_student->getStudentName();

            $this->assertEquals($replacement_name, $result);
        }

        function test_deletebyID()
        {
            $student_name = "Jim";
            $major = "Math";
            $test_student= new Student($student_name, $major);
            $test_student->save();

            $course_name = "Science";
            $student_id = $test_student->getId();
            $id = 1;
            $new_course = new Course($course_name, $student_id, $id);
            $new_course->save();

            $course_name2 = "Math";
            $student_id2 = 23;
            $id2 = 3;
            $new_course2 = new Course($course_name2, $student_id2, $id2);
            $new_course2->save();

            $test_student->delete();
            $result = Course::getAll();

            $this->assertEquals(array($new_course,$new_course2), $result);
        }

        function testGetCourses()
        {
            //Arrange
            $name = "Tom";
            $id = 5;
            $major = "math";
            $test_student = new Student($name, $major, $id);
            $test_student->save();

            $course_name = "Math";
            $id = 2;
            $test_course = new Course($course_name, $id);
            $test_course->save();

            $course_name2 = "Science";
            $id2 = 3;
            $test_course2 = new Course($course_name2, $id2);
            $test_course2->save();

            //Act
            $test_student->addCourse($test_course);
            $test_student->addCourse($test_course2);

            //Assert
            // var_dump("This is whats whats actually happening");
            // var_dump($test_student->getCourses());
            // var_dump("This is expected");
            // var_dump([$test_course, $test_course2]);
            $this->assertEquals([$test_course, $test_course2], $test_student->getCourses());
        }

                function testDelete()
        {
            //Arrange
            $student_name = "George";
            $id = 1;
            $major = "Math";
            $test_student = new Student($student_name, $major, $id);
            $test_student->save();

            $course_name = "History";
            $id = 2;
            $test_course = new Course($course_name, $id);
            $test_course->save();

            //Act
            $test_student->addCourse($test_course);
            $test_student->delete();

            //Assert
            $this->assertEquals([], $test_course->getStudents());
        }

    }
?>
