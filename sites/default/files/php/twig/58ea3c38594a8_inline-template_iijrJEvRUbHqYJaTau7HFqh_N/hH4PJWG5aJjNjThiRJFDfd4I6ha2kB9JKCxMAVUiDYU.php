<?php

/* {# inline_template_start #}{{name}}
{% if roles_target_id != "Operator" %}<br>({{ roles_target_id }}){% endif %} */
class __TwigTemplate_a936ad6d0be111b29807914213fc991b5cc2787021538f197cad48f59d4d387c extends Twig_Template
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
        $tags = array("if" => 2);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if'),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 1
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true));
        echo "
";
        // line 2
        if (((isset($context["roles_target_id"]) ? $context["roles_target_id"] : null) != "Operator")) {
            echo "<br>(";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["roles_target_id"]) ? $context["roles_target_id"] : null), "html", null, true));
            echo ")";
        }
    }

    public function getTemplateName()
    {
        return "{# inline_template_start #}{{name}}
{% if roles_target_id != \"Operator\" %}<br>({{ roles_target_id }}){% endif %}";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 2,  44 => 1,);
    }

    public function getSource()
    {
        return "{# inline_template_start #}{{name}}
{% if roles_target_id != \"Operator\" %}<br>({{ roles_target_id }}){% endif %}";
    }
}
