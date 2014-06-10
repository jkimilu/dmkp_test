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
        // Section wide
        $section_function = "section_partials_{$section_key}";
        $content_partials = method_exists($this, $section_function) ?
            $this->$section_function($content_item_key, $content, $chunks, $language) : array();

        // Content item wide
        $function = "partials_{$section_key}_{$content_item_key}";
        $content_content_partials = method_exists($this, $function) ? $this->$function($content, $chunks, $language) : array();

        $content_partials = array_merge($content_partials, $content_content_partials);

        return $content_partials;
    }

    // ------------------------------------
    // Partial content processors
    // ------------------------------------

    // EMS Summary

    private function partials_ems_summary_summary($content, $chunks, $language)
    {
        return array(
            "first_time_message" => true,
        );
    }

    // Appendix

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
            ),
            "right_column_mid_class" => "Lead",
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
            ),
            "right_column_mid_class" => "Lead",
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
            ),
            "right_column_mid_class" => "Plan",
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
            ),
            "right_column_mid_class" => "Implement",
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
            ),
            "right_column_mid_class" => "Resource",
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
            ),
            "right_column_mid_class" => "Facilitate",
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
            ),
            "right_column_mid_class" => "Protect",
        );
    }

    // EMS Functions

    private function partials_ems_functions_response_manager($content, $chunks, $language)
    {
        $link_to_tor_sog = site_url($this->get_link_to_section("appendix", "response_manager"));

        return(
            array(
                "tor_sog_link" => $link_to_tor_sog,
                "icon" => "fa fa-users",
                "pre_append" => "LEAD",
                "right_column_mid_class" => "Lead",
            )
        );
    }

    private function partials_ems_functions_programmes($content, $chunks, $language)
    {
        $link_to_tor_sog = site_url($this->get_link_to_section("appendix", "programmes_function_lead"));

        return(
            array(
                "tor_sog_link" => $link_to_tor_sog,
                "icon" => "fa fa-cogs",
                "pre_append" => "PLAN",
                "right_column_mid_class" => "Plan",
            )
        );
    }

    private function partials_ems_functions_operations($content, $chunks, $language)
    {
        $link_to_tor_sog = site_url($this->get_link_to_section("appendix", "operations_function_lead"));

        return(
            array(
                "tor_sog_link" => $link_to_tor_sog,
                "icon" => "fa fa-briefcase",
                "pre_append" => "IMPLEMENT",
                "right_column_mid_class" => "Implement",
            )
        );
    }

    private function partials_ems_functions_support_services($content, $chunks, $language)
    {
        $link_to_tor_sog = site_url($this->get_link_to_section("appendix", "support_services_function_lead"));

        return(
            array(
                "tor_sog_link" => $link_to_tor_sog,
                "icon" => "fa fa-briefcase",
                "pre_append" => "RESOURCE",
                "right_column_mid_class" => "Resource",
            )
        );
    }

    private function partials_ems_functions_liaison($content, $chunks, $language)
    {
        $link_to_tor_sog = site_url($this->get_link_to_section("appendix", "liaison_function_lead"));

        return(
            array(
                "tor_sog_link" => $link_to_tor_sog,
                "icon" => "fa fa-comments",
                "pre_append" => "FACILITATE",
                "right_column_mid_class" => "Facilitate",
            )
        );
    }

    private function partials_ems_functions_security($content, $chunks, $language)
    {
        $link_to_tor_sog = site_url($this->get_link_to_section("appendix", "security_function_lead"));

        return(
            array(
                "tor_sog_link" => $link_to_tor_sog,
                "icon" => "fa fa-shield",
                "pre_append" => "PROTECT",
                "right_column_mid_class" => "Protect",
            )
        );
    }

    // Appendices

    private function partials_appendices_abbreviations($content, $chunks, $language)
    {
        $this->ci->load->model('ems/content_abbreviations_model');

        $abbreviations = $this->ci->content_abbreviations_model->order_by('slug')->find_all();
        $abbreviations_array = array();

        if($abbreviations)
        {
            foreach($abbreviations as $abbreviation)
            {
                $abbreviations_array[$abbreviation->title] = $abbreviation->content;
            }
        }

        return array(
            "table" => $abbreviations_array,
        );
    }

    private function partials_appendices_definitions($content, $chunks, $language)
    {
        $this->ci->load->model('ems/content_definitions_model');

        $definitions = $this->ci->content_definitions_model->order_by('slug')->find_all();
        $definitions_array = array();

        if($definitions)
        {
            foreach($definitions as $definition)
            {
                $definitions_array[$definition->title] = $definition->content;
            }
        }

        return array(
            "table" => $definitions_array,
        );
    }

    // --------------------------------
    // Utility / Support functions
    // --------------------------------

    public function get_link_to_section($section_key, $content_key)
    {
        $this->ci->load->library('ems/ems_tree');
        $tree = $this->ci->ems_tree->get_ems_tree();

        $index = 0;
        $sub_index = 0;

        $current_index = 0;
        foreach($tree as $tree_item)
        {
            if($tree_item[0] == $section_key)
            {
                $index = $current_index;

                $current_sub_index = 0;

                foreach($tree_item[1] as $sub_tree_item)
                {
                    if($sub_tree_item == $content_key)
                    {
                        $sub_index = $current_sub_index;
                    }

                    $current_sub_index ++;
                }
            }

            $current_index ++;
        }

        return "ems/index/{$section_key}/{$content_key}/{$index}/{$sub_index}";
    }
}