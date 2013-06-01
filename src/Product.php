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

    /**
     * Set category
     *
     * @param \Category $category
     * @return Product
     */
    public function setCategory(\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}