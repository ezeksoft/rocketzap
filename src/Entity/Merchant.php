<?php 

namespace Ezeksoft\RocketZap\Entity;

class Merchant
{
    /** @var ?int */
    private ?int $id;

    /** @var string */
    private string $name = "";
    
    /** @var string */
    private string $email = "";

    /**
     * Set merchant ID
     *
     * @param int $id
     * @return Merchant
     */
    public function setId(int $id) : Merchant
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retrieve merchant ID
     *
     * @return integer
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set merchant name
     *
     * @param string $name
     * @return Merchant
     */
    public function setName(string $name) : Merchant
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Retrieve merchant name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set merchant email
     *
     * @param string $email
     * @return Merchant
     */
    public function setEmail(string $email) : Merchant
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Retrieve merchant email
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }
}