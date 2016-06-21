<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * dm_policies controller
 */
class dm_policies extends Base_Content_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->lang->load('dm_policies');

		// Set menu item (active)
		Template::set('dm_policies_active', true);

		Assets::add_module_js('dm_policies', 'dm_policies.js');
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