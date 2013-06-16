<?php

include_once "src/controllers/APIController.php";

class CategoriesController
{
	private $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

	public function POSTAction($params)
	{
		$category = new Category();
		$category->setName($name);

		$this->em->persist($category);
		$this->em->flush();
	}


	public function GETAction($params)
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