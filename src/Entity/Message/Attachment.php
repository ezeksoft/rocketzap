<?php 

namespace Ezeksoft\RocketZap\Entity\Message;

class Attachment
{
    /** @var string */
    private string $url = "";

    /** @var string */
    private string $filename = "";
    
    /**
     * Set url
     *
     * @param string $url
     * @return Attachment
     */
    public function setUrl(string $url) : Attachment
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
     * Set filename
     *
     * @param string $filename
     * @return Attachment
     */
    public function setFilename(string $filename) : Attachment
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * Retrieve filename
     *
     * @return string
     */
    public function getFilename() : string
    {
        return $this->filename;
    }
}