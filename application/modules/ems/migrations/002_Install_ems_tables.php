<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_ems_tables extends Migration
{
    const table_ems_main_content = "ems_main_content";
    const table_ems_main_content_roles = "ems_main_content_roles";
    const table_ems_content_chunks = "ems_content_chunks";
    const table_ems_content_chunks_roles = "ems_content_chunks_roles";
    const table_ems_content_popups = "ems_content_popups";
    const table_ems_content_abbreviations = "ems_content_abbreviations";
    const table_ems_content_definitions = "ems_content_definitions";

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
            'created_on' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'modified_on' => array(
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

        // Content chunks

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

        if ( ! $this->db->table_exists(self::table_ems_content_chunks))
        {
            $this->dbforge->add_field($content_chunks);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_content_chunks);
        }

        // Role paragraph views settings

        $role_paragraph_view = array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 11,
                'auto_increment' => true,
                'null' => false,
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'section_key' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'content_item_key' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'paragraph_index' => array(
                'type' => 'INT',
                'null' => false,
            ),
            'permission' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
        );

        if ( ! $this->db->table_exists(self::table_ems_main_content_roles))
        {
            $this->dbforge->add_field($role_paragraph_view);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_main_content_roles);
        }

        // Role chunks

        $role_chunks_paragraph_view = array(
            'id' => array(
                'type' => 'BIGINT',
                'constraint' => 11,
                'auto_increment' => true,
                'null' => false,
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'section_key' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'content_item_key' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'chunk' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
            'paragraph_index' => array(
                'type' => 'INT',
                'null' => false,
            ),
            'permission' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ),
        );

        if ( ! $this->db->table_exists(self::table_ems_content_chunks_roles))
        {
            $this->dbforge->add_field($role_chunks_paragraph_view);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_content_chunks_roles);
        }

        // Popups

        $content_popups = array(
            'id' => array(
                'type' => 'BIGINT',
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
            'popup_content' => array(
                'type' => 'TEXT',
                'null' => false,
            ),
            'permission' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
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

        if ( ! $this->db->table_exists(self::table_ems_content_popups))
        {
            $this->dbforge->add_field($content_popups);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_content_popups);
        }

        // Abbreviations

        $abbreviations = array(
            'id' => array(
                'type' => 'BIGINT',
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
            'content' => array(
                'type' => 'TEXT',
                'null' => false,
            ),
            'permission' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
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

        if ( ! $this->db->table_exists(self::table_ems_content_abbreviations))
        {
            $this->dbforge->add_field($abbreviations);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_content_abbreviations);
        }

        // Definitions

        $definitions = array(
            'id' => array(
                'type' => 'BIGINT',
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
            'content' => array(
                'type' => 'TEXT',
                'null' => false,
            ),
            'permission' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
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

        if ( ! $this->db->table_exists(self::table_ems_content_definitions))
        {
            $this->dbforge->add_field($definitions);
            $this->dbforge->add_key('id', true);
            $this->dbforge->create_table(self::table_ems_content_definitions);
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
        $this->dbforge->drop_table(self::table_ems_main_content_roles);
        $this->dbforge->drop_table(self::table_ems_content_chunks_roles);
        $this->dbforge->drop_table(self::table_ems_content_popups);
        $this->dbforge->drop_table(self::table_ems_content_abbreviations);
        $this->dbforge->drop_table(self::table_ems_content_definitions);
    }
}