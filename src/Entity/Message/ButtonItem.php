<?php 

namespace Ezeksoft\RocketZap\Entity\Message;

class ButtonItem
{
    /** @var string */
    private string $id = "";

    /** @var string */
    private string $text = "";

    /** @var string */
    private string $url = "";
    
    /**
     * Set id
     *
     * @param string $id
     * @return ButtonItem
     */
    public function setId(string $id) : ButtonItem
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retrieve id
     *
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
    
    /**
     * Set text
     *
     * @param string $text
     * @return ButtonItem
     */
    public function setText(string $text) : ButtonItem
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Retrieve text
     *
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }
    
    /**
     * Set url
     *
     * @param string $url
     * @return ButtonItem
     */
    public function setUrl(string $url) : ButtonItem
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

    /** @return bool */
    public function hasUrl() : bool
    {
        return !empty($this->url);
    }
}