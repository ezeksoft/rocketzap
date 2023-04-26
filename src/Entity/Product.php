<?php 

namespace Ezeksoft\RocketZap\Entity;

class Product implements Entity
{
    /**
     * Product ID
     * @var null|int
     */
    private ?int $id;

    /**
     * Product name
     *
     * @var string
     */
    private string $name = "";

    /**
     * Product price
     *
     * @var float
     */
    private float $price = 0;

    /**
     * Set product ID
     *
     * @param int $id
     * @return Product
     */
    public function setId(int $id) : Product
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set product name
     *
     * @param string $name
     * @return Product
     */
    public function setName(string $name) : Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set product price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price) : Product
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get product ID
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get product name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Get product price
     *
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
    }
}