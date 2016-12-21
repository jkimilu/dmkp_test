<?php

/**
 * Created by Ahmed Maawy.
 * User: ultimateprogramer
 * Date: 7/1/16
 * Time: 3:14 PM
 */
class ems_search
{
    /**
     * Perform search operation
     *
     * @param $searchTerm
     * @return array
     */
    public function search($searchTerm) {
        $ci = &get_instance();
        
        $ci->load->library('ems/ems_content_utilities', NULL, 'ems_content_utilities');
        $ci->load->model('ems/ems_content_model', 'ems_content_model');

        $searchArray = [];

        if(!$searchTerm)
        {
            return [];
        }
        else {
            $content_search =
                $ci->ems_content_model->search($searchTerm);

            if ($content_search) {
                foreach ($content_search as &$search_item) {
                    $search_item->link = site_url($ci->ems_content_utilities->get_link_to_section(
                        $search_item->content_section, $search_item->content_slug
                    ));

                    $search_item->brief_text = strip_tags(substr($search_item->main_content, 0, 500));

                    if (trim($search_item->brief_text) == '') {
                        $search_item->brief_text = strip_tags(substr($search_item->chunk_content, 0, 500));
                    }

                    $searchArray[] = $search_item;
                }
            }
        }

        return $searchArray;
    }
}