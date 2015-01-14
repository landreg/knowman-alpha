<?php

namespace Landreg\Bundle\KnowmanBundle\Document;


use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * @PHPCR\Document()
 */
class Item extends BaseContent
{
    public function __toString()
    {
        return isset($this->title) ? $this->title : "Item";
    }
}
