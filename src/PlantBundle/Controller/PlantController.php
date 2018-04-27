<?php

namespace PlantBundle\Controller;

use PlantBundle\Entity\Plant;
use PlantBundle\Form\Type\PlantType;
use PlantBundle\Service\PlantWatered;
use PlantBundle\Service\IsWateredChanger;
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
    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $isWateredChenger = $this->get('app.is_watered_chenger');
        $em->persist($isWateredChenger->checkIfYouNeedToWaterPlants($user));
        $em->flush();
        $plants = $em->getRepository('PlantBundle:Plant')->findBy([
            'owner' => $user->getId()
        ]);
        if($this->getUser()->getPreferences()->getView()=='tableView')
            return $this->render('myPlants/tableView.html.twig', [
            'plants' => $plants]);
        else  return $this->render('myPlants/cardView.html.twig', [
            'plants' => $plants
        ]);
    }

    /**
     * @Route("/plant/save-view-my-plants/{viewName}", name="saveViewMyPlants")
     * @param string $viewName
     * @return Response
     */
    public function saveViewMyPlantsAction(string $viewName)
    {
        $user = $this->getUser();
        $user->setPreferences($user->getPreferences()->setView($viewName));
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('myPlants');
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

            $this->addFlash('sucess', $this->get('translator')->trans('text_and_label.plant_added'));

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
        $this->addFlash('success', $this->get('translator')->trans('text_and_label.plant_deleted'));
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
            $this->addFlash('sucess', $this->get('translator')->trans('text_and_label.plant_changed'));
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
        $plantWatered = $this->get('app.plant_watered');

        if($plantWatered->checkIfCouldWateredPlant($plant))
        {
            $em->persist($plantWatered->wateringPlant($plant));
            $em->flush();
            if($plant->getRemaining()>0)
            {
                $this->addFlash('sucess',
                    $this->get('translator')->trans('text_and_label.the').$plant->getName().$this->
                    get('translator')->trans('text_and_label.info_about_watering_times').$plant->getName().' 
                '.$plant->getRemaining().$this->get('translator')->trans('text_and_label.times_today'));
            }
            else
            {
                $this->addFlash('sucess',
                    $this->get('translator')->trans('text_and_label.the').$plant->getName().$this->
                    get('translator')->trans('text_and_label.enough_watering'));
            }
        }
        else
        {
            $this->addFlash('error',
                $this->get('translator')->trans('text_and_label.dont_watered').$plant->getName().$this
                    ->get('translator')->trans('text_and_label.was_enough'));
        }
        return $this->redirect( $request->headers->get('referer') );
    }
}

