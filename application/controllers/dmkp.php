<?php

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/20/16
 * Time: 6:06 PM
 */
class dmkp extends Base_Content_Controller
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * Landing controller
     */
    public function index() {
        $this->force_login();
        Template::render();
    }

    /**
     * Download a resource
     *
     * @param $fileId
     */
    public function download_file($fileId) {
        // Perform download
    }
}