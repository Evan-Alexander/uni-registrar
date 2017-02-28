<?php
date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Course.php";
    require_once __DIR__."/../src/Student.php";


    use Symfony\Component\Debug\Debug;
    Debug::enable();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();
    $app['debug']=true;


    $server = 'mysql:host=localhost:8889;dbname=university';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/courses", function() use ($app) {
        $new_course = new Course($_POST['course_name'], $id = null);
        $new_course->save();
        return $app['twig']->render('show-courses.html.twig', array('courses' => Course::getAll()));
    });

    $app->get("/delete", function() use ($app) {
        Course::getAll();
        Course::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/delete", function() use ($app) {
        Course::getAll();
        Course::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/add-students/{id}", function($id) use ($app) {
        $course = Course::find($id);
        return $app['twig']->render("show-students.html.twig", array('course' => $course, 'courses' => Course::getAll(), 'students'=> Student::getAll()));
    });

    $app->post("/student-list/{id}", function($id) use ($app) {
        $course = Course::find($id);
        $new_student = new Student($_POST['student-name'], $_POST['major'], null);
        $new_student->save();
        return $app['twig']->render("show-students.html.twig", array('course' => $course, 'courses' => Course::getAll(), 'students'=> Student::getAll()));
    });

    return $app;
?>
