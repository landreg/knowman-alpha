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
            $item = $form->get('existingItem')->getData();

            $this->addExistingItem($object, $item);
        }
        return $returnValue;
    }



    /**
     * Create action
     *
     * @return Response
     *
     * @throws AccessDeniedException If access is not granted
     */
    public function createAction()
    {
        $returnValue = parent::createAction();

        if ($this->getRestMethod() == 'POST') {
            $form = $this->admin->getForm();
            if($form->isValid()) {
                $object = $this->admin->getSubject();
                $item = $form->get('existingItem')->getData();
                $this->addExistingItem($object, $item);
            }
        }
        return $returnValue;
    }

    public function addExistingItem($article, $item)
    {
        if (!$article) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if ($item) {
            $newItem = $this->admin->getItemAdmin()->getObject($item);
            $article->addItem($newItem);

            $dm = $this->admin->getModelManager()->getDocumentManager();
            $dm->persist($article);
            $dm->flush();
        }
    }
}