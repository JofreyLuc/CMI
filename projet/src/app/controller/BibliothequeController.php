<?php
namespace app\controller;
use app\model\Bibliotheque;
use app\model\Livre;

class BibliothequeController extends Controller {

    

    // fonction qui affiche tous les livres presents dans notre biblio perso
    public function afficherBibliotheque() {
        $this->app->render('layout/header.php', compact('app'));


        // on récupère tous les livres de la biblio -----> c'est des ID
        $biblio = Bibliotheque::all();

        // partie du code qui n'esdt pas a répété pour l'html
        echo '	<section>
				<div id="titreT"> <h3>Bibliothèque personnelle </h3> </div>
				<div id="top10">
				<div style="border:black solid medium">';

        // parcours de la biblio, on recupere les livres qui correspondent aux id

        foreach ($biblio as $b){
            $livres = Livre::all()->where('idLivre', $b->idLivre);

            //on fait passer les données une par une à la vue
            $this->app->view->setData('livres', $livres);
            $this->app->render('consulter_bibli.php');
        }

            echo '</div>
				</div>
			</section>';

    }




    public function afficherBibliothequeJson() {
      //  $this->app->render('layout/header.php', compact('app'));


        // on récupère tous les livres de la biblio -----> c'est des ID
        $biblio = Bibliotheque::all();


        // parcours de la biblio, on recupere les livres qui correspondent aux id

        foreach ($biblio as $b){
            $livres = Livre::all()->where('idLivre', $b->idLivre);

            //on fait passer les données une par une à la vue
           // $this->app->view->setData('livres', $livres);
            //$this->app->render('consulter_bibli.php');
            $a = json_encode($livres);
            $this->app->response->headers->set('Content-Type', 'application/json');
            $this->app->response->body($a);
        }

    }



















    //Ajax response example
    public function getBibliotheque() {
        $biblio = Bibliotheque::all();
        echo json_encode($biblio);
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