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
            "response_lead_function",
            "senior_leadership",
            "programmes_function",
            "operations_function",
            "support_services_function",
            "liaison_function",
            "security_function",
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
                "shared_leadership",
                "shared_leadership_ems",
                "orient",
                "ensure",
                "enable",
            )),
            // Index 4
            array("appendix", $this->build_appendix_sub_item())
        );
    }

    /**
     * Gets the frontend tree object with various additions
     *
     * @return stdClass
     */

    public function get_ems_frontend_tree()
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
                $sub_node_id = count($tree[$node_id]);
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
            return "{$tree[$node_id][0]}/{$tree[$node_id][1][$sub_node_id]}/{$node_id}/{$sub_node_id}";
        else
            return $tree[$node_id][1][$sub_node_id];
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
            return "{$tree[$node_id][0]}/{$tree[$node_id][1][$sub_node_id]}/{$node_id}/{$sub_node_id}";
        else
            return $tree[$node_id][1][$sub_node_id];
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
                            "terms_of_reference_regional_leader",
                            "standard_operating_guidelines_regional_leader",
                            "terms_of_reference_national_director",
                            "standard_operating_guidelines_national_director",
                            "terms_of_reference_regional_hea_director",
                            "standard_operating_guidelines_regional_hea_director",
                        );
                        break;
                    default:
                        return array(
                            "terms_of_reference",
                            "standard_operating_guidelines",
                        );
                        break;
                }


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