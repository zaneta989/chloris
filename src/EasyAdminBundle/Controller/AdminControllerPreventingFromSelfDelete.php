<?php

namespace EasyAdminBundle\Controller;

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController;
use JavierEguiluz\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use JavierEguiluz\Bundle\EasyAdminBundle\Exception\EntityRemoveException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminControllerPreventingFromSelfDelete extends AdminController
{

    /**
     * The method that is executed when the user performs a 'delete' action to
     * remove any entity.
     *
     * @return RedirectResponse
     */
    protected function deleteAction()
    {

        if ('DELETE' !== $this->request->getMethod() ) {
            return $this->redirect($this->generateUrl('easyadmin', array('action' => 'list', 'entity' => $this->entity['name'])));
        }
        $id = $this->request->query->get('id');

        $form = $this->createDeleteForm($this->entity['name'], $id);
        $form->handleRequest($this->request);
        if($this->getUser()->getId() != $id)
        {
            if ($form->isSubmitted() && $form->isValid())
            {
                $easyadmin = $this->request->attributes->get('easyadmin');
                $entity = $easyadmin['item'];

                $this->dispatch(EasyAdminEvents::PRE_REMOVE, array('entity' => $entity));

                $this->executeDynamicMethod('preRemove<EntityName>Entity', array($entity));

                try {
                    $this->em->remove($entity);
                    $this->em->flush();
                } catch (ForeignKeyConstraintViolationException $e) {
                    throw new EntityRemoveException(array('entity_name' => $this->entity['name']));
                }

                $this->dispatch(EasyAdminEvents::POST_REMOVE, array('entity' => $entity));
           }
        }
        else {

            $this->addFlash(
                'error',
                'You cannot delete yourself!'
            );
        }

        $this->dispatch(EasyAdminEvents::POST_DELETE);

        return $this->redirectToReferrer();
    }


}