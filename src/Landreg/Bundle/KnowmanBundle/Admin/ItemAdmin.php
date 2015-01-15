<?php

namespace Landreg\Bundle\KnowmanBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;

class ItemAdmin extends Admin
{
    protected $supportsPreviewMode = true;

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('body', 'textarea', array(
                'required' => false,
                'attr' => array('rows' => 10),
            ))
            ->add('reusable', 'choice', array(
                'choices' => array('1' => 'Reusable', '0' => 'Non-Reusable'),
                'expanded' => true,
                'multiple' => false,
            ))
            ->end();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', 'text',array(
                'route' => array('name' => 'show'),
            ))
            ->add('reusable', 'boolean')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                ),
                'label' => 'Options'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title', 'doctrine_phpcr_string');
        $datagridMapper->add('body', 'doctrine_phpcr_string');
        $datagridMapper->add('reusable');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('body')
        ;
    }

    public function getExportFormats()
    {
        return array();
    }

    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/knowman/item');
        $document->setParentDocument($parent);
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'preview':
                return 'LandregKnowmanBundle:Admin/Article:preview.html.twig';
                break;
            case 'show':
                return 'LandregKnowmanBundle:Admin/Article:show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
