<?php

/**
 * Pagination class
 */
class MY_Pagination extends CI_Pagination {
    public function __construct() {
        parent::__construct();
    }

    public function current_page() {
        return $this->cur_page;
    }
}