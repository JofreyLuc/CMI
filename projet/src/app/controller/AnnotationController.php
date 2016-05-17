<?php
namespace app\controller;
use app\model\Annotation;
class AnnotationController extends Controller {




    public function afficherAnnotation() {
        $annotations = Annotation::all();
        $this->app->view->setData('annotations', $annotations);
        $this->app->render('annotation.php');
    }

    //Ajax response example
    public function getAnnotation() {
        $annotations = Annotation::all();
        echo json_encode($annotations);
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