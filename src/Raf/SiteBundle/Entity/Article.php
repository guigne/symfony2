<?php

namespace Raf\SiteBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// On rajoute ce use pour le context :
use Symfony\Component\Validator\ExecutionContextInterface;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="Raf\SiteBundle\Entity\ArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Assert\Callback(methods={"contenuValide"})
 * @UniqueEntity(fields="titre", message="Un article existe déjà avec ce titre.")
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_edition", type="datetime")
     * @Assert\DateTime()
     */
    private $dateEdition;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, unique="true")
     * @Assert\MinLength(10)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     * @Assert\MinLength(2)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank()
     */
    private $contenu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_commentaires", type="integer")
     */
    private $nbCommentaires;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity="Raf\SiteBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Raf\SiteBundle\Entity\Categorie", cascade={"persist"})
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Raf\SiteBundle\Entity\Commentaire", mappedBy="article")
     */
    private $commentaires;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date             = new \Datetime;
        $this->publication      = true;
        $this->nb_commentaiers  = 0;
        $this->categories       = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commentaires     = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @Assert\True()
     */
    public function isTitre()
    {
        return false;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Article
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set publication
     *
     * @param boolean $publication
     * @return Article
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean 
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set image
     *
     * @param \Raf\SiteBundle\Entity\Image $image
     * @return Article
     */
    public function setImage(\Raf\SiteBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Raf\SiteBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add categories
     *
     * @param \Raf\SiteBundle\Entity\Categorie $categories
     * @return Article
     */
    public function addCategorie(\Raf\SiteBundle\Entity\Categorie $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Raf\SiteBundle\Entity\Categorie $categories
     */
    public function removeCategorie(\Raf\SiteBundle\Entity\Categorie $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add categories
     *
     * @param \Raf\SiteBundle\Entity\Categorie $categories
     * @return Article
     */
    public function addCategory(\Raf\SiteBundle\Entity\Categorie $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Raf\SiteBundle\Entity\Categorie $categories
     */
    public function removeCategory(\Raf\SiteBundle\Entity\Categorie $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Add commentaires
     *
     * @param \Raf\SiteBundle\Entity\Commentaire $commentaires
     * @return Article
     */
    public function addCommentaire(\Raf\SiteBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaire;
        $commentaires->setArticle($this); // On ajoute ceci
        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \Raf\SiteBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\Raf\SiteBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaire);
        // Et si notre relation était facultative (nullable=true, ce qui n'est pas notre cas ici attention) :        
        // $commentaire->setArticle(null);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set dateEdition
     *
     * @param \DateTime $dateEdition
     * @return Article
     */
    public function setDateEdition($dateEdition)
    {
        $this->dateEdition = $dateEdition;

        return $this;
    }

    /**
     * Get dateEdition
     *
     * @return \DateTime 
     */
    public function getDateEdition()
    {
        return $this->dateEdition;
    }

    /**
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function updateDate()
    {
        $this->setDateEdition(new \Datetime());
    }

    /**
     * @ORM\PrePersist
     */
    public function updateNbCommentaires()
    {
        $this->setNbCommentaires(0);
    }

    /**
     * Set nbCommentaires
     *
     * @param integer $nbCommentaires
     * @return Article
     */
    public function setNbCommentaires($nbCommentaires)
    {
        $this->nbCommentaires = $nbCommentaires;

        return $this;
    }

    /**
     * Get nbCommentaires
     *
     * @return integer 
     */
    public function getNbCommentaires()
    {
        return $this->nbCommentaires;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function contenuValide(ExecutionContextInterface $context)
    {
        $mots_interdits = array('échec', 'abandon');
             
        // On vérifie que le contenu ne contient pas l'un des mots
        if (preg_match('#'.implode('|', $mots_interdits).'#', $this->getContenu())) {
          // La règle est violée, on définit l'erreur et son message
          // 1er argument : on dit quel attribut l'erreur concerne, ici « contenu »
          // 2e argument : le message d'erreur
          $context->addViolationAt('contenu', 'Contenu invalide car il contient un mot interdit.', array(), null);
        }
    }
}
