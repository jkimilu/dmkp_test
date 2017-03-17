<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class dmkp404 extends Base_Content_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->force_login();
        Template::render();
    }
}