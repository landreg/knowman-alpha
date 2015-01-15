<?php

namespace spec\Landreg\Bundle\KnowmanBundle\Document;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArticleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Landreg\Bundle\KnowmanBundle\Document\Article');
        $this->shouldImplement('Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface');
    }

    function it_should_have_a_title()
    {
        $title = "title";
        $this->setTitle($title);
        $this->getTitle()->shouldReturn($title);
    }

    function it_should_have_a_body()
    {
        $body = "body";
        $this->setBody($body);
        $this->getBody()->shouldReturn($body);
    }

    function it_can_be_published()
    {
        $this->isPublishable()->shouldReturn(false);
        $this->setPublishable(true);
        $this->isPublishable()->shouldReturn(true);
    }
}
