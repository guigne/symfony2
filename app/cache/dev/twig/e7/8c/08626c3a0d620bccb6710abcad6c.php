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
        return array (  27 => 7,  22 => 4,  19 => 2,  150 => 61,  147 => 60,  144 => 59,  140 => 48,  137 => 47,  130 => 11,  127 => 10,  115 => 63,  113 => 59,  101 => 49,  99 => 47,  93 => 44,  89 => 42,  83 => 40,  80 => 39,  75 => 35,  62 => 28,  54 => 26,  38 => 13,  36 => 10,  31 => 8,  23 => 2,  63 => 18,  60 => 17,  55 => 19,  52 => 25,  46 => 12,  43 => 10,  40 => 9,  33 => 6,  30 => 5,  121 => 8,  110 => 27,  103 => 26,  98 => 25,  92 => 20,  85 => 18,  71 => 16,  68 => 30,  66 => 14,  48 => 13,  42 => 10,  39 => 8,  32 => 5,  29 => 4,);
    }
}
