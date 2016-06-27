<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ems controller
 */
class dm_standards extends Base_Content_Controller
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
        $this->load->library('dm_standards/dms_tree');
        $this->content_tree = $this->dms_tree->get_dms_tree();

        $this->load->library('form_validation');
        $this->lang->load('dm_standards/dm_standards');

        // Text parsing functionality
        $this->load->library('dm_standards/text_parsing');

        // Helpers
        $this->load->helper('dm_standards/dms');

        // Load pagination configuration
        $this->load->library('pagination');
        $this->pagination_config();

        Template::set('dms_tree_lang', lang('dms_tree'));

        // Load default models
        $this->load->model('dm_standards/content_model');
        $this->load->model('dm_standards/content_chunks_model');
        $this->load->model('dm_standards/content_popups_model');

        // Helpers
        $this->load->helper('html');

        // Set menu item (active)
        Template::set('dm_standards_active', true);

		Assets::add_module_js('dm_standards', 'dms.js');
	}

    //--------------------------------------------------------------------


    /**
     * Get content variables from the CMS
     *
     * @param $section_key
     * @param $content_item_key
     * @return array
     * @internal param $role
     */
    private function get_content_variables($section_key, $content_item_key)
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

        $content_variables['content'] = $main_content;
        $content_variables['partials'] = $this->dms_tree->get_content_segments($section_key, $content_item_key);
        $content_variables['chunks'] = $content_chunks;

        return $content_variables;
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
            "section_key" => "introduction_to_dms",
            "content_item_key" => "what_is_new",
            "section_id" => "0",
            "content_item_id" => "0",
        );
    }

    /**
     * Loads a view (renders a view)
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

    private function load_view($section_key, $content_item_key, $content_variables, $previous_link, $next_link,
                                    $previous_node, $next_node, $breadcrumb)
    {
        $this->load->library('dm_standards/content_utilities');
        $content_partials = $this->content_utilities->get_partials($section_key, $content_item_key,
            $content_variables["content"], $content_variables["chunks"], lang("dms_tree"));

        // Specific section views

        $role_view = $this->load->view("content/partials/{$section_key}_layout",
            array(
                // Content variables
                'content_partials' => $content_partials,
                'section_key' => $section_key,
                'content_item_key' => $content_item_key,
                'content_variables' => $content_variables,
                'language' => lang('dms_tree'),
                'popup_helpers' => $this->popup_helpers,
            ), true);

        // Main container view

        $learn_more_link =
            site_url($this->content_utilities->get_link_to_section('introduction_to_dms', 'what_is_new'));
        $edit_content_link =
            site_url($this->content_utilities->get_admin_edit_link_to_section($section_key, $content_item_key));

        // First time message functions
        $first_time_message_cookie = $this->input->cookie(self::show_first_page_alert_cookie);

        $first_time_message = isset($content_partials['first_time_message']) ? $content_partials['first_time_message'] : false;
        $first_time_message = $first_time_message_cookie == 'No' ? false : $first_time_message;

        $content_container_view = $this->load->view('dms_partials/content_page_layout',
            array(
                // Content
                'page_content' => $role_view,
                // Links
                'previous_link' => $previous_link,
                'next_link' => $next_link,
                'previous_node' => $previous_node,
                'next_node' => $next_node,
                'breadcrumb' => $breadcrumb,
                'tree_navigation' => $this->dms_tree->get_dms_frontend_tree(lang('dms_tree')),
                'language' => lang('dms_tree'),
                'active_section' => $section_key,
                'content_item_key' => $content_item_key,
                'right_column_mid_class' => isset($content_partials['right_column_mid_class']) ? " {$content_partials['right_column_mid_class']} " : '',
                'first_time_message' => $first_time_message,
                'logged_in_user' => $this->session->userdata('dmkp_user'),
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
        $language = lang('dms_tree');

        // Load content segments
        $content_variables = $this->get_content_variables($section_key, $content_item_key);
        $content_variables["changed_role_view"] = $changed_role_view;

        // << Previous link
        $previous_link = $this->dms_tree->get_previous_link($this->content_tree,
            $section_id, $content_item_id);

        if($previous_link != null)
            $previous_link = site_url("dm_standards/index/".$previous_link);

        $previous_node = $this->dms_tree->get_previous_link($this->content_tree,
            $section_id, $content_item_id, true);

        // Next >> link
        $next_link = $this->dms_tree->get_next_link($this->content_tree,
            $section_id, $content_item_id);

        if($next_link != null)
            $next_link = site_url("dm_standards/index/".$next_link);

        $next_node = $this->dms_tree->get_next_link($this->content_tree,
            $section_id, $content_item_id, true);

        // Breadcrumb
        $breadcrumb = $this->dms_tree->get_breadcrumb($this->content_tree,
            $language, $section_id, $content_item_id);

        // Load role specific edit view
        $view = $this->load_view($section_key, $content_item_key, $content_variables,
            $previous_link, $next_link, $previous_node, $next_node, $breadcrumb);

        // Set variables
        Template::set('content_variables', $content_variables);
        Template::set('section', $section_key);
        Template::set('content_view', $view);
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
     * Renders back a diagram view
     *
     * @param $diagram_index
     */

    public function popup_diagram_content($diagram_index)
    {
        $view = $this->load->view('dm_standards/diagram_views/'.$diagram_index, array(), true);
        echo $view;
    }

    /**
     * Does a PDF export
     */

    public function export_pdf()
    {
        $this->force_login();

        $this->load->library('dm_standards/pdf_content');
        $this->pdf_content->output_full_content_pdf();
    }
}