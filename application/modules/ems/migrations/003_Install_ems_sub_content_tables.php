<?php

/**
 * Created by Ahmed Maawy
 * User: ultimateprogramer
 * Date: 6/28/16
 * Time: 10:52 AM
 */
class Migration_Install_ems_sub_content_tables extends Migration
{

    const table_ems_sub_content = "ems_sub_content";

    /**
     * Abstract method ran when increasing the schema version. Typically installs
     * new data to the database or creates new tables.
     *
     * @access public
     */
    public function up()
    {
        $sub_content = array(
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

        if ( ! $this->db->table_exists(self::table_ems_sub_content))
        {
            $this->dbforge->add_field($sub_content);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_sub_content);
        }
    }

    /**
     * Abstract method ran when decreasing the schema version.
     *
     * @access public
     */
    public function down()
    {
        $this->dbforge->drop_table(self::table_ems_sub_content);
    }
}