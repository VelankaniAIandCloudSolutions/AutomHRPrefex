<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Databasequeryexecution extends AdminController
{
    /* List all staff members */
    public function add_column_to_tables($table = '', $column_name = '', $data_type = '', $column_length = '', $default_value = '')
    {
        $this->load->database();

        // Set parameters for the new column
        $column_name = 'branch_id';
        $data_type = 'enum("1")';
        $default_value = "1";

        // Get the list of tables
        $table_list = $this->get_table_list();
        if (!empty($table_list)) {
            foreach ($table_list as $table) {
                if ($table !== 'tblbranches') {
                    $sql = "ALTER TABLE $table ADD COLUMN $column_name $data_type";

                    if ($data_type == 'VARCHAR' || $data_type == 'CHAR') {
                        $sql .= "($column_length)";
                    }

                    $sql .= " DEFAULT $default_value";

                    // Execute the ALTER TABLE statement
                    $this->db->query($sql);
                }
            }
        }
    }


    public function get_table_list()
    {
        // Load the database library (if not already loaded)
        $this->load->database();

        // Get the database name
        $database_name = $this->db->database;

        // Get the list of tables
        $tables = $this->db->list_tables($database_name);
        return $tables;
    }
}
