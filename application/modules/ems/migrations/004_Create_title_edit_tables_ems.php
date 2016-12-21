<?php

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 7/5/16
 * Time: 2:00 PM
 */
class Migration_create_title_edit_tables_ems extends Migration
{
    private $permission_values = array(
        array(
            'name' => 'EMS.Content.SuperAdmin',
            'description' => 'EMS Super Admin Privileges',
            'status' => 'active',
        )
    );

    private $new_content_field = array(
        'edited_title' => array(
            'type' => 'VARCHAR',
            'constraint' => 150,
            'null' => true,
        )
    );

    private $permissions_table_name = 'permissions';
    private $roles_table_name = 'role_permissions';
    private $content_table = 'ems_main_content';
    private $sub_content_table = 'ems_sub_content';

    /**
     * Abstract method ran when increasing the schema version. Typically installs
     * new data to the database or creates new tables.
     *
     * @access public
     */
    public function up() {
        // Install permissions
        $role_permissions_data = array();

        foreach ($this->permission_values as $permission_value)
        {
            $this->db->insert($this->permissions_table_name, $permission_value);

            $role_permissions_data[] = array(
                'role_id' => '1',
                'permission_id' => $this->db->insert_id(),
            );
        }

        $this->db->insert_batch($this->roles_table_name, $role_permissions_data);

        // Modify content tables
        if (!$this->db->field_exists('edited_title', $this->content_table))
        {
            $this->dbforge->add_column($this->content_table, $this->new_content_field);
        }

        if (!$this->db->field_exists('edited_title', $this->sub_content_table))
        {
            $this->dbforge->add_column($this->sub_content_table, $this->new_content_field);
        }
    }

    /**
     * Abstract method ran when decreasing the schema version.
     *
     * @access public
     */
    public function down()
    {
        // Remove permissions
        foreach ($this->permission_values as $permission_value)
        {
            $query = $this->db->select('permission_id')
                ->get_where($this->permissions_table_name, array('name' => $permission_value['name'],));

            foreach ($query->result() as $row)
            {
                $this->db->delete($this->permissions_table_name, array('permission_id' => $row->permission_id));
            }

            $this->db->delete($this->permissions_table_name, array('name' => $permission_value['name']));
        }

        // Drop added columns
        foreach ($this->new_content_field as $column_name => $column_def)
        {
            if ($this->db->field_exists($column_name, $this->content_table))
            {
                $this->dbforge->drop_column($this->content_table, $column_name);
            }

            if ($this->db->field_exists($column_name, $this->sub_content_table))
            {
                $this->dbforge->drop_column($this->sub_content_table, $column_name);
            }
        }
    }
}