<?php
namespace app\controller;
use app\model\Livre;
use app\model\Bibliotheque;
class LivreController extends Controller {
	
	public function afficherLivre() {
		$livres = Livre::all();
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