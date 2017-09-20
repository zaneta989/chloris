<?php

namespace PlantBundle\Controller;

use PlantBundle\Entity\Plant;
use PlantBundle\Form\Type\PlantType;
use PlantBundle\Service\NotificationRemover;
use PlantBundle\Service\NotificationSender;
use PlantBundle\Service\PlantWatered;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlantController extends Controller
{
    /**
     * @Route("/plant/all", name="myPlants")
     * @return Response
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $plants = $em->getRepository('PlantBundle:Plant')->findBy([
            'owner' => $user->getId()
        ]);

        $notification = new NotificationSender();
        $em->persist($notification->sendNotification($user));
        $em->flush();
        return $this->render('plant/index.html.twig', [
            'plants' => $plants
        ]);
    }
    /**
     * @Route("/plant/new", name="addPlant")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {

        $user = $this->getUser();
        $plant = new Plant();
        $plant->setOwner($user);

        $form = $this->createForm(PlantType::class, $plant);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plant);
            $em->flush();

            $this->addFlash('sucess', 'Plant added!');

            return $this->redirectToRoute('myPlants');
        }

        return $this->render('plant/add.html.twig', [
            'plant' => $plant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/plant/{id}/remove", name="plantRemove")
     */
    public function removeAction(Request $request, $id)
    {
        $plant = $this
            ->getDoctrine()
            ->getRepository('PlantBundle:Plant')
            ->find($id);
        if($plant == null || $plant->getOwner() != $this->getUser())
        {
            throw new NotFoundHttpException();
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($plant);
        $em->flush();
        $this->addFlash('success', 'Plant is deleted!');
        return $this->redirectToRoute('myPlants');
    }
    /**
     * @Route("/plant/{id}", name="showPlant")
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $plant = $em->getRepository('PlantBundle:Plant')->find($id);

        if ($plant === null || $plant->getOwner() != $this->getUser())
        {
            throw new NotFoundHttpException();
        }
        $notification = new NotificationSender();
        $em->persist($notification->sendNotification($this->getUser()));
        $em->flush();
        return $this->render('plant/show.html.twig', [
            'plant' => $plant
        ]);
    }

    /**
     * Displays a form to edit an existing plant entity.
     *
     * @Route("/plant/{id}/edit", name="plantEdit")
     * @param Request $request
     * @param int     $id
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request,  $id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $plant = $em->getRepository('PlantBundle:Plant')->find($id);

        if ($plant == null || $plant->getOwner() != $user)
        {
            throw new NotFoundHttpException();
        }

        $form =  $this->createForm(PlantType::class, $plant, [
            'action' => $this->generateUrl('plantEdit', ['id' => $id])
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plant);
            $em->flush();
            $this->addFlash('sucess', 'Plant chnged!');
            return $this->redirectToRoute('showPlant', ['id' => $plant->getId()]);
        }
        return $this->render('plant/edit.html.twig', [
            'form' => $form->createView(),
            'plant' => $plant,
        ]);
    }

    /**
     * @Route("/plant/{id}/watered", name="plantSetWatered")
     * @param Request $request
     * @param int     $id
     * @return RedirectResponse
     */
    public function wateredPlantAction(Request $request, $id)
    {
        $user = $this->getUser();
        $plant = $this->getDoctrine()
            ->getRepository('PlantBundle:Plant')
            ->find($id);

        if($plant == null || $plant->getOwner() != $user)
        {
            throw new NotFoundHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $plantWatered = new PlantWatered();
        $notificationRemover = new NotificationRemover();

        if($plantWatered->checkIfCouldWateredPlant($plant))
        {
            $em->persist($plantWatered->wateringPlant($plant));
            $em->persist($notificationRemover->removeNotafication($user,$plant));
            $em->flush();
            $this->addFlash('sucess',  'The plant was watered today');
        }
        else
        {
            $this->addFlash('error',  'The plant was enough watered today');
        }
        return $this->redirect( $request->headers->get('referer') );
    }
}

