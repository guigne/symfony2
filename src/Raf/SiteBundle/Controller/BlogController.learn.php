<?php

// src/Raf/siteBundle/Controller/BlogController.php

namespace Raf\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
 
class BlogController extends Controller
{
    public function indexAction()
  	{
    	//return new Response("Hello World !");
    	return $this->render('RafSiteBundle:Blog:index.html.twig',
    		array(
    			'nom' => 'raf'
    		)
    	);

		  // On fixe un id au hasard ici, il sera dynamique par la suite, évidemment
	    //$id = 5;
	 
	    // On veut avoir l'URL de l'article d'id $id.
	    //$url = $this->generateUrl('rafsite_voir', array('id' => $id));
	    // $url vaut « /blog/article/5 »

	    // URL absolue, mettre le 3ème argument à true
	    //$url = $this->generateUrl('rafsite_voir', array('id' => $id), true);
	 
	    // On redirige vers cette URL (ça ne sert à rien, on est d'accord, c'est pour l'exemple !)
	    //return $this->redirect($url);
  	}

    /************************************************************************************************
     * Exemple utilisation du serice Antispam
     ************************************************************************************************/
    public function indexAction()
    {
      // On récupère le service
      $antispam = $this->container->get('raf_site.antispam');
   
      // Je pars du principe que $text contient le texte d'un message quelconque
      if ($antispam->isSpam($text)) {
        throw new \Exception('Votre message a été détecté comme spam !');
      }
   
      // Le message n'est pas un spam, on continue l'action…
    }

  	/************************************************************************************************
     * La route fait appel à RafSiteBundle:Blog:voir, on doit donc définir la méthode voirAction
  	 * On donne à cette méthode l'argument $id, pour correspondre au paramètre {id} de la route
     ************************************************************************************************/
  	/*public function voirAction($id)
    {	
    	// $id vaut 5 si l'on a appelé l'URL /blog/article/5
         
    	// Ici, on récupèrera depuis la base de données l'article correspondant à l'id $id
    	// Puis on passera l'article à la vue pour qu'elle puisse l'afficher
    	//return new Response("Affichage de l'article d'id : ".$id.".");

      // On récupère la requête
      $request = $this->getRequest();
     
      // On récupère notre paramètre tag
      $tag = $request->query->get('tag');
     
      return new Response("Affichage de l'article d'id : ".$id.", avec le tag : ".$tag);
  	}*/

    /************************************************************************************************
     * On modifie voirAction, car elle existe déjà => renvoie d'une erreur 404
     ************************************************************************************************/
    /*public function voirAction($id)
    {
      // On crée la réponse sans lui donner de contenu pour le moment
      $response = new Response;
   
      // On définit le contenu
      $response->setContent('Ceci est une page d\'erreur 404');
   
      // On définit le code HTTP
      // Rappelez-vous, 404 correspond à « page introuvable »
      $response->setStatusCode(404);
   
      // On retourne la réponse
      return $response;
    }*/

    /************************************************************************************************
     * On modifie voirAction pour avoir une réponse avec une vue
     ************************************************************************************************/
    /*public function voirAction($id)
    {
      // On utilise le raccourci : il crée un objet Response
      // Et lui donne comme contenu le contenu du template
      return $this->render('RafSiteBundle:Blog:voir.html.twig', array(
        'id'  => $id,
      ));
    }*/

    /************************************************************************************************
     * On modifie voirAction pour avoir une réponse avec une redirection
     ************************************************************************************************/
    /*public function voirAction($id)
    {
      // On utilise la méthode « generateUrl() » pour obtenir l'URL de la liste des articles à la page 2
      // Par exemple
      return $this->redirect( $this->generateUrl('rafsite_accueil', array('page' => 2)) );
    }*/

    /************************************************************************************************
     * On modifie voirAction pour avoir une réponse JSON
     ************************************************************************************************/
    /*public function voirAction($id)
    {
      // Créons nous-mêmes la réponse en JSON, grâce à la fonction json_encode()
      $response = new Response(json_encode(array('id' => $id)));
   
      // Ici, nous définissons le Content-type pour dire que l'on renvoie du JSON et non du HTML
      $response->headers->set('Content-Type', 'application/json');
   
      return $response;
   
      // Nous n'avons pas utilisé notre template ici, car il n'y en a pas vraiment besoin
    }*/

    /************************************************************************************************
     * On modifie voirAction pour utiliser le serice envoi d'email
     ************************************************************************************************/
    /*public function voirAction($id)
    {
      // Récupération du service
      $mailer = $this->get('mailer');
   
      // Création de l'e-mail : le service mailer utilise SwiftMailer, donc nous créons une instance de Swift_Message
      $message = \Swift_Message::newInstance()
        ->setSubject('Hello zéro !')
        ->setFrom('tutorial@symfony2.com')
        ->setTo('r.guigne@gmail.com')
        ->setBody('Coucou, voici un email que vous venez de recevoir !');
   
      // Retour au service mailer, nous utilisons sa méthode « send() » pour envoyer notre $message
      $mailer->send($message);
   
      // N'oublions pas de retourner une réponse, par exemple une page qui afficherait « L'e-mail a bien été envoyé »
      return new Response('Email bien envoyé');
    }*/

    /************************************************************************************************
     * On modifie voirAction pour utiliser le serice templatingl
     ************************************************************************************************/
    /*public function voirAction($id)
    {
      // Récupération du service
      $templating = $this->get('templating');
     
      // On récupère le contenu de notre template
      $contenu = $templating->render('RafSiteBundle:Blog:voir.html.twig', array('id' => $id));
     
      // On crée une réponse avec ce contenu et on la retourne
      return new Response($contenu);
    }*/

    /************************************************************************************************
     * On modifie voirAction pour utiliser le serice variable de session
     ************************************************************************************************/
    public function voirAction($id)
    {
      // Récupération du service
      $session = $this->get('session');
       
      // On récupère le contenu de la variable user_id
      $user_id = $session->get('user_id');
   
      // On définit une nouvelle valeur pour cette variable user_id
      $session->set('user_id', 91);

      return $this->render('RafSiteBundle:Blog:voir.html.twig', array('id' => $id));
   
      // On n'oublie pas de renvoyer une réponse
      //return new Response('Désolé je suis une page de test, je n\'ai rien à dire');
    }

	  // On récupère tous les paramètres en arguments de la méthode
	  public function voirSlugAction($slug, $annee, $_format)
	  {
	    // Ici le contenu de la méthode
	    return new Response("On pourrait afficher l'article correspondant au slug '".$slug."', créé en ".$annee." et au format ".$_format.".");
	  }

    // Ajoutez cette méthode ajouterAction :
    public function ajouterAction()
    {
      // Bien sûr, cette méthode devra réellement ajouter l'article
      // Mais faisons comme si c'était le cas
      $this->get('session')->getFlashBag()->add('info', 'Article bien enregistré');
   
      // Le « flashBag » est ce qui contient les messages flash dans la session
      // Il peut bien sûr contenir plusieurs messages :
      $this->get('session')->getFlashBag()->add('info', 'Oui oui, il est bien enregistré !');
           
      // Puis on redirige vers la page de visualisation de cet article
      return $this->redirect( $this->generateUrl('rafsite_voir', array('id' => 5)) );
    }
}