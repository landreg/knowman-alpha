<?php

namespace Landreg\Bundle\KnowmanBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;

class ItemAdmin extends BaseContentAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('body', 'textarea', array(
                'required' => false,
                'attr' => array('rows' => 10),
            ))
            ->end();
    }
}
