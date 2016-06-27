<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ems controller
 */
class ems extends Base_Content_Controller
{
    const num_login_cookie = 'num_frontend_logins';
    const num_of_logins_for_message = 3;
    const show_first_page_alert_cookie = 'show_first_page_alert';

	//--------------------------------------------------------------------

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

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

        // Render items to views
        Template::set('view_roles', $this->ems_tree->get_roles());
        Template::set('view_active_role', $active_role);
        Template::set('ems_tree_lang', lang('ems_tree'));

        // Load default models
        $this->load->model('ems/content_model');
        $this->load->model('ems/content_chunks_model');
        $this->load->model('ems/content_popups_model');
        $this->load->model('ems/role_paragraph_model');
        $this->load->model('ems/main_content_roles_model');
        $this->load->model('ems/content_chunks_roles_model');

        // Helpers
        $this->load->helper('html');

        // Set menu item (active)
        Template::set('ems_active', true);

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

        // Get the text blocks

        $main_content = $this->content_model->get_content($section_key, $content_item_key);
        $main_content = $this->text_parsing->process_text($main_content);
        $content_chunks = $this->content_chunks_model->get_content($section_key, $content_item_key);

        foreach($content_chunks as &$content_chunk)
        {
            $content_chunk = $this->text_parsing->process_text($content_chunk);
        }

        // Process the text for the current role

        $main_content_role_content_specs = $this->main_content_roles_model
            ->order_by('paragraph_index')
            ->find_all_by(array(
                'section_key' => $section_key,
                'content_item_key' => $content_item_key,
                'role' => $role,
            ));
        $main_content =
            $this->text_parsing->process_content_for_role($main_content, $main_content_role_content_specs);

        foreach($content_chunks as $content_chunk_key => &$content_chunk_value)
        {
            $chunk_content_role_content_specs = $this->content_chunks_roles_model
                ->order_by('paragraph_index')
                ->find_all_by(array(
                    'section_key' => $section_key,
                    'content_item_key' => $content_item_key,
                    'chunk' => $content_chunk_key,
                    'role' => $role,
                ));
            $content_chunk_value =
                $this->text_parsing->process_content_for_role($content_chunk_value, $chunk_content_role_content_specs);
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
                'popup_helpers' => $this->popup_helpers,
            ), true);

        // Main container view

        $learn_more_link =
            site_url($this->content_utilities->get_link_to_section('ems_summary', 'how_to_use_this_manual'));
        $edit_content_link =
            site_url($this->content_utilities->get_admin_edit_link_to_section($section_key, $content_item_key));

        // First time message functions
        $first_time_message_cookie = $this->input->cookie(self::show_first_page_alert_cookie);

        $first_time_message = isset($content_partials['first_time_message']) ? $content_partials['first_time_message'] : false;
        $first_time_message = $first_time_message_cookie == 'No' ? false : $first_time_message;

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
                'first_time_message' => $first_time_message,
                'logged_in_user' => $this->session->userdata('ems_user'),
                'learn_more_link' => $learn_more_link,
                'edit_content_link' => $edit_content_link,
                'is_admin' => $this->is_admin,
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

        $this->set_user_meta_data();

        $changed_role_view = $this->session->flashdata('new_view_role');
        $email_sent = $this->session->flashdata('email_sent');

        $flash_messages = false;

        if($changed_role_view)
        {
            $flash_messages = $changed_role_view;
        }

        if($email_sent)
        {
            if($flash_messages)
                $flash_messages.="<br>".$email_sent;
            else
                $flash_messages = $email_sent;
        }

        if($flash_messages)
            Template::set("global_alert", $flash_messages);

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
        $content_variables["changed_role_view"] = $changed_role_view;

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
        Template::render('ems');
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

        $this->set_user_meta_data();

        $role_message = "";

        switch($new_role)
        {
            case 'default':
                $role_message = "You are now on 'Default' view";
                break;
            case 'response_manager':
                $role_message = "You are now viewing as 'Response Manager'";
                break;
            case 'senior_leadership':
                $role_message = "You are now viewing as 'Senior Leadership'";
                break;
            case 'functional_lead':
                $role_message = "You are now viewing as 'Functional Lead'";
                break;
            case 'general_response_staff':
                $role_message = "You are now viewing as 'General Response Staff'";
                break;
        }

        $this->session->set_flashdata('new_view_role', $role_message);

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

    /**
     * Renders back a diagram view
     *
     * @param $diagram_index
     */

    public function popup_diagram_content($diagram_index)
    {
        $view = $this->load->view('ems/diagram_views/'.$diagram_index, array(), true);
        echo $view;
    }

    /**
     * Does a PDF export
     */

    public function export_pdf()
    {
        $this->force_login();

        $this->load->library('ems/pdf_content');
        $this->pdf_content->output_full_content_pdf();
    }
}