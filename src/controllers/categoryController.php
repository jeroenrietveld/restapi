<?php

class CategoryController
{
	private $em;

	public function CategoryController($em)
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
		if($_GET['id']) {
			$products = $this->em->getRepository('Product')->findById($_GET['id']);
		} else {
			$products = $this->em->getRepository('Product')->findAll();
		}

		$data = array();

		foreach($products as $product) {
			$data['products'][] = array('product' => array('id' => $product->getId(), 'name' => $product->getName()));
		}

		return $data;
	}
}