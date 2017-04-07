<?php

namespace ALD\PremierTestBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller {
    /* public function indexAction($page)
      {
      if($page<1)
      {
      throw new NotFoundHttpException('Page" ' .$page. ' "inexistante');
      }
      return $this->render('testBundle:Advert:index.html.twig');
      } */

    /* public function indexAction($page)
      {

      return $this->render('testBundle:Advert:index.html.twig',
      array('var1' =>$var1,'var2' =>$var2));
      }

      public function emailAction()
      {
      $contenu =$this->renderView('testBundle:Advert:email.txt.twig',
      array('var1' =>$var1,'var2' =>$var2));

      mail('moi@openclassrooms.com', 'inscription OK', $contenu);
      } */

    public function indexAction($page) {

// Notre liste d'annonce en dur

        $listAdverts = array(
            array(
                'title' => 'Recherche développpeur Symfony',
                'id' => 1,
                'author' => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
                'date' => new \Datetime()),
            array(
                'title' => 'Mission de webmaster',
                'id' => 2,
                'author' => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                'date' => new \Datetime()),
            array(
                'title' => 'Offre de stage webdesigner',
                'id' => 3,
                'author' => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date' => new \Datetime())
        );
// Et modifiez le 2nd argument pour injecter notre liste
        return $this->render('testBundle:Advert:index.html.twig', array(
                    'listAdverts' => $listAdverts
        ));
    }

    public function viewAction($id) {
        $advert = array(
            'title' => 'Recherche développpeur Symfony2',
            'id' => $id,
            'author' => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date' => new \Datetime()
        );

        return $this->render('testBundle:Advert:view.html.twig', array(
                    'advert' => $advert
        ));
    }

    /*public function addAction(Request $request) {
        // On récupère le service
        $antispam = $this->container->get('oc_platform.antispam');
        // Je pars du principe que $text contient le texte d'un message quelconque
        $text = 'hello';
        if ($antispam->isSpam($text)) {
            throw new \Exception('Votre message a été détecté comme spam !');
        }
        
      
    }*/

     public function addAction(Request $request) {//si la requete est en POST, c'est que le visiteur a soumis le formulaire
      if ($request->isMethod('POST')) {
      //On s'occupe de la création et de la gestion du formulaire
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée');
      //Puis on redirige vers la page de visualisation de cette annonce
      return $this->redirectToRoute('oc_platform_view', array('id' => 5));
      }
      //Si on est pas en POST, alors on affiche le formulaire
      return $this->render('testBundle:Advert:add.html.twig');
      } 

    public function editAction($id, Request $request) {

        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée');

            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }

        $advert = array(
            'title' => 'Recherche développpeur Symfony',
            'id' => $id,
            'author' => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
            'date' => new \Datetime()
        );
        return $this->render('testBundle:Advert:edit.html.twig', array('advert' => $advert));
    }

    public function deleteAction($id) {
//Içi, on gère la suppression
        return $this->render('testBundle:Advert:delete.html.twig');
    }

    public function menuAction($limit) {
//on fixe en dur une liste içi, bien entendu par la suite 
//on la récupérera depuis la BDD!
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );


//Tout l'interet est içi: le controleur passe 
//les variables nécessaires au template !!!
        return $this->render('testBundle:Advert:menu.html.twig', array('listAdverts' => $listAdverts));
    }

//méthode qui génère une url Absolue
    /* public function indexAction()
      {
      $url = $this->get('router')->generate('oc_platform_home', array(), UrlGeneratorInterface::ABSOLUTE_URL);

      return new Response ("L'url de l'annonce d'id 5 est : ".$url);
      }

      //méthode de création de session
      public function viewAction($id, Request $request)
      {
      //Récupération de la session
      $session = $request->getSession();
      //On récupère le contenu de la variable user_id
      $userId = $session->get('user_id');
      //On définit une nouvelle valeur pour cette variable user_id
      $session->set('user_id', 91);
      //Et on renvoie la réponse
      return new Response ("<body>bla bla bla</body>");
      }

      //méthode d'encodage de lecture de fichier(ex: JSON)
      public function viewAction($id)
      {
      return new JsonResponse(array('id' => $id));
      }

      //méthode courte de redirection

      public function viewAction ($id)
      {
      return $this->redirectToRoute('oc_platform_home');
      }


      //méthode moyenne de redirection

      public function viewAction ($id)
      {
      $url = $this->get('router')->generate('oc_platform_home');

      return $this->redirect($url);
      }

      //méthode longue de redirection
      public function viewAction($id, Request $request)
      {
      // $id vaut 5 si l'on a appelé l'URL /platform/advert/5
      $tag = $request->query->get('tag');

      return $this->render('testBundle:Advert:view.html.twig',array(
      'id' =>$id,
      'tag'=> $tag));
      }


      public function viewAction($id)
      {
      return $this->render('testBundle:Advert:view.html.twig', array('id' =>$id));
      }

      public function addAction(Request $request)
      {
      $session = $request->getSession();

      //on envoie des messages flash pour l'utilisateur
      $session->getFlashBag()->add('info', 'Annonce bien enregistrée');
      $session >getFlashBag()->add('info', 'oui, elle est bien enregistrée !');


      return $this->redirectToRoute('testBundle', array ('id' =>5));
      } */








    public function viewSlugAction($slug, $year, $_format) {
        return new Response(
                "On pourrait afficher l'annonce correspondant au
                            slug '" . $slug . "', créée en " . $year . " et au format " . $_format . "."
        );
    }

    public function helloAction() {
        $content = $this->get('templating')->render('testBundle:Advert:index.html.twig', array('nom' => 'haseo'));

        return new Response($content);
    }

}
