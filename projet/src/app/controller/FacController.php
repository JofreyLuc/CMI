<?php
namespace app\controller;
use app\model\User;
class FacController extends Controller {
	
	public function afficherFac() {
		$this->app->render('fac.php');
	}
	
	
	
	public function afficherUser() {
		echo 'coucou';
		$users = User::all();
		$this->app->view->setData('users', $users);
		$this->app->render('user.php');
	}
	
	//Ajax response example
	public function getUsers() {
		$users = User::all();
		echo json_encode($users);
	}
	
	public function create() {
		$id =  json_decode($_POST['id']);
		$name =  json_decode($_POST['name']);
		$usr = User();
		$usr->id = $id;
		$usr->name = $name;
		$usr->save();
	}
}