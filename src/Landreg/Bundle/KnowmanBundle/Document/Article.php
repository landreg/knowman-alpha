<?php

namespace Landreg\Bundle\KnowmanBundle\Document;


use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface;

/**
 * @PHPCR\Document()
 */
class Article extends BaseContent implements PublishableInterface
{
    /**
     * @var boolean
     * @PHPCR\Boolean()
     */
    protected $publishable = false;

    public function __toString()
    {
        return isset($this->title) ? $this->title : "Article";
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