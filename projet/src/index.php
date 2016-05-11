<?php

require 'vendor/autoload.php';

/**
 * Connection on database with the Eloquent ORM
 */
try {
    $config = parse_ini_file('db.config.ini');
    $db = new Illuminate\Database\Capsule\Manager();
    if (!empty($config)) {
        $db->addConnection($config);
        $db->setAsGlobal();
        $db->bootEloquent();
    }

} catch (Exception $e) {
    $e->getMessage();
}

//Application Slim
$app = new \Slim\Slim(array(
	'debug' => true,
	'templates.path' => 'app/view',
	'mode' => 'development'
));

//Routing system
$router = new app\Router($app);

//get
$router->get('/', "app\Controller\HomeController@index");
$router->get('/fac', "app\Controller\FacController@afficherFac");
$router->get('/fac/users', "app\Controller\FacController@afficherUser")->name("users");
$router->get('/users', "app\Controller\FacController@getUsers");

//post
$router->post('/user/new', "app\Controller\FacController@create");

//ex
$app->get('/hello', function () {
    echo "Hello";
});

$app->render('layout/header.php', compact('app'));
$app->run();
$app->render('layout/footer.php', compact('app'));