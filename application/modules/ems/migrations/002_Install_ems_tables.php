<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_ems_tables extends Migration
{
    const table_ems_main_content = "ems_main_content";
    const table_ems_content_chunks = "ems_content_chunks";

    /**
     * Abstract method ran when increasing the schema version. Typically installs
     * new data to the database or creates new tables.
     *
     * @access public
     */
    public function up()
    {
        $main_content = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'null' => false,
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
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
            'date_published' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'date_modified' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
        );

        if ( ! $this->db->table_exists(self::table_ems_main_content))
        {
            $this->dbforge->add_field($main_content);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_main_content);
        }

        $content_chunks = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'null' => false,
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
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
            'date_published' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'date_modified' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
        );

        if ( ! $this->db->table_exists(self::table_ems_content_chunks))
        {
            $this->dbforge->add_field($content_chunks);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_content_chunks);
        }
    }

    /**
     * Abstract method ran when decreasing the schema version.
     *
     * @access public
     */
    public function down()
    {
        $this->dbforge->drop_table(self::table_ems_main_content);
        $this->dbforge->drop_table(self::table_ems_content_chunks);
    }
}