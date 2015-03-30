<?php

namespace Sl24Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Sl24Bundle:Default:index.html.twig', array('name' => $name));
    }
}
