<?php
namespace app\controller;

require('LivreController.php');



class HomeController extends Controller {
	
	public function index() {

		// affichage des livre sur la page d'accueil
		$afficheLivre = new LivreController($this->app);
		$afficheLivre->top10();




		//afficher les evaluations
		//$affichageEval = new EvaluationController($this->app);
		//$affichageEval->afficherEvaluation();



		//affichage des users
		//$affichageUser = new UtilisateurController($this->app);
		//$affichageUser->afficherUserPourAccueil();




		// affichage du test pour recup les user dans la bdd
		//var_dump(compact($this->app));
		//$this->app->view->setData(['app' => $this->app]);
		//$this->app->render('home.php');
	}





	public function condition(){
		$this->app->render('layout/header.php', compact('app'));
		$this->app->render('layout/condition_utilisation.php');
	}
}	