<?php

/* RafSiteBundle:Blog:voir.html.twig */
class __TwigTemplate_0f432166a227b7b122d87929ab58a15b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("RafSiteBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'rafsite_body' => array($this, 'block_rafsite_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "RafSiteBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        // line 6
        echo "    Lecture d'un article - ";
        $this->displayParentBlock("title", $context, $blocks);
        echo "
";
    }

    // line 9
    public function block_rafsite_body($context, array $blocks = array())
    {
        // line 10
        echo " 
   ";
        // line 11
        $this->env->loadTemplate("RafSiteBundle:Blog:article.html.twig")->display($context);
        // line 12
        echo "
  <div class=\"well\">
    <h3>Commentaires</h3>
    ";
        // line 15
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["liste_commentaires"]) ? $context["liste_commentaires"] : $this->getContext($context, "liste_commentaires")));
        foreach ($context['_seq'] as $context["_key"] => $context["commentaire"]) {
            // line 16
            echo "      <p>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["commentaire"]) ? $context["commentaire"] : $this->getContext($context, "commentaire")), "auteur"), "html", null, true);
            echo " <br/> ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["commentaire"]) ? $context["commentaire"] : $this->getContext($context, "commentaire")), "contenu"), "html", null, true);
            echo "</p>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['commentaire'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "  </div>

 ";
        // line 20
        if ((twig_length_filter($this->env, (isset($context["liste_articleCompetence"]) ? $context["liste_articleCompetence"] : $this->getContext($context, "liste_articleCompetence"))) > 0)) {
            // line 21
            echo "    <div>
      Compétences utilisées dans cet article :
      <ul>
        ";
            // line 24
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["liste_articleCompetence"]) ? $context["liste_articleCompetence"] : $this->getContext($context, "liste_articleCompetence")));
            foreach ($context['_seq'] as $context["_key"] => $context["articleCompetence"]) {
                // line 25
                echo "          <li>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["articleCompetence"]) ? $context["articleCompetence"] : $this->getContext($context, "articleCompetence")), "competence"), "nom"), "html", null, true);
                echo " : ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["articleCompetence"]) ? $context["articleCompetence"] : $this->getContext($context, "articleCompetence")), "niveau"), "html", null, true);
                echo "</li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['articleCompetence'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "      </ul>
    </div>
  ";
        }
        // line 30
        echo " 
  <p>
    <a href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("rafsite_accueil"), "html", null, true);
        echo "\" class=\"btn\">
      <i class=\"icon-chevron-left\"></i>
      Retour à la liste
    </a>
    <a href=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("rafsite_modifier", array("id" => $this->getAttribute((isset($context["article"]) ? $context["article"] : $this->getContext($context, "article")), "id"))), "html", null, true);
        echo "\" class=\"btn\">
      <i class=\"icon-edit\"></i>
      Modifier l'article
    </a>
    <a href=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("rafsite_supprimer", array("id" => $this->getAttribute((isset($context["article"]) ? $context["article"] : $this->getContext($context, "article")), "id"))), "html", null, true);
        echo "\" class=\"btn\">
      <i class=\"icon-trash\"></i>
      Supprimer l'article
    </a>
  </p>
 
";
    }

    public function getTemplateName()
    {
        return "RafSiteBundle:Blog:voir.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 40,  109 => 36,  102 => 32,  98 => 30,  93 => 27,  82 => 25,  78 => 24,  73 => 21,  71 => 20,  67 => 18,  56 => 16,  52 => 15,  47 => 12,  45 => 11,  42 => 10,  39 => 9,  32 => 6,  29 => 5,);
    }
}
