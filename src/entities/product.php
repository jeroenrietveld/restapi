<?php

/**
 * @Entity @Table(name="Products")
 */
class Product
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
	 * @ManyToOne(targetEntity="Category", inversedBy="products")
	 * @JoinColumn(name="category_id", referencedColumnName="id")
	 */
	protected $category;

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

	public function getCategory()
	{
		return $this->category;
	}

	public function setCategory()
	{
		$this->category = $category;
	}
}