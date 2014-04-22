<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * content controller
 */
class content extends Admin_Controller
{
    private $content_tree;

    private $default_role;

	//--------------------------------------------------------------------


    /**
     * Constructor
     */
	public function __construct()
	{
		parent::__construct();

        // Load lobraries and initialize
        $this->load->library('ems/ems_tree');
        $this->content_tree = $this->ems_tree->get_ems_tree();

        $roles = $this->ems_tree->get_roles();
        $this->default_role = $roles[0];

        // Load default models
        $this->load->model('ems/content_model');
        $this->load->model('ems/content_chunks_model');

		$this->auth->restrict('EMS.Content.View');
		$this->lang->load('ems');
		
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('ems', 'ems.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		Template::set('toolbar_title', 'Manage EMS');
        Template::set('content_tree', $this->content_tree);
        Template::set('lang_items', lang("ems_tree"));
		Template::render();
	}

    private function get_content_variables($role, $section_key, $content_item_key)
    {
        $content_variables = array();
        $content_variables['content'] = $this->content_model->get_content($role, $section_key, $content_item_key);
        $content_variables['partials'] = $this->ems_tree->get_content_segments($section_key, $content_item_key);
        $content_variables['chunks'] = $this->content_chunks_model->get_content($role, $section_key, $content_item_key);

        return $content_variables;
    }

    private function load_role_view($role, $section_key, $content_item_key, $content_variables)
    {
        $content = $this->load->view("content/partials/{$section_key}_edit",
            array('content' => $content_variables,
                'role' => $role,
                'section_key' => $section_key,
                'content_item_key' => $content_item_key,
                'ckeditor_path' => base_url('assets/js/ckeditor/ckeditor.js')
            ), true);

        return $content;
    }

    private function load_role_dropdown_view($edit_view, $section_key, $content_item_key)
    {
        return $this->load->view("content/partials/role_drop_down",
            array('content' => $edit_view, 'section_key' => $section_key, 'content_key' => $content_item_key),
            true);
    }

    /**
     * Make an AJAX call and return a sub role view
     *
     * @param $role
     * @param $section_key
     * @param $content_item_key
     */

    public function ajax_role_content_edit_view($role, $section_key, $content_item_key)
    {
        $content_variables = $this->get_content_variables($role, $section_key, $content_item_key);
        echo $this->load_role_view($role, $section_key, $content_item_key, $content_variables);
    }

	//--------------------------------------------------------------------


    /**
     * Allows editing of EMS data.
     *
     * @param $section_key
     * @param $content_item_key
     * @param $section_id
     * @param $content_item_id
     * @return void
     */
	public function content_edit($section_key, $content_item_key, $section_id, $content_item_id)
	{
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $language = lang("ems_tree");

        $this->load->helper('ems/content');

        // Load content segments
        $content_variables = $this->get_content_variables($this->default_role, $section_key, $content_item_key);

        $edit_view = $this->load_role_view($this->default_role, $section_key, $content_item_key, $content_variables);
        $role_view = $this->load_role_dropdown_view($edit_view, $section_key, $content_item_key);

        // << Previous link
        $previous_link = $this->ems_tree->get_previous_link($this->content_tree,
            $section_id, $content_item_key);
        $previous_node = $this->ems_tree->get_previous_link($this->content_tree,
            $section_id, $content_item_key, true);

        // Next >> link
        $next_link = $this->ems_tree->get_next_link($this->content_tree,
            $section_id, $content_item_key);
        $next_node = $this->ems_tree->get_next_link($this->content_tree,
            $section_id, $content_item_key, true);

        // Set variables
        Template::set('content_variables', $content_variables);
        Template::set('role_view', $role_view);
		Template::set('section', $section_key);
        Template::set('section_id', $section_id);
        Template::set('previous_link', $previous_link);
        Template::set('previous_node', $previous_node);
        Template::set('next_link', $next_link);
        Template::set('next_node', $next_node);
        Template::set('content_item_id', $content_item_id);
        Template::set('toolbar_title', $language[$section_key].' > '.$language[$content_item_key]);

        // Render
		Template::render();
	}

	//--------------------------------------------------------------------

    public function content_save()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        if($this->input->post())
        {
            $post_vars = $this->input->post();

            $section_key = $post_vars["section_key"];
            $content_item_key = $post_vars["content_item_key"];
            $role = $post_vars["role"];

            $main_content = $post_vars["content"];
            $content_chunks = array();

            $content_segments = $this->ems_tree->get_content_segments($section_key, $content_item_key);

            foreach($content_segments as $segment)
            {
                $content_chunks[$segment] = $post_vars[$segment];
            }

            // Save main content
            $content_id = $this->content_model->save_content($role, $section_key, $content_item_key, $main_content);

            // Save content chunks
            $this->content_chunks_model->save_content($content_id, $role, $section_key, $content_item_key, $content_chunks);
        }

        // Redirect to landing page
        Template::redirect('admin/content/ems');
    }
}