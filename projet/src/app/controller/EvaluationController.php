<?php
namespace app\controller;
use app\model\Evaluation;
class EvaluationController extends Controller {


    public function afficherEvaluation() {
        $evaluations = Evaluation::all();
        $this->app->view->setData('evaluations', $evaluations);
        $this->app->render('evaluation.php');
    }




    //Ajax response example
    public function getEvaluation() {
        $evals = Evaluation::all();
        echo json_encode($evals);
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








