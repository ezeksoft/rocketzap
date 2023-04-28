<?php 

namespace Ezeksoft\RocketZap\Entity;

class CreditCard
{
    /** @var string */
    private string $first_six_digits = "";
    
    /** @var string */
    private string $last_four_digits = "";
    
    /** @var string */
    private string $flag = "";
    
    /** @var int */
    private int $installments = 1;
    
    /**
     * Set card bin
     *
     * @param string $first_six_digits
     * @return CreditCard
     */
    public function setFirstSixDigits(string $first_six_digits) : CreditCard
    {
        $this->first_six_digits = $first_six_digits;
        return $this;
    }

    /**
     * Retrieve card bin
     *
     * @return string
     */
    public function getFirstSixDigits() : string
    {
        return $this->first_six_digits;
    }

    /**
     * Sets last digits of card
     *
     * @param string $last_four_digits
     * @return CreditCard
     */
    public function setLastFourDigits(string $last_four_digits) : CreditCard
    {
        $this->last_four_digits = $last_four_digits;
        return $this;
    }

    /**
     * Retrieve last digits of card
     *
     * @return string
     */
    public function getLastFourDigits() : string
    {
        return $this->last_four_digits;
    }

    /**
     * Set flag
     *
     * @param string $flag
     * @return CreditCard
     */
    public function setFlag(string $flag) : CreditCard
    {
        $this->flag = $flag;
        return $this;
    }

    /**
     * Retrieve flag
     *
     * @return string
     */
    public function getFlag() : string
    {
        return $this->flag;
    }

    /**
     * Set installments
     *
     * @param int $installments
     * @return CreditCard
     */
    public function setInstallments(int $installments) : CreditCard
    {
        $this->installments = $installments;
        return $this;
    }

    /**
     * Retrieve installments
     *
     * @return int
     */
    public function getInstallments() : int
    {
        return $this->installments;
    }
}