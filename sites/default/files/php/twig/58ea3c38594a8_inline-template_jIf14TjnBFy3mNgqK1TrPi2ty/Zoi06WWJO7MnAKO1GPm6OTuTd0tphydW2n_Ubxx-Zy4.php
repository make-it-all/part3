<?php

/* {# inline_template_start #}{% if field_hardware is not empty %}<b>Hardware: </b>{{field_hardware}}{% endif %}
{% if field_hardware is not empty and field_software is not empty %}<br>{% endif %}
{% if field_software is not empty %}<b>Software: </b>{{field_software}}{% endif %} */
class __TwigTemplate_7c73e2d9f0c0c9ea35500d968fedfbbb213d17347932b0ca553de100e83db656 extends Twig_Template
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
        $tags = array("if" => 1);
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
        if ( !twig_test_empty((isset($context["field_hardware"]) ? $context["field_hardware"] : null))) {
            echo "<b>Hardware: </b>";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["field_hardware"]) ? $context["field_hardware"] : null), "html", null, true));
        }
        // line 2
        if (( !twig_test_empty((isset($context["field_hardware"]) ? $context["field_hardware"] : null)) &&  !twig_test_empty((isset($context["field_software"]) ? $context["field_software"] : null)))) {
            echo "<br>";
        }
        // line 3
        if ( !twig_test_empty((isset($context["field_software"]) ? $context["field_software"] : null))) {
            echo "<b>Software: </b>";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["field_software"]) ? $context["field_software"] : null), "html", null, true));
        }
    }

    public function getTemplateName()
    {
        return "{# inline_template_start #}{% if field_hardware is not empty %}<b>Hardware: </b>{{field_hardware}}{% endif %}
{% if field_hardware is not empty and field_software is not empty %}<br>{% endif %}
{% if field_software is not empty %}<b>Software: </b>{{field_software}}{% endif %}";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 3,  50 => 2,  45 => 1,);
    }

    public function getSource()
    {
        return "{# inline_template_start #}{% if field_hardware is not empty %}<b>Hardware: </b>{{field_hardware}}{% endif %}
{% if field_hardware is not empty and field_software is not empty %}<br>{% endif %}
{% if field_software is not empty %}<b>Software: </b>{{field_software}}{% endif %}";
    }
}
