<?php

/**
 * Created by Ahmed Maawy.
 * User: ultimateprogramer
 * Date: 7/1/16
 * Time: 3:08 PM
 */
class capacity_building_search
{
    public function search($searchTerm) {
        $ci = &get_instance();
        $ci->load->model('capacity_building/Capacity_Building_Content_Model');

        return $ci->Capacity_Building_Content_Model->search($searchTerm);
    }
}