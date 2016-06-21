<?php

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/21/16
 * Time: 4:28 PM
 */
class ResourceMigrations extends Migration
{
    protected $resourcesTableName = null;

    public function __construct($resourcesTableName) {
        $this->resourcesTableName = $resourcesTableName;
    }

    /**
     * Abstract method ran when increasing the schema version. Typically installs
     * new data to the database or creates new tables.
     *
     * @access public
     */
    public function up() {
        if($this->resourcesTableName != null) {
            $main_content = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                    'null' => false,
                ),
                'fields' => array(
                    'type' => 'TEXT',
                    'null' => false,
                ),
                'category' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 20,
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

            if ( ! $this->db->table_exists($this->resourcesTableName))
            {
                $this->dbforge->add_field($main_content);
                $this->dbforge->add_key('id', true);
                $this->dbforge->create_table($this->resourcesTableName);
            }
        }
    }

    /**
     * Abstract method ran when decreasing the schema version.
     *
     * @access public
     */
    public function down() {
        if($this->resourcesTableName != null) {
            $this->dbforge->drop_table($this->resourcesTableName);
        }
    }
}