<?php

namespace Landreg\Bundle\KnowmanBundle\Document;


use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * @PHPCR\Document(referenceable=true)
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
     * @PHPCR\ParentDocument()
     */
    protected $parentDocument;

    /**
     * @PHPCR\Referrers(referringDocument="Landreg\Bundle\KnowmanBundle\Document\Article", referencedBy="items")
     */
    private $referencedBy;


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

    /**
     * @return mixed
     */
    public function getReferencedBy()
    {
        return $this->referencedBy;
    }

    /**
     * @param mixed $referencedBy
     */
    public function setReferencedBy($referencedBy)
    {
        $this->referencedBy = $referencedBy;
    }



}
