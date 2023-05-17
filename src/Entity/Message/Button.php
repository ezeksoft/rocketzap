<?php 

namespace Ezeksoft\RocketZap\Entity\Message;
use Ezeksoft\RocketZap\Entity\Message\ButtonItem;

class Button
{
    /** @var string */
    private string $title = "";
    
    /** @var string */
    private string $footer = "";
    
    /** @var string */
    private string $message = "";
    
    /** @var bool */
    private bool $use_template_buttons = true;
    
    /** @var array */
    private array $buttons = [];

    /**
     * Create new button item
     *
     * @return ButtonItem
     */
    public function item() : ButtonItem
    {
        return new ButtonItem; 
    }
    
    /**
     * Set title
     *
     * @param string $title
     * @return string
     */
    public function setTitle(string $title) : Button
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Retrieve title
     *
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }
    
    /**
     * Set footer
     *
     * @param string $footer
     * @return Button
     */
    public function setFooter(string $footer) : Button
    {
        $this->footer = $footer;
        return $this;
    }

    /**
     * Retrieve footer
     *
     * @return string
     */
    public function getFooter() : string
    {
        return $this->footer;
    }
    
    /**
     * Set message
     *
     * @param string $message
     * @return Button
     */
    public function setMessage(string $message) : Button
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Retrieve message
     *
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }
    
    /**
     * Set template buttons
     *
     * @param bool $use_template_buttons
     * @return Button
     */
    public function setUseTemplateButtons(bool $use_template_buttons) : Button
    {
        $this->use_template_buttons = $use_template_buttons;
        return $this;
    }

    /**
     * Retrieve template buttons
     *
     * @return bool
     */
    public function getUseTemplateButtons() : bool
    {
        return $this->use_template_buttons;
    }
    
    /**
     * Add button item
     *
     * @param ButtonItem $button
     * @return Button
     */
    public function addItem(ButtonItem $button) : Button
    {
        $this->buttons[] = $button;
        return $this;
    }

    /**
     * Retrieve mapping
     *
     * @return object
     */
    public function getMapping() : object
    {
        $buttons = [];
        
        foreach ($this->buttons as $button) 
        {
            $item = (object)
            [
                "id" => $button->getId(),
                "text" => $button->getText()
            ];

            if ($button->hasUrl()) $item->url = $button->getUrl();

            $buttons[] = $item;
        }

        return (object)
        [
            "message" => $this->getMessage(),
            "title" => $this->getTitle(),
            "footer" => $this->getFooter(),
            "buttons" => $buttons,
            "use_template_buttons" => $this->getUseTemplateButtons()
        ];
    }
}