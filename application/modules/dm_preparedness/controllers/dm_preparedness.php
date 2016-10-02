<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * dm_preparedness controller
 */
class dm_preparedness extends BaseResourceController
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

		$this->resourceCategory = 'dm_preparedness';

		$this->load->library('form_validation');
		$this->lang->load('dm_preparedness');

		$this->load->model('dm_preparedness/DM_Preparedness_Content_Model', 'Content_Model');
        $this->Content_Model->setBaseUrl(site_url('dm_preparedness/index'));

		// Set menu item (active)
		Template::set('dm_preparedness_active', true);

		Assets::add_module_js('dm_preparedness', 'dm_preparedness.js');

        $category = $this->input->get('category', false);

        if($category) {
            $this->session->set_userdata('dm_preparedness_category', $category);
        } else {
            if(!($this->session->userdata('dm_preparedness_category'))) {
                $this->session->set_userdata('dm_preparedness_category', 'tools_and_templates');
            }
        }
	}

	/**
	 * Get categories
	 *
	 * @return array
	 */
	protected function getCategories()
	{
		return [
			'tools_and_templates' => 'Tools &amp; Templates',
			'recommended' => 'Recommended',
			'useful' => 'Useful'
		];
	}


    /**
     * Displays a list of form data.
     *
     * @param int $pageNumber
     */
	public function index($pageNumber = 1)
	{
		$this->force_login();

        $this->pageNumber = $pageNumber - 1;

		$categories = $this->getCategories();
		$categoryKeys = array_keys($categories);
		$category = $this->session->userdata('dm_preparedness_category');

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
		Template::set('tabsUrl', site_url('dm_preparedness'));
		Template::render();
	}
}