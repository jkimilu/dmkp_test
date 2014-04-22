<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Content_Model extends BF_Model
{
    /**
     * Name of the table
     *
     * @access protected
     *
     * @var string
     */
    protected $table_name = 'ems_main_content';

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
        $content_item = $this->find_by(array(
            'role' => $role,
            'section' => $section_key,
            'slug' => $content_item_key,
        ));

        if($content_item)
            return $content_item->content;

        return "";
    }

    public function save_content($role, $section_key, $content_item_key, $content)
    {
        $language = lang('ems_tree');

        $content_item = $this->find_by(array(
            'role' => $role,
            'section' => $section_key,
            'slug' => $content_item_key,
        ));

        if($content_item)
        {
            $this->update(
                array('id' => $content_item->id),
                array(
                    'section' => $section_key,
                    'slug' => $content_item_key,
                    'content' => $content,
                )
            );

            return $content_item->id;
        }
        else
        {
            return $this->insert(
                array(
                    'title' => $language[$content_item_key],
                    'role' => $role,
                    'section' => $section_key,
                    'slug' => $content_item_key,
                    'content' => $content,
                )
            );
        }
    }
}