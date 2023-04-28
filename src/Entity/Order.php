<?php 

namespace Ezeksoft\RocketZap\Entity;

class Order
{
    /** @var string */
    private string $id = "";
    
    /** @var float */
    private float $total = 0;

    /**
     * Order ID
     *
     * @param string $id
     * @return Order
     */
    public function setId(string $id) : Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retrieve order ID
     *
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
    
    /**
     * Set total
     *
     * @param float $total
     * @return Order
     */
    public function setTotal(float $total) : Order
    {
        $this->total = $total;
        return $this;
    }

    /**
     * Retrieve total
     *
     * @return float
     */
    public function getTotal() : float
    {
        return $this->total;
    }
}