<?php
class Content_Chunks_Model extends BF_Model
{
    /**
     * Name of the table
     *
     * @access protected
     *
     * @var string
     */
    protected $table_name = 'dms_content_chunks';

    /**
     * Name of the primary key
     *
     * @access protected
     *
     * @var string
     */
    protected $key = 'id';

    /**
     * Use soft deletes or not
     *
     * @access protected
     *
     * @var bool
     */
    protected $soft_deletes = TRUE;

    /**
     * The date format to use
     *
     * @access protected
     *
     * @var string
     */
    protected $date_format = 'datetime';

    /**
     * Set the created time automatically on a new record
     *
     * @access protected
     *
     * @var bool
     */
    protected $set_created = TRUE;

    /**
     * Set the modified time automatically on editing a record
     *
     * @access protected
     *
     * @var bool
     */
    protected $set_modified = TRUE;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ems/content_chunks_roles_model', 'chunks_roles_model');
    }

    /**
     * Get content from the DB
     *
     * @param $section_key
     * @param $content_item_key
     * @internal param $role
     * @return null $content
     */
    public function get_content($section_key, $content_item_key)
    {
        $this->load->library('dms/dms_tree');
        $content_segments = $this->dms_tree->get_content_segments($section_key, $content_item_key);

        $content_chunks = array();

        foreach($content_segments as $segment)
        {
            $content_item = $this->find_by(array(
                'section' => $section_key,
                'sub_section' => $content_item_key,
                'slug' => $segment,
            ));

            if($content_item)
            {
                $content_chunks[$segment] = $content_item->content;
            }
            else
            {
                $content_chunks[$segment] = "";
            }
        }

        return $content_chunks;
    }

    /**
     * Save content
     *
     * @param $content_id
     * @param $section_key
     * @param $content_item_key
     * @param $content
     */

    public function save_content($content_id, $section_key, $content_item_key, $content)
    {
        $language = lang('ems_tree');

        foreach($content as $content_chunk_key => $content_chunk_value)
        {
            $content_item = $this->find_by(array(
                'content_id' => $content_id,
                'section' => $section_key,
                'sub_section' => $content_item_key,
                'slug' => $content_chunk_key,
            ));

            if($content_item)
            {
                $this->update(
                    array('id' => $content_item->id),
                    array(
                        'content' => $content_chunk_value,
                    )
                );
            }
            else
            {
                $this->insert(
                    array(
                        'title' => $language[$content_chunk_key],
                        'content_id' => $content_id,
                        'section' => $section_key,
                        'sub_section' => $content_item_key,
                        'slug' => $content_chunk_key,
                        'content' => $content_chunk_value,
                    )
                );
            }
        }
    }

    public function save_role_visibility($section_key, $content_item_key, $chunk, $role, $role_visibility, $segment)
    {
        $chunk_role = $this->chunks_roles_model->find_by(array(
            'role' => $role,
            'section_key' => $section_key,
            'content_item_key' => $content_item_key,
            'chunk' => $chunk,
            'paragraph_index' => $segment,
        ));

        if($chunk_role)
        {
            $this->chunks_roles_model->update(array(
                'role' => $role,
                'section_key' => $section_key,
                'content_item_key' => $content_item_key,
                'chunk' => $chunk,
                'paragraph_index' => $segment,
            ), array(
                'permission' => $role_visibility,
            ));
        }
        else
        {
            $this->chunks_roles_model->insert(array(
                'role' => $role,
                'section_key' => $section_key,
                'content_item_key' => $content_item_key,
                'chunk' => $chunk,
                'paragraph_index' => $segment,
                'permission' => $role_visibility,
            ));
        }
    }
}