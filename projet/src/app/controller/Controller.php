<?php
namespace app\controller;
class Controller
{

    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
}