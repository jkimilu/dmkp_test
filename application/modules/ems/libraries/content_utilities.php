<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content_Utilities
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function get_partials($section_key, $content_item_key, $content, $chunks, $language)
    {
        $function = "partials_{$section_key}_{$content_item_key}";
        $content_partials = method_exists($this, $function) ? $this->$function($content, $chunks, $language) : array();

        return $content_partials;
    }

    // ------------------------------------
    // Partial content processors
    // ------------------------------------

    private function partials_appendix_response_manager($content, $chunks, $language)
    {
        // No tabs
        return array(
            "tabs" => array(
                array("tor" => $chunks['terms_of_reference'], "sog" => $chunks['standard_operating_guidelines'])
            )
        );
    }

    private function partials_appendix_senior_leadership($content, $chunks, $language)
    {
        // Tabs present
        return array(
            "tabs" => array(
                "1. {$language['regional_leader']}" => array(
                    "content_purpose" => $chunks['regional_leader_purpose'],
                    "content_role" => $chunks['regional_leader_role'],
                    "tor" => $chunks['terms_of_reference_regional_leader'],
                    "sog" => $chunks['standard_operating_guidelines_regional_leader']
                ),
                "2. {$language['national_director']}" => array(
                    "content_purpose" => $chunks['national_director_purpose'],
                    "content_role" => $chunks['national_director_role'],
                    "tor" => $chunks['terms_of_reference_national_director'],
                    "sog" => $chunks['standard_operating_guidelines_national_director']
                ),
                "3. {$language['regional_hea_director']}" => array(
                    "content_purpose" => $chunks['regional_hea_director_purpose'],
                    "content_role" => $chunks['regional_hea_director_role'],
                    "tor" => $chunks['terms_of_reference_regional_hea_director'],
                    "sog" => $chunks['standard_operating_guidelines_regional_hea_director']
                ),
                "4. {$language['partnership_lead_hea']}" => array(
                    "content_purpose" => $chunks['partnership_lead_hea_purpose'],
                    "content_role" => $chunks['partnership_lead_hea_role'],
                    "tor" => $chunks['terms_of_reference_partnership_lead_hea'],
                    "sog" => $chunks['standard_operating_guidelines_partnership_lead_hea']
                ),
            )
        );
    }

    private function partials_appendix_programmes_function_lead($content, $chunks, $language)
    {
        // No tabs
        return array(
            "tabs" => array(
                array("tor" => $chunks['terms_of_reference'], "sog" => $chunks['standard_operating_guidelines'])
            )
        );
    }

    private function partials_appendix_operations_function_lead($content, $chunks, $language)
    {
        return array();
    }

    private function partials_appendix_support_services_function_lead($content, $chunks, $language)
    {
        return array();
    }

    private function partials_appendix_liaison_function_lead($content, $chunks, $language)
    {
        // No tabs
        return array(
            "tabs" => array(
                array("tor" => $chunks['terms_of_reference'], "sog" => $chunks['standard_operating_guidelines'])
            )
        );
    }

    private function partials_appendix_security_function_lead($content, $chunks, $language)
    {
        // No tabs
        return array(
            "tabs" => array(
                array("tor" => $chunks['terms_of_reference'], "sog" => $chunks['standard_operating_guidelines'])
            )
        );
    }
}