<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app->get('/', function(Request $request, Response $response){
	$response->getBody()->write("Coucou");
	return $response;
});
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/contact', function(Request $request, Response $response){
	$response->getBody()->write("Contact");
	return $response;
});
$app->run();