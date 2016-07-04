<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * capacity_building controller
 */
class capacity_building extends BaseResourceController
{
    protected $latestVersionEnabled = false;
    protected $contactPersonEnabled = true;
    protected $gateKeeperEnabled = false;
    
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->resourceCategory = 'capacity_building';

		$this->load->library('form_validation');
		$this->lang->load('capacity_building');

		$this->load->model('capacity_building/Capacity_Building_Content_Model', 'Content_Model');

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

        $categories = $this->getCategories();
        $categoryKeys = array_keys($categories);
        $category = $this->input->get('category', null);

		// Specific for search
		$id = $this->input->get('id', 0);
		$activeCategory = null;

		if($id > 0) {
			$contentItem = $this->Content_Model->find($id);

			if($contentItem) {
				$activeCategory = $contentItem->category;
			}
		}

        if($category == null) {
            $category = $categoryKeys[0];
        }

        if($id > 0) {
            foreach($categoryKeys as $key) {
                Template::set($key.'_active', false);
            }

            Template::set($activeCategory.'_active', true);
        } else {
            foreach($categoryKeys as $key) {
                if($key == $category) {
                    Template::set($key.'_active', true);
                } else {
                    Template::set($key.'_active', false);
                }
            }
        }

        Template::set('keyInsights', $this->showKeyInsights($this->resourceCategory));
		Template::set('listView', $this->showResourcesList($this->resourceCategory,
            $this->Content_Model,
            true,
            $category,
            'table table-condensed table-striped table-hover mru_tbl',
            $id
        ));
        Template::set('categories', $categories);
        Template::set('tabsUrl', site_url('capacity_building'));
		Template::render();
	}
}