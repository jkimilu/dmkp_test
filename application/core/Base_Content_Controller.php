<?php
class Base_Content_Controller extends Front_Controller
{
    protected $is_logged_in = false;
    protected $is_admin = false;
    protected $dmkp_user_session_data;
    protected $content_tree;
    protected $view_active_role;

    protected $single_sign_on;
    protected $sign_in_mode;

    public function __construct()
    {
        parent::__construct();

        // Load the form helper
        $this->load->helper('form');
        $this->load->helper('dmkp');

        // Popup helpers library
        $this->load->library('popup_helpers');

        // Single sign on config status
        $this->config->load('single_sign_on');
        $this->sign_in_mode = $this->config->item('single_sign_on_mode');

        // Single sign on object setup
        if($this->sign_in_mode == "simplesaml")
        {
            require_once(dirname(__FILE__).'/../../public/sso/lib/_autoload.php');
            $this->single_sign_on = new SimpleSAML_Auth_Simple('default-sp');

            // Populate user metadata if it does not exist
            if(!$this->session->userdata('dmkp_user') &&
                $this->single_sign_on->isAuthenticated()) {
                $user_data = array();

                $authData = $this->single_sign_on->getAuthDataArray();
                $arrayIndexes = array_values($authData['Attributes']);
                $userNames = $arrayIndexes[0][0];
                $userNamesArray = explode(" ", $userNames, 2);

                $user_data['user_id'] = $authData['saml:sp:NameID']['Value'];
                $user_data['user_name'] = $userNames;
                $user_data['first_name'] = isset($userNamesArray[0]) ? $userNamesArray[0] : '';
                $user_data['last_name'] = isset($userNamesArray[1]) ? $userNamesArray[1] : '';

                $this->session->set_userdata('dmkp_user', $user_data);
            }
        }

        $this->load->library('users/auth');
        $this->is_admin = $this->auth->is_logged_in();

        $this->dmkp_user_session_data = $this->session->userdata('dmkp_user');

        if($this->dmkp_user_session_data)
            $this->is_logged_in = true;
        else
            $this->is_logged_in = false;

        $this->set_template_user_login_status();
    }

    /**
     * Update the user login status
     */
    protected function set_template_user_login_status()
    {
        Template::set('is_logged_in', $this->is_logged_in);
        Template::set('is_admin', $this->is_admin);

        if($this->is_logged_in)
            Template::set('logged_in_user', $this->session->userdata('dmkp_user'));
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
                redirect('dmkp/login');
            }
        }
        else if($this->sign_in_mode == "simplesaml")
        {
            if(!$this->single_sign_on->isAuthenticated())
            {
                $this->session->unset_userdata('dmkp_user');
                redirect('dmkp/login');
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

    /**
     * Login action
     */
    public function login()
    {
        $post_vars = $this->input->post();



        if($post_vars)
        {
            if($this->sign_in_mode == 'test')
            {
                $user_data = array();
                $user_data['user_id'] = "001";
                $user_data['user_name'] = "sample";
                $user_data['first_name'] = "First";
                $user_data['last_name'] = "Last";

                $this->session->set_userdata('dmkp_user', $user_data);

                //echo site_url(); exit;

                redirect(site_url());
            }
            else if($this->sign_in_mode == "simplesaml")
            {
                

                if(!$this->single_sign_on->isAuthenticated())
                {
                    $this->single_sign_on->requireAuth(array(
                        'ReturnTo' => site_url(),
                        'KeepPost' => FALSE,
                    ));
                }
            }
        }

        Template::set_default_theme('dmkp_basic');
        Template::render();
    }

    //--------------------------------------------------------------------

    /**
     * Logout
     */

    public function logout()
    {
        if($this->sign_in_mode == 'test')
        {
            $this->session->unset_userdata('dmkp_user');
            redirect("/");
        }
        else if($this->sign_in_mode == "simplesaml")
        {
            if($this->single_sign_on->isAuthenticated())
            {
                $this->single_sign_on->logout(site_url('dmkp/login'));
            }
            else
            {
                redirect("/");
            }
        }
    }
}