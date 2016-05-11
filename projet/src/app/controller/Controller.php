<?php
/**
 * Created by PhpStorm.
 * User: Ysee
 * Date: 06/01/15
 * Time: 16:50
 */
namespace app\controller;
class Controller
{

    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
}