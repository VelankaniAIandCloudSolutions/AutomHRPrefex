<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends App_Controller
{
    public function index($key = '')
    {
        update_option('cron_has_run_from_cli', 1);

        if (defined('APP_CRON_KEY') && (APP_CRON_KEY != $key)) {
            header('HTTP/1.0 401 Unauthorized');
            die('Passed cron job key is not correct. The cron job key should be the same like the one defined in APP_CRON_KEY constant.');
        }

        $last_cron_run                  = get_option('last_cron_run');
        $seconds = hooks()->apply_filters('cron_functions_execute_seconds', 300);

        if ($last_cron_run == '' || (time() > ($last_cron_run + $seconds))) {
            $this->load->model('cron_model');
            $this->cron_model->run();
        }
    }

    public function birthday_wishing()
    {
        ini_set("memory_limit", "-1");
        set_time_limit(0);

        $this->db->select("staffid, email");
        $this->db->from(db_prefix() . 'staff');
        $this->db->where("DATE_FORMAT(birthday,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
        $query = $this->db->get();
        $results = $query->result_array();

        if(!empty($results))
        {
            foreach($results as $results_val)
            {
                $staff_id = '';
                $staff_id = $results_val['staffid'];
                send_mail_template('birthday', $results_val['email'], $staff_id);
            }
        }
    }

    public function anniversary_wishing()
    {
        ini_set("memory_limit", "-1");
        set_time_limit(0);

        $this->db->select("staffid, email");
        $this->db->from(db_prefix() . 'staff');
        $this->db->where("DATE_FORMAT(datecreated,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
        $query = $this->db->get();
        $results = $query->result_array();

        if(!empty($results))
        {
            foreach($results as $results_val)
            {
                $staff_id = '';
                $staff_id = $results_val['staffid'];
                send_mail_template('anniversery', $results_val['email'], $staff_id);
            }
        }
    }
}
