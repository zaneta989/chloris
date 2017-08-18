<?php

namespace PlantBundle\Controller;

use PlantBundle\Entity\Plant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Collections\ArrayCollection;

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
}
