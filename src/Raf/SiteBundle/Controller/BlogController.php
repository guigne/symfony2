<?php
 
// src/Raf/SiteBundle/Controller/BlogController.php
 
namespace Raf\SiteBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Raf\SiteBundle\Entity\Article;
use Raf\SiteBundle\Form\ArticleType;
use Raf\SiteBundle\Form\ArticleEditType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

// Plus besoin de rajouter le use de l'exception dans ce cas
// Mais par contre il faut le use pour les annotations du bundle :
use JMS\SecurityExtraBundle\Annotation\Secure;
 
class BlogController extends Controller
{
  public function indexAction($page)
  {
    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à 1
    // Bien sûr pour le moment on ne se sert pas (encore !) de cette variable
    if ($page < 1) {
      // On déclenche une exception NotFoundHttpException 
      // Cela va afficher la page d'erreur 404
      // On pourra la personnaliser plus tard
      throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
    }
 
    // Pour récupérer la liste de tous les articles : on utilise findAll()
    $articles = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('RafSiteBundle:Article')
                     ->getArticles(3, $page);
 
    // L'appel de la vue ne change pas
    return $this->render('RafSiteBundle:Blog:index.html.twig', array(
      'articles'   => $articles,
      'page'       => $page,
      'nombrePage' => ceil(count($articles)/3)
    ));
  }
 
  public function voirAction(Article $article)
  {
    // À ce stade, la variable $article contient une instance de la classe Article
    // Avec l'id correspondant à l'id contenu dans la route !
 
    // On récupère ensuite les articleCompetence pour l'article $article
    // On doit le faire à la main pour l'instant, car la relation est unidirectionnelle
    // C'est-à-dire que $article->getArticleCompetences() n'existe pas !
    $listeArticleCompetence = $this->getDoctrine()
                                   ->getManager()
                                   ->getRepository('RafSiteBundle:ArticleCompetence')
                                   ->findByArticle($article->getId());
 
    return $this->render('RafSiteBundle:Blog:voir.html.twig', array(
      'article'                 => $article,
      'liste_articleCompetence' => $listeArticleCompetence,
      'liste_commentaires'      => $article->getCommentaires()
    ));
  }
 
  /**
   * @Secure(roles="ROLE_AUTEUR")
   */ 
  public function ajouterAction()
  {
    // Plus besoin du if avec le security.context, l'annotation s'occupe de tout ! Annotation ci-dessus
    // Dans cette méthode, vous êtes sûrs que l'utilisateur courant dispose du rôle ROLE_AUTEUR

    // On teste que l'utilisateur dispose bien du rôle ROLE_AUTEUR
    if (!$this->get('security.context')->isGranted('ROLE_AUTEUR')) {
      // Sinon on déclenche une exception « Accès interdit »
      throw new AccessDeniedHttpException('Accès limité aux auteurs');
    }

    $article = new Article;
 
    // On crée le formulaire grâce à l'ArticleType
    $form = $this->createForm(new ArticleType(), $article);
 
    // On récupère la requête
    $request = $this->getRequest();
 
    // On vérifie qu'elle est de type POST
    if ($request->getMethod() == 'POST') {
      // On fait le lien Requête <-> Formulaire
      $form->bind($request);
 
      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      if ($form->isValid()) {
        // On enregistre notre objet $article dans la base de données
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
 
        // On définit un message flash
        $this->get('session')->getFlashBag()->add('info', 'Article bien ajouté');
 
        // On redirige vers la page de visualisation de l'article nouvellement créé
        return $this->redirect($this->generateUrl('rafsite_voir', array('id' => $article->getId())));
      }
    }
 
    // À ce stade :
    // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
 
    return $this->render('RafSiteBundle:Blog:ajouter.html.twig', array(
      'form' => $form->createView(),
    ));
  }
 
  public function modifierAction(Article $article)
  {
    // On utiliser le ArticleEditType
    $form = $this->createForm(new ArticleEditType(), $article);
 
    $request = $this->getRequest();
 
    if ($request->getMethod() == 'POST') {
      $form->bind($request);
 
      if ($form->isValid()) {
        // On enregistre l'article
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
 
        // On définit un message flash
        $this->get('session')->getFlashBag()->add('info', 'Article bien modifié');
 
        return $this->redirect($this->generateUrl('rafsite_voir', array('id' => $article->getId())));
      }
    }
 
    return $this->render('RafSiteBundle:Blog:modifier.html.twig', array(
      'form'    => $form->createView(),
      'article' => $article
    ));
  }
 
  public function supprimerAction(Article $article)
  {
    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'article contre cette faille
    $form = $this->createFormBuilder()->getForm();
 
    $request = $this->getRequest();
    if ($request->getMethod() == 'POST') {
      $form->bind($request);
 
      if ($form->isValid()) {
        // On supprime l'article
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
 
        // On définit un message flash
        $this->get('session')->getFlashBag()->add('info', 'Article bien supprimé');
 
        // Puis on redirige vers l'accueil
        return $this->redirect($this->generateUrl('rafsite_accueil'));
      }
    }
 
    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('RafSiteBundle:Blog:supprimer.html.twig', array(
      'article' => $article,
      'form'    => $form->createView()
    ));
  }
 
  public function menuAction($nombre)
  {
    $liste = $this->getDoctrine()
                  ->getManager()
                  ->getRepository('RafSiteBundle:Article')
                  ->findBy(
                    array(),          // Pas de critère
                    array('date' => 'desc'), // On trie par date décroissante
                    $nombre,         // On sélectionne $nombre articles
                    0                // À partir du premier
                  );
 
    return $this->render('RafSiteBundle:Blog:menu.html.twig', array(
      'liste_articles' => $liste // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
    ));
  }

  public function testAction()
  {
    $article = new Article;
         
    $article->setDate(new \Datetime());  // Champ « date » OK
    $article->setTitre('abc');           // Champ « titre » incorrect : moins de 10 caractères
    //$article->setContenu('blabla');    // Champ « contenu » incorrect : on ne le définit pas
    $article->setAuteur('A');            // Champ « auteur » incorrect : moins de 2 caractères
         
    // On récupère le service validator
    $validator = $this->get('validator');
         
    // On déclenche la validation
    $liste_erreurs = $validator->validate($article);
 
    // Si le tableau n'est pas vide, on affiche les erreurs
    if(count($liste_erreurs) > 0) {
      return new Response(print_r($liste_erreurs, true));
    } else {
      return new Response("L'article est valide !");
    }
  }
}