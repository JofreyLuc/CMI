<?php
namespace app\controller;
use app\model\Bibliotheque;
use app\model\Livre;

class BibliothequeController extends Controller {

    

    // fonction qui affiche tous les livres presents dans notre biblio perso
    public function afficherBibliotheque() {
        $this->app->render('header.php', compact('app'));


        // on récupère tous les livres de la biblio -----> c'est des ID
        $biblio = Bibliotheque::all();

        // partie du code qui n'esdt pas a répété pour l'html
        echo '	<section>
				<div id="titreT"> <h3>Bibliothèque personnelle </h3> </div>
				<div id="top10">
				<div >';

        // parcours de la biblio, on recupere les livres qui correspondent aux id

        foreach ($biblio as $b){
            $livres = Livre::find($b->idLivre);

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
        $this->app->render('header.php', compact('app'));
        // partie du code qui n'esdt pas a répété pour l'html
        echo '	
	            <section>
				<div id="titreT"> <h3>Bibliothèque personnelle </h3> </div>
				<div id="top10">
				<div >';


        $biblio = Bibliotheque::where('idUtilisateur', $idUser)->get();
       // $livres = Livre::all();
        foreach ($biblio as $b){
            $livres = Livre::find($b->idLivre);
            //on fait passer les données une par une à la vue
            // $this->app->view->setData('livres', $livres);
            //$this->app->render('consulter_bibli.php');
            $this->app->view->setData('livres', $livres);
            $this->app->render('consulter_bibli.php');
        }



        echo '</div>
				</div>
			</section>';

    }



    public function afficherBiblioUserIdJson($idUser){
        $biblio = Bibliotheque::where('idUtilisateur', $idUser)->get();
        $a = json_encode($biblio);
        $this->app->response->headers->set('Content-Type', 'application/json');
        $this->app->response->body($a);
       /* foreach ($biblio as $b) {

            $livres = Livre::find($b->idLivre);
            $a = json_encode($livres);
            $this->app->response->headers->set('Content-Type', 'application/json');
            $this->app->response->body($a);
        }*/
        //$livres = Livre::whereIn($biblio->idLivre)->get();



    }


    /**
     * @param $idUser
     * @param $idLibrary
     * affiche le livre de la lbiblio d'un user, mais la biblio precisé avec un id
     */
    public function afficherBiblioUserLivreIdJson($idUser, $idLibrary){
        $biblio = Bibliotheque::where('idUtilisateur', $idUser)->where('idBibliotheque' , $idLibrary)->get();
        $a = json_encode($biblio);
        $this->app->response->headers->set('Content-Type', 'application/json');
        $this->app->response->body($a);



    }



    
 
    /**
    *ajoute un livre à la biblio d'un user identif par id
    **/
       public function ajouterLivreBiblioUserIdJson($idUser){
        // recuperation des data sur la page
        $a = json_decode(file_get_contents('php://input'));
        //var_dump($a);

        // traitemen des data et insertion


        $biblio = new Bibliotheque();

        $test = $a->idLivre;
        $biblio->idLivre = $test;
        $biblio->idUtilisateur = $idUser; // param passé dans lurl
        $biblio->positionLecture = $a->positionLecture;

        // Gestion de la date de modif
        date_default_timezone_set('Europe/Paris');
        if ($biblio->dateModification == null)
            $biblio->dateModification = date('Y-m-d H:i:s');

        $biblio->save();

        $b = json_encode($biblio);
        $this->app->response->headers->set('Content-Type', 'application/json');
        $this->app->response->setStatus(201);
        $this->app->response->body($b);
    }



    public function ajouterLivreBiblioUserIdJsonWeb($idUser){
        // recuperation des data sur la page
        //$a = json_decode(file_get_contents('php://input'));
        $a = $_POST["idLivre"];
        $b = $_POST["positionLecture"];
        //var_dump($a);

        // traitemen des data et insertion


        $biblio = new Bibliotheque();

        $test = $a;
        $biblio->idLivre = $test;
        $biblio->idUtilisateur = $idUser; // param passé dans lurl
        $biblio->positionLecture = $b;

        // Gestion de la date de modif
        date_default_timezone_set('Europe/Paris');
        if ($biblio->dateModification == null)
            $biblio->dateModification = date('Y-m-d H:i:s');

        $biblio->save();

        $b = json_encode($biblio);
        $this->app->response->headers->set('Content-Type', 'application/json');
        $this->app->response->setStatus(201);
        $this->app->response->body($b);
    }

    /**
 * modif une biblio d'un user
 */
public function modifLivreBiblioUserIdJson($idUser){
    // recuperation des data sur la page
    $a = json_decode(file_get_contents('php://input'));

    date_default_timezone_set('Europe/Paris');

    if (isset($a->dateModification))
        $date = $a->dateModification;
    else
        $date = date('Y-m-d H:i:s');

    // recup le tuple qu'on veut modif
    $bibliotheque = Bibliotheque::find($a->idBibliotheque);
    $bibliotheque->dateModification = $date;
    $bibliotheque->positionLecture = $a->positionLecture;
    $bibliotheque->save();
    $this->app->response->headers->set('Content-Type', 'application/json');
    $this->app->response->setStatus(204);
}


    /**
     * supprime une biblio d'un user
     * @param $idUser
     * @param $idLibrary
     */
    public function deleteLivreBiblioUserIdJson($idUser, $idLibrary) {
        $result = Bibliotheque::destroy($idLibrary);
        $this->app->response->headers->set('Content-Type', 'application/json');
        if ($result)
            $this->app->response->setStatus(204);
        else
            $this->app->response->setStatus(204);
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