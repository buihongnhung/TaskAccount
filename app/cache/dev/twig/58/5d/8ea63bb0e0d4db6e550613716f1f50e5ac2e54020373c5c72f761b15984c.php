<?php

/* AccountBundle:Default:index.html.twig */
class __TwigTemplate_585d8ea63bb0e0d4db6e550613716f1f50e5ac2e54020373c5c72f761b15984c extends Twig_Template
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
        ";
            // line 15
            if (array_key_exists("fbid", $context)) {
                // line 16
                echo "            <a href=\"/login/facebook\">Connect with FB</a>
        ";
            }
            // line 18
            echo "
        <a href=\"/account/changepassword\">Change Password</a>
        <a href=\"/account/logout\">Logout</a>
    ";
        } else {
            // line 22
            echo "        <a href=\"/login\">Login</a>
        <a href=\"/account/resetpassword\">Forgot password</a>
        <a href=\"/login/facebook\">Login via FB</a>
        <a href=\"/register\">Register</a>
    ";
        }
        // line 27
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
        return array (  89 => 27,  82 => 22,  76 => 18,  72 => 16,  70 => 15,  65 => 14,  63 => 13,  58 => 10,  49 => 7,  46 => 6,  42 => 5,  39 => 4,  36 => 3,  11 => 2,);
    }
}
