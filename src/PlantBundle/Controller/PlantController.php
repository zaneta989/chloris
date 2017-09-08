<?php

namespace PlantBundle\Controller;

use PlantBundle\Entity\Plant;
use PlantBundle\Form\Type\PlantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlantController extends Controller
{
    /**
     * @Route("/my-plants", name="myPlants")
     * @return Response
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $this->addFlash('error', 'You must be logged in.');

            return $this->redirectToRoute('fos_user_security_login');
        }

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $plants = $em->getRepository('PlantBundle:Plant')->findBy([
            'owner' => $user->getId()
        ]);

        return $this->render('plant/index.html.twig', [
            'plants' => $plants
        ]);
    }

    /**
     * @Route("/my-plants/{id}", name="showPlant")
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $plant = $em->getRepository('PlantBundle:Plant')->find($id);

        if ($plant === null)
        {
            $this->addFlash('error', 'Could not find plant');

            return $this->redirectToRoute('homepage');
        }
        return $this->render('plant/show.html.twig', [
            'plant' => $plant
        ]);
    }

    /**
     * @Route("/plant/add", name="addPlant")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $this->addFlash('error', 'You must be logged in.');

            return $this->redirectToRoute('fos_user_security_login');
        }

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
            $this->addFlash('error', 'Could not find plant');

            return $this->redirectToRoute('homepage');
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
     * @Route("/plant/setWatered/{id}", name="plantSetWatered")
     * @param Request $request
     * @param int     $id
     * @return RedirectResponse
     */
    public function setTodayAction(Request $request, $id)
    {
        $user = $this->getUser();
        $plant = $this->getDoctrine()
            ->getRepository('PlantBundle:Plant')
            ->find($id);

        if($plant == null || $plant->getOwner() != $user)
        {
            $this->addFlash('error', 'Could not find plant');

            return $this->redirectToRoute('homepage');
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($plant->moveToToday());
        $em->flush();

        $this->addFlash('sucess',  'The plant was watered today');

        return $this->redirect( $request->headers->get('referer') );
    }
}

