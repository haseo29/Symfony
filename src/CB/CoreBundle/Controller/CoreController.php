<?php

namespace CB\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoreController extends Controller {
    
    public function indexAction()
    {
        return $this->render('CBCoreBundle:Core:index.html.twig');
    }

    public function ContactAction(Request $request) 
    {
        $pageEnCoursDeConstruction= $request->getSession();
        
        $pageEnCoursDeConstruction->getFlashBag()->add('info','Veuillez nous excusez, la formulaire de contact est en cours de construction');
        
        return $this->redirectToRoute('cb_core_homepage');
    }

}
