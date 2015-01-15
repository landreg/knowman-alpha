<?php

namespace spec\Landreg\Bundle\KnowmanBundle\Admin;

use Landreg\Bundle\KnowmanBundle\Document\Item;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sonata\AdminBundle\Model\ModelManagerInterface;

class ItemAdminSpec extends ObjectBehavior
{
    function let($code, $class, $baseControllerName)
    {
        $this->beConstructedWith($code, $class, $baseControllerName);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Landreg\Bundle\KnowmanBundle\Admin\ItemAdmin');
    }


    function it_persists_to_the_right_path(ModelManagerInterface $modelManager, Item $document)
    {
        $this->setModelManager($modelManager);
        $modelManager->find(Argument::any(), '/knowman/item')->shouldBeCalled();
        $this->prePersist($document);
    }
}
