<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lex_Callbacks extends Standard_Lex_Callback
{
    public function __construct() {
        parent::__construct();
        self::$content_popups_model = $this->ci->load->model('ems/content_popups_model');
    }
}
