<?php

namespace Landreg\Bundle\KnowmanBundle\Document;


use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * @PHPCR\Document()
 */
class Item
{
    /**
     * @PHPCR\Id()
     */
    protected $id;

    /**
     * @PHPCR\String()
     */
    protected $title;

    /**
     * @PHPCR\String(nullable=true)
     */
    protected $body;

    /**
     * @PHPCR\Boolean()
     */
    protected $reusable;

    /**
     * @PHPCR\ParentDocument()
     */
    protected $parentDocument;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function isReusable()
    {
        return $this->reusable;
    }

    /**
     * @param mixed $reusable
     */
    public function setReusable($reusable)
    {
        $this->reusable = $reusable;
    }

    /**
     * @return mixed
     */
    public function getParentDocument()
    {
        return $this->parentDocument;
    }

    /**
     * @param mixed $parentDocument
     */
    public function setParentDocument($parentDocument)
    {
        $this->parentDocument = $parentDocument;
    }

    public function __toString()
    {
        return isset($this->title) ? $this->title : "Item";
    }
}
