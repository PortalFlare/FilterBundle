<?php

namespace PortalFlare\Bundle\FilterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PortalFlareFilterBundle:Default:index.html.twig', array('name' => $name));
    }
}
