<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App;
// get all posts
$app->get('/api/categories', function(Request $request, Response $response){
		echo 'CATAGORIES';

	
});

