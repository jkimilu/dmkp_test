<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * capacity_building controller
 */
class capacity_building extends BaseResourceController
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->lang->load('capacity_building');

		$this->load->model('capacity_building/Content_Model');

		// Set menu item (active)
		Template::set('capacity_building_active', true);

		Assets::add_module_js('capacity_building', 'capacity_building.js');
	}

	/**
	 * Get categories
	 *
	 * @return array
	 */
	protected function getCategories()
	{
		return [
			'ecampus_courses' => 'eCampus Courses',
			'other_resources' => 'Other Resources'
		];
	}


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->force_login();

		Template::set('listView', $this->showResourcesList($this->Content_Model, 'table table-condensed table-striped table-hover mru_tbl'));
		Template::render();
	}
}