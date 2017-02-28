<?php
    class Student
    {
        private $student_name;
        private $major;
        private $id;

        function __construct($student_name, $major, $id = null)
        {
            $this->student_name = $student_name;
            $this->major = $major;
            $this->id = $id;
        }

        function setStudentName($new_name)
        {
            $this->student_name = (string) $new_name;
        }

        function getStudentName()
        {
            return $this->student_name;
        }

        function setMajor($new_major)
        {
            $this->major = (string) $new_major;
        }

        function getMajor()
        {
            return $this->major;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (student_name, major) VALUES ('{$this->getstudentName()}', '{$this->getMajor()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach ($returned_students as $student) {
                $student_name = $student['student_name'];
                $major = $student['major'];
                $id = $student['id'];
                $new_student = new Student($student_name, $major, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }

        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach ($students as $student) {
                $student_id = $student->getId();
                if ($student_id == $search_id) {
                    $found_student = $student;
                }
            }
            return $found_student;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE students SET student_name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setstudentName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE course_id = {$this->getId()};");
        }
    }
?>
