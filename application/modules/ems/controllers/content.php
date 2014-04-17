<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * content controller
 */
class content extends Admin_Controller
{
    private $content_tree;

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

        $this->load->library('ems/ems_tree');
        $this->content_tree = $this->ems_tree->get_ems_tree();

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

	//--------------------------------------------------------------------


	/**
	 * Creates a EMS object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('EMS.Content.Create');

		Assets::add_module_js('ems', 'ems.js');

		Template::set('toolbar_title', lang('ems_create') . ' EMS');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of EMS data.
	 *
	 * @return void
	 */
	public function content_edit($section_key, $content_item_key)
	{
        $this->load->model('ems/content_model');

        $content_variables = array();
        $content_variables['content'] = $this->content_model->get_content($section_key, $content_item_key);

		switch($section_key)
        {
            case 'ems_summary':
                break;
            case 'ems_principles':
                break;
            case 'ems_functions':
                break;
            case 'shared_leadership_ems':
                break;
            case 'appendix':
                break;
        }

        Template::set('content_variables', $content_variables);
		Template::set('section', $section_key);
        Template::set('toolbar_title', lang('ems_edit') .' EMS');
		Template::render();
	}

	//--------------------------------------------------------------------
}