<?php

/**
 * @Entity @Table(name="Categories")
 */
class Category
{
	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 */
	protected $id;

	/**
	 * @Column(type="string")
	 */
	protected $name;

	/**
	 * @OneToMany(targetEntity="Product", mappedBy="categories")
	 */
	protected $products;

	public function __construct()
	{
		$this->products = new \Doctrine\Common\Collections\ArrayColletion();
	}
	
	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getProducts()
	{
		return $this->products;
	}

	public function addProduct($product)
	{
		$this->products[] = $product;
	}

	public function setProducts($products)
	{
		$this->products = $products;
	}
}