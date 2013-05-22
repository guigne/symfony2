<?php

/* RafSiteBundle:Blog:modifier.html.twig */
class __TwigTemplate_b9f857f1f88048e1c9ac3471f4ddab14 extends Twig_Template
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
        echo "  Modifier un article - ";
        $this->displayParentBlock("title", $context, $blocks);
        echo "
";
    }

    // line 9
    public function block_rafsite_body($context, array $blocks = array())
    {
        // line 10
        echo " 
  <h2>Modifier un article</h2>
 
  ";
        // line 13
        $this->env->loadTemplate("RafSiteBundle:Blog:formulaire.html.twig")->display($context);
        // line 14
        echo " 
  <p>
    Vous éditez un article déjà existant,
    ne le changez pas trop pour éviter
    aux membres de ne pas comprendre
    ce qu'il se passe.
  </p>
 
  <p>
    <a href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("rafsite_voir", array("id" => $this->getAttribute((isset($context["article"]) ? $context["article"] : $this->getContext($context, "article")), "id"))), "html", null, true);
        echo "\" class=\"btn\">
      <i class=\"icon-chevron-left\"></i>
      Retour à l'article
    </a>
  </p>
 
";
    }

    public function getTemplateName()
    {
        return "RafSiteBundle:Blog:modifier.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 23,  49 => 14,  47 => 13,  42 => 10,  39 => 9,  32 => 6,  29 => 5,);
    }
}
