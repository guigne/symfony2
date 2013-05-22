<?php

namespace Raf\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
	public function myFindAll()
	{
	  $queryBuilder = $this->createQueryBuilder('a');

	  // Méthode équivalente, mais plus longue :
	  $queryBuilder = $this->_em->createQueryBuilder()
		                        ->select('a')
		                        ->from($this->_entityName, 'a');
	  // Dans un repository, $this->_entityName est le namespace de l'entité gérée
	  // Ici, il vaut donc Raf\SiteBundle\Entity\Article

	  // On a fini de construire notre requête

	  // On récupère la Query à partir du QueryBuilder
	  $query = $queryBuilder->getQuery();

	  // On récupère les résultats à partir de la Query
	  $resultats = $query->getResult();

	  // On retourne ces résultats
	  return $resultats;
	}

	public function myFindOne($id)
	{
	  // On passe par le QueryBuilder vide de l'EntityManager pour l'exemple
	  $qb = $this->_em->createQueryBuilder();
	 
	  $qb->select('a')
	     ->from('SdzBlogBundle:Article', 'a')
	     ->where('a.id = :id')
	     ->setParameter('id', $id);
	 
	    return $qb->getQuery()
	              ->getResult();
	}

	public function findByAuteurAndDate($auteur, $annee)
	{
	  // On utilise le QueryBuilder créé par le repository directement pour gagner du temps
	  // Plus besoin de faire le select() ni le from() par la suite donc
	  $qb = $this->createQueryBuilder('a');
	 
	  $qb->where('a.auteur = :auteur')
	      ->setParameter('auteur', $auteur)
	     ->andWhere('a.date < :annee')
	      ->setParameter('annee', $annee)
	     ->orderBy('a.date', 'DESC');
	 
	  return $qb->getQuery()
	            ->getResult();
	}

	public function whereCurrentYear(\Doctrine\ORM\QueryBuilder $qb)
	{
	  $qb->andWhere('a.date BETWEEN :debut AND :fin')
	      ->setParameter('debut', new \Datetime(date('Y').'-01-01'))  // Date entre le 1er janvier de cette année
	      ->setParameter('fin',   new \Datetime(date('Y').'-12-31')); // Et le 31 décembre de cette année
	 
	    return $qb;
	}

	public function myFind()
	{
	  $qb = $this->createQueryBuilder('a');
	 
	  // On peut ajouter ce qu'on veut avant
	  $qb->where('a.auteur = :auteur')
	      ->setParameter('auteur', 'winzou');
	 
	  // On applique notre condition
	  $qb = $this->whereCurrentYear($qb);
	 
	  // On peut ajouter ce qu'on veut après
	  $qb->orderBy('a.date', 'DESC');
	     
	  return $qb->getQuery()
	            ->getResult();
	}

	public function getArticleAvecCommentaires()
	{
	  $qb = $this->createQueryBuilder('a')
	             ->leftJoin('a.commentaires', 'c')
	             ->addSelect('c');
	 
	  return $qb->getQuery()
	            ->getResult();
	}

	public function getAvecCategories($categories = array()) 
	{
		$qb = $this->createQueryBuilder('a')
				   ->leftJoin('a.categories c')
				   ->where($qb->expr()->in('c.nom', $categories)); // Puis on filtre sur le nom des catégories à l'aide d'un IN

		return $qb->getQuery()
				  ->getResult();
	}

	// On ajoute deux arguments : le nombre d'articles par page, ainsi que la page courante
	public function getArticles($nombreParPage, $page)
	  {
	    // On déplace la vérification du numéro de page dans cette méthode
	    if ($page < 1) {
	      throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "'.$page.'").');
	    }
	 
	    // La construction de la requête reste inchangée
	    $query = $this->createQueryBuilder('a')
	                  ->leftJoin('a.image', 'i')
	                    ->addSelect('i')
	                  ->leftJoin('a.categories', 'cat')
	                    ->addSelect('cat')
	                  ->orderBy('a.date', 'DESC')
	                  ->getQuery();
	 
	    // On définit l'article à partir duquel commencer la liste
	    $query->setFirstResult(($page-1) * $nombreParPage)
	    // Ainsi que le nombre d'articles à afficher
	          ->setMaxResults($nombreParPage);
	 
	    // Enfin, on retourne l'objet Paginator correspondant à la requête construite
	    // (n'oubliez pas le use correspondant en début de fichier)
	    return new Paginator($query);
	}

	public function getSelectList()
	{
	    $qb = $this->createQueryBuilder('a')
	               ->where('a.publication = 1'); // On filtre sur l'attribut publication
	 
	    // Et on retourne simplement le QueryBuilder, et non la Query, attention
	    return $qb;
	}
}