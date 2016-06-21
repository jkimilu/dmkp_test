<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * developer controller
 */
class developer extends Admin_Controller
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

		$this->auth->restrict('DM_Policies.Developer.View');
		$this->lang->load('dm_policies');
		
		Template::set_block('sub_nav', 'developer/_sub_nav');

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

		Template::set('toolbar_title', 'Manage DM Policies');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a DM Policies object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('DM_Policies.Developer.Create');

		Assets::add_module_js('dm_policies', 'dm_policies.js');

		Template::set('toolbar_title', lang('dm_policies_create') . ' DM Policies');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of DM Policies data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('dm_policies_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/dm_policies');
		}

		Template::set('toolbar_title', lang('dm_policies_edit') .' DM Policies');
		Template::render();
	}

	//--------------------------------------------------------------------



}