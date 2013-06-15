<?php

class ProductsController
{
	private $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

	public function POSTAction()
	{
		if(isset($_POST['name']) && isset($_POST['category'])) {
			$category = $this->getCategory($_POST['category']);
			
			if($category) {
				$product = new Product();
				$product->setName($_POST['name']);
				$product->setCategory($category[0]);

				$this->em->persist($product);
				$this->em->flush();

				return true;
			} else {
				APIController::sendResponse(400, 'Invalid Category name');
			}
		}
		APIController::sendResponse(404);
	}

	public function PUTAction($put_vars)
	{
		if(!isset($put_vars['id']) || !isset($put_vars['name']) || !isset($put_vars['category'])) {
			APIController::sendResponse(404);
		}

		$product = $this->getProduct($put_vars['id']);
		$category = $this->getCategory($put_vars['category']);
		if(!$product) {
			APIController::sendResponse(204, 'Invalid product');
		}

		$product->setName($put_vars['name']);
		$product->setCategory($category[0]);

		$this->em->persist($product);
		$this->em->flush();

		return true;
	}

	public function GETAction()
	{
		if(isset($_GET['id'])) {
			$products = $this->em->getRepository('Product')->findById($_GET['id']);

			if(!$products) {
				APIController::sendResponse(404);
			}
		} else {
			$products = $this->em->getRepository('Product')->findAll();
		}

		$data = array();

		foreach($products as $product) {
			$data['products'][] = array('product' => array('id' => $product->getId(), 'name' => $product->getName()));
		}

		return $data;
	}

	private function getCategory($name)
	{
		return $this->em->getRepository('Category')->findByName($name);
	}

	private function getProduct($id)
	{
		return $this->em->find('Product', $id);
	}
}