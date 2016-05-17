<?php
namespace app\controller;
use app\model\Suivi;
class SuiviController extends Controller {


    public function afficherSuivi() {
        $suivi = Suivi::all();
        $this->app->view->setData('suivi', $suivi);
        $this->app->render('Suivi.php');
    }

    //Ajax response example
    public function getSuivi() {
        $suivi = Suivi::all();
        echo json_encode($suivi);
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