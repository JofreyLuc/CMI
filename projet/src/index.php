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
$router->get('/users1', "app\Controller\UtilisateurController@getUsers");
$router->get('/livres', "app\Controller\LivreController@afficherLivre");
$router->get('/bibliotheque', "app\Controller\BibliothequeController@afficherBibliotheque");
$router->get('/test', "app\Controller\UtilisateurController@ajouterUser");

//post
//$router->post('/user/new', "app\Controller\UtilisateurController@create");


// Add


/*
$app->post('/new', function() use($app, $db){
    $app->response()->header("Content-Type", "application/json");
    $car = $app->request()->post();
    $result = $db->utilisateur->insert($car);
    echo json_encode(array('id' => $result['id']));
});
*/


// Update
/*
$app->put('/car/:id', function($id) use($app, $db){
    $app->response()->header("Content-Type", "application/json");
    $car = $db->utilisateur();//->where("id", $id);
    if ($car->fetch()) {
        $post = $app->request()->put();
        $result = $car->update($post);
        echo json_encode(array(
            "status" => (bool)$result,
            "message" => "Car updated successfully"
        ));
    }
    else{
        echo json_encode(array(
            "status" => false,
            "message" => "Car id $id does not exist"
        ));
    }
});
*/




//ex
$app->get('/hello', function () {
    echo "Hello";
});

$app->render('layout/header.php', compact('app'));
$app->run();
//$app->render('layout/footer.php', compact('app'));