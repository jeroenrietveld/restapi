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

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
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