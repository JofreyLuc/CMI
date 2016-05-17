<?php
namespace app\controller;
use app\model\Bibliotheque;
use app\model\Livre;
class BibliothequeController extends Controller {

    

    public function afficherBibliotheque() {
        $afficheLivre = new LivreController($this->app);

        // on récupère tous les livres de la biblio -----> c'est des ID
        $biblio = Bibliotheque::all();

        // partie du code qui n'esdt pas a répété pour l'html
        echo '<section>
	            <div id=\"titreT\"> <h3> Bibliotheque perso </h3> </div>
	                <div id=\"top10\">
			          <table>';
        
        // parcours de la biblio, on recupere les livres qui correspondent aux id
        foreach ($biblio as $b){
            $livres = Livre::all()->where('idLivre', $b->idLivre);

            //on fait passer les données une par une à la vue
            $this->app->view->setData('livres', $livres);
            $this->app->render('consulter_bibli.php');
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