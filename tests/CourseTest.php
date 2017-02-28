<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    //
    require_once "src/Student.php";
    require_once "src/Course.php";

    $server = 'mysql:host=localhost:8889;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class courseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
        }

        function test_setCourseName()
        {
            $course_name = "Math";
            $id = null;
            $new_course_name = new Course($course_name, $id);
            $replacement_course_name = "Science";

            $new_course_name->setCourseName($replacement_course_name);
            $result = $new_course_name->getCourseName();

            $this->assertEquals($replacement_course_name, $result);
        }

        function test_getCourseName()
        {
            $course_name = "Math";
            $id = null;
            $new_course_name = new Course($course_name, $id);

            $result = $new_course_name->getCourseName();

            $this->assertEquals($course_name, $result);
        }

        function test_getCourseId()
        {
            //Arrange
            $student_name = "Penny";
            $major = "Math";
            $id = null;
            $test_student = new Student($student_name, $major, $id);
            $test_student->save();

            $course = "Math";
            $test_course = new Course($course, $id);
            $test_course->save();
            //Act
            $result = $test_course->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }


        function test_save()
        {
            //Arrange
            $student_name = "Penny";
            $major = "Math";
            $id = 2;
            $test_student = new Student($student_name, $major, $id);
            $test_student->save();

            $course = "Math";
            $test_course = new Course($course, $id);

            //Act
            $test_course->save();
            //Assert
            $result = Course::getAll();


            $this->assertEquals($test_course, $result[0]);
        }

        function test_deleteAll()
        {
            //Arrange
            $student_name = "Penny";
            $major = "Math";
            $id = 2;
            $test_student = new Student($student_name, $major, $id);
            $test_student->save();

            $course = "Math";
            $test_course = new Course($course,$id);
            $test_course->save();

            $course2 = "Science";
            $test_course2 = new Course($course2, $id);
            $test_course2->save();
            //Act
            Course::deleteAll();
            //Assert
            $result = Course::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $course = "Science";
            $id = null;
            $test_course = new Course($course, $id);
            $test_course->save();

            $result = Course::find($test_course->getId());

            $this->assertEquals($test_course, $result);

        }

        function test_update()
        {
            $course_name = "Science";
            $id = 1;
            $new_course = new Course($course_name, $id);
            $new_course->save();
            $replacement_name = "Math";
            $replacement_course_id = 3;
            $replacement_course = new Course($replacement_name, $replacement_course_id);
            $replacement_course->save();

            $new_course->update($replacement_name);

            $result = array($result_name = $new_course->getCourseName());

            $comparison = array($comparison_name = $replacement_course->getCourseName());

            $this->assertEquals($comparison, $result);
        }

        function test_deleteCourse()
        {
            $course_name = "Math";
            $id = 4;
            $new_course = new Course($course_name, $id);
            $new_course->save();

            $new_course->deleteCourse();
            $result = Course::getAll();

            $this->assertEquals([], $result);
        }

        function testGetStudents()
        {
            //Arrange
            $course_name = "Basket Weaving";
            $id = 1;
            $test_course = new Course($course_name, $id);
            $test_course->save();

            $student_name = "Bob";
            $major = "Science";
            $id2 = 2;
            $test_student = new Student($student_name, $major, $id2);
            $test_student->save();

            $student_name = "Sam";
            $major = "Science";
            $id3 = 3;
            $test_student2 = new Student($student_name, $major, $id3);
            $test_student2->save();

            //Act
            $test_course->addStudent($test_student);
            $test_course->addStudent($test_student2);

            //Assert
            $this->assertEquals($test_course->getStudents(), [$test_student, $test_student2]);

        }

        function testDelete()
        {
            //Arrange
            $student_name = "Tom";
            $id = 1;
            $major = "math";
            $test_student = new Student($student_name, $id);
            $test_student->save();

            $course_name = "Math";
            $id = 2;
            $test_course = new Course($course_name, $id);
            $test_course->save();

            //Act
            $test_course->addStudent($test_student);
            $test_course->deletecourse();

            //Assert
            $this->assertEquals([], $test_student->getCourses());
        }
    }
?>
