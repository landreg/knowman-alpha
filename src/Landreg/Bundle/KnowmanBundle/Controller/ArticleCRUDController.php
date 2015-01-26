<?php

namespace Landreg\Bundle\KnowmanBundle\Controller;


use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleCRUDController extends CRUDController
{
    /**
     * Edit action
     *
     * @param int|string|null $id
     *
     * @return Response|RedirectResponse
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function editAction($id = null)
    {
        $returnValue = parent::editAction($id);

        if ($this->getRestMethod() == 'POST') {
            $id = $this->get('request')->get($this->admin->getIdParameter());
            $object = $this->admin->getObject($id);

            $form = $this->admin->getForm();
            $itemForm = $form->get('existingItem');
            $item = $itemForm->getData();

            if (!$object) {
                throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
            }

            if ($item) {
                $newItem = $this->admin->getItemAdmin()->getObject($item);
                $object->addItem($newItem);

                $dm = $this->admin->getModelManager()->getDocumentManager();
                $dm->persist($object);
                $dm->flush();
            }
        }
        return $returnValue;
    }
}