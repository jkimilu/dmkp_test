<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_dm_policies_tables extends ResourceMigrations
{
    public function __construct() {
        parent::__construct('dm_policies_content');
    }
}