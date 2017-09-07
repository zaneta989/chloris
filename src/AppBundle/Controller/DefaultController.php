<?php

namespace AppBundle\Controller;

use PlantBundle\Service\NotificationSender;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $em=$this->getDoctrine()->getManager();
            $notification = new NotificationSender();
            $em->persist($notification->sendNotification($this->getUser()));
            $em->flush();

        }
        return $this->render('homeView/index.html.twig');
    }
}

