<?php 

namespace Ezeksoft\RocketZap\Entity;

class Pix
{
    /** @var string */
    private string $text = "";
    
    /** @var string */
    private string $image = "";
    
    /**
     * Set pix code
     *
     * @param string $text
     * @return Pix
     */
    public function setText(string $text) : Pix
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
     * Set pix QRCode
     *
     * @param string $image
     * @return Pix
     */
    public function setImage(string $image) : Pix
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Retrieve pix QRCode
     *
     * @return string
     */
    public function getImage() : string
    {
        return $this->image;
    }
}