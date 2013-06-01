<?php

class ProductsController
{
	private $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

	public function POSTAction($params)
	{
		$product = new Product();
		$product->setName($name);

		$this->em->persist($product);
		$this->em->flush();
	}

	public function GETAction($params)
	{
		if($_GET['id']) {
			$products = $this->em->getRepository('Product')->findById($_GET['id']);
			var_dump($products[0]->getCategory()->getName());die;
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