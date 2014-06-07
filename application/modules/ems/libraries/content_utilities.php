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
                array(
                    "title" => $language['response_manager'],
                    "content" => $content,
                    "content_purpose" => $chunks["purpose"],
                    "content_role" => $chunks["role"],
                    "tor" => $chunks['terms_of_reference'],
                    "sog" => $chunks['standard_operating_guidelines'],
                )
            )
        );
    }

    private function partials_appendix_senior_leadership($content, $chunks, $language)
    {
        // Tabs present
        return array(
            "tabs" => array(
                "1. {$language['regional_leader']}" => array(
                    "title" => $language['regional_leader'],
                    "content" => $chunks['regional_leader'],
                    "content_purpose" => $chunks['regional_leader_purpose'],
                    "content_role" => $chunks['regional_leader_role'],
                    "tor" => $chunks['terms_of_reference_regional_leader'],
                    "sog" => $chunks['standard_operating_guidelines_regional_leader']
                ),
                "2. {$language['national_director']}" => array(
                    "title" => $language['national_director'],
                    "content" => $chunks['national_director'],
                    "content_purpose" => $chunks['national_director_purpose'],
                    "content_role" => $chunks['national_director_role'],
                    "tor" => $chunks['terms_of_reference_national_director'],
                    "sog" => $chunks['standard_operating_guidelines_national_director']
                ),
                "3. {$language['regional_hea_director']}" => array(
                    "title" => $language['regional_hea_director'],
                    "content" => $chunks['regional_hea_director'],
                    "content_purpose" => $chunks['regional_hea_director_purpose'],
                    "content_role" => $chunks['regional_hea_director_role'],
                    "tor" => $chunks['terms_of_reference_regional_hea_director'],
                    "sog" => $chunks['standard_operating_guidelines_regional_hea_director']
                ),
                "4. {$language['partnership_lead_hea']}" => array(
                    "title" => $language['partnership_lead_hea'],
                    "content" => $chunks['partnership_lead_hea'],
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
                array(
                    "title" => $language['programmes_function_lead'],
                    "content" => $content,
                    "content_purpose" => $chunks["purpose"],
                    "content_role" => $chunks["role"],
                    "tor" => $chunks['terms_of_reference'],
                    "sog" => $chunks['standard_operating_guidelines'],
                )
            )
        );
    }

    private function partials_appendix_operations_function_lead($content, $chunks, $language)
    {
        // Tabs present
        return array(
            "tabs" => array(
                "1. {$language['operations']}" => array(
                    "title" => $language['operations'],
                    "content" => $chunks['operations'],
                    "content_purpose" => $chunks['operations_purpose'],
                    "content_role" => $chunks['operations_role'],
                    "tor" => $chunks['terms_of_reference_operations'],
                    "sog" => $chunks['standard_operating_guidelines_operations']
                ),
                "2. {$language['sector_technical']}" => array(
                    "title" => $language['sector_technical'],
                    "content" => $chunks['sector_technical'],
                    "content_purpose" => $chunks['sector_technical_purpose'],
                    "content_role" => $chunks['sector_technical_role'],
                    "tor" => $chunks['terms_of_reference_sector_technical'],
                    "sog" => $chunks['standard_operating_guidelines_sector_technical']
                ),
            )
        );
    }

    private function partials_appendix_support_services_function_lead($content, $chunks, $language)
    {
        return array(
            "tabs" => array(
                "1. {$language['administration']}" => array(
                    "title" => $language['administration'],
                    "content" => $chunks['administration'],
                    "content_purpose" => $chunks['administration_purpose'],
                    "content_role" => $chunks['administration_role'],
                    "tor" => $chunks['terms_of_reference_administration'],
                    "sog" => $chunks['standard_operating_guidelines_administration']
                ),
                "2. {$language['logistics']}" => array(
                    "title" => $language['logistics'],
                    "content" => $chunks['logistics'],
                    "content_purpose" => $chunks['logistics_purpose'],
                    "content_role" => $chunks['logistics_role'],
                    "tor" => $chunks['terms_of_reference_logistics'],
                    "sog" => $chunks['standard_operating_guidelines_logistics']
                ),
                "3. {$language['finance']}" => array(
                    "title" => $language['finance'],
                    "content" => $chunks['finance'],
                    "content_purpose" => $chunks['finance_purpose'],
                    "content_role" => $chunks['finance_role'],
                    "tor" => $chunks['terms_of_reference_finance'],
                    "sog" => $chunks['standard_operating_guidelines_finance']
                ),
                "4. {$language['ict']}" => array(
                    "title" => $language['ict'],
                    "content" => $chunks['ict'],
                    "content_purpose" => $chunks['ict_purpose'],
                    "content_role" => $chunks['ict_role'],
                    "tor" => $chunks['terms_of_reference_ict'],
                    "sog" => $chunks['standard_operating_guidelines_ict']
                ),
                "5. {$language['people_culture']}" => array(
                    "title" => $language['people_culture'],
                    "content" => $chunks['people_culture'],
                    "content_purpose" => $chunks['people_culture_purpose'],
                    "content_role" => $chunks['people_culture_role'],
                    "tor" => $chunks['terms_of_reference_people_culture'],
                    "sog" => $chunks['standard_operating_guidelines_people_culture']
                ),
            )
        );
    }

    private function partials_appendix_liaison_function_lead($content, $chunks, $language)
    {
        // No tabs
        return array(
            "tabs" => array(
                array(
                    "title" => $language['liaison_function_lead'],
                    "content" => $content,
                    "content_purpose" => $chunks["purpose"],
                    "content_role" => $chunks["role"],
                    "tor" => $chunks['terms_of_reference'],
                    "sog" => $chunks['standard_operating_guidelines'],
                )
            )
        );
    }

    private function partials_appendix_security_function_lead($content, $chunks, $language)
    {
        // No tabs
        return array(
            "tabs" => array(
                array(
                    "title" => $language['security_function_lead'],
                    "content" => $content,
                    "content_purpose" => $chunks["purpose"],
                    "content_role" => $chunks["role"],
                    "tor" => $chunks['terms_of_reference'],
                    "sog" => $chunks['standard_operating_guidelines'],
                )
            )
        );
    }
}