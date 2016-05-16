<?php
namespace app\controller;
use app\model\Bibliotheque;
class BibliothequeController extends Controller {

    

    public function afficherBibliotheque() {
        $biblio = Bibliotheque::all();
        $this->app->view->setData('bibliotheque', $biblio);
        $this->app->render('consulter_bibli.php');
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