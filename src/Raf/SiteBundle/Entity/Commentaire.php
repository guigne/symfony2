<?php

namespace Raf\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Raf\SiteBundle\Validator\AntiFlood;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="Raf\SiteBundle\Entity\CommentaireRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Commentaire
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
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @AntiFlood()
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Raf\SiteBundle\Entity\Article", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;


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
     * Set auteur
     *
     * @param string $auteur
     * @return Commentaire
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
     * @return Commentaire
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
     * Set date
     *
     * @param \DateTime $date
     * @return Commentaire
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
     * Set article
     *
     * @param \Raf\SiteBundle\Entity\Article $article
     * @return Commentaire
     */
    public function setArticle(\Raf\SiteBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Raf\SiteBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @ORM\PrePersist
     */
    public function increase()
    {
        $nbCommentaires = $this->getArticle()->getNbCommentaires();
        $this->getArticle()->setNbCommentaires($nbCommentaires+1);
    }
     
    /**
     * @ORM\PreRemove
     */
    public function decrease()
    {
        $nbCommentaires = $this->getArticle()->getNbCommentaires();
        $this->getArticle()->setNbCommentaires($nbCommentaires-1);
    }
}
