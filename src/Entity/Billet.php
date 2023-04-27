<?php 

namespace Ezeksoft\RocketZap\Entity;

use Ezeksoft\RocketZap\Entity\Entity;

class Billet
{
    /** @var string */
    private string $text = "";
    
    /** @var string */
    private string $pdf = "";
    
    /**
     * Set pix code
     *
     * @param string $text
     * @return Billet
     */
    public function setText(string $text) : Billet
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Retrieve pix code
     *
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * Set billet PDF
     *
     * @param string $pdf
     * @return Billet
     */
    public function setPdf(string $pdf) : Billet
    {
        $this->pdf = $pdf;
        return $this;
    }

    /**
     * Retrieve billet PDF
     *
     * @return string
     */
    public function getPdf() : string
    {
        return $this->pdf;
    }
}