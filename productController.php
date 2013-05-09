<?php

class productController
{
	private $em;

	public function productController($em)
	{
		$this->em = $em;
	}

	public function newProduct($name)
	{
		$product = new Product();
		$product->setName($name);

		$this->em->persist($product);
		$this->em->flush();
	}
}