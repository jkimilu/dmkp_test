<?php

/**
 * Created by Ahmed Maawy.
 * User: ultimateprogramer
 * Date: 7/11/16
 * Time: 2:31 PM
 */
class Migration_Create_sub_content_chunks extends Migration
{

    const table_ems_sub_content_chunks = "ems_sub_content_chunks";

    /**
     * Abstract method ran when increasing the schema version. Typically installs
     * new data to the database or creates new tables.
     *
     * @access public
     */
    public function up()
    {
        $content_chunks = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'null' => false,
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'content_id' => array(
                'type' => 'INT',
                'null' => false,
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'section' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'sub_content_index' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ),
            'sub_section' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'content' => array(
                'type' => 'TEXT',
                'null' => true,
            ),
            'deleted' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
            ),
            'created_on' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'modified_on' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
        );

        if ( ! $this->db->table_exists(self::table_ems_sub_content_chunks))
        {
            $this->dbforge->add_field($content_chunks);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_sub_content_chunks);
        }
    }

    /**
     * Abstract method ran when decreasing the schema version.
     *
     * @access public
     */
    public function down()
    {
        $this->dbforge->drop_table(self::table_ems_sub_content_chunks);
    }
}