<?php

namespace spec\Landreg\Bundle\KnowmanBundle\Admin;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BaseContentAdminSpec extends ObjectBehavior
{
    function let($code, $class, $baseControllerName)
    {
        $this->beConstructedWith($code, $class, $baseControllerName);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Landreg\Bundle\KnowmanBundle\Admin\BaseContentAdmin');
    }
}
