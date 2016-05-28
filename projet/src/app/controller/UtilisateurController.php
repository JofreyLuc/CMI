<?php
namespace app\controller;
use app\model\Utilisateur;
use app\model\Livre;
use Illuminate\Contracts\Pagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;


class UtilisateurController extends Controller {


	/**
	 * affiche les utilisateurs
	 * pagination mise en place ici
	 *
	 */
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



	/**
	 * @param $id
	 * affiche un user identif par son id
	 */
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




	/**
	 * @param $idUser
	 * pour le moment on peut que modifier :
	 * nom, prenom, date naissance , sexe
	 */
	public function modifierUserIdJson($idUser){
		// recuperation des data sur la page
		$a = json_decode(file_get_contents('php://input'));

		// recuperation et modif de l'user
		$user = Utilisateur::where('idUtilisateur', $idUser)->update([
			'pseudo' => $a->pseudo,
			'nom' => $a->nom,
			'prenom' => $a->prenom,
			'dateNaissance' => $a->dateNaissance
		]);


		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->setStatus(204);
	}


	public function modifierUserId($idUser){
		// recuperation des data sur la page
		$a = json_decode(file_get_contents('php://input'));

		// recuperation et modif de l'user
		$user = Utilisateur::where('idUtilisateur', $idUser)->update([
			'pseudo' => $a->pseudo,
			'nom' => $a->nom,
			'prenom' => $a->prenom,
			'dateNaissance' => $a->dateNaissance
		]);


		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->setStatus(204);
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
        $SALT_MAX_LENGHT = 16;
        $intermediateSalt = str_replace('+', '.', base64_encode(md5(mt_rand(), true)));
        $salt = substr($intermediateSalt, 0, $SALT_MAX_LENGHT);
        $hash = hash("sha256", $psw . $salt);   // creates 256 bit hash.

		$usr = new Utilisateur();


		echo $age."<br>";
		echo $pseudo."<br>";
		echo $nom."<br>";
		echo $prenom."<br>";
		echo $mail."<br>";
		echo $psw."<br>";
		echo $hash."<br>";

		$usr->email = $mail;
		$usr->nom = $nom;
		$usr->password = $hash;
        $usr->salt = $salt;
		$usr->pseudo = $pseudo;
		$usr->prenom = $prenom;

		$usr->save();

		//$this->app->render('layout/header.php', compact('app'));
		$this->app->render('layout/inscription_validation.php', compact('app'));
	}

	/**
	 * Inscription en Json
	 */
	public function inscriptionVerificationJson(){
		$a = json_decode(file_get_contents('php://input'));
		$pseudo = $a->pseudo;
		$email = $a->email;
		$psw = $a->password;
		
		// Si conflit d'email -> 409
		if (Utilisateur::where('email', '=', $email)->exists()){
			$this->app->response->setStatus(409);
		} else {
			
			// encodage du psw
			$SALT_MAX_LENGHT = 16;
			$intermediateSalt = str_replace('+', '.', base64_encode(md5(mt_rand(), true)));
			$salt = substr($intermediateSalt, 0, $SALT_MAX_LENGHT);
			$hash = hash("sha256", $psw . $salt);   // creates 256 bit hash.

			$user = new Utilisateur();
			$user->pseudo = $pseudo;
			$user->email = $email;
			$user->salt = $salt;
			$user->password = $hash;
			
			$user->save();
			
			$userResponse = $user;
			unset($userResponse->salt);
			unset($userResponse->password);
			$r = json_encode($userResponse);
			
			$this->app->response->headers->set('Content-Type', 'application/json');
			$this->app->response->body($r);
			$this->app->response->setStatus(201);
		}
	}
	
	/**
	 * Connexion Json
	 */
	public function connexionJson(){
		$a = json_decode(file_get_contents('php://input'));
		$email = $a->email;
		$psw = $a->password;
	
		$userCol = Utilisateur::where('email', '=', $email)->get();
		if ($userCol->isEmpty()){
			// Utilisateur inconnu
			$this->app->response->setStatus(401);
		} else {
			$user = $userCol->first();
			
			// encodage du psw
			$hash = hash("sha256", $psw . $user->salt);   // creates 256 bit hash.
			
			if ($hash == $user->password) {
				// Infos de connexion valides
				unset($user->salt);
				unset($user->password);
				$r = json_encode($user);
				$this->app->response->headers->set('Content-Type', 'application/json');
				$this->app->response->body($r);
			} else {
				// Mauvais password
				$this->app->response->setStatus(401);
			}
		}
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
