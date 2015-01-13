<?php

namespace Landreg\Bundle\KnowmanBundle\Document;


use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface;

/**
 * @PHPCR\Document()
 */
class Topic implements PublishableInterface
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
     * @PHPCR\String()
     */
    protected $body;

    /**
     * @var boolean
     * @PHPCR\Boolean()
     */
    protected $publishable = true;


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
        return isset($this->title) ? $this->title : "Topic";
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


}