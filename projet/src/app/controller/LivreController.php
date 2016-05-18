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