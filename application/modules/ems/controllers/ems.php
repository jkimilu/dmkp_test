<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ems controller
 */
class ems extends Front_Controller
{

    private $default_role = null;

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

        // Load default models
        $this->load->model('ems/content_model');
        $this->load->model('ems/content_chunks_model');

        // Load lobraries and initialize
        $this->load->library('ems/ems_tree');
        $this->content_tree = $this->ems_tree->get_ems_tree();

		$this->load->library('form_validation');
		$this->lang->load('ems');

		Assets::add_module_js('ems', 'ems.js');
	}

    private function get_content_variables($role, $section_key, $content_item_key)
    {
        $content_variables = array();
        $content_variables['content'] = $this->content_model->get_content($role, $section_key, $content_item_key);
        $content_variables['partials'] = $this->ems_tree->get_content_segments($section_key, $content_item_key);
        $content_variables['chunks'] = $this->content_chunks_model->get_content($role, $section_key, $content_item_key);
    }

    private function load_role_view($section_key, $content_variables)
    {
        $this->load->view("content/partials/{$section_key}_edit", array('content' => $content_variables), true);
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

        // Load content segments
        $content_variables = $this->get_content_variables($this->default_role, $section_key, $content_item_key);

        // Load role specific edit view
        $edit_view = $this->load_role_view($section_key, $content_variables);
        $role_view = $this->load->view("content/partials/role_drop_down",
            array('content' => $edit_view, 'section_key' => $section_key, 'content_key' => $content_item_key),
            true);

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

        // Render
        Template::render();
    }

	//--------------------------------------------------------------------
}