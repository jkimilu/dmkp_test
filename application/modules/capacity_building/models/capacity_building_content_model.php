<?php

/**
 * Created by Ahmed Maawy
 * User: ultimateprogramer
 * Date: 6/22/16
 * Time: 3:51 PM
 */
class Capacity_Building_Content_Model extends Resource_Model
{
    public function __construct()
    {
        parent::__construct('capacity_building_content', site_url('capacity_building'));
        $this->resourceCategory = 'capacity_building';
    }


    public function find($id=NULL)
	{
		if (empty($id) || ! is_integer($id))
		{
			return FALSE;
		}
		else
		$id="";

		$capacity = parent::find($id);

		if ($capacity == FALSE)
		{
			return FALSE;
		}

		

		return $capacity;

	}
}

