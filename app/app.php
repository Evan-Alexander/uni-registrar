<?php
date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";


    use Symfony\Component\Debug\Debug;
    Debug::enable();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();
    $app['debug']=true;


    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app) {

    $stylist = new Stylist($_POST['stylist_name']);
    $stylist->save();
    return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
    return $app['twig']->render('stylist.html.twig', array('stylists' => Stylist::find($id), 'clients' => Client::searchBystylist($id)));
    });

    $app->post("/client", function() use ($app) {
    $new_client = new Client ($_POST['client_name'], $_POST['stylist_id']);
    $new_client->save();
    return $app['twig']->render('stylist.html.twig', array('stylists' => Stylist::find($_POST['stylist_id']), 'clients' => Client::searchBystylist($_POST['stylist_id'])));
    });

    $app->get("/client-edit/{id}", function($id) use ($app) {
    return $app['twig']->render('client-editor.html.twig', array('client' => Client::find($id), 'stylists' => Stylist::getAll()));
    });

    $app->patch("/display-update", function() use ($app) {
        $current_client = Client::find($_POST['id']);
        $current_client->update($_POST['new-name'], $_POST['stylist_update']);
        return $app['twig']->render('stylist.html.twig', array('stylists' => Stylist::find($_POST['stylist_update']), 'clients' => Client::searchBystylist($_POST['stylist_update'])));
    });

    $app->delete("/delete_client/{id}", function($id) use ($app) {
        $client = Client::find($id);
        $client->deleteclient();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    return $app;
?>
