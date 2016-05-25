<?php
namespace app\controller;
use app\model\Evaluation;
use app\model\Livre;

class EvaluationController extends Controller {


    public function afficherEvaluation() {
        $evaluations = Evaluation::all();
        $this->app->view->setData('evaluations', $evaluations);
        $this->app->render('evaluation.php');
    }




    /**
     * affiche toutes les eval d'un livre identif par id
     * pour cette fct :
     * si je passe un param dans l'url : ?comment=true
     * alors j'affiche les evals qui ont un commentaire
     * si pas de param ou param à false, affichage de tous les comments meme les vides
     */
    public function afficherEvalsLivreIdJson($id){
        $comment = $this->app->request()->params('comment');
        // si le parametre comment est rentré
        if($comment == 'true'){
            $evals = Evaluation::where('idLivre', $id)->whereNotNull('commentaire')->get();
            //->where('commenraire', '!=' , null)->get();
            $a = json_encode($evals);
            $this->app->response->headers->set('Content-Type', 'application/json');
            $this->app->response->body($a);
        }else{
            $evals = Evaluation::where('idLivre', $id)->get();
            $a = json_encode($evals);
            $this->app->response->headers->set('Content-Type', 'application/json');
            $this->app->response->body($a);
        }

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








