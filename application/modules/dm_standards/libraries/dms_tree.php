<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dms_Tree
{
    private $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    /**
     * Get the full EMS tree
     *
     * @return array
     */
    public function get_dms_tree()
    {
        return array(
            // Index 0
            array("introduction_to_dms", array(
                "what_is_new",
                "who_was_involved_in_putting_them_together",
                "how_do_the_new_standards_work",
                "standards_for_preparedness",
            )),
            // Index 1
            array("introduction", array(
                "standards_for_the_national_offices",
                "standards_for_the_support_offices",
                "standards_for_the_regional_offices",
                "standards_for_the_global_offices",
            )),
        );
    }

    /**
     * Gets the frontend tree object with various additions
     *
     * @param $language
     * @return stdClass
     */

    public function get_dms_frontend_tree($language)
    {
        $tree_object = new stdClass();

        $tree_object->tree = $this->get_dms_tree();
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
            case "introduction_to_dms":
                return array();
                break;
            case "introduction":
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