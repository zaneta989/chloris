<?php

namespace PlantBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class NotificationController extends  Controller
{
    /**
     * @Route("/notification/all", name="notifications")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('homeView/index.html.twig');
    }

}

