<?php

namespace PlantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlantSpecificationController extends Controller
{
    /**
     * @Route("/catalogue", name="catalogue")
     */
    public function catalogueAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plantsSpecification = $em->getRepository('PlantBundle:PlantSpecification')->findAll();

        return $this->render('plantSpecification/catalogue.html.twig', ['plants' => $plantsSpecification]);
    }

    /**
     * @Route("/catalogue/{id}", name="showPlant")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $plantSpecification =  $this->getDoctrine()
            ->getRepository('PlantBundle:PlantSpecification')->find($id);

        if (!$plantSpecification) {
            throw $this->createNotFoundException('No plant found for id '.$id);
        }
        return $this->render('plantSpecification/show.html.twig',['plant' => $plantSpecification]);
    }
}
