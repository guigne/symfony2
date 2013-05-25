<?php

/* RafSiteBundle:Blog:menu.html.twig */
class __TwigTemplate_e78c08626c3a0d620bccb6710abcad6c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo " 
";
        // line 4
        echo " 
<ul>
<ul class=\"nav nav-pills nav-stacked\">
  ";
        // line 7
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["liste_articles"]) ? $context["liste_articles"] : $this->getContext($context, "liste_articles")));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 8
            echo "    <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("rafsite_voir", array("id" => $this->getAttribute((isset($context["article"]) ? $context["article"] : $this->getContext($context, "article")), "id"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["article"]) ? $context["article"] : $this->getContext($context, "article")), "titre"), "html", null, true);
            echo "</a></li>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "</ul>
</ul>";
    }

    public function getTemplateName()
    {
        return "RafSiteBundle:Blog:menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 7,  22 => 4,  19 => 2,  131 => 55,  128 => 54,  125 => 53,  121 => 42,  118 => 41,  111 => 11,  108 => 10,  102 => 8,  96 => 57,  94 => 53,  82 => 43,  80 => 41,  74 => 38,  70 => 36,  64 => 34,  61 => 33,  56 => 29,  38 => 13,  36 => 10,  23 => 2,  68 => 18,  65 => 17,  57 => 17,  54 => 15,  45 => 12,  40 => 11,  35 => 10,  32 => 8,  29 => 7,  72 => 22,  67 => 20,  60 => 19,  55 => 14,  51 => 13,  46 => 11,  42 => 10,  39 => 9,  33 => 7,  31 => 8,  28 => 5,);
    }
}
