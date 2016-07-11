<?php
class Sub_Content_Chunks_Model extends BF_Model
{
    /**
     * Name of the table
     *
     * @access protected
     *
     * @var string
     */
    protected $table_name = 'ems_sub_content_chunks';

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
     * @param $sectionId
     * @param $contentItemId
     * @param $contentIndex
     * @return null $content
     * @internal param $role
     */
    public function get_content($section_key, $content_item_key, $sectionId, $contentItemId, $contentIndex)
    {
        $this->load->library('ems/ems_tree');
        $content_segments = $this->ems_tree->get_sub_content_segments();

        $content_chunks = array();

        foreach($content_segments[$sectionId][$contentItemId + 1] as $segment)
        {
            $content_item = $this->find_by(array(
                'section' => $section_key,
                'sub_section' => $content_item_key,
                'slug' => $segment,
                'sub_content_index' => $contentIndex,
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
     * @param $contentIndex
     * @param $content
     */

    public function save_content($content_id, $section_key, $content_item_key, $contentIndex, $content)
    {
        $language = lang('ems_tree');

        foreach($content as $content_chunk_key => $content_chunk_value)
        {
            $content_item = $this->find_by(array(
                'content_id' => $content_id,
                'section' => $section_key,
                'sub_section' => $content_item_key,
                'slug' => $content_chunk_key,
                'sub_content_index' => $contentIndex,
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
                        'sub_content_index' => $contentIndex,
                    )
                );
            }
        }
    }
}