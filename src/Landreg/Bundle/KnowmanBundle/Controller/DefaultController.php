<?php

namespace Landreg\Bundle\KnowmanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LandregKnowmanBundle:Default:index.html.twig', array('name' => $name));
    }
}
