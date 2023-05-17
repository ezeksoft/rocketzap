<?php 

namespace Ezeksoft\RocketZap\Entity\Message;

class Text
{
    /** @var string */
    private string $content = "";
    
    /**
     * Set content
     *
     * @param string $content
     * @return Text
     */
    public function setContent(string $content) : Text
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Retrieve content
     *
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }
}