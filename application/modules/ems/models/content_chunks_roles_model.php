<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Content_Chunks_Roles_Model extends BF_Model
{
    /**
     * Name of the table
     *
     * @access protected
     *
     * @var string
     */
    protected $table_name = 'ems_content_chunks_roles';

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
    protected $soft_deletes = FALSE;

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
    protected $set_created = FALSE;

    /**
     * Set the modified time automatically on editing a record
     *
     * @access protected
     *
     * @var bool
     */
    protected $set_modified = FALSE;
}