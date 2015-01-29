<?php

namespace Landreg\Bundle\KnowmanBundle\Controller;


class ItemCRUDController extends CRUDController
{
    /**
     * List action
     *
     * @return Response
     *
     * @throws AccessDeniedException If access is not granted
     */
    public function listAction()
    {
        if($this->isXmlHttpRequest()) {
            $this->admin->setBatchActions(array());
        }
        return parent::listAction();
    }
}