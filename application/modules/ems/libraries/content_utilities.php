<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content_Utilities
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();;
    }

    public function get_partials($section_key, $content_item_key, $content, $chunks)
    {
        $function = "partials_{$section_key}_{$content_item_key}";
        $content_partials = method_exists($this, $function) ? $this->$function($content, $chunks) : array();

        return $content_partials;
    }

    // ------------------------------------
    // Partial content processors
    // ------------------------------------

    private function partials_appendix_response_manager($content, $chunks)
    {
        return array();
    }

    private function partials_appendix_senior_leadership($content, $chunks)
    {
        return array();
    }

    private function partials_appendix_programmes_function_lead($content, $chunks)
    {
        return array();
    }

    private function partials_appendix_operations_function_lead($content, $chunks)
    {
        return array();
    }

    private function partials_appendix_support_services_function_lead($content, $chunks)
    {
        return array();
    }

    private function partials_appendix_liaison_function_lead($content, $chunks)
    {
        return array();
    }

    private function partials_appendix_security_function_lead($content, $chunks)
    {
        return array();
    }
}