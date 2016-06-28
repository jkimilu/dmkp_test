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
		$this->contactPersonEnabled = true;

        $this->homeScreenUrl = site_url(SITE_AREA .'/content/capacity_building');
        $this->submitUrl = site_url(SITE_AREA .'/content/capacity_building/save');
        $this->resourceEditUrl = site_url(SITE_AREA .'/content/capacity_building/edit');
        $this->resourceAddUrl = site_url(SITE_AREA .'/content/capacity_building/edit');
        $this->resourceDeleteUrl = site_url(SITE_AREA .'/content/capacity_building/delete');
        $this->resourceResourcesUrl = site_url(SITE_AREA .'/content/capacity_building/resources');
        $this->resourceResourceDeleteUrl = site_url(SITE_AREA .'/content/capacity_building/delete_resource');
        $this->resourceVisibilityUrl = site_url(SITE_AREA .'/content/capacity_building/set_visible');

        $this->resourceCategory = 'capacity_building';

		parent::__construct();

        $this->auth->restrict('Capacity_Building.Content.View');

		$this->load->model('capacity_building/Content_Model');
		$this->lang->load('capacity_building');
		$this->load->library('pagination');

        $this->resourceModel = $this->Content_Model;
		
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('capacity_building', 'capacity_building.js');
	}

	protected function getCategories()
    {
        return [
            'ecampus_courses' => 'eCampus Courses',
            'other_resources' => 'Other Resources'
        ];
    }


    /**
     * Displays a list of form data.
     */
	public function index()
	{
        $records = $this->Content_Model->find_all();

        Template::set('extraJS', sureToDelete($records));
		Template::set('listView', $this->showResourcesList($this->resourceCategory, $this->Content_Model, null));
		Template::set('toolbar_title', 'Manage Capacity Building');
		Template::render();
	}

	/**
	 * Allows editing of Capacity Building data.
	 *
	 * @return void
	 */
	public function edit()
	{
        $this->auth->restrict('Capacity_Building.Content.Create');

		$id = $this->uri->segment(5);

		if(empty($id)) {
            // New record
			Template::set('formView', $this->showEditor());
		} else {
            // Existing record
            Template::set('formView', $this->showEditor($id));
        }

		Template::set('toolbar_title', lang('capacity_building_edit') .' Capacity Building');
		Template::render();
	}

    /**
     * Save edited / inserted resource
     */
	public function save() {
        $this->auth->restrict('Capacity_Building.Content.Create');

        $this->saveResource($this->input, $this->input->post('id', null));
        Template::redirect(SITE_AREA .'/content/capacity_building/index');
    }

    /**
     * Delete existing resource
     */
    public function delete() {
        $this->auth->restrict('Capacity_Building.Content.Delete');

        $id = $this->uri->segment(5);

        if(!empty($id)) {
            $this->deleteResource($id);
        }

        Template::redirect(SITE_AREA .'/content/capacity_building/index');
    }

    /**
     * Edit resources for a specific resource
     */
    public function resources()
    {
        if($this->input->post('resource_id', false)) {
            $this->auth->restrict('Capacity_Building.Content.Create');
            $this->addOrEditResourceLink();
            $id = $this->input->post('resource_id');

            Template::redirect($this->resourceResourcesUrl.'/'.$id);
        } else {
            $this->auth->restrict('Capacity_Building.Content.View');
            $id = $this->uri->segment(5);
            $listView = $this->showResourceResourcesList($id);

            Template::set('backUrl', $this->homeScreenUrl);
            Template::set('listView', $listView);
            Template::render();
        }
    }

    /**
     * Delete a resource
     */
    public function delete_resource() {
        $this->auth->restrict('Capacity_Building.Content.Delete');

        $id = $this->uri->segment(5);
        $resourceResourceId = $this->uri->segment(6);
        $this->Resource_Resources_Model->delete($id);

        Template::redirect($this->resourceResourcesUrl.'/'.$resourceResourceId);
    }

    /**
     * Sets visibility of a resource
     */
    public function set_visible() {
        $id = $this->uri->segment(5);
        $visibility = $this->uri->segment(6);

        $this->setVisible($id, $visibility);

        Template::redirect($this->homeScreenUrl);
    }
}