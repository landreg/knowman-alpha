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
        $this->getTemplate('preview')->shouldReturn("LandregKnowmanBundle:Admin/Article:preview.html.twig");
    }

    function it_has_a_show_template()
    {
        $this->getTemplate('show')->shouldReturn("LandregKnowmanBundle:Admin/Article:show.html.twig");
    }

    function it_persists_to_the_right_path(ModelManagerInterface $modelManager, Article $document) {
        $this->setModelManager($modelManager);
        $modelManager->find(Argument::any(), '/knowman/article')->shouldBeCalled();
        $this->prePersist($document);
    }
}
