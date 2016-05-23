<?php
namespace app\controller;
use app\model\Livre;
use app\model\Bibliotheque;
class LivreController extends Controller {





	// fonction qui affiche tous les livres dans la table livre
	public function top10() { // juste pour afficher qques livres tant qu'on arrive pas la pagination
		//$livres = Livre::all()->sortBy('noteMoyenne')->take(10);
		$livres = Livre::all()->sortBy("noteMoyenne")->take(10);
		$this->app->view->setData('livres', $livres);
		$this->app->render('layout/header.php', compact('app'));
		$this->app->render('livre.php');
	}


	public function top10Json() { // juste pour afficher qques livres tant qu'on arrive pas la pagination
		//$livres = Livre::all()->whereInLoose('idLivre', [100,101,102,103,104,105,106,107,108,109,110,1941,156,5768,873,1235,87987,65,5468,46487,7868,7897,464,654,87,654,687]);
		$livres = Livre::all()->sortBy('note')->take(10);
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



	/**
	 * fonction qui va retourner les livres (en json)
	 * dans l'ur faut mettre /api/books?titre&auteur
	 */
	public function afficherLivreAuteurTitreJson(){

		// on récupère le tab de param dans l'url
		$tab = $this->app->request()->params();
		$tabIndice = array_keys($tab);
		$count = count($tab);

		/*echo "tabindice"."<br>";
		var_dump($tabIndice);

		echo "<br>"."tab"."<br>";
		var_dump($tab);*/

		$livres = Livre::all();

		/*for($i=0;$i< $count;$i++) {
			$livres->where($tabIndice[$i], 'like', $tab[$tabIndice[$i]]);
		}*/
		//var_dump($livres);

		//$livres = Livre::where('titre',  'like', '%'.$this->app->request()->params('titre').'%')->where('auteur', 'like', '%'.$this->app->request()->params('auteur').'%')->get();
		//$a = json_encode($livres);
		//$this->app->response->headers->set('Content-Type', 'application/json');
		//$this->app->response->body($a);


		if($count == 0){
			$livres = Livre::all()->take(20)->forpage(1,20);
			$a = json_encode($livres);
			$this->app->response->headers->set('Content-Type', 'application/json');
			$this->app->response->body($a);

		}else {
			$livres = Livre::where('titre', 'like', '%' . $this->app->request()->params('titre') . '%')->where('auteur', 'like', '%' . $this->app->request()->params('auteur') . '%')->get();
			$a = json_encode($livres);
			$this->app->response->headers->set('Content-Type', 'application/json');
			$this->app->response->body($a);
		}



	}


	/**
	 * fonction qui :
	 * affiche les livres normalement si on met pas de param dans l'url
	 * sinon ça affiche le resultat de recherche
	 */
	public function afficherLivreAuteurTitre(){
		//récupération des param passés dans l'url
		$tab = $this->app->request()->params();
		$tabIndice = array_keys($tab);
		$count = count($tab);

		// si on passe des param dans l'url alros on fait la query correspondant
		// sinon on affiche les livrse narmol
		if($count == 0){
			$livres = Livre::all()->take(20)->forpage(1,20);
			$this->app->view->setData('livres', $livres);
			$this->app->render('layout/header.php', compact('app'));
			$this->app->render('layout/recherche.php', compact('app'));
			$this->app->render('livre.php');
		}else {
			$livres = Livre::where('titre', 'like', '%' . $this->app->request()->params('titre') . '%')->where('auteur', 'like', '%' . $this->app->request()->params('auteur') . '%')->get();
			$this->app->view->setData('livres', $livres);
			$this->app->render('layout/header.php', compact('app'));
			$this->app->render('layout/recherche.php', compact('app'));
			$this->app->render('livre.php');
		}

	}



	/** fonction de recherche HARDCORE
	 *  celle qui est utilisée pour la barre de recherche
	 */
	public function afficherLivreAuteurTitreGenre(){
		//récupération des param passés dans l'url
		$tab = $this->app->request()->params();
		$tabIndice = array_keys($tab);
		$count = count($tab);

		// si on passe des param dans l'url alros on fait la query correspondant
		// sinon on affiche les livrse narmol
		if($count == 0){
			$livres = Livre::all()->take(20)->forpage(1,20);
			$this->app->view->setData('livres', $livres);
			$this->app->render('layout/header.php', compact('app'));
			$this->app->render('layout/recherche.php', compact('app'));
			$this->app->render('livre.php');
		}else {
			$livres = Livre::where('titre', 'like', '%' . $this->app->request()->params('titre') . '%')->where('auteur', 'like', '%' . $this->app->request()->params('auteur') . '%')->where('genre', 'like', '%' . $this->app->request()->params('genre') . '%')->get();
			$this->app->view->setData('livres', $livres);
			$this->app->render('layout/header.php', compact('app'));
			$this->app->render('layout/recherche.php', compact('app'));
			$this->app->render('livre.php');
		}
		
	}



	public function afficherLivreAuteurTitreGenreJson(){
		//récupération des param passés dans l'url
		$tab = $this->app->request()->params();
		$tabIndice = array_keys($tab);
		$count = count($tab);
		// si on passe des param dans l'url alros on fait la query correspondant
		// sinon on affiche les livrse narmol
		if($count == 0){
			$livres = Livre::all()->take(20)->forpage(1,20);
			$a = json_encode($livres);
			$this->app->response->headers->set('Content-Type', 'application/json');
			$this->app->response->body($a);
		}else {
			$livres = Livre::where('titre', 'like', '%' . $this->app->request()->params('titre') . '%')->where('auteur', 'like', '%' . $this->app->request()->params('auteur') . '%')->where('genre', 'like', '%' . $this->app->request()->params('genre') . '%')->get();
			$a = json_encode($livres);
			$this->app->response->headers->set('Content-Type', 'application/json');
			$this->app->response->body($a);
		}

	}











/*
	// utile pour la recherche
	public function afficherLivreRecherche(){
		$livres = Livre::where('titre',  'like', '%'.$this->app->request()->params('titre').'%')->where('auteur', 'like', '%'.$this->app->request()->params('auteur').'%')->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('layout/header.php', compact('app'));
		$this->app->render('layout/recherche.php', compact('app'));
		$this->app->render('livre.php');
	}
*/








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


	/**
	 * affiche le livre recherché via le mot clé (pas la recherche avancée)
	 */
	public function afficherLivreMotCle(){
		$livres = Livre::where('auteur', 'like', $this->app->request()->params('auteur'))->orWhere('titre', 'like', $this->app->request()->params('titre'));
		$this->app->view->setData('livres', $livres);
		$this->app->render('layout/header.php', compact('app'));
		$this->app->render('layout/recherche.php', compact('app'));
		$this->app->render('livre.php');
	}


	
	
	
	/**
	 * fonction pour consulter les details d'un livre
	 */
	public function consulterDetails($id){
		//$livre = Livre::where('idLivre', '=', $id);
		//echo $id;
		$livre = Livre::where('idLivre', '=', $id)->get();
		$this->app->view->setData('livre', $livre);
		$this->app->render('layout/header.php', compact('app'));
		$this->app->render('details.php', compact('app'));
	}




	public function consulterDetailsJson($id){
		$livre = Livre::where('idLivre', '=', $id)->get();
		$a = json_encode($livre);
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