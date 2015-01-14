<?php

namespace spec\LandReg\Bundle\KnowmanBundle\Admin;

use Landreg\Bundle\KnowmanBundle\Document\Article;
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

    function it_sets_the_right_path(Article $document, ModelManagerInterface $modelManager)
    {
        $this->setModelManager($modelManager);
        $document->setParentDocument(Argument::any())->shouldBeCalled();
        $this->prePersist($document);
    }

    function it_has_a_preview_template()
    {
        $this->getTemplate('preview')->shouldReturn("LandregKnowmanBundle:Article:article.html.twig");
    }

}
