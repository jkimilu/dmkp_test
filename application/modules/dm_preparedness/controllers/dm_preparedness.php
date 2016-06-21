<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * dm_preparedness controller
 */
class dm_preparedness extends Base_Content_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->lang->load('dm_preparedness');

		// Set menu item (active)
		Template::set('dm_preparedness_active', true);

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
		$this->force_login();
		Template::render();
	}

	//--------------------------------------------------------------------
}