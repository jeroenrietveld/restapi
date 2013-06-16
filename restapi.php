<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "bootstrap.php";
include_once "src/controllers/productController.php";
include_once "src/controllers/categoryController.php";
include_once "src/controllers/APIController.php";
		
$method 		= $_SERVER['REQUEST_METHOD'];
$action 		= strtoupper($method) . 'Action';
$params 		= explode('/', $_SERVER['REQUEST_URI']);
$name				= ucfirst($params[3] . 'Controller');
$controller = new $name($em);

switch($method) {
	case 'HEAD':
		break;
	case 'OPTIONS':
		break;
	case 'GET':
		if(!isset($_GET['format'])) {
			APIController::sendResponse(404);
		}
		$data	= $controller->$action();

		APIController::render($data, $_GET['format']);
		break;
	case 'POST':
		if($controller->$action()) {
			APIController::sendResponse(201);
		}
		break;
	case 'PUT':
		parse_str(file_get_contents("php://input"), $put_vars);

		if($controller->$action($put_vars)) {
			APIController::sendResponse(201);
		}
		break;
	case 'DELETE':
		if($controller->$action()) {
			APIController::sendResponse(200, 'Entity Deleted');
		}
		break;
	default:
		APIController::sendResponse(404);
		break;
}