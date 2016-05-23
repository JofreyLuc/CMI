<?php
namespace app\controller;
use app\model\Utilisateur;
use app\model\Livre;
use Illuminate\Contracts\Pagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;


class UtilisateurController extends Controller {


	public function afficherUser() {


		$count= Utilisateur::all()->count();
		$page = 1; // nb de data par page a afficher (je veux 1 truc par page)
		$parPage = 2;
		$total = ceil($count/$parPage);
		$users = Utilisateur::all()->forPage($this->app->request()->params('page'),$parPage);


		// on envoie le compte total de data pour la preparation à la pagination
		$this->app->view->setData('count',$count);
		$this->app->view->setData('page',$page);
		$this->app->view->setData('parPage',$parPage);
		$this->app->view->setData('total',$total);


		$this->app->view->setData('users', $users);
		$this->app->render('layout/header.php', compact('app'));
		$this->app->render('user.php');
	}





	function afficherUserPourAccueil(){
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
	public function afficherUserId($id)
	{
		//$this->app->render('layout/header.php', compact('app'));
		$users = Utilisateur::where('idUtilisateur', $id)->get();
		$this->app->view->setData('users', $users);
		$this->app->render('user_recherche_id.php');

	}




	public function afficherUserIdJson($id)
	{
		//$this->app->render('layout/header.php', compact('app'));
		$users = Utilisateur::where('idUtilisateur', $id)->get();
		$a = json_encode($users);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}



	public function test0(){

		//$this->app->request()->params('id');
		//$this->app->request()->params('kaka');

		// on récupère le tab de param dans l'url
		$tab = $this->app->request()->params();
		$tabIndice = array_keys($tab);
		$count = count($tab);

		//echo "tabindice"."<br>";
		//var_dump($tabIndice);

		//echo "<br>"."tab"."<br>";
		//var_dump($tab);




		//echo count($tab);
		$users = Utilisateur::all();
		$clone = $users;
		/*for($i=0;$i< count($tab);$i++){
			//echo "tabindice de i :".$tabIndice[$i];
			//echo "     ".$tab[$tabIndice[$i]];
			$users->where($tabIndice[$i],'like',$tab[$tabIndice[$i]]);
			//var_dump($users);
			//echo $tabIndice[$i]." ".$tab[$i]."<br>";
		}*/


		//$users = Utilisateur::where('pseudo',  'like', '%'.$this->app->request()->params('pseudo').'%')->where('nom', 'like', '%'.$this->app->request()->params('nom').'%')->get();

		// on encode nos données
		// deux fonctions le font :
		//var_dump($users);
		$reponse = json_encode($users);
		//$a = $users->toJson();
		//var_dump($reponse);


		//echo $this->getUsers();
		//echo $this->app->request->getBody();

		//echo $this->getUsers();//->getBody();//->app->response->getBody();


		//$this->app->response->headers->set('Content-Type', 'text/html');

		$caca = $this->getUsers();


		//var_dump($caca);

/*

		$this->app->view->setData('users', $caca);//$this->getUsers());

		$this->app->render('layout/header.php', compact('app'));

		$this->app->render('user.php');*/
	}


	/**
	 * fonction qui affiche le formulaire d'inscription
	 */
	public function afficherInscription(){


		$this->app->render('layout/header.php', compact('app'));

		$this->app->render('layout/inscription.php');
	}


	/**
	 * fonction qui est appelée lors de l'envoie de l'inscription
	 * va effectuer des verifs puis insertion en cas de date OK
	 */
	public function inscriptionVerification(){
		$pseudo = $_POST['pseudo'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$age = $_POST['age'];
		$mail = $_POST['email'];
		$psw = $_POST['psw'];

		// encodage du psw
		$hach = md5($psw);
		$usr = new Utilisateur();


		echo $age."<br>";
		echo $pseudo."<br>";
		echo $nom."<br>";
		echo $prenom."<br>";
		echo $mail."<br>";
		echo $psw."<br>";
		echo $hach."<br>";

		/*//$hach = mb_detect_encoding($psw);
		echo $hach;
		//$decode = mcrypt_decrypt($hach);
		$decode = md5($hach);
		echo $decode;
*/


		$usr->email = $mail;
		$usr->nom = $nom;
		$usr->password = $hach;
		$usr->pseudo = $pseudo;
		$usr->prenom = $prenom;

		$usr->save();

		//$this->app->render('layout/header.php', compact('app'));
		$this->app->render('layout/inscription_validation.php', compact('app'));
	}


	/**
	 * fonction pour la consultation de son profil
	 */
	public function consulterSonProfil(){

	}









	public function oui(){

	}



		//Ajax response example
	public function getUsers() {
		//$users = Utilisateur::where('pseudo', 'like', 'USER1')->get();
		$users = Utilisateur::all();
		//$this->app->header("Content-Type: application/json");




		$a = json_encode($users);


		//echo $this->app->response->headers->get('Content-Type');
		$this->app->response->headers->set('Content-Type', 'application/json');


		//var_dump( $a);

		$this->app->response->body($a);//->write($a);
		//$this->app->request->post($a);


		//echo $a;
		//return $a;
		//exit;
		//die;
	}




	/*
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
	}*/



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
