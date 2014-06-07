<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ems controller
 */
class ems extends Ems_Controller
{
	//--------------------------------------------------------------------


	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

        // Load default models
        $this->load->model('ems/content_model');
        $this->load->model('ems/content_chunks_model');
        $this->load->model('ems/content_popups_model');
        $this->load->model('ems/role_paragraph_model');

		Assets::add_module_js('ems', 'ems.js');
	}

    //--------------------------------------------------------------------


    /**
     * Get content variables from the CMS
     *
     * @param $role
     * @param $section_key
     * @param $content_item_key
     * @return array
     */
    private function get_content_variables($role, $section_key, $content_item_key)
    {
        $content_variables = array();

        $main_content = $this->content_model->get_content($section_key, $content_item_key);
        $main_content = $this->text_parsing->process_text($main_content);
        $content_chunks = $this->content_chunks_model->get_content($section_key, $content_item_key);

        foreach($content_chunks as &$content_chunk)
        {
            $content_chunk = $this->text_parsing->process_text($content_chunk);
        }

        $content_variables['content'] = $main_content;
        $content_variables['partials'] = $this->ems_tree->get_content_segments($section_key, $content_item_key);
        $content_variables['chunks'] = $content_chunks;

        return $content_variables;
    }

    //--------------------------------------------------------------------


    /**
     * Load a specific view for a specific role
     *
     * @param $section_key
     * @param $content_item_key
     * @param $content_variables
     * @param $previous_link
     * @param $next_link
     * @param $previous_node
     * @param $next_node
     * @param $breadcrumb
     * @return mixed
     */

    private function load_role_view($section_key, $content_item_key, $content_variables, $previous_link, $next_link,
        $previous_node, $next_node, $breadcrumb)
    {
        $this->load->library('ems/content_utilities');
        $content_partials = $this->content_utilities->get_partials($section_key, $content_item_key,
            $content_variables["content"], $content_variables["chunks"], lang("ems_tree"));

        // Specific section views

        $role_view = $this->load->view("content/partials/{$section_key}_layout",
            array(
                // Content variables
                'content_partials' => $content_partials,
                'section_key' => $section_key,
                'content_item_key' => $content_item_key,
                'content_variables' => $content_variables,
                'language' => lang('ems_tree'),
            ), true);

        // Main container view

        $learn_more_link =
            site_url($this->content_utilities->get_link_to_section('ems_summary', 'how_to_use_this_manual'));

        $content_container_view = $this->load->view('ems_partials/content_page_layout',
            array(
                // Content
                'page_content' => $role_view,
                // Links
                'previous_link' => $previous_link,
                'next_link' => $next_link,
                'previous_node' => $previous_node,
                'next_node' => $next_node,
                'breadcrumb' => $breadcrumb,
                'tree_navigation' => $this->ems_tree->get_ems_frontend_tree(lang('ems_tree')),
                'language' => lang('ems_tree'),
                'active_section' => $section_key,
                'content_item_key' => $content_item_key,
                'right_column_mid_class' => isset($content_partials['right_column_mid_class']) ? " {$content_partials['right_column_mid_class']} " : '',
                'first_time_message' => isset($content_partials['first_time_message']) ? $content_partials['first_time_message'] : false,
                'logged_in_user' => $this->session->userdata('ems_user'),
                'learn_more_link' => $learn_more_link,
            ), true);

        // Global alert system

        if(isset($content_partials['global_alert']))
        {
            Template::set('global_alert', $content_partials['global_alert']);
        }

        return $content_container_view;
    }

    //--------------------------------------------------------------------


    /**
     * Gets the last user viewed item
     *
     * @return array
     */
    private function get_last_viewed_item()
    {
        return array(
            "section_key" => "ems_summary",
            "content_item_key" => "summary",
            "section_id" => "0",
            "content_item_id" => "0",
        );
    }

    //--------------------------------------------------------------------

    /**
     * Allows viewing data
     *
     * @param $section_key
     * @param $content_item_key
     * @param $section_id
     * @param $content_item_id
     * @return void
     */
    public function index($section_key = null, $content_item_key = null, $section_id = null, $content_item_id = null)
    {
        $this->force_login();

        // Landed there by default
        if($section_key == null && $content_item_key == null && $section_id == null && $content_item_id == null)
        {
            // Load the last visible item
            $last_viewed_items = $this->get_last_viewed_item();

            $section_key = $last_viewed_items["section_key"];
            $content_item_key = $last_viewed_items["content_item_key"];
            $section_id = $last_viewed_items["section_id"];
            $content_item_id = $last_viewed_items["content_item_id"];
        }

        // Load language files
        $language = lang('ems_tree');

        // Load content segments
        $content_variables = $this->get_content_variables($this->view_active_role, $section_key, $content_item_key);

        // << Previous link
        $previous_link = $this->ems_tree->get_previous_link($this->content_tree,
            $section_id, $content_item_id);

        if($previous_link != null)
            $previous_link = site_url("ems/index/".$previous_link);

        $previous_node = $this->ems_tree->get_previous_link($this->content_tree,
            $section_id, $content_item_id, true);

        // Next >> link
        $next_link = $this->ems_tree->get_next_link($this->content_tree,
            $section_id, $content_item_id);

        if($next_link != null)
            $next_link = site_url("ems/index/".$next_link);

        $next_node = $this->ems_tree->get_next_link($this->content_tree,
            $section_id, $content_item_id, true);

        // Breadcrumb
        $breadcrumb = $this->ems_tree->get_breadcrumb($this->content_tree,
            $language, $section_id, $content_item_id);

        // Load role specific edit view
        $role_view = $this->load_role_view($section_key, $content_item_key, $content_variables,
            $previous_link, $next_link, $previous_node, $next_node, $breadcrumb);

        // Set variables
        Template::set('content_variables', $content_variables);
        Template::set('content_view', $role_view);
        Template::set('section', $section_key);
        Template::set('section_id', $section_id);
        Template::set('previous_link', $previous_link);
        Template::set('previous_node', $previous_node);
        Template::set('next_link', $next_link);
        Template::set('next_node', $next_node);
        Template::set('content_item_id', $content_item_id);
        Template::set('page_title', $language[$content_item_key]);

        // Render
        Template::render();
    }

    //--------------------------------------------------------------------

    /**
     * The "terms" page
     */
    public function terms()
    {
        $this->force_login();

        $content_container_view = $this->load->view('ems_partials/terms_page_layout',
            array(
                'tree_navigation' => $this->ems_tree->get_ems_frontend_tree(lang('ems_tree')),
                'language' => lang('ems_tree'),
            ), true);

        Template::set('content_view', $content_container_view);
        Template::render();
    }

    //--------------------------------------------------------------------

    /**
     * Login action
     */
    public function login()
    {
        $post_vars = $this->input->post();

        if($post_vars)
        {
            $this->config->load('single_sign_on');
            $sign_on_mode = $this->config->item('single_sign_on_mode');

            if($sign_on_mode == 'test')
            {
                $user_data = array();
                $user_data['user_id'] = "001";
                $user_data['user_name'] = "sample";
                $user_data['first_name'] = "First";
                $user_data['last_name'] = "Last";

                $this->session->set_userdata('ems_user', $user_data);

                redirect("/");
            }
        }

        Template::set_default_theme('ems_basic');
        Template::render();
    }

    //--------------------------------------------------------------------

    /**
     * Logout
     */

    public function logout()
    {
        $this->session->unset_userdata('ems_user');
        redirect("/");
    }

    //--------------------------------------------------------------------

    /**
     * Changes the current default role
     *
     * @param $new_role
     */
    public function change_view_role($new_role)
    {
        $this->force_login();

        $this->load->library('user_agent');

        $this->session->set_userdata('active_view_role', $new_role);

        if ($this->agent->is_referral())
        {
            redirect($this->agent->referrer());
        }
        else
        {
            redirect('/');
        }
    }
}