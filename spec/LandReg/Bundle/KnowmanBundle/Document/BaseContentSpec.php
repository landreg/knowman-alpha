<?php

namespace spec\Landreg\Bundle\KnowmanBundle\Document;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class BaseContentSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Landreg\Bundle\KnowmanBundle\Document\BaseContent');
        $this->shouldImplement('Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface');
    }


    function it_should_have_a_title() {
        $title = "title";
        $this->setTitle($title);
        $this->getTitle()->shouldReturn($title);
    }

    function it_should_have_a_body() {
        $body = "body";
        $this->setBody($body);
        $this->getBody()->shouldReturn($body);
    }
}
