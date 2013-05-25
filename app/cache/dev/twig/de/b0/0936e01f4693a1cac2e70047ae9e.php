<?php

/* RafSiteBundle::layout.html.twig */
class __TwigTemplate_deb00936e01f4693a1cac2e70047ae9e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
            'rafsite_body' => array($this, 'block_rafsite_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        // line 6
        echo "  Blog - ";
        $this->displayParentBlock("title", $context, $blocks);
        echo "
";
    }

    // line 9
    public function block_body($context, array $blocks = array())
    {
        // line 10
        echo " 
  ";
        // line 12
        echo "  <h1>Blog</h1>
 
  <hr>
 
  ";
        // line 17
        echo "  ";
        $this->displayBlock('rafsite_body', $context, $blocks);
        // line 19
        echo " 
";
    }

    // line 17
    public function block_rafsite_body($context, array $blocks = array())
    {
        // line 18
        echo "  ";
    }

    public function getTemplateName()
    {
        return "RafSiteBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 18,  60 => 17,  55 => 19,  52 => 17,  46 => 12,  43 => 10,  40 => 9,  33 => 6,  30 => 5,  121 => 30,  110 => 27,  103 => 26,  98 => 25,  92 => 20,  85 => 18,  71 => 16,  68 => 15,  66 => 14,  48 => 13,  42 => 9,  39 => 8,  32 => 5,  29 => 4,);
    }
}
