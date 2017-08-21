<?php

namespace PlantBundle\Controller;

use PlantBundle\Entity\Plant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;

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

        return $this->render('Plant/index.html.twig', ['plants' => $plants]);
    }
    /**
     * @Route("/add/{id}", name="addPlant")
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
                $this->addFlash('notice', 'You have this plant in your account');
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

                $this->addFlash('notice', 'Plant is added to your account');
            }
        }
        else
        {
            $this->addFlash('notice', 'You must be logged in');
        }

        return $this->redirectToRoute('catalogue');;
    }
}

