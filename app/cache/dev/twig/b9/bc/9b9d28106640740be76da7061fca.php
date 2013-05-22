<?php

/* RafSiteBundle:Blog:ajouter.html.twig */
class __TwigTemplate_b9bc9b9d28106640740be76da7061fca extends Twig_Template
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
        echo "  Ajouter un article - ";
        $this->displayParentBlock("title", $context, $blocks);
        echo "
";
    }

    // line 9
    public function block_rafsite_body($context, array $blocks = array())
    {
        // line 10
        echo " 
  <h2>Ajouter un article</h2>
 
  ";
        // line 13
        $this->env->loadTemplate("RafSiteBundle:Blog:formulaire.html.twig")->display($context);
        // line 14
        echo " 
  <p>
    Vous ajoutez un nouvel article.
  </p>
 
";
    }

    public function getTemplateName()
    {
        return "RafSiteBundle:Blog:ajouter.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 14,  47 => 13,  42 => 10,  39 => 9,  32 => 6,  29 => 5,);
    }
}
