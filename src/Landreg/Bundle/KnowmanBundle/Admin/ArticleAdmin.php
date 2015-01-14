<?php
namespace Landreg\Bundle\KnowmanBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;

class ArticleAdmin extends Admin {

    protected $supportsPreviewMode = true;

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', 'text')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'preview' => array('template' => 'LandregKnowmanBundle:CRUD:list__action_preview.html.twig'),
                    'edit' => array(),
                    'delete' => array(),
                ),
                'label' => 'Options'
            ))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
            ->add('body', 'textarea', array('required' => false))
            ->end();
    }

    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/knowman/article');
        $document->setParentDocument($parent);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title', 'doctrine_phpcr_string');
        $datagridMapper->add('body', 'doctrine_phpcr_string');
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

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('preview', $this->getRouterIdParameter().'/preview', array(), array('id' => '.+'), array('expose'=>true));
        parent::configureRoutes($collection);
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'preview':
                return 'LandregKnowmanBundle:Article:article.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}

