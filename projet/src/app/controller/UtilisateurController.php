<?php
namespace app\controller;
use app\model\Utilisateur;


class UtilisateurController extends Controller {
	
	public function afficherUser() {
	$users = Utilisateur::all();
		$this->app->view->setData('users', $users);
		$this->app->render('user.php');
	}
	
	//Ajax response example
	public function getUsers() {
		$users = Utilisateur::all();
		echo json_encode($users);
	}
	
	public function create() {
		// MODIFIER POUR AVOIR LE BON CODE
		$email =  json_decode($_POST['email']);
		$pass =  json_decode($_POST['pass']);
		$nom =  json_decode($_POST['nom']);
		$prenom =  json_decode($_POST['prenom']);
		$usr = User();
		$usr->email = $email;
		$usr->nom = $nom;
		$usr->password = $pass;
		$usr->prenom = $prenom;
		var_dump($usr);
		//$usr->save();
	}
/*
$app->post('/new', function() use($app, $db){
    $app->response()->header("Content-Type", "application/json");
    $car = $app->request()->post();
    $result = $db->utilisateur->insert($car);
    echo json_encode(array('id' => $result['id']));
});*/



	public function ajouterUser(){


	}
}
