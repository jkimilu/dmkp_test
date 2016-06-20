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

		$this->auth->restrict('EMS.Settings.View');
		$this->lang->load('ems');
		
		Template::set_block('sub_nav', 'settings/_sub_nav');

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
		$this->auth->restrict('EMS.Settings.Create');

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
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('ems_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/ems');
		}

		Template::set('toolbar_title', lang('ems_edit') .' EMS');
		Template::render();
	}

	//--------------------------------------------------------------------



}