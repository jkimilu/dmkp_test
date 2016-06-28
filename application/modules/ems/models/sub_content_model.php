<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sub_Content_Model extends BF_Model
{
    /**
     * Name of the table
     *
     * @access protected
     *
     * @var string
     */
    protected $table_name = 'ems_sub_content';

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

    public function __construct()
    {
        parent::__construct();

        $this->load->model('ems/main_content_roles_model', 'content_roles_model');
    }

    /**
     * Get content from the DB
     *
     * @param $section_key
     * @param $content_item_key
     * @param $sub_content_index
     * @return null $content
     * @internal param $role
     */
    public function get_content($section_key, $content_item_key, $sub_content_index)
    {
        $content_item = $this->find_by(array(
            'section' => $section_key,
            'slug' => $content_item_key,
            'sub_content_index' => $sub_content_index,
        ));

        if($content_item)
            return $content_item->content;

        return "";
    }

    /**
     * Save content item
     *
     * @param $section_key
     * @param $content_item_key
     * @param $sub_content_index
     * @param $content
     * @return bool|mixed
     */

    public function save_content($section_key, $content_item_key, $sub_content_index, $content)
    {
        $language = lang('ems_tree');

        $content_item = $this->find_by(array(
            'section' => $section_key,
            'slug' => $content_item_key,
            'sub_content_index' => $sub_content_index,
        ));

        if($content_item)
        {
            $this->update(
                array('id' => $content_item->id),
                array(
                    'section' => $section_key,
                    'slug' => $content_item_key,
                    'content' => $content,
                    'sub_content_index' => $sub_content_index,
                )
            );

            return $content_item->id;
        }
        else
        {
            return $this->insert(
                array(
                    'title' => $language[$content_item_key],
                    'section' => $section_key,
                    'slug' => $content_item_key,
                    'sub_content_index' => $sub_content_index,
                    'content' => $content,
                )
            );
        }
    }
    
    public function search($keyword, $limit, $start)
    {
        $this->select("*, ems_main_content.slug as `content_slug`,
            ems_main_content.section as `content_section`, ems_main_content.title as `content_title`,
            ems_main_content.content as `main_content`, ems_content_chunks.content as `chunk_content`");
        $this->limit($limit, $start);
        $this->like('ems_content_chunks.content', $keyword);
        $this->or_like('ems_main_content.content', $keyword);
        $this->join('ems_content_chunks', 'ems_content_chunks.content_id = ems_main_content.id', 'left outer');
        $this->group_by('ems_main_content.id');

        return $this->find_all();
    }

    public function search_count($keyword)
    {
        $this->select("*, ems_main_content.slug as `content_slug`,
            ems_main_content.section as `content_section`, ems_main_content.title as `content_title`,
            ems_main_content.content as `main_content`, ems_content_chunks.content as `chunk_content`");
        $this->like('ems_content_chunks.content', $keyword);
        $this->or_like('ems_main_content.content', $keyword);
        $this->join('ems_content_chunks', 'ems_content_chunks.content_id = ems_main_content.id', 'left outer');
        $this->group_by('ems_main_content.id');

        $rows = $this->find_all();

        if($rows)
            return count($rows);
        else
            return 0;
    }
}