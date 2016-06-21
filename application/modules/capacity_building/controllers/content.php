<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * content controller
 */
class content extends Admin_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Capacity_Building.Content.View');
		$this->lang->load('capacity_building');
		
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('capacity_building', 'capacity_building.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		Template::set('toolbar_title', 'Manage Capacity Building');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Capacity Building object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Capacity_Building.Content.Create');

		Assets::add_module_js('capacity_building', 'capacity_building.js');

		Template::set('toolbar_title', lang('capacity_building_create') . ' Capacity Building');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Capacity Building data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('capacity_building_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/capacity_building');
		}

		Template::set('toolbar_title', lang('capacity_building_edit') .' Capacity Building');
		Template::render();
	}

	//--------------------------------------------------------------------



}