<?php

namespace Landreg\Bundle\KnowmanBundle\Document;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface;

/**
 * @PHPCR\Document(referenceable=true)
 */
class Article implements PublishableInterface
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
    protected $publishable = false;

    /**
     * @PHPCR\ReferenceMany(strategy="hard", targetDocument="Landreg\Bundle\KnowmanBundle\Document\Item", cascade="persist")
     */
    private $items;

    /**
     * @PHPCR\ParentDocument()
     */
    protected $parentDocument;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

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
     * Set the boolean flag whether this content is publishable or not.
     *
     * @param boolean $publishable
     */
    public function setPublishable($publishable)
    {
        $this->publishable = $publishable;
    }

    /**
     * Whether this content is publishable at all.
     *
     * A false value indicates that the content is not published. True means it
     * is allowed to show this content.
     *
     * @return boolean
     */
    public function isPublishable()
    {
        return $this->publishable;
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

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function __toString()
    {
        return isset($this->title) ? $this->title : "Article";
    }

    public function addItem($item)
    {
        $this->items->add($item);
    }
}
