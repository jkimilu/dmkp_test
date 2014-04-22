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
    protected $table_name = 'ems_content_chunks';

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
    protected $set_modified = FALSE;

    /**
     * Get content from the DB
     *
     * @param $role
     * @param $section_key
     * @param $content_item_key
     * @return null $content
     */
    public function get_content($role, $section_key, $content_item_key)
    {
        $this->load->library('ems/ems_tree');
        $content_segments = $this->ems_tree->get_content_segments($section_key);

        $content_chunks = array();

        foreach($content_segments as $segment)
        {
            $content_item = $this->find_by(array(
                'role' => $role,
                'section' => $section_key,
                'slug' => $content_item_key,
                'content_id' => $segment,
            ));

            if($content_item)
            {
                $content_chunks[$segment] = $content_item->content;
            }
            else
            {
                $content_item[$segment] = "";
            }
        }

        return $content_chunks;
    }

    public function save_content($role, $section_key, $content_item_key, $content)
    {
        foreach($content as $content_chunk_key => $content_chunk_value)
        {
            $content_item = $this->find_by(array(
                'content_id' => $content_chunk_key,
                'role' => $role,
                'section' => $section_key,
                'slug' => $content_item_key,
            ));

            if($content_item)
            {
                $this->update(
                    array('id' => $content_item->id),
                    array(
                        'section_key' => $section_key,
                        'content_item_key' => $content_item_key,
                        'content' => $content,
                    )
                );
            }
            else
            {
                $this->insert(
                    array(
                        'content_id' => $content_chunk_key,
                        'section_key' => $section_key,
                        'content_item_key' => $content_item_key,
                        'content' => $content,
                    )
                );
            }
        }
    }
}