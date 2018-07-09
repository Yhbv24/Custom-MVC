<?php

/* index.html.twig */
class __TwigTemplate_e8be71aeb5c00dbaedce0e966bf810bcc282210ae5cc599008330ca345832c7e extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<p>dsfdsdfdfsds</p>

";
        // line 3
        if (($context["name"] ?? null)) {
            // line 4
            echo "    <p>";
            echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
            echo "</p>
";
        }
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 4,  27 => 3,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.html.twig", "/Applications/MAMP/my_apps/custom_mvc/app/views/index.html.twig");
    }
}
