<?php 

namespace Ezeksoft\RocketZap\Entity;

class Customer
{
    /** @var ?int */
    private ?int $id;
    
    /** @var string */
    private string $first_name = "";

    /** @var string */
    private string $last_name = "";

    /** @var string */
    private string $email = "";

    /** @var string */
    private string $phone = "";

    /**
     * Customer ID
     *
     * @param int $id
     * @return Customer
     */
    public function setId(int $id) : Customer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retrieve customer ID
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set customer name (separate first and last name)
     *
     * @param string $name
     * @return Customer
     */
    public function setName(string $name) : Customer
    {
        $aux = explode(" ", $name);
        $first_name = $aux[0];
        $last_name = substr($name, strlen($first_name) + 1, strlen($name));
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * Retrieve customer name
     *
     * @return string
     */
    public function getName() : string
    {
        return join(" ", [$this->first_name, $this->last_name]);
    }

    /**
     * Set first name
     *
     * @param string $first_name
     * @return Customer
     */
    public function setFirstName(string $first_name) : Customer
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * Retrieve customer first name
     *
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->first_name;
    }

    /**
     * Set customer last name
     *
     * @param string $last_name
     * @return Customer
     */
    public function setLastName(string $last_name) : Customer
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * Retrieve customer last name
     *
     * @return string
     */
    public function getLastName() : string
    {
        return $this->last_name;
    }

    /**
     * Set customer email
     *
     * @param string $email
     * @return Customer
     */
    public function setEmail(string $email) : Customer
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Retrieve customer email
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Set customer phone
     *
     * @param string $phone
     * @return Customer
     */
    public function setPhone(string $phone) : Customer
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Retrieve customer phone
     *
     * @return string
     */
    public function getPhone() : string
    {
        return $this->phone;
    }
}