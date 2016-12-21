<?php

/**
 * Created by Ahmed Maawy
 * User: ultimateprogramer
 * Date: 6/22/16
 * Time: 3:51 PM
 */
class DM_Preparedness_Content_Model extends Resource_Model
{
    public function __construct()
    {
        parent::__construct('dm_preparedness_content', site_url('dm_preparedness'));
        $this->resourceCategory = 'dm_preparedness';
    }
}