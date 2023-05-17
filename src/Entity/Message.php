<?php 

namespace Ezeksoft\RocketZap\Entity;

use Ezeksoft\RocketZap\Entity\Message\{Text, Image, Attachment, Button};
use Ezeksoft\RocketZap\Enum\MessageType;

class Message
{
    /** @var MessageType */
    private MessageType $type;

    /** @var Text */
    private Text $text;

    /** @var Image */
    private Image $image;

    /** @var Button */
    private Button $button;

    /** @var Attachment */
    private Attachment $attachment;

    /**
     * Create new text
     *
     * @return Text
     */
    public function text() : Text
    {
        return new Text; 
    }

    /**
     * Create new image
     *
     * @return Image
     */
    public function image() : Image
    {
        return new Image; 
    }

    /**
     * Create new attachment
     *
     * @return Attachment
     */
    public function attachment() : Attachment
    {
        return new Attachment; 
    }

    /**
     * Create new button
     *
     * @return Button
     */
    public function button() : Button
    {
        return new Button; 
    }
    
    /**
     * Set type
     *
     * @param MessageType $type
     * @return Message
     */
    public function setType(MessageType $type) : Message
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Retrieve type
     *
     * @return MessageType
     */
    public function getType() : MessageType
    {
        return $this->type;
    }

    /** @return bool */
    public function hasType() : bool
    {
        return !empty($this->type);
    }
    
    /**
     * Set text
     *
     * @param string $text
     * @return Message
     */
    public function setText(string $text) : Message
    {
        $this->setType(MessageType::TEXT);
        $this->text = $this->text()->setContent($text);
        return $this;
    }

    /**
     * Retrieve text
     *
     * @return Text
     */
    public function getText() : Text
    {
        return $this->text;
    }

    /** @return bool */
    public function hasText() : bool
    {
        return !empty($this->text);
    }

    /**
     * Set image
     *
     * @param Image $image
     * @return Message
     */
    public function setImage(Image $image) : Message
    {
        $this->setType(MessageType::IMAGE);
        $this->image = $image;
        return $this;
    }

    /**
     * Retrieve image
     *
     * @return Image
     */
    public function getImage() : Image
    {
        return $this->image;
    }

    /** @return bool */
    public function hasImage() : bool
    {
        return !empty($this->image);
    }

    /**
     * Set attachment
     *
     * @param Attachment $attachment
     * @return Message
     */
    public function setAttachment(Attachment $attachment) : Message
    {
        $this->setType(MessageType::ATTACHMENT);
        $this->attachment = $attachment;
        return $this;
    }
 
    /**
     * Retrieve attachment
     *
     * @return Attachment
     */
    public function getAttachment() : Attachment
    {
        return $this->attachment;
    }

    /** @return bool */
    public function hasAttachment() : bool
    {
        return !empty($this->attachment);
    }

    /**
     * Set button
     *
     * @param Button $button
     * @return Button
     */
    public function setButton(Button $button) : Message
    {
        $this->setType(MessageType::BUTTON);
        $this->button = $button;
        return $this;
    }
 
    /**
     * Retrieve button
     *
     * @return Button
     */
    public function getButton() : Button
    {
        return $this->button;
    }

    /** @return bool */
    public function hasButton() : bool
    {
        return !empty($this->button);
    }

    /**
     * Retrieve content
     *
     * @return object
     */
    public function getContent() : object
    {
        return match($this->getType())
        {
            MessageType::TEXT => (object)
            [
                "text" => $this->getText()->getContent()
            ],
            MessageType::IMAGE => (object)
            [
                "url" => $this->getImage()->getUrl(),
                "caption" => $this->getImage()->getCaption()
            ],
            MessageType::ATTACHMENT => (object)
            [
                "url" => $this->getAttachment()->getUrl(),
                "filename" => $this->getAttachment()->getFilename()
            ],
            MessageType::BUTTON => $this->getButton()->getMapping()
        };
    }
}