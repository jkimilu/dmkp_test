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
        $this->content_tree = $this->ems_tree->get_ems_tree();

        $roles = $this->ems_tree->get_roles();
        $this->default_role = $roles[0];

        // Load default models
        $this->load->model('ems/content_model');
        $this->load->model('ems/content_chunks_model');

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
     * Get roles
     *
     * @return array
     */

    private function get_roles_array()
    {
        $language = lang("ems_tree");

        $roles = $this->ems_tree->get_roles();

        $role_array = array();

        foreach($roles as $role)
        {
            $role_array[$role] = $language[$role];
        }

        return $role_array;
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

    /**
     * Popups list
     */
    public function popups()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        Template::render();
    }

    /**
     * Popups edit
     *
     * @param $popup_id
     */
    public function popup_edit($popup_id)
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        Template::render();
    }

    /**
     * Popups save
     */
    public function popups_save()
    {
        // Requires Content Editing rights
        $this->auth->restrict('EMS.Content.Edit');

        Template::redirect('admin/content/ems/popups');
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

        // Variables
        Template::set('roles', $this->ems_tree->get_roles());
        Template::set('view_modes', $this->text_parsing->get_role_view_modes());
        Template::set('content_text_segments', $content_text_segments);
        Template::set('chunk_text_segments', $chunk_text_segments);
        Template::set('section_key', $section_key);
        Template::set('section_id', $section_id);
        Template::set('content_item_key', $content_item_key);
        Template::set('content_item_id', $content_item_id);
        Template::set('language', $language);
        Template::set('toolbar_title', $language[$section_key].' > '.$language[$content_item_key]);

        // Render
        Template::render();
    }
}