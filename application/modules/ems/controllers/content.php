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

        $this->load->library('ems/ems_tree');
        $this->content_tree = $this->ems_tree->get_ems_tree();

        $roles = $this->ems_tree->get_roles();
        $this->default_role = $roles[0];

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

    private function load_role_view($role, $section_key)
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
        //
        $this->auth->restrict('EMS.Content.Edit');

        $this->load->model('ems/content_model');

        $content_variables = array();
        $content_variables['content'] = $this->content_model->get_content($section_key, $content_item_key);
        $content_variables['partials'] = $this->ems_tree->get_content_segments($section_key, $content_item_key);

        // Load role specific edit view
        $edit_view = $this->load_role_view($this->default_role, $section_key);
        $role_view =
            $this->load->view("content/partials/role_drop_down", array(
                'content' => $edit_view, 'section_key' => $section_key, 'content_key' => $content_item_key), true);

        // << Previous link
        $previous_link = $this->ems_tree->get_previous_link($this->content_tree,
            $section_id, $content_item_key);

        // Next >> link
        $next_link = $this->ems_tree->get_next_link($this->content_tree,
            $section_id, $content_item_key);

        // Set variables
        Template::set('content_variables', $content_variables);
        Template::set('role_view', $role_view);
		Template::set('section', $section_key);
        Template::set('section_id', $section_id);
        Template::set('previous_link', $previous_link);
        Template::set('next_link', $next_link);
        Template::set('toolbar_title', lang('ems_edit') .' EMS');

        // Render
		Template::render();
	}

	//--------------------------------------------------------------------
}