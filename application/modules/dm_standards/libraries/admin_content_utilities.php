<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Content_Utilities
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function content_states($section_key, $content_item_key, $language)
    {
        // Section wide
        $section_function = "section_rules_{$section_key}";
        $content_rules = method_exists($this, $section_function) ?
            $this->$section_function($content_item_key, $language) : array();

        // Content item wide
        $function = "rules_{$section_key}_{$content_item_key}";
        $content_content_partials = method_exists($this, $function) ? $this->$function($language) : array();

        $content_rules = array_merge($content_rules, $content_content_partials);

        if(count($content_rules) == 0)
            $content_rules = array(
                "field_display" => array(),
                "optionals" => array(),
                "hidden" => array(),
            );

        return $content_rules;
    }

    private function section_rules_appendix($content_item_key, $language)
    {
        return array(
            "field_display" => array(
                "main_content" => $language["preamble"],
            ),
            "optionals" => array(
                "main_content",
            ),
            "hidden" => array(),
        );
    }

    private function rules_appendices_abbreviations($language)
    {
        return array(
            "field_display" => array(
                "main_content" => $language["preamble"],
            ),
            "optionals" => array(),
            "hidden" => array(),
        );
    }

    private function rules_appendices_definitions($language)
    {
        return array(
            "field_display" => array(
                "main_content" => $language["preamble"],
            ),
            "optionals" => array(),
            "hidden" => array(),
        );
    }
}