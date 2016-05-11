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
$router->get('/users', "app\Controller\UtilisateurController@afficherUser")->name("users");
//$router->get('/users', "app\Controller\UtilisateurController@getUsers");
$router->get('/livres', "app\Controller\LivreController@afficherLivre");
//post
$router->post('/user/new', "app\Controller\UtilisateurController@create");

//ex
$app->get('/hello', function () {
    echo "Hello";
});

$app->render('layout/header.php', compact('app'));
$app->run();
$app->render('layout/footer.php', compact('app'));