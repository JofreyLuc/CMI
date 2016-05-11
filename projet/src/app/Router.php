<?php
/**
 * Created by PhpStorm.
 * User: Ysee
 * Date: 06/01/15
 * Time: 14:17
 */
namespace app;
class Router
{

    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    private function call($method, $url, $action)
    {
        return $this->app->$method($url, function () use ($action) {
            $action = explode('@', $action);
            $controller_name = $action[0];
            $method_name = $action[1];
            $controller = new $controller_name($this->app);
            call_user_func_array([$controller, $method_name], func_get_args());
        });
    }

    public function get($url, $action)
    {
        return $this->call('get', $url, $action);
    }

    public function post($url, $action)
    {
        return $this->call('post', $url, $action);
    }
}