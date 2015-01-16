<?php

namespace spec\LandReg\Bundle\KnowmanBundle\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Landreg\Bundle\KnowmanBundle\Document\Article;
use Landreg\Bundle\KnowmanBundle\Document\Item;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class ArticleAdminSpec extends ObjectBehavior
{
    function let($code, $class, $baseControllerName)
    {
        $this->beConstructedWith($code, $class, $baseControllerName);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('LandReg\Bundle\KnowmanBundle\Admin\ArticleAdmin');
    }

    function it_has_a_preview_template()
    {
        $this->getTemplate('preview')->shouldReturn("LandregKnowmanBundle:Admin/Article:preview.html.twig");
    }

    function it_has_a_show_template()
    {
        $this->getTemplate('show')->shouldReturn("LandregKnowmanBundle:Admin/Article:show.html.twig");
    }

    function xit_can_prepersist_the_article(ModelManagerInterface $modelManager, Article $article, ArrayCollection $collection, Item $item)
    {
        $modelManager->find(Argument::any(), '/knowman/item')->shouldBeCalled();
        $this->setModelManager($modelManager);

        $article->getItems()->shouldBeCalled();
        $article->getItems(Argument::any())->willReturn($collection);
        $collection->toArray()->willReturn(array($item));

        $item->setParentDocument(Argument::any())->shouldBeCalled();
        $this->setItemsParent($article);
    }

}
