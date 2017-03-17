<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * settings controller
 */
class settings extends Admin_Controller
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

		$this->auth->restrict('Contact_Persons.Settings.View');
		$this->load->model('contact_persons_model', null, true);
		$this->lang->load('contact_persons');
		
		Template::set_block('sub_nav', 'settings/_sub_nav');

		Assets::add_module_js('contact_persons', 'contact_persons.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->contact_persons_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('contact_persons_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('contact_persons_delete_failure') . $this->contact_persons_model->error, 'error');
				}
			}
		}

		$records = $this->contact_persons_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Contact Persons');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Contact Persons object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Contact_Persons.Settings.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_contact_persons())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('contact_persons_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'contact_persons');

				Template::set_message(lang('contact_persons_create_success'), 'success');
				redirect(SITE_AREA .'/settings/contact_persons');
			}
			else
			{
				Template::set_message(lang('contact_persons_create_failure') . $this->contact_persons_model->error, 'error');
			}
		}
		Assets::add_module_js('contact_persons', 'contact_persons.js');

		Template::set('toolbar_title', lang('contact_persons_create') . ' Contact Persons');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Contact Persons data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('contact_persons_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/contact_persons');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Contact_Persons.Settings.Edit');

			if ($this->save_contact_persons('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('contact_persons_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'contact_persons');

				Template::set_message(lang('contact_persons_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('contact_persons_edit_failure') . $this->contact_persons_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Contact_Persons.Settings.Delete');

			if ($this->contact_persons_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('contact_persons_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'contact_persons');

				Template::set_message(lang('contact_persons_delete_success'), 'success');

				redirect(SITE_AREA .'/settings/contact_persons');
			}
			else
			{
				Template::set_message(lang('contact_persons_delete_failure') . $this->contact_persons_model->error, 'error');
			}
		}
		Template::set('contact_persons', $this->contact_persons_model->find($id));
		Template::set('toolbar_title', lang('contact_persons_edit') .' Contact Persons');
		Template::render();
	}

	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/**
	 * Summary
	 *
	 * @param String $type Either "insert" or "update"
	 * @param Int	 $id	The ID of the record to update, ignored on inserts
	 *
	 * @return Mixed    An INT id for successful inserts, TRUE for successful updates, else FALSE
	 */
	private function save_contact_persons($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['contact_person']        = $this->input->post('contact_persons_contact_person');
		$data['contact_person_link']        = $this->input->post('contact_persons_contact_person_link');

		if ($type == 'insert')
		{
			$id = $this->contact_persons_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			}
			else
			{
				$return = FALSE;
			}
		}
		elseif ($type == 'update')
		{
			$return = $this->contact_persons_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}