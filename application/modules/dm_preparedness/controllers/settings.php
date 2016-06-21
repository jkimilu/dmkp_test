<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * settings controller
 */
class settings extends Admin_Controller
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

		$this->auth->restrict('DM_Preparedness.Settings.View');
		$this->lang->load('dm_preparedness');
		
		Template::set_block('sub_nav', 'settings/_sub_nav');

		Assets::add_module_js('dm_preparedness', 'dm_preparedness.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		Template::set('toolbar_title', 'Manage DM Preparedness');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a DM Preparedness object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('DM_Preparedness.Settings.Create');

		Assets::add_module_js('dm_preparedness', 'dm_preparedness.js');

		Template::set('toolbar_title', lang('dm_preparedness_create') . ' DM Preparedness');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of DM Preparedness data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('dm_preparedness_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/dm_preparedness');
		}

		Template::set('toolbar_title', lang('dm_preparedness_edit') .' DM Preparedness');
		Template::render();
	}

	//--------------------------------------------------------------------



}