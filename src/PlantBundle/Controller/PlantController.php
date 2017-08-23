<?php

namespace PlantBundle\Controller;

use PlantBundle\Entity\Plant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PlantController extends Controller
{
    /**
     * @Route("/my-plants", name="myPlants")
     */
    public function indexAction()
    {
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();

        $plants= $em->getRepository('PlantBundle:Plant')->findBy(['owner' => $user->getId()]);

        return $this->render('plant/index.html.twig', ['plants' => $plants]);
    }

    /**
     * @Route("/add/{id}", name="addPlant")
     * @param int $id
     * @return RedirectResponse
     */
    public function addAction($id)
    {
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        if($user!=null)
        {
            if ($em->getRepository('PlantBundle:Plant')
                    ->findBy(['owner' => $user->getId(),'plantSpecification' => $id])!=null)
            {
                $this->addFlash('error', 'You have this plant in your account');
            }
            else
            {
                $plantSpecification= $em->getRepository('PlantBundle:PlantSpecification')->find($id);

                $plant = new Plant();
                $plant->setPlantSpecification($plantSpecification);
                $plant->setOwner($user);
                $plant->setIsWatered(false);

                $em->persist($plant);
                $em->flush();

                $this->addFlash('sucess', 'plant is added to your account');
            }
        }
        else
        {
            $this->addFlash('error', 'You must be logged in');
        }

        return $this->redirectToRoute('catalogue');
    }
}

