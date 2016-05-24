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
				<div >';

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


    /**
     * @param $idUser
     * affiche la biblio d'un user
     */
    public function afficherBiblioUserId($idUser){
        $this->app->render('layout/header.php', compact('app'));
        // partie du code qui n'esdt pas a répété pour l'html
        echo '	
	            <section>
				<div id="titreT"> <h3>Bibliothèque personnelle </h3> </div>
				<div id="top10">
				<div >';


        $biblio = Bibliotheque::where('idUtilisateur', $idUser)->get();
        $livres = Livre::all();
        foreach ($biblio as $b){
            $livres->where('idLivre', $b->idLivre);

            //on fait passer les données une par une à la vue
            // $this->app->view->setData('livres', $livres);
            //$this->app->render('consulter_bibli.php');

        }
        $this->app->view->setData('livres', $livres);
        $this->app->render('consulter_bibli.php');


        echo '</div>
				</div>
			</section>';

    }



    public function afficherBiblioUserIdJson($idUser){
        $biblio = Bibliotheque::where('idUtilisateur', $idUser)->get();
        $tab = array();
        $i = 0;
        foreach ($biblio as $b){

            $livres = Livre::all()->where('idLivre', $b->idLivre);
            $tab[$i] = $livres;
            $i++;
            /*
            $this->app->response->headers->set('Content-Type', 'application/json');
            $this->app->response->body($a);*/

        }

        $a = json_encode($tab);
        $this->app->response->headers->set('Content-Type', 'application/json');
        $this->app->response->body($a);

    }


    /**
     * @param $idUser
     * @param $idLibrary
     * affiche le livre de la lbiblio d'un user, mais la biblio precisé avec un id
     */
    public function afficherBiblioUserLivreIdJson($idUser, $idLibrary){
        $biblio = Bibliotheque::where('idUtilisateur', $idUser)->where('idBibliotheque' , $idLibrary)->get();
        echo $biblio->get('idLivre');
        $livres = Livre::where('idLivre', $biblio->idLivre)->get();
        $a = json_encode($livres);
        $this->app->response->headers->set('Content-Type', 'application/json');
        $this->app->response->body($a);

    }



    
    $a = json_encode($livres);
		$this->app->response->headers->set('Content-Type', 'application/json');
		$this->app->response->body($a);


    /**
    *ajoute un livre à la biblio d'un user identif par id
    **/
    public function ajouterLivreBiblioUserIdJson($idUser){
      $a = json_decode(file_get_contents('php://input'));
      //var_dump($a);
      
      
      $b = json_encode($livres);
        $this->app->response->headers->set('Content-Type', 'application/json');
        $this->app->response->body($b);
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