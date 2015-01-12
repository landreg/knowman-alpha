<?php

namespace Landreg\Bundle\KnowmanBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;


class CRUDController extends Controller {

    public function previewAction($id = null)
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('VIEW', $object)) {
            throw new AccessDeniedException();
        }

        $this->admin->setSubject($object);

        return $this->render("LandregKnowmanBundle:Topic:topic.html.twig", array(
            'action'   => 'show',
            'object'   => $object,
            'elements' => $this->admin->getShow(),
        ));
    }
}