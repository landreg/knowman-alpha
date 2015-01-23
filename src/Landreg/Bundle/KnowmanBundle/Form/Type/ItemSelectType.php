<?php

namespace Landreg\Bundle\KnowmanBundle\Form\Type;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Test\FormIntegrationTestCase;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemSelectType extends AbstractType implements ContainerAwareInterface {
    private $container;

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'admin' => null,
            'btn_list' => "Select item",
            'btn_catalogue'     => 'LandregKnowmanAdminBundle',
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'itemselect';
    }

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['associated_admin'] = $this->container->get($options['admin']);
        $view->vars['btn_list'] = $options['btn_list'];
        $view->vars['btn_catalogue'] = $options['btn_catalogue'];
        return parent::buildView($view, $form, $options);
    }
}