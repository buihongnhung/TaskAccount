<?php

/* AccountBundle:Admin:index.html.twig */
class __TwigTemplate_fd5895a56e02115ec8e1272f41a1bc40e56c1aab8d0c92555044e255af918056 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("::base.html.twig");
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
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_body($context, array $blocks = array())
    {
        // line 3
        echo "    <a href=\"/admin/addgroup\">ADD GROUP</a>
    <table>
        <tr>
            <td>ID</td>
            <td>UserName</td>
            <td>Email</td>
            <td>Roles</td>

        </tr>
        ";
        // line 12
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["accounts"]) ? $context["accounts"] : $this->getContext($context, "accounts")));
        foreach ($context['_seq'] as $context["_key"] => $context["account"]) {
            // line 13
            echo "            <tr>
                <td>";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["account"], "id", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($context["account"], "username", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["account"], "email", array()), "html", null, true);
            echo "</td>
                <td><a href=\"/admin/update/";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["account"], "id", array()), "html", null, true);
            echo "\">Edit</a></td>
                <td><a href=\"/admin/delete/";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($context["account"], "id", array()), "html", null, true);
            echo "\">Delete</a></td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['account'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "    </table>
";
    }

    public function getTemplateName()
    {
        return "AccountBundle:Admin:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 21,  73 => 18,  69 => 17,  65 => 16,  61 => 15,  57 => 14,  54 => 13,  50 => 12,  39 => 3,  36 => 2,  11 => 1,);
    }
}
