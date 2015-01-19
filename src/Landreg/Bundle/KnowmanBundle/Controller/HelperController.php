<?php

namespace Landreg\Bundle\KnowmanBundle\Controller;

use Sonata\AdminBundle\Controller\HelperController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HelperController extends Controller
{

    public function appendEditFormFieldElementAction(Request $request)
    {
        $code      = $request->get('code');
        $elementId = $request->get('elementId');
        $objectId  = $request->get('objectId');
        $uniqid    = $request->get('uniqid');

        $admin = $this->pool->getInstance($code);
        $admin->setRequest($request);

        if ($uniqid) {
            $admin->setUniqid($uniqid);
        }

        $subject = $admin->getModelManager()->find($admin->getClass(), $objectId);
        if ($objectId && !$subject) {
            throw new NotFoundHttpException;
        }

        if (!$subject) {
            $subject = $admin->getNewInstance();
        }

        $admin->setSubject($subject);

        list($fieldDescription, $form) = $this->helper->appendFormFieldElement($admin, $subject, $elementId);

        /** @var $form \Symfony\Component\Form\Form */
        $article = $admin->getObject('/knowman/article/128368893');
        //$form->setData($article);
        $itemAdmin = $this->pool->getInstance('langreg.knowman.admin.content_item');
        $item = $itemAdmin->getObject("/knowman/item/1266224827");
        /** @var $itemsForm \Symfony\Component\Form\Form */
        $itemsForm = $form->get('items');
        $offsetForm = $itemsForm->get($itemsForm->count() - 1);
        $offsetForm->setData($item);

//        $itemsForm->offsetSet($itemsForm->count() - 1, $offsetForm);
//        $form->offsetSet('items', $itemsForm);

        $finalForm = $admin->getFormBuilder()->getForm();
        $items = $subject->getItems();
        $items->removeElement($items->last());
        $items->add($item);
        $subject->setItems($items);

        $finalForm->setData($subject);
        //$finalForm->setData($form->getData());

        $view = $this->helper->getChildFormView($finalForm->createView(), $elementId);

        // render the widget
        // todo : fix this, the twig environment variable is not set inside the extension ...

        $extension = $this->twig->getExtension('form');
        $extension->initRuntime($this->twig);
        $extension->renderer->setTheme($view, $admin->getFormTheme());

        return new Response($extension->renderer->searchAndRenderBlock($view, 'widget'));
    }
}
