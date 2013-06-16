<?php

include_once "src/controllers/APIController.php";

class CategoriesController
{
	private $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

	public function POSTAction()
	{
		if(isset($_POST['name'])) {
			$category = new Category();
			
			$category->setName($_POST['name']);

			$this->em->persist($category);
			$this->em->flush();

			return true;
		}
		APIController::sendResponse(404);
	}

	public function PUTAction($put_vars)
	{
		if(!isset($_GET['id']) || !isset($put_vars['name'])) {
			APIController::sendResponse(404);
		}

		$category = $this->em->find('Category', $_GET['id']);
		
		if(!$category) {
			APIController::sendResponse(204, 'Invalid category');
		}

		$category->setName($put_vars['name']);

		$this->em->persist($category);
		$this->em->flush();

		return true;
	}

	public function DELETEAction()
	{
		if(isset($_GET['id'])) {

			$category = $this->em->find('Category', $_GET['id']);
			if(!$category) {
				APIController::sendResponse(204, 'Invalid category');
			}

			$this->em->remove($category);
			$this->em->flush();

			return true;
		}

		APIController::sendResponse(400, 'Id must be specified');
	}

	public function GETAction()
	{
		if(isset($_GET['id'])) {
			$categories = $this->em->getRepository('Category')->findById($_GET['id']);

			if(!$categories){
				APIController::sendResponse(404);
			}
		} else {
			$categories = $this->em->getRepository('Category')->findAll();
		}

		$data = array();

		foreach($categories as $category) {
			$products = array();
			foreach($category->getProducts() as $product) {
				$products[] = array('product' => array('id' => $product->getId(), 'name' => $product->getName()));
			}

			$data['categories'][] = array('category' => array('id' => $category->getId(), 'name' => $category->getName(), 'products' => $products));
		}

		return $data;
	}
}