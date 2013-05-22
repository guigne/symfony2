<?php

/* RafSiteBundle:Blog:formulaire.html.twig */
class __TwigTemplate_b4a01e83f3fc635dd8b7c986301dc02b extends Twig_Template
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
<h3>Formulaire d'article</h3>
 
<div class=\"well\">
\t<form action=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("rafsite_ajouter"), "html", null, true);
        echo "\" method=\"post\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo ">
\t 
\t";
        // line 9
        echo "\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
\t 
\t<div>
\t  ";
        // line 13
        echo "\t  ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "titre"), 'label', array("label" => "Titre de l'article"));
        echo "
\t 
\t  ";
        // line 16
        echo "\t  ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "titre"), 'errors');
        echo "
\t 
\t  ";
        // line 19
        echo "\t  ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "titre"), 'widget');
        echo "
\t</div>
\t 
\t";
        // line 23
        echo "\t<div>
\t  ";
        // line 24
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "contenu"), 'label', array("label" => "Contenu de l'article"));
        echo "
\t  ";
        // line 25
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "contenu"), 'errors');
        echo "
\t  ";
        // line 26
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "contenu"), 'widget');
        echo "
\t</div>
\t 
\t";
        // line 33
        echo "\t";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "

\t<input type=\"submit\" class=\"btn btn-primary\" value=\"Enregistrer\" />
\t 
\t</form>
</div>

";
        // line 42
        echo "<script src=\"http://code.jquery.com/jquery-1.8.2.min.js\"></script>
 
";
        // line 45
        echo "<script type=\"text/javascript\">
\$(document).ready(function() {
  // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
  var \$container = \$('div#raf_sitebundle_articletype_categories');
 
  // On ajoute un lien pour ajouter une nouvelle catégorie
  var \$lienAjout = \$('<a href=\"#\" id=\"ajout_categorie\" class=\"btn\">Ajouter une catégorie</a>');
  \$container.append(\$lienAjout);
 
  // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
  \$lienAjout.click(function(e) {
    ajouterCategorie(\$container);
    e.preventDefault(); // évite qu'un # apparaisse dans l'URL
    return false;
  });
 
  // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
  var index = \$container.find(':input').length;
 
  // On ajoute un premier champ directement s'il n'en existe pas déjà un (cas d'un nouvel article par exemple).
  if (index == 0) {
    ajouterCategorie(\$container);
  } else {
    // Pour chaque catégorie déjà existante, on ajoute un lien de suppression
    \$container.children('div').each(function() {
      ajouterLienSuppression(\$(this));
    });
  }
 
  // La fonction qui ajoute un formulaire Categorie
  function ajouterCategorie(\$container) {
    // Dans le contenu de l'attribut « data-prototype », on remplace :
    // - le texte \"__name__label__\" qu'il contient par le label du champ
    // - le texte \"__name__\" qu'il contient par le numéro du champ
    var \$prototype = \$(\$container.attr('data-prototype').replace(/__name__label__/g, 'Catégorie n°' + (index+1))
                                                        .replace(/__name__/g, index));
 
    // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
    ajouterLienSuppression(\$prototype);
 
    // On ajoute le prototype modifié à la fin de la balise <div>
    \$container.append(\$prototype);
 
    // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
    index++;
  }
 
  // La fonction qui ajoute un lien de suppression d'une catégorie
  function ajouterLienSuppression(\$prototype) {
    // Création du lien
    \$lienSuppression = \$('<a href=\"#\" class=\"btn btn-danger\">Supprimer</a>');
 
    // Ajout du lien
    \$prototype.append(\$lienSuppression);
 
    // Ajout du listener sur le clic du lien
    \$lienSuppression.click(function(e) {
      \$prototype.remove();
      e.preventDefault(); // évite qu'un # apparaisse dans l'URL
      return false;
    });
  }
});
</script>";
    }

    public function getTemplateName()
    {
        return "RafSiteBundle:Blog:formulaire.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 45,  86 => 42,  75 => 33,  69 => 26,  65 => 25,  61 => 24,  58 => 23,  51 => 19,  45 => 16,  39 => 13,  32 => 9,  25 => 6,  19 => 2,);
    }
}
