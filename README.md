# **University Registar**
#### Jason Brown, Sarah Leahy 2/28/2017

&nbsp;
## Description
An app for a university registrar to add students, courses and departments.

&nbsp;
## Database Setup
CREATE DATABASE university;
USE university;
CREATE TABLE students (id serial PRIMARY KEY, student_name VARCHAR (255), majot VARCHAR(255));

CREATE TABLE courses (id serial PRIMARY KEY, course_name VARCHAR(255));
&nbsp;
## Specifications

|Behavior|Input 1|Output|
|--------|-------|------|
| Input student name . | "Jane" | "Jane" |
| Inputs another student name. | "Mary" | " Jane", "Mary" |
| Delete all students. | 'delete' | " " |
| Inputs a course | "Math" | "Math"|
| Search for students in a course|Course Id = 1|Students, 1,5,7|
| Search for courses by department| Department Id = 2| Courses = 2,6,7|
| deletes a course | "Math" | " " |
| deletes all courses. | 'delete' | " " |


&nbsp;
## Setup/Installation Requirements
##### _To view and use this application:_
* You will need the dependency manager Composer installed on your computer to use this application. Go to [getcomposer.org] (https://getcomposer.org/) to download Composer for free.
* Go to my [Github repository] (https://github.com/Brendangrubb/animal_shelter)
* Download the zip file via the green button
* Unzip the file and open the **_university-master_** folder
* Open Terminal, navigate to **_university-master_** project folder, type **_composer install_** and hit enter
* Navigate Terminal to the **_university-master/web_** folder and set up a server by typing **_php -S localhost:8000_**
* Type **_localhost:8000_** into your web browser
* The application will load and be ready to use!

&nbsp;
## Known Bugs
* No known bugs

&nbsp;
## Technologies Used
* PHP
* Silex
* SQL
* Apache
* Twig
* PHPUnit
* Composer
* Bootstrap
* CSS
* HTML



Copyright (c) 2017 Jason Brown, Sarah Leahy

This software is licensed under the GPL license
