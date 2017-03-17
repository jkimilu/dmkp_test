<?php

/**
 * Created by Ahmed Maawy.
 * User: ultimateprogramer
 * Date: 7/1/16
 * Time: 3:08 PM
 */
class dm_policies_search
{
    public function search($searchTerm) {
        $ci = &get_instance();
        $ci->load->model('dm_policies/DM_Policies_Content_Model');

        return $ci->DM_Policies_Content_Model->search($searchTerm);
    }
}