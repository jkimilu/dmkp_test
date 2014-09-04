<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ems_Tree
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $ci = &$this->ci;
    }

    private function build_appendix_sub_item()
    {
        return array(
            "response_manager",
            "senior_leadership",
            "programmes_function_lead",
            "operations_function_lead",
            "support_services_function_lead",
            "liaison_function_lead",
            "security_function_lead",
        );
    }

    /**
     * Get user roles
     *
     * @return mixed
     */
    public function get_roles()
    {
        return array(
            "default",
            "response_manager",
            "senior_leadership",
            "functional_lead",
            "general_response_staff",
        );
    }

    /**
     * Get the full EMS tree
     *
     * @return array
     */
    public function get_ems_tree()
    {
        return array(
            // Index 0
            array("ems_summary", array(
                "summary",
                "how_to_use_this_manual",
                "why_this_manual",
            )),
            // Index 1
            array("ems_principles", array(
                "introduction",
                "management_by_objective",
                "unity_of_command",
                "flexible_temporary_structure",
                "span_of_control",
                "common_terminology",
                "competency_based_staffing",
            )),
            // Index 2
            array("ems_functions", array(
                "introduction",
                "response_manager",
                "programmes",
                "operations",
                "support_services",
                "liaison",
                "security",
            )),
            // Index 3
            array("shared_leadership_ems", array(
                "introduction",
                "levels_of_accountability_and_responsibility",
                "shared_leadership_ems",
                "orient",
                "ensure",
                "enable",
            )),
            // Index 4
            array("appendix", $this->build_appendix_sub_item()),
            // Index 5
            array("appendices", array(
                "abbreviations",
                "definitions",
                "strategic_intent_definition",
                "strategic_intent_examples",
                "sample_ems_scenario",
                "sample_ems_information",
            ))
        );
    }

    /**
     * Gets the frontend tree object with various additions
     *
     * @param $language
     * @return stdClass
     */

    public function get_ems_frontend_tree($language)
    {
        $tree_object = new stdClass();

        $tree_object->tree = $this->get_ems_tree();
        $tree_object->icons = array(
            "0" => array(
                "0" => "fa fa-info-circle",
            ),
            "1" => array(
                "0" => "fa fa-list-ol",
            ),
            "2" => array(
                "0" => "fa fa-cogs",
                "2" => "fa fa-users",
                "3" => "fa fa-file",
                "4" => "fa fa-cogs",
                "5" => "fa fa-briefcase",
                "6" => "fa fa-comments",
                "7" => "fa fa-shield",
            ),
            "3" => array(
                "0" => "fa fa-exchange",
            ),
            "4" => array(
                "0" => "fa fa-list-ul",
            ),
            "5" => array(
                "0" => "fa fa-plus-square"
            ),
        );
        $tree_object->list_classes = array(
            "2" => array(
                "1" => "Lead",
                "2" => "Lead",
                "3" => "Plan",
                "4" => "Implement",
                "5" => "Resource",
                "6" => "Facilitate",
                "7" => "Protect",
            ),
        );
        $tree_object->pre_pends = array(
            "1" => array(
                "2" => "1.",
                "3" => "2.",
                "4" => "3.",
                "5" => "4.",
                "6" => "5.",
                "7" => "6.",
            ),
            "3" => array(
                "4" => "1.",
                "5" => "2.",
                "6" => "3.",
            ),
        );
        $tree_object->post_pends = array(
            "2" => array(
                "2" => " (". $language['lead'].")",
                "3" => " (". $language['plan'].")",
                "4" => " (". $language['implement'].")",
                "5" => " (". $language['resource'].")",
                "6" => " (". $language['facilitate'].")",
                "7" => " (". $language['protect'].")",
            )
        );

        return $tree_object;
    }

    /**
     * Generates a breadcrumb
     *
     * @param $tree
     * @param $language
     * @param $current_node_index
     * @param $current_sub_node_index
     * @return string
     */

    public function get_breadcrumb($tree, $language, $current_node_index, $current_sub_node_index)
    {
        $home_link = site_url('/');

        $current_node = $tree[$current_node_index][0];
        $current_sub_node = $tree[$current_node_index][1][$current_sub_node_index];

        $parent_node_link = site_url("/ems/index/{$tree[$current_node_index][0]}/{$tree[$current_node_index][1][0]}/{$current_node_index}/0");

        $bread_crumb = '
            <ul class="breadcrumb">
                <li><a href="'.$home_link.'">'.$language['home'].'</a> <span class="divider">/</span></li>
                <li><a href="'.$parent_node_link.'">'.$language[$current_node].'</a> <span class="divider">/</span></li>
                <li class="active">'.$language[$current_sub_node].'</li>
            </ul>';

        return $bread_crumb;
    }

    /**
     * Get the link to the previous tree item
     *
     * @param $tree
     * @param $current_node_index
     * @param $current_sub_node_index
     * @param bool $as_node_key
     * @return null|string
     */
    public function get_previous_link($tree, $current_node_index, $current_sub_node_index, $as_node_key = false)
    {
        $node_id = 0;
        $sub_node_id = 0;

        if($current_node_index > 0)
        {
            if($current_sub_node_index > 0)
            {
                $node_id = $current_node_index;
                $sub_node_id = $current_sub_node_index - 1;
            }
            else
            {
                $node_id = $current_node_index - 1;
                $sub_node_id = count($tree[$node_id][1]) - 1;
            }
        }
        else
        {
            if($current_sub_node_index > 0)
            {
                $node_id = $current_node_index;
                $sub_node_id = $current_sub_node_index - 1;
            }
            else
            {
                return null;
            }
        }

        if(!$as_node_key)
        {
            return "{$tree[$node_id][0]}/{$tree[$node_id][1][$sub_node_id]}/{$node_id}/{$sub_node_id}";
        }
        else
        {
            $tree_sub_node = $tree[$node_id][1][$sub_node_id];

            if($tree_sub_node != "introduction" && $tree_sub_node != "response_manager" &&
                $tree_sub_node != "abbreviations")
            {
                return $tree[$node_id][1][$sub_node_id];
            }
            else if($tree_sub_node == "introduction")
            {
                return $tree[$node_id][0]."_".$tree[$node_id][1][$sub_node_id];
            }
            else if($tree_sub_node == "response_manager")
            {
                return $tree[$node_id][0]."_".$tree[$node_id][1][$sub_node_id];
            }
            else if($tree_sub_node == "abbreviations")
            {
                return $tree[$node_id][0]."_".$tree[$node_id][1][$sub_node_id];
            }
        }
    }

    /**
     * Get the link to the next tree item
     *
     * @param $tree
     * @param $current_node_index
     * @param $current_sub_node_index
     * @param bool $as_node_key
     * @return null|string
     */
    public function get_next_link($tree, $current_node_index, $current_sub_node_index, $as_node_key = false)
    {
        $node_id = 0;
        $sub_node_id = 0;

        $num_parent_nodes = count($tree);
        $num_children_nodes = count($tree[$current_node_index][1]);

        if($current_node_index < ($num_parent_nodes - 1))
        {
            if($current_sub_node_index < ($num_children_nodes - 1))
            {
                $node_id = $current_node_index;
                $sub_node_id = $current_sub_node_index + 1;
            }
            else
            {
                $node_id = $current_node_index + 1;
                $sub_node_id = 0;
            }
        }
        else
        {
            if($current_sub_node_index < ($num_children_nodes - 1))
            {
                $node_id = $current_node_index;
                $sub_node_id = $current_sub_node_index + 1;
            }
            else
            {
                return null;
            }
        }

        if(!$as_node_key)
        {
            return "{$tree[$node_id][0]}/{$tree[$node_id][1][$sub_node_id]}/{$node_id}/{$sub_node_id}";
        }
        else
        {
            $tree_sub_node = $tree[$node_id][1][$sub_node_id];

            if($tree_sub_node != "introduction" && $tree_sub_node != "response_manager" &&
                $tree_sub_node != "abbreviations")
            {
                return $tree[$node_id][1][$sub_node_id];
            }
            else if($tree_sub_node == "introduction")
            {
                return $tree[$node_id][0]."_".$tree[$node_id][1][$sub_node_id];
            }
            else if($tree_sub_node == "response_manager")
            {
                return $tree[$node_id][0]."_".$tree[$node_id][1][$sub_node_id];
            }
            else if($tree_sub_node == "abbreviations")
            {
                return $tree[$node_id][0]."_".$tree[$node_id][1][$sub_node_id];
            }
        }
    }

    public function get_content_segments($section, $sub_section = null)
    {
        switch($section)
        {
            case "ems_summary":
                return array();
                break;
            case "ems_principles":
                return array();
                break;
            case "ems_functions":
                return array();
                break;
            case "shared_leadership_ems":
                return array();
                break;
            case "appendix":
                switch($sub_section)
                {
                    case "senior_leadership":
                        return array(
                            "regional_leader",
                            "regional_leader_purpose",
                            "regional_leader_role",
                            "terms_of_reference_regional_leader",
                            "standard_operating_guidelines_regional_leader",

                            "national_director",
                            "national_director_purpose",
                            "national_director_role",
                            "terms_of_reference_national_director",
                            "standard_operating_guidelines_national_director",

                            "regional_hea_director",
                            "regional_hea_director_purpose",
                            "regional_hea_director_role",
                            "terms_of_reference_regional_hea_director",
                            "standard_operating_guidelines_regional_hea_director",

                            "partnership_lead_hea",
                            "partnership_lead_hea_purpose",
                            "partnership_lead_hea_role",
                            "terms_of_reference_partnership_lead_hea",
                            "standard_operating_guidelines_partnership_lead_hea",
                        );
                        break;
                    case "operations_function_lead":
                        return array(
                            "operations",
                            "operations_purpose",
                            "operations_role",
                            "terms_of_reference_operations",
                            "standard_operating_guidelines_operations",

                            "sector_technical",
                            "sector_technical_purpose",
                            "sector_technical_role",
                            "terms_of_reference_sector_technical",
                            "standard_operating_guidelines_sector_technical",
                        );
                        break;
                    case "support_services_function_lead":
                        return array(
                            "administration",
                            "administration_purpose",
                            "administration_role",
                            "terms_of_reference_administration",
                            "standard_operating_guidelines_administration",

                            "logistics",
                            "logistics_purpose",
                            "logistics_role",
                            "terms_of_reference_logistics",
                            "standard_operating_guidelines_logistics",

                            "finance",
                            "finance_purpose",
                            "finance_role",
                            "terms_of_reference_finance",
                            "standard_operating_guidelines_finance",

                            "ict",
                            "ict_purpose",
                            "ict_role",
                            "terms_of_reference_ict",
                            "standard_operating_guidelines_ict",

                            "people_culture",
                            "people_culture_purpose",
                            "people_culture_role",
                            "terms_of_reference_people_culture",
                            "standard_operating_guidelines_people_culture",
                        );
                        break;
                    default:
                        return array(
                            "purpose",
                            "role",
                            "terms_of_reference",
                            "standard_operating_guidelines",
                        );
                        break;
                }


                break;
            case "appendices":
                return array();
                break;
        }
    }

    public function get_tor_sog_relationships($section)
    {
        $appendix_sub_item = array(
            "response_lead_function" => "response_lead_function",
            "programmes_function" => "programmes_function",
            "operations_function" => "operations_function",
            "support_services_function" => "support_services_function",
            "liaison_function" => "liaison_function",
            "security_function" => "security_function",
        );

        return $appendix_sub_item[$section];
    }
}