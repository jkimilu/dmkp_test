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
                "0" => "fa fa-list-ol",
            ),
            "1" => array(
                "0" => "fa fa-list-ol",
            ),
        );
        $tree_object->list_classes = array();
        $tree_object->pre_pends = array();
        $tree_object->post_pends = array();

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
        $home_link = site_url('/dm_standards/');

        $current_node = $tree[$current_node_index][0];
        $current_sub_node = $tree[$current_node_index][1][$current_sub_node_index];

        $parent_node_link = site_url("/dm_standards/index/{$tree[$current_node_index][0]}/{$tree[$current_node_index][1][0]}/{$current_node_index}/0");

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
}