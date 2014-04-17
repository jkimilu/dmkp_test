<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ems_Tree
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $ci = &$this->ci;
    }

    public function get_ems_tree()
    {
        $response_lead_functions = array(
            "regional_leader",
            "national_director",
            "response_manager",
            "regional_hea_director",
            "partnership_lead"
        );

        $appendix_sub_item = array(
            "response_lead_function" => $response_lead_functions,
            "programmes_function",
            "operations_function",
            "support_services_function",
            "liaison_function",
            "security_function",
        );

        return array(
            "intro" => array(
                "ems_summary" => array(
                    "summary",
                    "how_to_use_this_manual",
                    "why_this_manual",
                ),
                "ems_principles" => array(
                    "management_by_objective",
                    "unity_of_command",
                    "flexible_temporary_structure",
                    "span_of_control",
                    "common_terminology",
                ),
                "ems_functions" => array(
                    "response_manager",
                    "programmes",
                    "operations",
                    "support_services",
                    "liaison",
                    "security",
                ),
                "shared_leadership_ems" => array(
                    "shared_leadership",
                    "levels_of_accountability_and_responsibility",
                    "shared_leadership_ems",
                ),
                "appendix" => array(
                    "terms_of_reference" => $appendix_sub_item,
                    "standard_operating_guidelines" => $appendix_sub_item,
                )
            )
        );
    }
}