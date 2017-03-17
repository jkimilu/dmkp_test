<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_capacity_building_tables extends ResourceMigrations
{
    public function __construct() {
        parent::__construct('capacity_building_content');
    }
}