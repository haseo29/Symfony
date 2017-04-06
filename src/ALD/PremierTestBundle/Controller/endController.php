<?php

namespace ALD\PremierTestBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class endController extends Controller
{

        public function endDoorAction()            
            {
              $finDePage = $this->get('templating')->render('testBundle:Advert:endDoor.html.twig');
        
              return new Response($finDePage);
            }   
}