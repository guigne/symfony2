<?php

// src/Raf/siteBundle/Controller/BlogController.php

namespace Raf\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Raf\SiteBundle\Entity\Article;
use Raf\SiteBundle\Entity\Image;
use Raf\SiteBundle\Entity\Commentaire;
use Raf\SiteBundle\Entity\Categorie;
use Raf\SiteBundle\Entity\ArticleCompetence;
 
class BlogController extends Controller
{
  public function indexAction($page)
  {
    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à 1
    if( $page < 1 )
    {
      // On déclenche une exception NotFoundHttpException
      // Cela va afficher la page d'erreur 404 (on pourra personnaliser cette page plus tard d'ailleurs)
      throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
    }

    // Les articles :
    $articles = array(
      array(
        'titre'   => 'Mon weekend a Phi Phi Island !',
        'id'      => 1,
        'auteur'  => 'winzou',
        'contenu' => 'Ce weekend était trop bien. Blabla…',
        'date'    => new \Datetime()),
      array(
        'titre'   => 'Repetition du National Day de Singapour',
        'id'      => 2,
        'auteur' => 'winzou',
        'contenu' => 'Bientôt prêt pour le jour J. Blabla…',
        'date'    => new \Datetime()),
      array(
        'titre'   => 'Chiffre d\'affaire en hausse',
        'id'      => 3, 
        'auteur' => 'M@teo21',
        'contenu' => '+500% sur 1 an, fabuleux. Blabla…',
        'date'    => new \Datetime())
    );
 
    // Dans l'action indexAction() :
    return $this->render('RafSiteBundle:Blog:index.html.twig', array(
      'articles' => $articles
    ));
  }
   
   
  public function voirAction($id)
  {
    // On récupère le repository
    $repository = $this->getDoctrine()
                       ->getManager()
                       ->getRepository('RafSiteBundle:Article');
   
    // On récupère l'entité correspondant à l'id $id
    $article = $repository->find($id);
   
    // $article est donc une instance de Sdz\BlogBundle\Entity\Article
   
    // Ou null si aucun article n'a été trouvé avec l'id $id
    if($article === null)
    {
      throw $this->createNotFoundException('Article[id='.$id.'] inexistant.');
    }
    
    $em = $this->getDoctrine()->getManager();

    // On récupère la liste des commentaires
    $liste_commentaires = $em->getRepository('RafSiteBundle:Commentaire')
                             ->findAll();

    // On récupère les articleCompetence pour l'article $article
    $liste_articleCompetence = $em->getRepository('RafSiteBundle:ArticleCompetence')
                            ->findByArticle($article->getId());

    // Puis modifiez la ligne du render comme ceci, pour prendre en compte l'article :
    return $this->render('RafSiteBundle:Blog:voir.html.twig', array(
      'article'        => $article,
      'liste_commentaires' => $liste_commentaires,
      'liste_articleCompetence' => $liste_articleCompetence
    ));
  }
   
  public function ajouterAction()
  {
    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // Création de l'entité Article
    $article = new Article();
    $article->setTitre('Mon dernier weekend');
    $article->setContenu("C'était vraiment super et on s'est bien amusé.");
    $article->setAuteur('winzou');
    $article->setDate(new \Datetime());
    $article->setPublication(true);
 
    // Création de l'entité Image
    $image = new Image();
    $image->setUrl('http://uploads.siteduzero.com/icones/478001_479000/478657.png');
    $image->setAlt('Logo Symfony2');
 
    // Création d'un premier commentaire
    $commentaire1 = new Commentaire();
    $commentaire1->setAuteur('winzou');
    $commentaire1->setContenu('On veut les photos !');
    $commentaire1->setDate(new \Datetime());
 
    // Création d'un deuxième commentaire, par exemple
    $commentaire2 = new Commentaire();
    $commentaire2->setAuteur('Choupy');
    $commentaire2->setContenu('Les photos arrivent !');
    $commentaire2->setDate(new \Datetime());
 
    // On lie les commentaires à l'article
    $commentaire1->setArticle($article);
    $commentaire2->setArticle($article);

    // Étape 1 : On persiste les entités
    $em->persist($article);
 
    // On lie l'image à l'article
    $article->setImage($image);

    // Pour cette relation pas de cascade, car elle est définie dans l'entité Commentaire et non Article
    // On doit donc tout persister à la main ici
    $em->persist($commentaire1);
    $em->persist($commentaire2);
 
    // Étape 1 bis : si on n'avait pas défini le cascade={"persist"}, on devrait persister à la main l'entité $image
    // $em->persist($image);

    // Étape 2 : on déclenche l'enregistrement
    $em->flush();

    // Les compétences existent déjà, on les récupère depuis la bdd
    $liste_competences = $em->getRepository('RafSiteBundle:Competence')
                            ->findAll(); // Pour l'exemple, notre Article contient toutes les Competences
 
    // Pour chaque compétence
    foreach($liste_competences as $i => $competence)
    {
      // On crée une nouvelle « relation entre 1 article et 1 compétence »
      $articleCompetence[$i] = new ArticleCompetence;
 
      // On la lie à l'article, qui est ici toujours le même
      $articleCompetence[$i]->setArticle($article);
      // On la lie à la compétence, qui change ici dans la boucle foreach
      $articleCompetence[$i]->setCompetence($competence);
 
      // Arbitrairement, on dit que chaque compétence est requise au niveau 'Expert'
      $articleCompetence[$i]->setNiveau('Expert');
 
      // Et bien sûr, on persiste cette entité de relation, propriétaire des deux autres relations
      $em->persist($articleCompetence[$i]);
    }
 
    // Étape 2 : on déclenche l'enregistrement
    $em->flush();
     
    // Reste de la méthode qu'on avait déjà écrit
    if ($this->getRequest()->getMethod() == 'POST') {
      $this->get('session')->getFlashBag()->add('info', 'Article bien enregistré');
      return $this->redirect( $this->generateUrl('rafsite_voir', array('id' => $article->getId())) );
    }
 
    return $this->render('RafSiteBundle:Blog:ajouter.html.twig');
  }
   
  public function modifierAction($id)
  {
    $em = $this->getDoctrine()->getManager();

    // On récupère l'entité correspondant à l'id $id
    $article = $em->getRepository('RafSiteBundle:Article')
                  ->find($id);
 
    if ($article === null) {
      throw $this->createNotFoundException('Article[id='.$id.'] inexistant.');
    }

    // Ici, on s'occupera de la création et de la gestion du formulaire

    // On récupère toutes les catégories :
    $liste_categories = $em->getRepository('RafSiteBundle:Categorie')
                           ->findAll();
 
    // On boucle sur les catégories pour les lier à l'article
    foreach($liste_categories as $categorie)
    {
      $article->addCategorie($categorie);
    }
 
    // Inutile de persister l'article, on l'a récupéré avec Doctrine
 
    // Étape 2 : On déclenche l'enregistrement
    $em->flush();
 
    $article = array(
      'id'      => 1,
      'titre'   => 'Mon weekend a Phi Phi Island !',
      'auteur'  => 'winzou',
      'contenu' => 'Ce weekend était trop bien. Blabla…',
      'date'    => new \Datetime()
    );
         
    // Puis modifiez la ligne du render comme ceci, pour prendre en compte l'article :
    return $this->render('RafSiteBundle:Blog:modifier.html.twig', array(
      'article' => $article
    ));
  }

  public function menuAction()
  {
    // On fixe en dur une liste ici, bien entendu par la suite on la récupérera depuis la BDD !
    $liste = array(
      array('id' => 2, 'titre' => 'Mon dernier weekend !'),
      array('id' => 5, 'titre' => 'Sortie de Symfony2.1'),
      array('id' => 9, 'titre' => 'Petit test')
    );
         
    return $this->render('RafSiteBundle:Blog:menu.html.twig', array(
      'liste_articles' => $liste // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
    ));
  }

 // Suppression des catégories d'un article :
  public function supprimerAction($id)
  {
    // On récupère l'EntityManager
    $em = $this->getDoctrine()
               ->getManager();
 
    // On récupère l'entité correspondant à l'id $id
    $article = $em->getRepository('RafSiteBundle:Article')
                  ->find($id);
 
    if ($article === null) {
      throw $this->createNotFoundException('Article[id='.$id.'] inexistant.');
    }
     
    // On récupère toutes les catégories :
    $liste_categories = $em->getRepository('RafSiteBundle:Categorie')
                           ->findAll();
     
    // On enlève toutes ces catégories de l'article
    foreach($liste_categories as $categorie)
    {
      // On fait appel à la méthode removeCategorie() dont on a parlé plus haut
      // Attention ici, $categorie est bien une instance de Categorie, et pas seulement un id
      $article->removeCategorie($categorie);
    }
 
    // On n'a pas modifié les catégories : inutile de les persister
     
    // On a modifié la relation Article - Categorie
    // Il faudrait persister l'entité propriétaire pour persister la relation
    // Or l'article a été récupéré depuis Doctrine, inutile de le persister
   
    // On déclenche la modification
    $em->flush();
 
    return new Response('OK');

    //return $this->render('RafSiteBundle:Blog:supprimer.html.twig');
  }

  public function modifierImageAction($id_article)
  {
    $em = $this->getDoctrine()->getManager();
   
    // On récupère l'article
    $article = $em->getRepository('RafSiteBundle:Article')->find($id_article);
   
    // On modifie l'URL de l'image par exemple
    $article->getImage()->setUrl('test.png');
   
    // On n'a pas besoin de persister notre article (si vous le faites, aucune erreur n'est déclenchée, Doctrine l'ignore)
    // Rappelez-vous, il l'est automatiquement car on l'a récupéré depuis Doctrine
   
    // Pas non plus besoin de persister l'image ici, car elle est également récupérée par Doctrine
   
    // On déclenche la modification
    $em->flush();
   
    return new Response('OK');
  }

  // Ajout d'un article existant à plusieurs catégories existantes :
  /*public function modifierAction($id)
  {
    // On récupère l'EntityManager
    $em = $this->getDoctrine()
               ->getManager();
 
    // On récupère l'entité correspondant à l'id $id
    $article = $em->getRepository('RafSiteBundle:Article')
                  ->find($id);
 
    if ($article === null) {
      throw $this->createNotFoundException('Article[id='.$id.'] inexistant.');
    }
 
    // On récupère toutes les catégories :
    $liste_categories = $em->getRepository('RafSiteBundle:Categorie')
                           ->findAll();
 
    // On boucle sur les catégories pour les lier à l'article
    foreach($liste_categories as $categorie)
    {
      $article->addCategorie($categorie);
    }
 
    // Inutile de persister l'article, on l'a récupéré avec Doctrine
 
    // Étape 2 : On déclenche l'enregistrement
    $em->flush();
 
    return new Response('OK');
 
    // … reste de la méthode
  }*/

  // Depuis un contrôleur
  public function listeAction()
  {
    $listeArticles = $this->getDoctrine()
                          ->getManager()
                          ->getRepository('RafSiteBundle:Article')
                          ->getArticleAvecCommentaires();
   
    foreach($listeArticles as $article)
    {
      // Ne déclenche pas de requête : les commentaires sont déjà chargés !
      // Vous pourriez faire une boucle dessus pour les afficher tous
      $article->getCommentaires();
    }
   
    // …
  }

  /**
   * Test evenement doctrine prePersist dateCreation
   */
  /*public function testAction()
  {
    $em = $this->getDoctrine()->getManager();
    $article = $em->getRepository('RafSiteBundle:Article')->find(5);
    $article->setTitre('mon toto titre');
    $em->flush($article);

    return new Response('OK');
  }*/

  /**
   * Test extension doctrine sluggable
   */
  public function testAction()
  {
    $article = new Article();
    $article->setTitre("L'histoire d'un bon weekend !");
    $article->setAuteur("Auteur");
    $article->setContenu("Contenu");
    $article->setNbCommentaires(0);
    $article->setDate(new \Datetime());
    $article->setDateEdition(new \Datetime());
    $article->setPublication(true);
   
    $em = $this->getDoctrine()->getManager();
    $em->persist($article);
    $em->flush(); // C'est à ce moment qu'est généré le slug
   
    return new Response('Slug généré : '.$article->getSlug()); // Affiche « Slug généré : l-histoire-d-un-bon-weekend »
  }
}