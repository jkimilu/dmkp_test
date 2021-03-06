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

        $this->homeScreenUrl = site_url(SITE_AREA .'/content/dm_policies');
		$this->submitUrl = site_url(SITE_AREA .'/content/dm_policies/save');
		$this->resourceEditUrl = site_url(SITE_AREA .'/content/dm_policies/edit');
		$this->resourceAddUrl = site_url(SITE_AREA .'/content/dm_policies/edit');
		$this->resourceDeleteUrl = site_url(SITE_AREA .'/content/dm_policies/delete');
		$this->resourceResourcesUrl = site_url(SITE_AREA .'/content/dm_policies/resources');
        $this->resourceResourceDeleteUrl = site_url(SITE_AREA .'/content/dm_policies/delete_resource');
		$this->resourceVisibilityUrl = site_url(SITE_AREA .'/content/dm_policies/set_visible');

        $this->resourceCategory = 'dm_policies';

		parent::__construct();

		$this->auth->restrict('DM_Policies.Content.View');

		$this->load->model('dm_policies/DM_Policies_Content_Model', 'Content_Model');
		$this->lang->load('dm_policies');
		$this->load->library('pagination');

		$this->resourceModel = $this->Content_Model;
        $this->resourceModel->setBaseUrl(site_url('admin/content/dm_policies/index'));

		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('dm_policies', 'dm_policies.js');
	}

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
     * @param int $pageNumber
     */
	public function index($pageNumber = 1)
	{
	    $this->pageNumber = $pageNumber - 1;

        $records = $this->Content_Model->find_all();

		Template::set('extraJS', sureToDelete($records));
		Template::set('listView', $this->showResourcesList($this->resourceCategory, $this->Content_Model, null));
		Template::set('toolbar_title', 'Manage DM Policies');
		Template::render();
	}

	/**
	 * Allows editing of Capacity Building data.
	 *
	 * @return void
	 */
	public function edit()
	{
        $this->auth->restrict('DM_Policies.Content.Create');

		$id = $this->uri->segment(5);

		if(empty($id)) {
			// New record
			Template::set('formView', $this->showEditor());
		} else {
			// Existing record
			Template::set('formView', $this->showEditor($id));
		}

		Template::set('toolbar_title', lang('dm_policies_edit') .' DM Policy');
		Template::render();
	}

	/**
	 * Save edited / inserted resource
	 */
	public function save() {
        $this->auth->restrict('DM_Policies.Content.Create');

		$this->saveResource($this->input, $this->input->post('id', null));
		Template::redirect(SITE_AREA .'/content/dm_policies/index');
	}

	/**
	 * Delete existing resource
	 */
	public function delete() {
        $this->auth->restrict('DM_Policies.Content.Delete');

		$id = $this->uri->segment(5);

		if(!empty($id)) {
			$this->deleteResource($id);
		}

		Template::redirect(SITE_AREA .'/content/dm_policies/index');
	}

    /**
     * Edit resources for a specific resource
     */
    public function resources()
    {
        if($this->input->post('resource_id', false)) {
            $this->auth->restrict('DM_Policies.Content.Create');
            $this->addOrEditResourceLink();
            $id = $this->input->post('resource_id');

            Template::redirect($this->resourceResourcesUrl.'/'.$id);
        } else {
            $this->auth->restrict('DM_Policies.Content.View');
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
        $this->auth->restrict('DM_Policies.Content.Delete');

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