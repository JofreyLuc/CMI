<?php
namespace app\controller;
use app\model\Livre;
use app\model\Bibliotheque;
class LivreController extends Controller {





	// fonction qui affiche tous les livres dans la table livre
	public function afficherLivre() { // juste pour afficher qques livres tant qu'on arrive pas la pagination
		$livres = Livre::all()->whereInLoose('idLivre', [100,101,102,103,104,105,106,107,108,109,110,1941,156,5768,873,1235,87987,65,5468,46487,7868,7897,464,654,87,654,687]);
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}


	public function afficherLivreJson() { // juste pour afficher qques livres tant qu'on arrive pas la pagination
		$livres = Livre::all()->whereInLoose('idLivre', [100,101,102,103,104,105,106,107,108,109,110,1941,156,5768,873,1235,87987,65,5468,46487,7868,7897,464,654,87,654,687]);
		$a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}







	// affiche un livre avec une id précise
	public function afficherLivreId($id){
		$livres = Livre::where('idLivre', $id)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}

	public function afficherLivreIdJson($id){
		$livres = Livre::where('idLivre', $id)->get();
		$a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}







	// affiche un livre avec un mot clé en recherche
	public function afficherLivreTitre($titre){
		$livres = Livre::where('titre', 'like', '%'.$titre.'%')->get();

			//->contains($titre)->get();
	//	$livres = Livre::where('titre', $titre)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}

	public function afficherLivreTitreJson($titre){
		$livres = Livre::where('titre', 'like', '%'.$titre.'%')->get();
		$a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}







	public function afficherLivreAuteur($auteur){
		$livres = Livre::where('auteur', 'like', '%'.$auteur.'%')->get();

		//->contains($titre)->get();
		//	$livres = Livre::where('titre', $titre)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}

	public function afficherLivreAuteurJson($auteur){
		$livres = Livre::where('auteur', 'like', '%'.$auteur.'%')->get();
		$a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}



	public function afficherLivreAuteurTitreJson(){
		//$livres = Livre::where('titre', 'like', $this->app->request()->params('titre'))->where('auteur', 'like', $this->app->request()->params('auteur'))->get();
		$livres = Livre::where('titre',  'like', '%'.$this->app->request()->params('titre').'%')->where('auteur', 'like', '%'.$this->app->request()->params('auteur').'%')->get();
		$a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}




	// affiche un livre recherché avec un auteur et un livre
	public function afficherLivreSpe($titre, $auteur){
		$livres = Livre::where('auteur', 'like', '%'.$auteur.'%')->where('titre', 'like', '%'.$titre.'%')->get();
		//->contains($titre)->get();
		//	$livres = Livre::where('titre', $titre)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}

	public function afficherLivreSpeJson($titre, $auteur){
		$livres = Livre::where('auteur', 'like', '%'.$auteur.'%')->where('titre', 'like', '%'.$titre.'%')->get();
		$a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}






	public function test0(){

		//$this->app->request()->params('id');
		//$this->app->request()->params('kaka');

		// on récupère le tab de param dans l'url
		$tab = $this->app->request()->params();
		$tabIndice = array_keys($tab);

		echo "tabindice"."<br>";
		var_dump($tabIndice);

		echo "<br>"."tab"."<br>";
		var_dump($tab);




		//echo count($tab);
		$livres = Livre::all();
		for($i=0;$i< count($tab);$i++){
			$livres->where($tabIndice[$i],'=',$tab[$tabIndice[$i]]);
			//echo $tabIndice[$i]." ".$tab[$i]."<br>";
		}
		
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}




	
	
	//Ajax response example
	public function getLivres() {
		$livres = Livre::all();
		echo json_encode($livres);
	}
	
	public function create() {
		// MODIFIER POUR AVOIR LE BON CODE
		/*$id =  json_decode($_POST['id']);
		$name =  json_decode($_POST['name']);
		$usr = User();
		$usr->id = $id;
		$usr->name = $name;
		$usr->save();*/
	}
}