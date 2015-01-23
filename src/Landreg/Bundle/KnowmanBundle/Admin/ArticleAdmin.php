<?php
namespace Landreg\Bundle\KnowmanBundle\Admin;


use Landreg\Bundle\KnowmanBundle\Form\Type\ItemSelectType;
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

    public function getItemAdmin()
    {
        return $this->itemAdmin;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group.article', array(
                'translation_domain' => 'LandregKnowmanBundleAdmin',
            ))
                ->add('title', 'text')
            ->end()
            ->with('form.group.items', array(
                'translation_domain' => 'LandregKnowmanBundleAdmin',
            ))
                ->add('asdf', 'itemselect', array(
                    'mapped' => false,
                    'admin' => 'langreg.knowman.admin.content_item',
                    'btn_list' => "Select item",
                ), array('mapped' => false))
//                ->add('existingItem', 'sonata_type_admin', array(
//                    'btn_add' => false,
//                    'btn_list' => "Select item",
//                    'btn_delete' => false,
//                    'btn_catalogue' => 'sadf',
//                    'required' => false,
//                    'help' => "Selecting an item will save your document",
//                    'label' => "Select existing item",
//                    ), array(
//                    'edit' => 'list',
//                    'type' => 1,
//                ))
                ->add('items', 'sonata_type_collection', array(), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ))
            ->end()
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
        $this->processExistingItem($document);
        $parent = $this->getModelManager()->find(null, '/knowman/article');
        $document->setParentDocument($parent);
        $this->setItemsParent($document);
    }

    public function preUpdate($document)
    {
        $this->setItemsParent($document);
        $this->processExistingItem($document);
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

    public function processExistingItem($document)
    {
        $document->setExistingItem(null);
    }
}
