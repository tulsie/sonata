<?php

namespace Tulsie\Bundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TulsiePageBundle:Default:index.html.twig', array('name' => $name));
    }
}
