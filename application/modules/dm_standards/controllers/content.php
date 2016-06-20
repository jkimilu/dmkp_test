<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * content controller
 */
class content extends Admin_Controller
{
    private $content_tree;

    const mode_code_view = "code_view";
    const mode_wysiwyg_view = "wysiwyg_view";

	//--------------------------------------------------------------------


    /**
     * Constructor
     */
	public function __construct()
	{
		parent::__construct();

        // Load libraries and initialize
        $this->load->library('dm_standards/dms_tree');
        $this->load->library('dm_standards/utilities');
        $this->load->library('dm_standards/admin_content_utilities');
        $this->content_tree = $this->dms_tree->get_dms_tree();

        // Load default models
        $this->load->model('dm_standards/content_model');
        $this->load->model('dm_standards/content_popups_model');
        $this->load->model('dm_standards/content_abbreviations_model');
        $this->load->model('dm_standards/content_definitions_model');

		$this->auth->restrict('DM_Standards.Content.View');
		$this->lang->load('dm_standards');
		
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('dms', 'dms.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Content landing.
	 *
	 * @return void
	 */
	public function index()
	{
		Template::set('toolbar_title', 'Manage dms Content');
        Template::set('content_tree', $this->content_tree);
        Template::set('lang_items', lang("dms_tree"));

        Template::render();
	}

    private function get_content_variables($section_key, $content_item_key)
    {
        $content_variables = array();
        $content_variables['content'] = $this->content_model->get_content($section_key, $content_item_key);
        $content_variables['partials'] = $this->dms_tree->get_content_segments($section_key, $content_item_key);
        $content_variables['chunks'] = $this->content_chunks_model->get_content($section_key, $content_item_key);

        return $content_variables;
    }

    private function load_view($section_key, $content_item_key, $content_variables, $section_id,
        $content_item_id, $is_ajax = false, $is_array = false)
    {
        $this->load->library('dms/my_content');

        // CKEditor
        $ckeditor_script_path = base_url('assets/js/ckeditor/ckeditor.js');

        // CodeMirror
        $codemirror_script_path = base_url('assets/js/codemirror/codemirror.js');
        $codemirror_css_path = base_url('assets/css/codemirror/codemirror.css');
        $codemirror_theme_path = base_url('assets/js/codemirror/themes/eclipse.css');
        $codemirror_mode_path = base_url('assets/js/codemirror/modes/htmlmixed/htmlmixed.js');
        $codemirror_addon_path = base_url('assets/js/codemirror/addons/');

        // Content
        $content = null;

        $array = array('content' => $content_variables,
            'section_key' => $section_key,
            'content_item_key' => $content_item_key,
            'is_ajax' => $is_ajax,
            'section_id' => $section_id,
            'content_item_id' => $content_item_id,
            'mode' => self::mode_code_view,
            // CKEditor
            'ckeditor_path' => $ckeditor_script_path,
            // CodeMirror
            'codemirror_script_path' => $codemirror_script_path,
            'codemirror_css_path' => $codemirror_css_path,
            'codemirror_theme_path' => $codemirror_theme_path,
            'codemirror_mode_path' => $codemirror_mode_path,
            'codemirror_addon_path' => $codemirror_addon_path,
        );

        if(!$is_array)
        {
            $content = $this->my_content->load_content_editors($section_key, $content_item_key, $section_id,
                $content_item_id, $content_variables, $ckeditor_script_path,
                $this->admin_content_utilities->content_states($section_key, $content_item_key, lang("dms_tree")),
                $array);
        }
        else
        {
            $content = $array;
        }

        return $content;
    }

    //--------------------------------------------------------------------


    /**
     * Allows editing of dms data.
     *
     * @param $section_key
     * @param $content_item_key
     * @param $section_id
     * @param $content_item_id
     * @return void
     */
	public function content_edit($section_key, $content_item_key, $section_id, $content_item_id)
	{
        // Requires Content Editing rights
        $this->auth->restrict('DM_Standards.Content.Edit');

        $language = lang("dms_tree");

        // Load content segments
        $content_variables = $this->get_content_variables($section_key, $content_item_key);

        $edit_view = $this->load_view($section_key, $content_item_key, $content_variables, $section_id, $content_item_id);

        // << Previous link
        $previous_link = $this->dms_tree->get_previous_link($this->content_tree, $section_id, $content_item_key);
        $previous_node = $this->dms_tree->get_previous_link($this->content_tree, $section_id, $content_item_key, true);

        // Next >> link
        $next_link = $this->dms_tree->get_next_link($this->content_tree, $section_id, $content_item_key);
        $next_node = $this->dms_tree->get_next_link($this->content_tree, $section_id, $content_item_key, true);

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
        $this->auth->restrict('DM_Standards.Content.Edit');

        if($this->input->post())
        {
            $post_vars = $this->input->post();

            if($post_vars["submit_btn"] != "Discard")
            {
                $section_key = $post_vars["section_key"];
                $content_item_key = $post_vars["content_item_key"];

                $main_content = $post_vars["content"];
                $content_chunks = array();

                $content_segments = $this->dms_tree->get_content_segments($section_key, $content_item_key);

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
        Template::redirect('admin/content/dms');
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
        $this->auth->restrict('DM_Standards.Content.Edit');

        Template::set('toolbar_title', lang('dms_content_popups'));
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
        $this->auth->restrict('DM_Standards.Content.Edit');

        $script_path = base_url('assets/js/ckeditor_basic/ckeditor.js');

        Template::set('popup', $popup_id > 0 ? $this->content_popups_model->find($popup_id) : null);
        Template::set('toolbar_title', lang('dms_content_popups'));
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
        $this->auth->restrict('DM_Standards.Content.Edit');

        $post_vars = $this->input->post();

        if($post_vars)
        {
            $this->form_validation->set_rules('popup_title', lang('dms_popup_title'), 'required');
            $submit = $post_vars['submit'];

            if($submit == 'Save')
            {
                if(!$this->form_validation->run())
                {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    Template::redirect('admin/content/dms/popup_edit/'.$post_vars['popup_id']);
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

        Template::redirect('admin/content/dms/popups');
    }

    public function popup_delete($id)
    {
        // Requires Content Deleting rights
        $this->auth->restrict('DM_Standards.Content.Delete');

        $this->content_popups_model->delete($id);
        Template::redirect('admin/content/dms/popups');
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
        $this->auth->restrict('DM_Standards.Content.Edit');

        Template::set('toolbar_title', lang('dms_content_abbreviations'));
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
        $this->auth->restrict('DM_Standards.Content.Edit');

        $script_path = base_url('assets/js/ckeditor_basic/ckeditor.js');

        Template::set('abbreviation', $abbreviation_id > 0 ? $this->content_abbreviations_model->find($abbreviation_id) : null);
        Template::set('toolbar_title', lang('dms_content_popups'));
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
        $this->auth->restrict('DM_Standards.Content.Edit');

        $post_vars = $this->input->post();

        if($post_vars)
        {
            $this->form_validation->set_rules('abbreviation', lang('dms_abbreviation'), 'required');
            $submit = $post_vars['submit'];

            if($submit == 'Save')
            {
                if(!$this->form_validation->run())
                {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    Template::redirect('admin/content/dms/abbreviation_edit/'.$post_vars['abbreviation_id']);
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

        Template::redirect('admin/content/dms/abbreviations');
    }

    /**
     * Delete abbreviation
     *
     * @param $id
     */

    public function abbreviation_delete($id)
    {
        // Requires Content Deleting rights
        $this->auth->restrict('DM_Standards.Content.Delete');

        $this->content_abbreviations_model->delete($id);
        Template::redirect('admin/content/dms/abbreviations');
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
        $this->auth->restrict('DM_Standards.Content.Edit');

        Template::set('toolbar_title', lang('dms_content_definitions'));
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
        $this->auth->restrict('DM_Standards.Content.Edit');

        $script_path = base_url('assets/js/ckeditor_basic/ckeditor.js');

        Template::set('definition', $definition_id > 0 ? $this->content_definitions_model->find($definition_id) : null);
        Template::set('toolbar_title', lang('dms_content_popups'));
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
        $this->auth->restrict('DM_Standards.Content.Edit');

        $post_vars = $this->input->post();

        if($post_vars)
        {
            $this->form_validation->set_rules('definition', lang('dms_definition'), 'required');

            $submit = $post_vars['submit'];

            if($submit == 'Save')
            {
                if(!$this->form_validation->run())
                {
                    $this->session->set_flashdata('validation_errors', validation_errors());
                    Template::redirect('admin/content/dms/definition_edit/'.$post_vars['definition_id']);
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

        Template::redirect('admin/content/dms/definitions');
    }

    /**
     * Delete a definition
     *
     * @param $id
     */

    public function definition_delete($id)
    {
        // Requires Content Deleting rights
        $this->auth->restrict('DM_Standards.Content.Delete');

        $this->content_definitions_model->delete($id);
        Template::redirect('admin/content/dms/definitions');
    }

    // --------------------------------
    // End of content segments
    // --------------------------------
}