<?php

/* AccountBundle:Default:index.html.twig */
class __TwigTemplate_b138bf5c95e43e1a3d9ec9f60c402ec53f058c9c6cf8a8681191c4445015222d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        try {
            $this->parent = $this->env->loadTemplate("::base.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(2);

            throw $e;
        }

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "
";
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "get", array(0 => "warning"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 6
            echo "    <div class=\"flash-notice\">
        ";
            // line 7
            echo twig_escape_filter($this->env, $context["flashMessage"], "html", null, true);
            echo "
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "
<div>
    <h1>Welcome to ABC</h1>
    ";
        // line 13
        if (array_key_exists("name", $context)) {
            // line 14
            echo "        ";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
            echo "
        <a href=\"/account/changepassword\">Change Password</a>
        <a href=\"/account/logout\">Logout</a>
    ";
        } else {
            // line 18
            echo "        <a href=\"/account/login\">Login</a>
        <a href=\"/account/register\">Register</a>
    ";
        }
        // line 21
        echo "</div>

";
    }

    public function getTemplateName()
    {
        return "AccountBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 21,  73 => 18,  65 => 14,  63 => 13,  58 => 10,  49 => 7,  46 => 6,  42 => 5,  39 => 4,  36 => 3,  11 => 2,);
    }
}
