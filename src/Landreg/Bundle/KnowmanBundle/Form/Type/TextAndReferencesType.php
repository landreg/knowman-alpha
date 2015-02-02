<?php

namespace Landreg\Bundle\KnowmanBundle\Form\Type;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Test\FormIntegrationTestCase;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TextAndReferencesType extends TextType {

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'text_and_references';
    }
}