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
     * Sets the meta data for the user if in Single Sign On Mode
     */
    protected function set_user_meta_data()
    {
        // Get current user attributes (if Single Sign On Mode)

        if($this->sign_in_mode == "simplesaml")
        {
            $user_attributes = $this->single_sign_on->getAttributes();

            $user_data = array();

            if(isset($user_attributes['displayName']))
            {
                $user_data['user_id'] = "";
                $user_data['user_name'] = "";
                $user_data['first_name'] = $user_attributes['displayName'][0];
                $user_data['last_name'] = "";

                $this->session->set_userdata('dmkp_user', $user_data);
            }
        }
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

                redirect("/");
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
                else
                {
                    redirect("/");
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

    //--------------------------------------------------------------------

    /**
     * Sends an email to the publishing team
     */

    public function send_email_to_publishing()
    {
        $this->load->library('user_agent');

        $post_vars = $this->input->post();

        if($post_vars)
        {
            $this->load->library('email');

            $this->email->from($post_vars['email_address'], $post_vars['full_names']);
            $this->email->to('info@bluedigital.co.ke');

            $this->email->subject($post_vars['subject']);
            $this->email->message($post_vars['body']);

            $this->email->send();
            $this->session->set_flashdata('email_sent', "Thank you {$post_vars['full_names']} for your email, we will respond to your query shortly");
        }

        if($this->agent->is_referral())
            redirect($this->agent->referrer());
    }

    /**
     * The "terms" page
     */
    public function copyright_notice()
    {
        $this->force_login();

        $this->set_user_meta_data();

        $email_sent = $this->session->flashdata('email_sent');

        if($email_sent)
            Template::set("global_alert", $email_sent);

        $content_container_view = $this->load->view('dmkp/copyright_notice', [], true);

        Template::set('popup_helpers', $this->popup_helpers);
        Template::set('content_view', $content_container_view);
        Template::render();
    }

    //--------------------------------------------------------------------

    /**
     * The "search" page
     */

    public function search()
    {
        $this->force_login();

        $this->set_user_meta_data();

        // Continue on with other functionality

        $this->load->library('dm_standards/content_utilities');

        $page = $this->uri->segment(3);
        $search_term = $this->input->get('search');

        $pagination_config = $this->pagination_config(
            array(
                'base_url' => site_url('dm_standards/search'),
                'total_rows' => $this->content_model->search_count($search_term),
            )
        );

        if(!$search_term)
        {
            redirect("/");
        }
        else
        {
            $content_search =
                $this->content_model->search($search_term, $pagination_config['per_page'], $page);

            if($content_search)
            {
                foreach($content_search as &$search_item)
                {
                    $search_item->link = site_url($this->content_utilities->get_link_to_section(
                        $search_item->content_section, $search_item->content_slug
                    ));

                    $search_item->brief_text = strip_tags(substr($search_item->main_content, 0, 500));

                    if(trim($search_item->brief_text) == '')
                    {
                        $search_item->brief_text = strip_tags(substr($search_item->chunk_content, 0, 500));
                    }
                }
            }

            $content_container_view = $this->load->view('dms_partials/search_results_page_layout',
                array(
                    'tree_navigation' => $this->dms_tree->get_dms_frontend_tree(lang('dms_tree')),
                    'language' => lang('dms_tree'),
                    'results' => $content_search,
                    'term' => $search_term,
                    'links' => $this->pagination->create_links(),
                    'pagination' => $this->pagination,
                ), true);

            Template::set('content_view', $content_container_view);
            Template::render();
        }
    }
}