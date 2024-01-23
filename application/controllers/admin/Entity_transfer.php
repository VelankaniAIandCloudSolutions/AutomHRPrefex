<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Entity_transfer extends AdminController
{
    /* List all staff members */
    public function index()
    {
        if (!has_permission('entity_transfer', '', 'list')) {
            access_denied('entity_transfer');
        }
        $data['title']         = _l('entity_transfer');
        $this->load->view('admin/entity_transfer/list', $data);
    }

    public function list()
    {
        // Parameters sent by DataTables
        $start = 0;
        $length = 10;
        $search = '';
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];

        // Count the total number of rows before applying limit and search filter
        $this->db->select('COUNT(*) as total');
        $this->db->from(db_prefix() . "transfer_history as th");
        $this->db->join(db_prefix() . "staff as staff", "staff.staffid = th.user_id", "inner");
        $this->db->where("th.status", "0");

        if ($search !== "") {
            $this->db->group_start();
            $this->db->like("staff.firstname", $search, "both");
            $this->db->or_like("staff.middlename", $search, "both");
            $this->db->or_like("staff.lastname", $search, "both");
            $this->db->group_end();
        }

        // $totalCountQuery = clone $this->db;
        $totalCount = $this->db->get()->row()->total;

        // Fetch the actual data with limit and search filter
        $this->db->select("th.*, staff.*, staff.staffid as staff_id, previos_branches.branch_prefix as previous_branch_prefix, new_branches.branch_prefix as new_branch_prefix,
            departments.name as department_name, hr_job_position.position_name, manager.firstname as manager_firstname,
            manager.middlename as manager_middlename,
            manager.lastname as manager_lastname");
        $this->db->from(db_prefix() . "transfer_history as th");
        $this->db->join(db_prefix() . "staff as staff", "staff.staffid = th.user_id", "inner");
        $this->db->join(db_prefix() . "branches as previos_branches", "previos_branches.branch_id = th.prev_branch_id", "left");
        $this->db->join(db_prefix() . "branches as new_branches", "new_branches.branch_id = th.branch_id", "left");
        $this->db->join(db_prefix() . "departments as departments", "departments.departmentid = th.department_id", "left");
        $this->db->join(db_prefix() . "hr_job_position as hr_job_position", "hr_job_position.position_id = th.designation_id", "left");
        $this->db->join(db_prefix() . "staff as manager", "manager.staffid = th.report_to", "left");
        $this->db->where("th.status", "0");

        if ($search !== "") {
            $this->db->group_start();
            $this->db->like("staff.firstname", $search, "both");
            $this->db->or_like("staff.middlename", $search, "both");
            $this->db->or_like("staff.lastname", $search, "both");
            $this->db->group_end();
        }

        $this->db->limit($length, $start);

        $query = $this->db->get();


        $response = $query->result_array();

        $final_data = array();

        if (!empty($response)) {
            foreach ($response as $key => $response_val) {
                $staff_name = $type_change = $effective_date = $manager_name = '';
                if ($response_val["firstname"] != "") {
                    $staff_name .= $response_val["firstname"];
                }
                if ($response_val["middlename"] != "") {
                    $staff_name .= ' ' . $response_val["middlename"];
                }
                if ($response_val["lastname"] != "") {
                    $staff_name .= ' ' . $response_val["lastname"];
                }

                $type_change = $response_val['type_change'];
                $effective_date = date("d-m-Y", strtotime($response_val['effective_date']));
                $previous_emp_code = $response_val['previous_branch_prefix'] . $response_val['prev_employee_id'];

                // Create an associative array for each row
                $row_data = array(
                    "s_no" => $key +1,
                    "staff_name" => $staff_name,
                    "type_change" => $type_change,
                    "effective_date" => $effective_date,
                    "previous_emp_code" => $previous_emp_code,
                    "new_emp_code" => $response_val['new_branch_prefix'] . $response_val['new_employee_id'],
                    "department_name" => $response_val['department_name'] ? $response_val['department_name'] : "",
                    "position_name" => $response_val['position_name'] ? $response_val['position_name'] :"",
                    "manager_name" => $response_val['manager_firstname'] . ' ' . $response_val['manager_middlename'] . ' ' . $response_val['manager_lastname'],
                );

                $final_data[] = $row_data;
            }
        }
        echo json_encode(array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $totalCount,
            'data' => $final_data
        ));
    }

    public function add()
    {
        $staff_list = $this->staff_model->get();
        $this->db->select("branch_id as id, branch_name, branch_prefix");
        $this->db->from(db_prefix()."branches");
        $this->db->where("branch_status","0");
        $this->db->order_by("id","desc");
        $branch_query = $this->db->get(); 
        $branch_result = $branch_query->result_array();

        $data['staff_list']    = $staff_list;
        $data['branch_list']    = $branch_result;
        $data['title']         = _l('entity_transfer');
        $this->load->view('admin/entity_transfer/add', $data);
    }
}
