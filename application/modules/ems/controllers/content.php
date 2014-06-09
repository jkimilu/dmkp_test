<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * content controller
 */
class content extends Admin_Controller
{
    private $content_tree;

    private $default_role;

	//--------------------------------------------------------------------


    /**
     * Constructor
     */
	public function __construct()
	{
		parent::__construct();

        // Load lobraries and initialize
        $this->load->library('ems/ems_tree');
        $this->load->library('ems/utilities');
        $this->content_tree = $this->ems_tree->get_ems_tree();

        $roles = $this->ems_tree->get_roles();
        $this->default_role = $roles[0];

        // Load default models
        $this->load->model('ems/content_model');
        $this->load->model('ems/content_chunks_model');
        $this->load->model('ems/content_popups_model');
        $this->load->model('ems/content_abbreviations_model');
        $this->load->model('ems/content_definitions_model');

		$this->auth->restrict('EMS.Content.View');
		$this->lang->load('ems');
		
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('ems', 'ems.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Content landing.
	 *
	 * @return void
	 */
	public function index()
	{
		Template::set('toolbar_title', 'Manage EMS Content');
        Template::set('content_tree', $this->content_tree);
        Template::set('lang_items', lang("ems_tree"));

        Template::render();
	}

    /**
     * Displays a list of form data.
     *
     * @return void
     */
    public function role_index()
    {
        Template::set('toolbar_title', 'Manage EMS Content to Roles');
        Template::set('content_tree', $this->content_tree);
        Template::set('lang_items', lang("ems_tree"));

        Template::render();
    }

    private function get_content_variables($section_key, $content_item_key)
    {
        $content_variables = array();
        $content_variables['content'] = $this->content_model->get_content($section_key, $content_item_key);
        $content_variables['partials'] = $this->ems_tree->get_content_segments($section_key, $content_item_key);
        $content_variables['chunks'] = $this->content_chunks_model->get_content($section_key, $content_item_key);

        return $content_variables;
    }

    private function load_view($section_key, $content_item_key, $content_variables, $section_id,
        $content_item_id, $is_ajax = false, $is_array = false)
    {
        $this->load->library('ems/my_content');

        $script_path = base_url('assets/js/ckeditor/ckeditor.js');
        $content = null;

        $array = array('content' => $content_variables,
            'section_key' => $section_key,
            'content_item_key' => $content_item_key,
            'ckeditor_path' => $script_path,
            'is_ajax' => $is_ajax,
            'section_id' => $section_id,
            'content_item_id' => $content_item_id,
        );

        if(!$is_array)
        {
            $content = $this->my_content->load_content_editors($section_key, $content_item_key, $section_id,
                $content_item_id, $content_variables, $script_path);
        }
        else
        {
            $content = $array;
        }

        return $content;
    }

    //--------------------------------------------------------------------


    /**
     * Allows editing of EMS data.
     *
     * @param $section_key
     * @param $content_item_key
     * @param $section_id
     * @param $content_item_id
     * @internal param null $role
     * @return void
     */
	public function content_edit($section_key, $content_item_key, $section_id, $content_item_id)
	{
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $language = lang("ems_tree");

        // Load content segments
        $content_variables = $this->get_content_variables($section_key, $content_item_key);

        $edit_view = $this->load_view($section_key, $content_item_key, $content_variables, $section_id, $content_item_id);

        // << Previous link
        $previous_link = $this->ems_tree->get_previous_link($this->content_tree, $section_id, $content_item_key);
        $previous_node = $this->ems_tree->get_previous_link($this->content_tree, $section_id, $content_item_key, true);

        // Next >> link
        $next_link = $this->ems_tree->get_next_link($this->content_tree, $section_id, $content_item_key);
        $next_node = $this->ems_tree->get_next_link($this->content_tree, $section_id, $content_item_key, true);

        // Set variables
        Template::set('content_variables', $content_variables);
        Template::set('edit_view', $edit_view);
		Template::set('section', $section_key);
        Template::set('section_id', $section_id);
        Template::set('previous_link', $previous_link);
        Template::set('previous_node', $previous_node);
        Template::set('next_link', $next_link);
        Template::set('next_node', $next_node);
        Template::set('content_item_id', $content_item_id);
        Template::set('toolbar_title', $language[$section_key].' > '.$language[$content_item_key]);

        // Render
		Template::render();
	}

	//--------------------------------------------------------------------

    public function content_save()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        if($this->input->post())
        {
            $post_vars = $this->input->post();

            if($post_vars["submit_btn"] != "Discard")
            {
                $section_key = $post_vars["section_key"];
                $content_item_key = $post_vars["content_item_key"];

                $main_content = $post_vars["content"];
                $content_chunks = array();

                $content_segments = $this->ems_tree->get_content_segments($section_key, $content_item_key);

                foreach($content_segments as $segment)
                {
                    $content_chunks[$segment] = $post_vars[$segment];
                }

                // Save main content
                $content_id = $this->content_model->save_content($section_key, $content_item_key, $main_content);

                // Save content chunks
                $this->content_chunks_model->save_content($content_id, $section_key, $content_item_key, $content_chunks);
            }
        }

        // Redirect to landing page
        Template::redirect('admin/content/ems');
    }

    // -----------------------------
    // Popups
    // -----------------------------

    /**
     * Popups list
     */
    public function popups()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        Template::set('toolbar_title', lang('ems_content_popups'));
        Template::set('popups',
            $this->content_popups_model
                ->order_by('slug')
                ->where('deleted', 0)
                ->find_all());
        Template::render();
    }

    /**
     * Popups edit
     *
     * @param $popup_id
     */
    public function popup_edit($popup_id = 0)
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $script_path = base_url('assets/js/ckeditor_basic/ckeditor.js');

        Template::set('popup', $popup_id > 0 ? $this->content_popups_model->find($popup_id) : null);
        Template::set('toolbar_title', lang('ems_content_popups'));
        Template::set('script_path', $script_path);
        Template::set('validation_errors', $this->session->flashdata('validation_errors'));
        Template::set('popup_id', $popup_id);
        Template::render();
    }

    /**
     * Popups save
     */
    public function popup_save()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $post_vars = $this->input->post();

        if($post_vars)
        {
            $this->form_validation->set_rules('popup_title', lang('ems_popup_title'), 'required');
            $submit = $post_vars['submit'];

            if($submit == 'Save')
            {
                if(!$this->form_validation->run())
                {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    Template::redirect('admin/content/ems/popup_edit/'.$post_vars['popup_id']);
                }

                $popup_id = $post_vars["popup_id"];

                if($popup_id == "0")
                {
                    // Create new
                    $this->content_popups_model->insert(array(
                        'title' => $post_vars['popup_title'],
                        'slug'=> $this->utilities->get_slug($post_vars['popup_title']),
                        'popup_content' => $post_vars['popup_content'],
                        'permission' => 'admin',
                    ));
                }
                else
                {
                    // Update existing
                    $this->content_popups_model->update(array(
                        'id' => $popup_id,
                    ),array(
                        'title' => $post_vars['popup_title'],
                        'slug'=> $this->utilities->get_slug($post_vars['popup_title']),
                        'popup_content' => $post_vars['popup_content'],
                        'permission' => 'admin',
                    ));
                }
            }
        }

        Template::redirect('admin/content/ems/popups');
    }

    public function popup_delete($id)
    {
        // Requires Content Deleting rights
        $this->auth->restrict('EMS.Content.Delete');

        $this->content_popups_model->delete($id);
        Template::redirect('admin/content/ems/popups');
    }

    // -----------------------------
    // Abbreviations
    // -----------------------------

    /**
     * Abbreviations list
     */
    public function abbreviations()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        Template::set('toolbar_title', lang('ems_content_abbreviations'));
        Template::set('abbreviations',
            $this->content_abbreviations_model
                ->order_by('slug')
                ->where('deleted', 0)
                ->find_all());
        Template::render();
    }

    /**
     * Abbreviations edit
     *
     * @param $abbreviation_id
     */
    public function abbreviation_edit($abbreviation_id = 0)
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $script_path = base_url('assets/js/ckeditor_basic/ckeditor.js');

        Template::set('abbreviation', $abbreviation_id > 0 ? $this->content_abbreviations_model->find($abbreviation_id) : null);
        Template::set('toolbar_title', lang('ems_content_popups'));
        Template::set('script_path', $script_path);
        Template::set('validation_errors', $this->session->flashdata('validation_errors'));
        Template::set('abbreviation_id', $abbreviation_id);
        Template::render();
    }

    /**
     * Abbreviations save
     */
    public function abbreviation_save()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $post_vars = $this->input->post();

        if($post_vars)
        {
            $this->form_validation->set_rules('abbreviation', lang('ems_abbreviation'), 'required');
            $submit = $post_vars['submit'];

            if($submit == 'Save')
            {
                if(!$this->form_validation->run())
                {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    Template::redirect('admin/content/ems/abbreviation_edit/'.$post_vars['abbreviation_id']);
                }

                $abbreviation_id = $post_vars["abbreviation_id"];

                if($abbreviation_id == "0")
                {
                    // Create new
                    $this->content_abbreviations_model->insert(array(
                        'title' => $post_vars['abbreviation'],
                        'slug'=> $this->utilities->get_slug($post_vars['abbreviation']),
                        'content' => $post_vars['content'],
                        'permission' => 'admin',
                    ));
                }
                else
                {
                    // Update existing
                    $this->content_abbreviations_model->update(array(
                        'id' => $abbreviation_id,
                    ),array(
                        'title' => $post_vars['abbreviation'],
                        'slug'=> $this->utilities->get_slug($post_vars['abbreviation']),
                        'content' => $post_vars['content'],
                        'permission' => 'admin',
                    ));
                }
            }
        }

        Template::redirect('admin/content/ems/abbreviations');
    }

    /**
     * Delete abbreviation
     *
     * @param $id
     */

    public function abbreviation_delete($id)
    {
        // Requires Content Deleting rights
        $this->auth->restrict('EMS.Content.Delete');

        $this->content_abbreviations_model->delete($id);
        Template::redirect('admin/content/ems/abbreviations');
    }

    // -----------------------------
    // Definitions
    // -----------------------------

    /**
     * Abbreviations list
     */
    public function definitions()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        Template::set('toolbar_title', lang('ems_content_definitions'));
        Template::set('definitions',
            $this->content_definitions_model
                ->order_by('slug')
                ->where('deleted', 0)
                ->find_all());
        Template::render();
    }

    /**
     * Abbreviations edit
     *
     * @param $definition_id
     */
    public function definition_edit($definition_id = 0)
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $script_path = base_url('assets/js/ckeditor_basic/ckeditor.js');

        Template::set('definition', $definition_id > 0 ? $this->content_definitions_model->find($definition_id) : null);
        Template::set('toolbar_title', lang('ems_content_popups'));
        Template::set('script_path', $script_path);
        Template::set('validation_errors', $this->session->flashdata('validation_errors'));
        Template::set('definition_id', $definition_id);
        Template::render();
    }

    /**
     * Abbreviations save
     */
    public function definition_save()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $post_vars = $this->input->post();

        if($post_vars)
        {
            $this->form_validation->set_rules('definition', lang('ems_definition'), 'required');

            $submit = $post_vars['submit'];

            if($submit == 'Save')
            {
                if(!$this->form_validation->run())
                {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    Template::redirect('admin/content/ems/definition_edit/'.$post_vars['definition_id']);
                }

                $definition_id = $post_vars["definition_id"];

                if($definition_id == "0")
                {
                    // Create new
                    $this->content_definitions_model->insert(array(
                        'title' => $post_vars['definition'],
                        'slug'=> $this->utilities->get_slug($post_vars['definition']),
                        'content' => $post_vars['content'],
                        'permission' => 'admin',
                    ));
                }
                else
                {
                    // Update existing
                    $this->content_definitions_model->update(array(
                        'id' => $definition_id,
                    ),array(
                        'title' => $post_vars['definition'],
                        'slug'=> $this->utilities->get_slug($post_vars['definition']),
                        'content' => $post_vars['content'],
                        'permission' => 'admin',
                    ));
                }
            }
        }

        Template::redirect('admin/content/ems/definitions');
    }

    /**
     * Delete a definition
     *
     * @param $id
     */

    public function definition_delete($id)
    {
        // Requires Content Deleting rights
        $this->auth->restrict('EMS.Content.Delete');

        $this->content_definitions_model->delete($id);
        Template::redirect('admin/content/ems/definitions');
    }

    // --------------------------------
    // End of content segments
    // --------------------------------

    /**
     * Roles and segments
     *
     * @param $section_key
     * @param $content_item_key
     * @return array
     */

    private function get_saved_roles_segments($section_key, $content_item_key)
    {
        $this->load->model('ems/main_content_roles_model', 'crm');
        $this->load->model('ems/content_chunks_roles_model', 'ccrm');

        $roles = $this->ems_tree->get_roles();

        $segments = array();
        $chunks_segments = array();

        foreach($roles as $role)
        {
            // Main content
            $crm = $this->crm->find_all_by(array(
                'section_key' => $section_key,
                'content_item_key' => $content_item_key,
                'role' => $role,
            ));

            // Content chunks
            $ccrm = $this->ccrm->find_all_by(array(
                'section_key' => $section_key,
                'content_item_key' => $content_item_key,
                'role' => $role,
            ));

            if($crm)
            {
                foreach($crm as $crm_item)
                {
                    if(!isset($segments[$crm_item->role]))
                    {
                        $segments[$crm_item->role] = array();
                    }

                    $segments[$crm_item->role][$crm_item->paragraph_index] = $crm_item->permission;
                }
            }
            if($ccrm)
            {
                foreach($ccrm as $ccrm_item)
                {
                    if(!isset($chunks_segments[$ccrm_item->role]))
                    {
                        $chunks_segments[$ccrm_item->role] = array();

                        if(!isset($chunks_segments[$ccrm_item->role][$ccrm_item->chunk]))
                        {
                            $chunks_segments[$ccrm_item->role][$ccrm_item->chunk] = array();
                        }
                    }

                    $chunks_segments[$ccrm_item->role][$ccrm_item->chunk][$ccrm_item->paragraph_index] = $ccrm_item->permission;
                }
            }
        }

        return array('main_content' => $segments, 'chunks' => $chunks_segments);
    }

    /**
     * Allows you to edit segments for a document according to roles
     *
     * @param $section_key
     * @param $content_item_key
     * @param $section_id
     * @param $content_item_id
     */

    public function role_segments($section_key, $content_item_key, $section_id, $content_item_id)
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $this->load->library('ems/text_parsing');
        $content_variables = $this->get_content_variables($section_key, $content_item_key);

        $language = lang("ems_tree");

        $content_text_segments = $this->text_parsing->get_text_segments($content_variables['content']);
        $chunk_text_segments = array();

        foreach($content_variables['chunks'] as $chunk_key => $chunk_value)
        {
            $chunk_text_segments[$chunk_key] = $this->text_parsing->get_text_segments($chunk_value);
        }

        // Role view
        $role_view_modes = $this->text_parsing->get_role_view_modes();

        // Make them language specific
        foreach($role_view_modes as &$view_mode_value)
        {
            $view_mode_value = $language[$view_mode_value];
        }

        // Variables
        Template::set('roles', $this->ems_tree->get_roles());
        Template::set('view_modes', $role_view_modes);
        Template::set('content_text_segments', $content_text_segments);
        Template::set('chunk_text_segments', $chunk_text_segments);
        Template::set('section_key', $section_key);
        Template::set('section_id', $section_id);
        Template::set('content_item_key', $content_item_key);
        Template::set('content_item_id', $content_item_id);
        Template::set('language', $language);
        Template::set('toolbar_title', $language[$section_key].' > '.$language[$content_item_key]);
        Template::set('roles_segments', $this->get_saved_roles_segments($section_key, $content_item_key));

        // Render
        Template::render();
    }

    /**
     * Saves roles segment values
     */

    public function role_segments_save()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        $post_vars = $this->input->post();

        if($post_vars)
        {
            $submit_value = $post_vars['submit'];

            if($submit_value == "Save")
            {
                $section_key = $post_vars['section_key'];
                $content_item_key = $post_vars['content_item_key'];
                $content_item_id = $post_vars['content_item_id'];

                $content_variables = $this->get_content_variables($section_key, $content_item_key);
                $roles = $this->ems_tree->get_roles();

                foreach($roles as $role)
                {
                    $main_content_segments = intval($post_vars["main_content_segments"]);

                    for($segment = 1; $segment <= $main_content_segments; $segment ++)
                    {
                        $main_content_visibility = $post_vars["main_content_".$role."_".$segment];

                        $this->content_model->save_role_visibility($section_key, $content_item_key,
                            $role, $main_content_visibility, $segment);
                    }

                    foreach($content_variables['chunks'] as $chunk_key => $chunk_value)
                    {
                        $chunk_segments = intval($post_vars[$chunk_key."_segments"]);

                        for($segment = 1; $segment <= $chunk_segments; $segment ++)
                        {
                            $role_visibility = $post_vars[$chunk_key."_".$role."_".$segment];

                            $this->content_chunks_model->save_role_visibility($section_key, $content_item_key,
                                $chunk_key, $role, $role_visibility, $segment);
                        }
                    }
                }
            }
        }

        // Redirect to landing page
        Template::redirect('admin/content/ems/role_index');
    }
}