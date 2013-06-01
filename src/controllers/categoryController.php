<?php

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
		if($_GET['id']) {
			$categories = $this->em->getRepository('Category')->findById($_GET['id']);
			$test = $categories[0]->getProducts();
			var_dump($test);
		} else {
			$categories = $this->em->getRepository('Category')->findAll();
		}

		$data = array();

		foreach($categories as $category) {
			$data['categories'][] = array('category' => array('id' => $category->getId(), 'name' => $category->getName()));
		}

		return $data;
	}
}