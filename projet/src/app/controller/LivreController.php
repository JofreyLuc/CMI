<?php
namespace app\controller;
use app\model\Livre;
use app\model\Bibliotheque;
use app\model\Evaluation;
use app\model\Utilisateur;

class LivreController extends Controller
{


	// fonction qui affiche tous les livres dans la table livre
	public function top10()
	{ // juste pour afficher qques livres tant qu'on arrive pas la pagination
		//$livres = Livre::all()->sortBy('noteMoyenne')->take(10);
		$livres = Livre::orderBy('noteMoyenne', SORT_DESC)->take(10)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('header.php', compact('app'));
		$this->app->render('livre.php');
	}


	public function top10Json()
	{ // juste pour afficher qques livres tant qu'on arrive pas la pagination
		//$livres = Livre::all()->whereInLoose('idLivre', [100,101,102,103,104,105,106,107,108,109,110,1941,156,5768,873,1235,87987,65,5468,46487,7868,7897,464,654,87,654,687]);
		$livres = Livre::orderBy('noteMoyenne', SORT_DESC)->take(10)->get();
		$a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);


	}


	// affiche un livre avec une id précise
	public function afficherLivreId($id)
	{
		$livres = Livre::where('idLivre', $id)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}

	public function afficherLivreIdJson($id)
	{
		$livre = Livre::find($id);
		$this->app->response->headers->set('Content-Type', 'application/json');
		if (isset($livre))
			$this->app->response->body(json_encode($livre));
	}


	// affiche un livre avec un mot clé en recherche
	public function afficherLivreTitre($titre)
	{
		$livres = Livre::where('titre', 'like', '%' . $titre . '%')->get();

		//->contains($titre)->get();
		//	$livres = Livre::where('titre', $titre)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}

	public function afficherLivreTitreJson($titre)
	{
		$livres = Livre::where('titre', 'like', '%' . $titre . '%')->get();
		$a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}


	public function afficherLivreAuteur($auteur)
	{
		$livres = Livre::where('auteur', 'like', '%' . $auteur . '%')->get();

		//->contains($titre)->get();
		//	$livres = Livre::where('titre', $titre)->get();
		$this->app->view->setData('livres', $livres);
		$this->app->render('livre.php');
	}

	public function afficherLivreAuteurJson($auteur)
	{
		$livres = Livre::where('auteur', 'like', '%' . $auteur . '%')->get();
		$a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}


	/**
	 * fonction qui va retourner les livres (en json)
	 * dans l'ur faut mettre /api/books?titre&auteur
	 */
	public function afficherLivreAuteurTitreJson()
	{

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


		if ($count == 0) {
			$livres = Livre::all()->take(20)->forpage(1, 20);
			$a = json_encode($livres);
			$this->app->response->headers->set('Content-Type', 'application/json');
			$this->app->response->body($a);

		} else {
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
	public function afficherLivreAuteurTitre()
	{
		//récupération des param passés dans l'url
		$tab = $this->app->request()->params();
		$tabIndice = array_keys($tab);
		$count = count($tab);

		// si on passe des param dans l'url alros on fait la query correspondant
		// sinon on affiche les livrse narmol
		if ($count == 0) {
			$livres = Livre::all()->take(20)->forpage(1, 20);
			$this->app->view->setData('livres', $livres);
			$this->app->render('header.php', compact('app'));
			$this->app->render('recherche.php', compact('app'));
			$this->app->render('livre.php');
		} else {
			$livres = Livre::where('titre', 'like', '%' . $this->app->request()->params('titre') . '%')->where('auteur', 'like', '%' . $this->app->request()->params('auteur') . '%')->get();
			$this->app->view->setData('livres', $livres);
			$this->app->render('header.php', compact('app'));
			$this->app->render('recherche.php', compact('app'));
			$this->app->render('livre.php');
		}

	}


	/** fonction de recherche HARDCORE
	 *  celle qui est utilisée pour la barre de recherche
	 */
	public function afficherLivreAuteurTitreGenre()
	{
		//récupération des param passés dans l'url
		$tab = $this->app->request()->params();
		$tabIndice = array_keys($tab);
		$count = count($tab);

		// si on passe des param dans l'url alros on fait la query correspondant
		// sinon on affiche les livrse narmol
		if ($count == 0) {
			/*
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
            */

			//$count = Livre::all()->count();
			//$page = 1;
			//$parPage = 10;
			//$total = ceil($count / $parPage);

			$livres = Livre::all()->take(10);//->forpage($this->app->request()->params('page'), $parPage);
			// On récupère toutes les langues possibles
			$langues = Livre::select('langue')->distinct('langue')->get()->toArray();

			// On post tout sur la page pour faire la pagination
			//$this->app->view->setData('count', $count);
			//$this->app->view->setData('page', $page);
			//$this->app->view->setData('parPage', $parPage);
			//$this->app->view->setData('total', $total);
			// on post les informations des livres
			$this->app->view->setData('livres', $livres);
			$this->app->view->setData('langues', $langues);
			$this->app->render('header.php', compact('app'));
			$this->app->render('recherche.php', compact('app'));
			$this->app->render('livre.php');
		} else {
			//$count = Livre::all()->count();
			//$page = 1;
			//$parPage = 10;
			//$total = ceil($count / $parPage);

			//echo $this->app->request()->params('page')."</br>";

			$livres = Livre::where('titre', 'like', '%' . $this->app->request()->params('titre') . '%')->where('auteur', 'like', '%' . $this->app->request()->params('auteur') . '%')->where('genre', 'like', '%' . $this->app->request()->params('genre') . '%')->where('langue', 'like', '%' . $this->app->request()->params('langue') . '%')->get();//->forpage($this->app->request()->params('page'), $parPage);

			// On récupère toutes les langues possibles
			// On post tout sur la page pour faire la pagination
			//$this->app->view->setData('count', $count);
		//	$this->app->view->setData('page', $page);
			//$this->app->view->setData('parPage', $parPage);
			//$this->app->view->setData('total', $total);
			// on envoie le livre et les langues
			$langues = Livre::select('langue')->distinct('langue')->get()->toArray();
			$this->app->view->setData('livres', $livres);
			$this->app->view->setData('langues', $langues);
			$this->app->render('header.php', compact('app'));
			$this->app->render('recherche.php', compact('app'));
			$this->app->render('livre.php');
		}

	}



	/**
	 * fonction de test de la recherche
	 */
	public function recherche(){
		$tab = $this->app->request()->params();
		$count = count($tab);

		if ($count == 0) {
			$livres = Livre::all()->take(10);
			$langues = Livre::select('langue')->distinct('langue')->get()->toArray();

			$this->app->view->setData('livres', $livres);
			$this->app->view->setData('langues', $langues);

			$this->app->render('header.php', compact('app'));
			$this->app->render('recherche.php', compact('app'));
			$this->app->render('livre.php');
		}else{

			$livres = Livre::where('titre', 'like', '%' . $this->app->request()->params('titre') . '%')->where('auteur', 'like', '%' . $this->app->request()->params('auteur') . '%')->where('genre', 'like', '%' . $this->app->request()->params('genre') . '%')->get();//->where('langue', 'like', '%' . $this->app->request()->params('langue') . '%')->get();//->forpage($this->app->request()->params('page'), $parPage);
			$langues = Livre::select('langue')->distinct('langue')->get()->toArray();

			$this->app->view->setData('livres', $livres);
			$this->app->view->setData('langues', $langues);

			$this->app->render('header.php', compact('app'));
			$this->app->render('recherche.php', compact('app'));
			$this->app->render('livre.php');
		}



	}









	public function afficherLivreAuteurTitreGenreJson()
	{
		//récupération des param passés dans l'url
		$tab = $this->app->request()->params();
		$tabIndice = array_keys($tab);
		$count = count($tab);
		// si on passe des param dans l'url alros on fait la query correspondant
		// sinon on affiche les livrse narmol
		if ($count == 0) {
			$livres = Livre::all()->take(20)->forpage(1, 20);
		} else {
			$livres = Livre::where('titre', 'like', '%' . $this->app->request()->params('titre') . '%')->orWhere('auteur', 'like', '%' . $this->app->request()->params('auteur') . '%')->orWhere('genre', 'like', '%' . $this->app->request()->params('genre') . '%')->where('langue', 'like', '%' . $this->app->request()->params('langue') . '%')->get();
		}
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




	
	
	
	/**
	 * fonction pour consulter les details d'un livre
	 */
	public function consulterDetails($id){
		//$livre = Livre::where('idLivre', '=', $id);
		//echo $id;
		$livre = Livre::where('idLivre', '=', $id)->get();

		$this->app->view->setData('livre', $livre);
		$this->app->render('header.php', compact('app'));
		$this->app->render('details.php', compact('app'));
	}




	public function consulterDetailsJson($id){
		$livre = Livre::find($id);
		$a = json_encode($livre);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);
	}


	
	public function lectureLivre($id){
		$livre = Livre::where('idLivre', '=', $id)->get();
		$this->app->view->setData('livre', $livre);
		$this->app->render('header.php', compact('app'));
		$this->app->render('lecture.php', compact('app'));
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