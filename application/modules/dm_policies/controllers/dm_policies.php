<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * dm_policies controller
 */
class dm_policies extends BaseResourceController
{
	protected $latestVersionEnabled = true;
	protected $contactPersonEnabled = false;
	protected $gateKeeperEnabled = true;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->resourceCategory = 'dm_policies';

		$this->load->library('form_validation');
		$this->lang->load('dm_policies');

		$this->load->model('dm_policies/DM_Policies_Content_Model', 'Content_Model');

		// Set menu item (active)
		Template::set('dm_policies_active', true);

		Assets::add_module_js('dm_policies', 'dm_policies.js');
	}

	/**
	 * Get categories
	 *
	 * @return array
	 */
	protected function getCategories()
	{
		return [
			'mandatory' => 'Mandatory',
			'recommended' => 'Recommended',
			'useful' => 'Useful'
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

		$categories = $this->getCategories();
		$categoryKeys = array_keys($categories);
		$category = $this->input->get('category', null);

		if($category == null) {
			$category = $categoryKeys[0];
		}

		foreach($categoryKeys as $key) {
			if($key == $category) {
				Template::set($key.'_active', true);
			} else {
				Template::set($key.'_active', false);
			}
		}

        Template::set('keyInsights', $this->showKeyInsights($this->resourceCategory));
		Template::set('listView', $this->showResourcesList($this->resourceCategory, $this->Content_Model, true, $category, 'table table-condensed table-striped table-hover mru_tbl'));
		Template::set('categories', $categories);
		Template::set('tabsUrl', site_url('dm_policies'));
		Template::render();
	}
}