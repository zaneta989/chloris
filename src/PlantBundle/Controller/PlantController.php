<?php

namespace PlantBundle\Controller;

use PlantBundle\Entity\Plant;
use PlantBundle\Form\Type\PlantType;
use PlantBundle\Service\IsWateredChanger;
use PlantBundle\Service\PlantWatered;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
    public function indexTableViewAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $isWateredChenger = new IsWateredChanger();
        $em->persist($isWateredChenger->checkIfYouNeedToWaterPlants($user));
        $em->flush();
        $plants = $em->getRepository('PlantBundle:Plant')->findBy([
            'owner' => $user->getId()
        ]);

        return $this->render('myPlants/tableView.html.twig', [
            'plants' => $plants
        ]);
    }
    /**
     * @Route("/plant/all/cardview", name="myPlantsCardView")
     * @return Response
     */
    public function indexCardViewAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $isWateredChenger = new IsWateredChanger();
        $em->persist($isWateredChenger->checkIfYouNeedToWaterPlants($user));
        $em->flush();
        $plants = $em->getRepository('PlantBundle:Plant')->findBy([
            'owner' => $user->getId()
        ]);

        return $this->render('myPlants/cardView.html.twig', [
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
     * @ParamConverter("plant", class="PlantBundle:Plant")
     * @param Plant $plant
     * @return RedirectResponse
     */
    public function removeAction(Plant $plant)
    {
        if($plant->getOwner() != $this->getUser())
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
     * @ParamConverter("plant", class="PlantBundle:Plant")
     * @param Plant $plant
     * @return RedirectResponse|Response
     */
    public function showAction(Plant $plant)
    {
        if ($plant->getOwner() != $this->getUser())
        {
            throw new NotFoundHttpException();
        }
        return $this->render('plant/show.html.twig', [
            'plant' => $plant
        ]);
    }

    /**
     * Displays a form to edit an existing plant entity.
     *
     * @Route("/plant/{id}/edit", name="plantEdit")
     * @ParamConverter("plant", class="PlantBundle:Plant")
     * @param Request $request
     * @param Plant $plant
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request,  Plant $plant)
    {
        $user = $this->getUser();
        if ($plant->getOwner() != $user)
        {
            throw new NotFoundHttpException();
        }

        $form =  $this->createForm(PlantType::class, $plant, [
            'action' => $this->generateUrl('plantEdit', ['id' => $plant->getId()])
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
     * @param Plant $plant
     * @return RedirectResponse
     */
    public function wateredPlantAction(Request $request, Plant $plant)
    {
        $user = $this->getUser();
        if($plant->getOwner() != $user)
        {
            throw new NotFoundHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $plantWatered = new PlantWatered();

        if($plantWatered->checkIfCouldWateredPlant($plant))
        {
            $em->persist($plantWatered->wateringPlant($plant));
            $em->flush();
            if($plant->getRemaining()>0)
            {
                $this->addFlash('sucess',  'The '.$plant->getName().' was watered today. You should water the '.$plant->getName().' 
                '.$plant->getRemaining().' times today. ');
            }
            else
            {
                $this->addFlash('sucess',  'The '.$plant->getName().' was watered today. Its enough for today.');
            }
        }
        else
        {
            $this->addFlash('error',  'Do not water anymore. The '.$plant->getName().' was enough watered today.');
        }
        return $this->redirect( $request->headers->get('referer') );
    }
}

