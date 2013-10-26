<?php

namespace Ushios\Bundle\TumblrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UshiosTumblrBundle:Default:index.html.twig', array('name' => $name));
    }
}
