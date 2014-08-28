<?php
class Ems_Controller extends Front_Controller
{
    protected $is_logged_in = false;
    protected $is_admin = false;
    protected $ems_user_session_data;
    protected $content_tree;
    protected $view_active_role;

    protected $single_sign_on;
    protected $sign_in_mode;

    public function __construct()
    {
        parent::__construct();

        // Single sign on config status
        $this->config->load('single_sign_on');
        $this->sign_in_mode = $this->config->item('single_sign_on_mode');

        // Single sign on object setup
        if($this->sign_in_mode == "simplesaml")
        {
            require_once(dirname(__FILE__).'/../../public/sso/lib/_autoload.php');
            $this->single_sign_on = new SimpleSAML_Auth_Simple('default-sp');
        }

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

        // Load pagination configuration
        $this->load->library('pagination');
        $this->pagination_config();

        // Set active role
        if(!$active_role)
            $active_role = "default";

        $this->view_active_role = $active_role;

        // Render
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
        if($this->sign_in_mode == "test")
        {
            if(!$this->is_logged_in)
            {
                redirect('ems/login');
            }
        }
        else if($this->sign_in_mode == "simplesaml")
        {
            if(!$this->single_sign_on->isAuthenticated())
            {
                redirect('ems/login');
            }
        }
    }

    /**
     * Loads pagination configuration specific to the ems theme
     */
    protected function pagination_config($pagination_config = array())
    {
        $config['uri_segment'] = 3;
        $config['per_page'] = 20;
        $config['page_query_string'] = FALSE;
        $config['full_tag_open'] = '<div class="pagination pagination-right">';
        $config['full_tag_close'] = '</div>';

        if(array_key_exists('base_url', $pagination_config))
            $config['base_url'] = $pagination_config['base_url'];

        if(array_key_exists('total_rows', $pagination_config))
            $config['total_rows'] = $pagination_config['total_rows'];

        $this->pagination->initialize($config);

        return $config;
    }
}