<?php
class Ems_Controller extends Front_Controller
{
    protected $is_logged_in = false;
    protected $is_admin = false;
    protected $ems_user_session_data;
    protected $content_tree;
    protected $view_active_role;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('users/auth');
        $this->is_admin = $this->auth->is_logged_in();

        $this->ems_user_session_data = $this->session->userdata('ems_user');

        if($this->ems_user_session_data)
            $this->is_logged_in = true;
        else
            $this->is_logged_in = false;

        $this->set_template_user_login_status();

        // Load libraries and initialize
        $this->load->library('ems/ems_tree');
        $this->content_tree = $this->ems_tree->get_ems_tree();

        $this->load->library('form_validation');
        $this->lang->load('ems/ems');

        // Text parsing functionality
        $this->load->library('ems/text_parsing');

        // Helpers
        $this->load->helper('ems/ems');

        // Load up the current 'active' role
        $active_role = $this->session->userdata('active_view_role');

        if(!$active_role)
            $active_role = "default";

        $this->view_active_role = $active_role;

        Template::set('view_roles', $this->ems_tree->get_roles());
        Template::set('view_active_role', $active_role);
        Template::set('ems_tree_lang', lang('ems_tree'));
    }

    /**
     * Update the user login status
     */
    protected function set_template_user_login_status()
    {
        Template::set('is_logged_in', $this->is_logged_in);
        Template::set('is_admin', $this->is_admin);

        if($this->is_logged_in)
            Template::set('logged_in_user', $this->session->userdata('ems_user'));
    }

    /**
     * Force login
     */
    protected function force_login()
    {
        if(!$this->is_logged_in)
        {
            redirect('ems/login');
        }
    }
}