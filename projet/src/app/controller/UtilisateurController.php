<?php
namespace app\controller;
use app\model\Utilisateur;
use app\model\Livre;
use Illuminate\Contracts\Pagination;


class UtilisateurController extends Controller {
	
	public function afficherUser() {


		$count= Utilisateur::all()->count();
		// nombre de data total
		$pages = 1; // nb de data par page a afficher (je veux 1 truc par page)
		$dataParPage = 20;
		$pageCourante = 1;
		$total = ceil($count/$dataParPage);

	//	$a = Utilisateur::query("SELECT * from utilisateur")->find(1);

		//$users = Utilisateur::all()->games()->take(3)->skip(2)->get();

		$users = Utilisateur::all();
		//$users = Utilisateur::where('idUtilisateur', 4)->get();
		$this->app->view->setData('users', $users);
		$this->app->render('user.php');
	}




	// fonction qui afficher l'user avec une certaine user
	public function afficherUserIds($id)
	{
		echo "id :".$id;
		$users = Utilisateur::where('idUtilisateur', $id)->get();
		$this->app->view->setData('users', $users);
		$this->app->render('user.php');

	}


	public function test(){
		echo 'coucoucocuocujc';
	}




		//Ajax response example
	public function getUsers() {
		$users = Utilisateur::all();
		echo json_encode($users);
	}
	
	public function create() {
		// MODIFIER POUR AVOIR LE BON CODE
		$email =  json_decode($_POST['email']);
		$pass =  json_decode($_POST['password']);
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



	public function peuplerBDD(){
		include 'scriptPeuplerBDD.php';
	}
}
