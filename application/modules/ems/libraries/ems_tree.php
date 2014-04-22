<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ems_Tree
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $ci = &$this->ci;
    }

    private function build_appendix_senior_lead_functions()
    {
        return $response_lead_functions = array(
            "regional_leader",
            "national_director",
            "response_manager",
            "regional_hea_director",
            "partnership_lead"
        );
    }

    private function build_appendix_sub_item()
    {
        return $appendix_sub_item = array(
            "response_lead_function",
            "senior_leadership" => $this->build_appendix_senior_lead_functions(),
            "programmes_function",
            "operations_function",
            "support_services_function",
            "liaison_function",
            "security_function",
        );
    }

    /**
     * Get user roles (They are part of the section "ems_functions" in the tree)
     *
     * @param int $role_index
     * @return mixed
     */
    public function get_roles($role_index = 2)
    {
        $tree = $this->get_ems_tree();
        $roles = $tree[$role_index];

        return $roles[1];
    }

    /**
     * Get the full EMS tree
     *
     * @return array
     */
    public function get_ems_tree()
    {
        return array(
            array("ems_summary", array(
                "summary",
                "how_to_use_this_manual",
                "why_this_manual",
            )),
            array("ems_principles", array(
                "management_by_objective",
                "unity_of_command",
                "flexible_temporary_structure",
                "span_of_control",
                "common_terminology",
            )),
            array("ems_functions", array(
                "response_manager",
                "programmes",
                "operations",
                "support_services",
                "liaison",
                "security",
            )),
            array("shared_leadership_ems", array(
                "shared_leadership",
                "levels_of_accountability_and_responsibility",
                "shared_leadership_ems",
            )),
            array("appendix", array(
                array("terms_of_reference", $this->build_appendix_sub_item()),
                array("standard_operating_guidelines", $this->build_appendix_sub_item()),
            ))
        );
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
                $node_id = $tree[$current_node_index - 1];
                $sub_node_id = count($node_id) - 1;
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
            return "{$tree[$node_id][0]}/{$tree[$node_id][$sub_node_id][0]}/{$node_id}/{$sub_node_id}";
        else
            return $tree[$node_id][$sub_node_id][0];
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
        $num_children_nodes = count($tree[$current_node_index]);

        if($current_node_index < ($num_parent_nodes - 1))
        {
            if($current_sub_node_index < ($num_children_nodes - 1))
            {
                $node_id = $current_node_index;
                $sub_node_id = $current_sub_node_index + 1;
            }
            else
            {
                $node_id = $tree[$current_node_index + 1];
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
            return "{$tree[$node_id][0]}/{$tree[$node_id][$sub_node_id][0]}/{$node_id}/{$sub_node_id}";
        else
            return $tree[$node_id][$sub_node_id][0];
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