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

        $this->submitUrl = site_url(SITE_AREA .'/content/capacity_building/save');
        $this->resourceEditUrl = site_url(SITE_AREA .'/content/capacity_building/edit');
        $this->resourceAddUrl = site_url(SITE_AREA .'/content/capacity_building/edit');
        $this->resourceDeleteUrl = site_url(SITE_AREA .'/content/capacity_building/delete');

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

	public function save() {
        $this->saveResource($this->input, $this->input->post('id', null));
        Template::redirect(SITE_AREA .'/content/capacity_building/index');
    }

    public function delete() {
        $id = $this->uri->segment(5);

        if(!empty($id)) {
            $this->deleteResource($id);
        }

        Template::redirect(SITE_AREA .'/content/capacity_building/index');
    }
}