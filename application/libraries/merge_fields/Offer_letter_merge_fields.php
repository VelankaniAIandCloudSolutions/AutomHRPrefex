<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Offer_letter_merge_fields extends App_merge_fields
{
    public function build()
    {
        return [
            [
                'name' => _l('job_role'),
                'key' => '{job_role}',
                'available' => [],
                'templates' => [
                    'offer_letter',
                ],
            ],
            [
                'name' => _l('annual_ctc'),
                'key' => '{annual_ctc}',
                'available' => [],
                'templates' => [
                    'offer_letter',
                ],
            ],
            [
                'name' => _l('monthly_breakup_ctc'),
                'key' => '{monthly_breakup_ctc}',
                'available' => [],
                'templates' => [
                    'offer_letter',
                ],
            ],
        ];
    }

    /**
     * Merge fields for tasks
     * @return array
     */
    public function format($candidate_id)
    {
        $fields = [];
        
        $this->ci->db->where('candidate_id', $candidate_id);
        $this->ci->db->order_by("id","desc");
        $this->ci->db->limit(1);
        $salary_breakup = $this->ci->db->get(db_prefix().'candidate_salary_breakup')->row();




        $fields['{job_role}']               = '';
        $fields['{annual_ctc}']             = '';
        $fields['{monthly_breakup_ctc}']    = '';

        if (!$candidate_id) {
            return $candidate_id;
        }

        $fields['{job_role}']               = $salary_breakup->annual_ctc;
        $fields['{annual_ctc}']             = $salary_breakup->annual_ctc;
        $fields['{monthly_breakup_ctc}']    = $salary_breakup;

        return hooks()->apply_filters('offer_letter_merge_fields', $fields, [
            'candidate_id'    => $candidate_id,
            'salary_breakup' => $salary_breakup
         ]);
    }
}
