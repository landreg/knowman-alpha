<?php
namespace Landreg\Bundle\KnowmanBundle\Admin;


use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;

class ArticleAdmin extends Admin
{
    protected $supportsPreviewMode = true;
    /**
     * @var $itemAdmin ItemAdmin
     */
    protected $itemAdmin;

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', 'text',array(
                'route' => array('name' => 'show'),
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                ),
                'label' => 'Options'
            ))
        ;
    }

    public function setItemAdmin(ItemAdmin $itemAdmin)
    {
        $this->itemAdmin = $itemAdmin;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text')
//            ->add('body', 'textarea', array(
//                'required' => false,
//                'attr' => array('rows' => 41)
//            ))
            ->add('items', 'sonata_type_collection', array(), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ))
            ->end();
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

    public function prePersist($document)
    {
        $parent = $this->getModelManager()->find(null, '/knowman/article');
        $document->setParentDocument($parent);
        $this->setItemsParent($document);
    }

    public function preUpdate($document)
    {
        $item = $this->itemAdmin->getObject("/knowman/item/1266224827");
        $document->addItem($item);
        $dm = $this->getModelManager()->getDocumentManager();
        $dm->persist($document);
        $dm->flush();
        $this->setItemsParent($document);
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

    public function setItemsParent($document)
    {
        $parent = $this->getModelManager()->find(null, '/knowman/item');
        $items = $document->getItems();
        foreach($items->toArray() as $item) {
            $item->setParentDocument($parent);
        }
    }

    public function postUpdate($document)
    {
    }
}
