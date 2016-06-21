<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * capacity_building controller
 */
class capacity_building extends Base_Content_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->lang->load('capacity_building');

		// Set menu item (active)
		Template::set('capacity_building_active', true);

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
		$this->force_login();
		Template::render();
	}

	//--------------------------------------------------------------------
}