<?php

/* AccountBundle:Default:testing.html.twig */
class __TwigTemplate_4dfad4b5aec843c60483bc8066be64a1fb552b3946e55e743c8c6ddced9a33a1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("TwigBundle::layout.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TwigBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        // line 4
        echo "    <link rel=\"icon\" sizes=\"16x16\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmedemo/css/demo.css"), "html", null, true);
        echo "\" />
";
    }

    // line 8
    public function block_title($context, array $blocks = array())
    {
        echo "Demo Bundle";
    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        // line 11
        echo "<div>
    <h1>Welcome to ABC</h1>
    ";
        // line 13
        if (array_key_exists("name", $context)) {
            // line 14
            echo "        ";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "
        <a href=\"/account/changepassword\">Change Password</a>
        <a href=\"/account/logout\">Logout</a>
    ";
        } elseif (        // line 17
array_key_exists("token", $context)) {
            // line 18
            echo "        <a href=\"/account/changepassword\">Change Password</a>
        <a href=\"/account/logout\">Logout</a>
    ";
        } else {
            // line 21
            echo "        <a href=\"/account/login\">Login</a>
        <a href=\"/account/register\">Register</a>
        <a href=\"/account/resetpassword\">Reset password</a>    

        ";
            // line 25
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->env->getExtension('hwi_oauth')->getResourceOwners());
            foreach ($context['_seq'] as $context["_key"] => $context["owner"]) {
                // line 26
                echo "            <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('hwi_oauth')->getLoginUrl($context["owner"]), "html", null, true);
                echo "\">Login via facebook</a> <br />
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['owner'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 28
            echo "
    ";
        }
        // line 30
        echo "</div>

";
    }

    public function getTemplateName()
    {
        return "AccountBundle:Default:testing.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 30,  100 => 28,  91 => 26,  87 => 25,  81 => 21,  76 => 18,  74 => 17,  67 => 14,  65 => 13,  61 => 11,  58 => 10,  52 => 8,  46 => 5,  41 => 4,  38 => 3,  11 => 1,);
    }
}
