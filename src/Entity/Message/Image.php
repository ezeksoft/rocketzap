<?php 

namespace Ezeksoft\RocketZap\Entity\Message;

class Image
{
    /** @var string */
    private string $url = "";

    /** @var string */
    private string $caption = "";
    
    /**
     * Set url
     *
     * @param string $url
     * @return Image
     */
    public function setUrl(string $url) : Image
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Retrieve url
     *
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }
    
    /**
     * Set caption
     *
     * @param string $caption
     * @return Image
     */
    public function setCaption(string $caption) : Image
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * Retrieve caption
     *
     * @return string
     */
    public function getCaption() : string
    {
        return $this->caption;
    }
}