<?php

namespace spec\LandReg\Bundle\KnowmanBundle\Admin;

use Landreg\Bundle\KnowmanBundle\Document\Topic;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class TopicAdminSpec extends ObjectBehavior
{

    function let($code, $class, $baseControllerName)
    {
        $this->beConstructedWith($code, $class, $baseControllerName);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('LandReg\Bundle\KnowmanBundle\Admin\TopicAdmin');
    }

    function it_sets_the_right_path(Topic $document, ModelManagerInterface $modelManager)
    {
        $this->setModelManager($modelManager);
        $document->setParentDocument(Argument::any())->shouldBeCalled();
        $this->prePersist($document);
    }
}
