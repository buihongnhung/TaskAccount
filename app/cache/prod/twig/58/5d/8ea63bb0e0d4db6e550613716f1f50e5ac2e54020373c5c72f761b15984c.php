<?php

/* AccountBundle:Default:index.html.twig */
class __TwigTemplate_585d8ea63bb0e0d4db6e550613716f1f50e5ac2e54020373c5c72f761b15984c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("base.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "<div>
    <h1>Welcome to ABC</h1>
    ";
        // line 6
        if (array_key_exists("name", $context)) {
            // line 7
            echo "        ";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "
        <a href=\"/account/changepassword\">Change Password</a>
        <a href=\"/account/logout\">Logout</a>
    ";
        } else {
            // line 11
            echo "        <a href=\"/login\">Login</a>
        <a href=\"/connect/facebook\">Login Via Facebook</a>
        <a href=\"/register\">Register</a>
        <a href=\"/account/resetpassword\">Reset password</a>
    ";
        }
        // line 16
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
        return array (  60 => 16,  53 => 11,  45 => 7,  43 => 6,  39 => 4,  36 => 3,  11 => 1,);
    }
}
