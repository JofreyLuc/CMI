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
$router->get('/users', "app\Controller\UtilisateurController@afficherUser");
$router->get('/users1', "app\Controller\UtilisateurController@getUsers");
$router->get('/books', "app\Controller\LivreController@afficherLivre");
$router->get('/bibliotheque', "app\Controller\BibliothequeController@afficherBibliotheque");
$router->get('/peupler', "app\Controller\UtilisateurController@peuplerBDD");


// routes pour les requetes de recherche sur user
$router->get('/users/:id', "app\Controller\UtilisateurController@afficherUserId");


// routes pour les requetes de recherche sur livre
$router->get('/books/:id', "app\Controller\LivreController@afficherLivreId")->conditions(array('id' => '[0-9]*')); // faut que l'id soit un nombre 
$router->get('/books/:titre', "app\Controller\LivreController@afficherLivreTitre");
$router->get('/books/:auteur', "app\Controller\LivreController@afficherLivreAuteur");


$router->get('/books/:titre/:auteur', "app\Controller\LivreController@afficherLivreSpe");



//$router->get('/books?titre:titre&auteur:auteur' ,"app\Controller\LivreController@test");

$router->get('/testJ', "app\Controller\UtilisateurController@getUsers");



//appel test commentaire
$router->get('/test0', "app\Controller\UtilisateurController@test0");




// test
//
/*
$app->get('/test1', function () use($app){
   
    echo 'aze';
    echo $app->request()->params('id');
    echo $app->request()->params('kaka');
     $afficheLivre = new \app\controller\UtilisateurController($this->app);
     $afficheLivre->test();

    
});
*/


/*


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