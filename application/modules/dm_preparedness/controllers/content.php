<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * content controller
 */
class content extends ResourceContentController
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->gateKeeperEnabled = true;
		$this->latestVersionEnabled = true;

		$this->submitUrl = site_url(SITE_AREA .'/content/dm_preparedness/save');
		$this->resourceEditUrl = site_url(SITE_AREA .'/content/dm_preparedness/edit');
		$this->resourceAddUrl = site_url(SITE_AREA .'/content/dm_preparedness/edit');
		$this->resourceDeleteUrl = site_url(SITE_AREA .'/content/dm_preparedness/delete');

		parent::__construct();

		$this->auth->restrict('DM_Preparedness.Content.View');

		$this->load->model('dm_preparedness/Content_Model');
		$this->lang->load('dm_preparedness');
		$this->load->library('pagination');

		$this->resourceModel = $this->Content_Model;

		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('dm_preparedness', 'dm_preparedness.js');
	}

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
	 */
	public function index()
	{
		$records = $this->Content_Model->find_all();
		$extraJS = '';

		if($records) {
			foreach ($records as $record) {
				$recordId = $record->id;
				$extraJS .=
<<<JS
				$('#delete_{$recordId}').click(function () {
                    return confirm("Sure you want to delete?");
                });
JS;
			}
		}

		Template::set('extraJS', $extraJS);
		Template::set('listView', $this->showResourcesList($this->Content_Model, null));
		Template::set('toolbar_title', 'Manage DM Preparedness');
		Template::render();
	}

	/**
	 * Allows editing of Capacity Building data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$this->auth->restrict('DM_Preparedness.Content.Create');

		$id = $this->uri->segment(5);

		if(empty($id)) {
			// New record
			Template::set('formView', $this->showEditor());
		} else {
			// Existing record
			Template::set('formView', $this->showEditor($id));
		}

		Template::set('toolbar_title', lang('dm_preparedness_edit') .' DM Preparedness');
		Template::render();
	}

	/**
	 * Save edited / inserted resource
	 */
	public function save() {
		$this->auth->restrict('DM_Preparedness.Content.Create');

		$this->saveResource($this->input, $this->input->post('id', null));
		Template::redirect(SITE_AREA .'/content/dm_preparedness/index');
	}

	/**
	 * Delete existing resource
	 */
	public function delete() {
		$this->auth->restrict('DM_Preparedness.Content.Delete');

		$id = $this->uri->segment(5);

		if(!empty($id)) {
			$this->deleteResource($id);
		}

		Template::redirect(SITE_AREA .'/content/dm_preparedness/index');
	}
}