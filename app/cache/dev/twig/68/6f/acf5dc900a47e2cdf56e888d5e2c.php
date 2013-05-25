<?php

/* ::layout.html.twig */
class __TwigTemplate_686facf5dc900a47e2cdf56e888d5e2c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo " 
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
 
    <title>";
        // line 8
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
 
    ";
        // line 10
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 13
        echo "  </head>
 
  <body>
    <div class=\"container\">
      <div id=\"header\" class=\"hero-unit\">
        <h1>Mon Projet Symfony2</h1>
        <p>Ce projet est propulsé par Symfony2, et construit grâce au tutoriel du siteduzero.</p>
        <p><a class=\"btn btn-primary btn-large\" href=\"http://www.siteduzero.com/informatique/tutoriels/developpez-votre-site-web-avec-le-framework-symfony2\">
          Lire le tutoriel »
        </a></p>
      </div>

      ";
        // line 25
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 26
            echo "          Connecté en tant que ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "username"), "html", null, true);
            echo " - <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_logout"), "html", null, true);
            echo "\">Déconnexion</a>
      ";
        } else {
            // line 28
            echo "          <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_login"), "html", null, true);
            echo "\">Connexion</a>
      ";
        }
        // line 30
        echo " 
      <div class=\"row\">
        <div id=\"menu\" class=\"span3\">
          <h3>Le blog</h3>
          <ul class=\"nav nav-pills nav-stacked\">
            <li><a href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("rafsite_accueil"), "html", null, true);
        echo "\">Accueil du blog</a></li>

            ";
        // line 39
        echo "            ";
        if ($this->env->getExtension('security')->isGranted("ROLE_AUTEUR")) {
            // line 40
            echo "              <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("rafsite_ajouter"), "html", null, true);
            echo "\">Ajouter un article</a></li>
            ";
        }
        // line 42
        echo "          </ul>
                     
          ";
        // line 44
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("RafSiteBundle:Blog:menu", array("nombre" => 3)));
        echo "
        </div>
        <div id=\"content\" class=\"span9\">
          ";
        // line 47
        $this->displayBlock('body', $context, $blocks);
        // line 49
        echo "        </div>
      </div>
 
      <hr>
 
      <footer>
        <p>The sky's the limit © 2012 and beyond.</p>
      </footer>
    </div>
 
  ";
        // line 59
        $this->displayBlock('javascripts', $context, $blocks);
        // line 63
        echo " 
  </body>
</html>";
    }

    // line 8
    public function block_title($context, array $blocks = array())
    {
        echo "Raf";
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "      <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/bootstrap.css"), "html", null, true);
        echo "\" type=\"text/css\" />
    ";
    }

    // line 47
    public function block_body($context, array $blocks = array())
    {
        // line 48
        echo "          ";
    }

    // line 59
    public function block_javascripts($context, array $blocks = array())
    {
        // line 60
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/bootstrap.js"), "html", null, true);
        echo "\"></script>
  ";
    }

    public function getTemplateName()
    {
        return "::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 61,  147 => 60,  144 => 59,  140 => 48,  137 => 47,  130 => 11,  127 => 10,  121 => 8,  115 => 63,  113 => 59,  101 => 49,  99 => 47,  93 => 44,  89 => 42,  83 => 40,  80 => 39,  75 => 35,  68 => 30,  62 => 28,  54 => 26,  52 => 25,  38 => 13,  36 => 10,  31 => 8,  23 => 2,);
    }
}
