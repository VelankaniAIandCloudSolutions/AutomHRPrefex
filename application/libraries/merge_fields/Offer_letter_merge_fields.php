<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Offer_letter_merge_fields extends App_merge_fields
{
    public function build()
    {
        $fields = array("offer_letter_date", 
        "candidate_name", 
        "candidate_address_1",
        "candidate_address_2",
        "candidate_city",
        "candidate_state",
        "candidate_pin_code",
        "candidate_country",
        "candidate_title",
        "company_name",
        "job_role",
        "annual_ctc",
        "monthly_breakup_ctc",
        "reporting_manager_title",
        "reporting_manager_name",
        "shift_timing",
        "joining_date",
        "last_date_of_offer_acceptance",
        "name_of_person_to_reporting_on_start_date",
        "name_of_person_authorized_to_make_offer",
        "name_of_person_authorized_position",
        "company_logo"
        );

        $array_data = array();
        if(!empty($fields))
        {
           
            foreach($fields as $key => $val)
            {
                $tmp_array = array();
                $tmp_array =  array(
                            'name' => _l($val),
                            'key' => '{'.$val.'}',
                            'available' => [],
                            'templates' => [
                                'offer_letter',
                            ],
                        );
                array_push($array_data, $tmp_array);
            }
        }
        return $array_data;
    }

    /**
     * Merge fields for tasks
     * @return array
     */
    // public function format($candidate_id)
    // {
    //     $fields = [];
        
    //     $this->ci->db->where('candidate_id', $candidate_id);
    //     $this->ci->db->order_by("id","desc");
    //     $this->ci->db->limit(1);
    //     $salary_breakup = $this->ci->db->get(db_prefix().'candidate_salary_breakup')->row();

    //     $tmp_fields = array(
    //         "offer_letter_date",
    //         "candidate_name",
    //         "candidate_address_1",
    //         "candidate_address_2",
    //         "candidate_city",
    //         "candidate_state",
    //         "candidate_pin_code",
    //         "candidate_country",
    //         "candidate_title",
    //         "company_name",
    //         "job_role",
    //         "annual_ctc",
    //         "monthly_breakup_ctc",
    //         "reporting_manager_title",
    //         "reporting_manager_name",
    //         "shift_timing",
    //         "joining_date",
    //         "last_date_of_offer_acceptance",
    //         "name_of_person_to_reporting_on_start_date",
    //         "name_of_person_authorized_to_make_offer",
    //         "name_of_person_authorized_position",
    //         "company_logo"
    //     );
        
    //     foreach ($tmp_fields as $key => $val) {
    //         $fields["{".$val."}"] = '';
    //     }

    //     // if (!$candidate_id) {
    //     //     return $candidate_id;
    //     // }

    //     // $fields['{job_role}']               = $salary_breakup->annual_ctc;
    //     // $fields['{annual_ctc}']             = $salary_breakup->annual_ctc;
    //     // $fields['{monthly_breakup_ctc}']    = $salary_breakup;

    //     return hooks()->apply_filters('offer_letter_merge_fields', $fields, [
    //         'candidate_id'    => $candidate_id,
    //         'salary_breakup' => $salary_breakup
    //      ]);
    // }
}
