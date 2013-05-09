<?php
include_once "bootstrap.php";
include_once "src/controllers/productController.php";
include_once "src/controllers/APIController.php";

$method 	= $_SERVER['REQUEST_METHOD'];
$action 	= strtoupper($method) . 'Action';
$params 	= explode('/', $_SERVER['REQUEST_URI']);
$name		= ucfirst($params[3] . 'Controller');
$controller = new $name($em);
$data 		= $controller->$action($params);

$API = new APIController();

switch($method) {
	case 'HEAD':
		break;
	case 'OPTIONS':
		break;
	case 'GET':
		$API->render($data, $_GET['format']);
		break;
}