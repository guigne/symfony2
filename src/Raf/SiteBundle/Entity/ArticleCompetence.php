<?php
// src/Raf/SiteBundle/Entity/ArticleCompetence.php
 
namespace Raf\SiteBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="article_competence")
 */
class ArticleCompetence
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Raf\SiteBundle\Entity\Article")
     */
    private $article;
     
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Raf\SiteBundle\Entity\Competence")
     */
    private $competence;
     
    /**
      * @ORM\Column()
      */
    private $niveau; // Ici j'ai un attribut de relation « niveau »

    /**
     * Set niveau
     *
     * @param string $niveau
     * @return ArticleCompetence
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string 
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set article
     *
     * @param \Raf\SiteBundle\Entity\Article $article
     * @return ArticleCompetence
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
     * Set competence
     *
     * @param \Raf\SiteBundle\Entity\Competence $competence
     * @return ArticleCompetence
     */
    public function setCompetence(\Raf\SiteBundle\Entity\Competence $competence)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get competence
     *
     * @return \Raf\SiteBundle\Entity\Competence 
     */
    public function getCompetence()
    {
        return $this->competence;
    }
}
