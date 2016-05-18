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



	// affiche un livre avec une id précise
	public function afficherLivreId($id){
		$livres = Livre::where('idLivre', $id)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}




	// affiche un livre avec un mot clé en recherche
	public function afficherLivreTitre($titre){
		$livres = Livre::where('titre', 'like', '%'.$titre.'%')->get();

			//->contains($titre)->get();
	//	$livres = Livre::where('titre', $titre)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}




	public function afficherLivreAuteur($auteur){
		$livres = Livre::where('auteur', 'like', '%'.$auteur.'%')->get();

		//->contains($titre)->get();
		//	$livres = Livre::where('titre', $titre)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}


	// affiche un livre recherché avec un auteur et un livre
	public function afficherLivreSpe($titre, $auteur){
		$livres = Livre::where('auteur', 'like', '%'.$auteur.'%')->where('titre', 'like', '%'.$titre.'%')->get();
		//->contains($titre)->get();
		//	$livres = Livre::where('titre', $titre)->get();
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