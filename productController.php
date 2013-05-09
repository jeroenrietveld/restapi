<?php

class ProductsController
{
	private $em;

	public function ProductsController($em)
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
		$products = $this->em->getRepository('Product')->findAll();
		$data = array();

		foreach($products as $product) {
			$data['products'][] = array('product' => array('id' => $product->getId(), 'name' => $product->getName()));
		}

		return $data;
	}
}