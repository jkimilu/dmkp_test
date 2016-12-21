<?php

/**
 * Created by Ahmed Maawy
 * User: ultimateprogramer
 * Date: 6/22/16
 * Time: 3:05 PM
 */
class Resource_Resources_Model extends BaseDeleteSupportModel
{
    protected $table_name 	= 'resource_tracker';
    protected $soft_deletes = TRUE;
    protected $date_format = 'datetime';
}