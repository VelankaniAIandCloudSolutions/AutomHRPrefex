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
        if(isset($_POST) && !empty($_POST))
        {
            $this->save_transfer_entity($_POST);
        }   
        $staff_list = $this->staff_model->get();
        $this->db->select("branch_id as id, branch_name, branch_prefix");
        $this->db->from(db_prefix()."branches");
        $this->db->where("branch_status","0");
        $this->db->order_by("id","desc");
        $branch_query = $this->db->get(); 
        $branch_result = $branch_query->result_array();
        $departments = array();
        $departments = Entity_transfer::departments();
        $data['staff_list']    = $staff_list;
        $data['branch_list']    = $branch_result;
        $data['departments']    = $departments;
        $data['title']         = _l('entity_transfer');
        $this->load->view('admin/entity_transfer/add', $data);
    }

    function save_transfer_entity($post = array())
    {
        if(!empty($post))
        {
            $user_id = get_staff_user_id(); // user loggedin id
            $type_change = $this->input->post('type_of_change');
            $staff_members = $this->input->post('staff_members'); // employee id
            $branch_id = $this->input->post('branch_id');
            $prefix = $this->input->post('prefix');
            $new_employee_id = $this->input->post('new_employee_id');
            $department = $this->input->post('department');
            $job_position = $this->input->post('job_position');
            $reporting_to = $this->input->post('reporting_to');
            $effective_date = $this->input->post('effective_date');
            $location = $this->input->post('location');
            $business_unit = $this->input->post('business_unit');
            $division = $this->input->post('division');
            $id = array("staffid"   =>  $staff_members);
            $staff_data = $this->staff_model->get('',  $id);
            $prev_branch_id = '';
            $insert_data = array();
            $insert_data = array(
                "user_id"           =>  $user_id,
                "type_change"       =>  $type_change,
                "department_id"     =>  $department,
                "designation_id"    =>  $job_position,
                "report_to"         =>  $reporting_to,
                "effective_date"    =>  date("Y-m-d", strtotime($effective_date)),
                "location"          =>  $location,
                "division"          =>  $division,
                "business_unit"     =>  $business_unit,
                "branch_id"         =>  $branch_id,
                "prev_branch_id"     => $prev_branch_id,
                "employee_id"     =>  $prefix,
            );
        }
    }

    public function branch_location()
    {
        $branch_id = $this->input->post("branch_id");
        
        if($branch_id != "" )
        {
            $this->db->select("branch_id as id, branch_name, branch_prefix, address");
            $this->db->from(db_prefix()."branches");
            $this->db->where("branch_status","0");
            $this->db->where("branch_id",$branch_id);
            $this->db->order_by("id","desc");
            $branch_query = $this->db->get(); 
            $branch_result = $branch_query->result_array();

            if(!empty($branch_result))
            {
                foreach($branch_result as $val)
                {
                    $final_result =  $val;
                }
            }
            if(!empty($final_result))
            {
                echo json_encode($final_result);
            }
        }
    }

    public function staff_info()
    {
        $staff_id = $this->input->post("staff_id");
        
        if($staff_id != "" )
        {
            $final_result = array();
            $staff_list = $this->staff_model->get('', array("staffid" => $staff_id));
            if(!empty($staff_list))
            {
               
                foreach($staff_list as $val)
                {
                    $final_result =  $val;
                }
            }
            if(!empty($final_result))
            {
                echo json_encode($final_result);
            }
        }
        else{
            $return_val[] = 'No Records found';
            echo json_encode($return_val);
        }
    }

    public function digit_character_extract($string = '')
    {
        $characters = preg_replace("/[0-9]/", "", $string);
        $digits = preg_replace("/[^0-9]/", "", $string); 

        $final_result = array();
        $final_result = array(
            "character" => $characters,
            "digits" => $digits,
        );
        echo json_encode($final_result); 
    }

    public function departments()
    {
        $ajax_req = $this->input->is_ajax_request();

        $staff_id = $this->input->post("staff_id"); 
        $final_result = array();
        $department_id ='';
        if($staff_id != "")
        {
            $staff_department_list= array();
            $this->db->where("staffid", $staff_id);
            $staff_department_list = $this->db->get(db_prefix()."staff_departments")->result_array();
            if(!empty($staff_department_list))
            {
                foreach($staff_department_list  as $val)
                {
                    $department_id = $val['departmentid'];
                }
            }
        }
        if($department_id != "")
        {
            $department_list = $this->db->get_where(db_prefix()."departments", array("departmentid" => $department_id))->result_array();
        }

        if($staff_id == ""){
            $department_list = $this->db->get(db_prefix()."departments")->result_array();
        }

        if(!empty($department_list))
        {
            foreach($department_list as $val)
            {
                $final_result =  $val;
            }
        }

        if($ajax_req)
        {
            echo json_encode($final_result);
        }
        else{
            return $department_list;
        }
    }

    public function job_position()
    {
        $ajax_req = $this->input->is_ajax_request();

        $department_id = $this->input->post("department_id"); 
        $final_result = array();
        $position_list =  array();

        if($department_id != "")
        {   
            $position_list = $this->db->get_where(db_prefix()."hr_job_position", array("department_id" => $department_id))->result_array();
        }

        if(!empty($position_list))
        {
            $temp_result = array();
            foreach($position_list as $val)
            {
                $tmp_val = array();
                $tmp_val['id']  =  $val['position_id'];
                $tmp_val['position_name']  =  $val['position_name'];
                array_push($temp_result, $tmp_val);
            }
        }

        if($ajax_req)
        {
            echo json_encode($temp_result);
        }
        else{
            return $position_list;
        }
    }
}
