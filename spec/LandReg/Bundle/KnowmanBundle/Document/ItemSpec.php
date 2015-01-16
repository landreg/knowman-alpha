<?php

namespace spec\Landreg\Bundle\KnowmanBundle\Document;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ItemSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Landreg\Bundle\KnowmanBundle\Document\Item');
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

    function it_is_reusable()
    {
       $this->isReusable()->shouldReturn(null);
        $this->setReusable(true);
        $this->isReusable()->shouldReturn(true);
    }
}
