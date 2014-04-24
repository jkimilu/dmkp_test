<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ems controller
 */
class ems extends Front_Controller
{

    private $default_role = null;

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

        // Load default models
        $this->load->model('ems/content_model');
        $this->load->model('ems/content_chunks_model');
        $this->load->model('ems/content_popups_model');
        $this->load->model('ems/role_paragraph_model');

        // Load lobraries and initialize
        $this->load->library('ems/ems_tree');
        $this->content_tree = $this->ems_tree->get_ems_tree();

		$this->load->library('form_validation');
		$this->lang->load('ems');

		Assets::add_module_js('ems', 'ems.js');
	}

    //--------------------------------------------------------------------


    /**
     * Get content variables from the CMS
     *
     * @param $role
     * @param $section_key
     * @param $content_item_key
     */
    private function get_content_variables($role, $section_key, $content_item_key)
    {
        $content_variables = array();

        $main_content = $this->content_model->get_content($section_key, $content_item_key);
        $main_content = $this->text_parsing->process_text($main_content);
        $content_chunks = $this->content_chunks_model->get_content($section_key, $content_item_key);

        foreach($content_chunks as &$content_chunk)
        {
            $content_chunk = $this->text_parsing->process_text($content_chunk);
        }

        $content_variables['content'] = $main_content;
        $content_variables['partials'] = $this->ems_tree->get_content_segments($section_key, $content_item_key);
        $content_variables['chunks'] = $content_chunks;
    }

    //--------------------------------------------------------------------


    /**
     * Load a specific view for a specific role
     *
     * @param $section_key
     * @param $content_variables
     * @param $previous_link
     * @param $next_link
     */

    private function load_role_view($section_key, $content_variables, $previous_link, $next_link)
    {
        return $this->load->view("content/partials/{$section_key}_layout",
            array(
                'content' => $content_variables,
                'previous_link' => $previous_link,
                'next_link' => $next_link,
            ), true);
    }

    //--------------------------------------------------------------------


    /**
     * Allows viewing data
     *
     * @param $section_key
     * @param $content_item_key
     * @param $section_id
     * @param $content_item_id
     * @return void
     */
    public function index($section_key, $content_item_key, $section_id, $content_item_id)
    {
        $this->load->library('ems/text_parsing');

        // Load content segments
        $content_variables = $this->get_content_variables($this->default_role, $section_key, $content_item_key);

        // << Previous link
        $previous_link = $this->ems_tree->get_previous_link($this->content_tree,
            $section_id, $content_item_key);
        $previous_node = $this->ems_tree->get_previous_link($this->content_tree,
            $section_id, $content_item_key, true);

        // Next >> link
        $next_link = $this->ems_tree->get_next_link($this->content_tree,
            $section_id, $content_item_key);
        $next_node = $this->ems_tree->get_next_link($this->content_tree,
            $section_id, $content_item_key, true);

        // Load role specific edit view
        $role_view = $this->load_role_view($section_key, $content_variables, $previous_link, $next_link);

        // Set variables
        Template::set('content_variables', $content_variables);
        Template::set('role_view', $role_view);
        Template::set('section', $section_key);
        Template::set('section_id', $section_id);
        Template::set('previous_link', $previous_link);
        Template::set('previous_node', $previous_node);
        Template::set('next_link', $next_link);
        Template::set('next_node', $next_node);
        Template::set('content_item_id', $content_item_id);

        // Render
        Template::render();
    }
}