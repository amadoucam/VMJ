<?php

namespace Vmj\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VmjUserBundle:Default:index.html.twig');
    }
}
