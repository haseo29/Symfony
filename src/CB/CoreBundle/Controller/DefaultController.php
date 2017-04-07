<?php

namespace CB\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CBCoreBundle:Default:index.html.twig');
    }
}
