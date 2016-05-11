<?php
namespace app\controller;

class HomeController extends Controller {
	
	public function index() {
		var_dump(compact($this->app));
		$this->app->view->setData(['app' => $this->app]);
		$this->app->render('home.php');
	}
}	