<?php

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/22/16
 * Time: 11:54 AM
 */
class Contact_Persons_Model extends BaseDeleteSupportModel
{
    protected $table_name 	= 'resource_contact_persons';
    protected $soft_deletes = TRUE;
    protected $date_format = 'datetime';
}