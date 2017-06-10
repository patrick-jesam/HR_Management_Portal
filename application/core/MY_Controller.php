<?php

session_start();

/**
 * Description of MY_Controller
 *
 * @author Trescoder
 */
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('admin_model');
        $this->load->model('global_model');


        $lang = $this->session->userdata("lang") == null ? "english" : $this->session->userdata("lang");
        $this->lang->load($lang, $lang);

        $uri1 = $this->uri->segment(1);
        $uri2 = $this->uri->segment(2);
        $uri3 = $this->uri->segment(3);
        if ($uri3) {
            $uri3 = '/' . $uri3;
        }
        $uriSegment = $uri1 . '/' . $uri2 . $uri3;
        $menu_uri['menu_active_id'] = $this->admin_model->select_menu_by_uri($uriSegment);
        $menu_uri['menu_active_id'] == false || $this->session->set_userdata($menu_uri);

// Login check
        $exception_uris = array(
            'login',
            'login/index/1',
            'login/index/2',
            'login/logout'
        );        
        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if ($this->login_model->loggedin() == FALSE) {
                redirect('login');
            }
        }

        // check notififation status by where
        $where = array('notify_me' => '1', 'view_status' => '2');
        // check email notification status
        $this->admin_model->_table_name = 'tbl_inbox';
        $this->admin_model->_order_by = 'inbox_id';
        $data['total_email_notification'] = count($this->admin_model->get_by($where, FALSE));
        $data['email_notification'] = $this->admin_model->get_by($where, FALSE);

        // check notice notification status
        $this->admin_model->_table_name = 'tbl_notice';
        $this->admin_model->_order_by = 'notice_id';
        $data['total_notice_notification'] = count($this->admin_model->get_by($where, FALSE));

        $data['notice_notification'] = $this->admin_model->get_by($where, FALSE);

        // check leave notification status
        $this->admin_model->_table_name = 'tbl_application_list';
        $this->admin_model->_order_by = 'application_list_id';
        $data['total_leave_notifation'] = count($this->admin_model->get_by($where, FALSE));
        $data['leave_notification'] = $this->admin_model->get_emp_leave_info();

        // check leave notification status
        $this->admin_model->_table_name = 'tbl_clock_history';
        $this->admin_model->_order_by = 'clock_history_id';
        $data['total_time_change_request'] = count($this->admin_model->get_by($where, FALSE));
        $data['time_change_request'] = $this->admin_model->get_time_change_request();
        // set all data into session 
        $_SESSION['notify'] = $data;

        // get all general settings info
        $this->admin_model->_table_name = "tbl_gsettings"; //table name
        $this->admin_model->_order_by = "id_gsettings";
        $info['genaral_info'] = $this->admin_model->get();

        date_default_timezone_set($info['genaral_info'][0]->timezone_name);

        $this->session->set_userdata($info);

        // get all attendance by date        
        $this->admin_model->_table_name = 'tbl_employee';
        $this->admin_model->_order_by = 'employee_id';
        $all_employee_info = $this->admin_model->get_by(array('status' => '1'), FALSE);
        foreach ($all_employee_info as $v_employee) {
//             set timezone to user timezone

            $date = date('Y-m-d', time());

            // get office houre info
            $this->admin_model->_table_name = 'tbl_working_hours';
            $this->admin_model->_order_by = 'working_hours_id';
            $working_hours_info = $this->admin_model->get_by(array('working_hours_id' => '1'), TRUE);
            if (!empty($working_hours_info)) {
                // get all attendance by date        
                $this->admin_model->_table_name = 'tbl_attendance';
                $this->admin_model->_order_by = 'attendance_id';
                $all_attendance_info = $this->admin_model->get_by(array('employee_id' => $v_employee->employee_id, 'date_in' => $date), FALSE);
                // get working holliday
                $holidays = $this->global_model->get_holidays(); //tbl working Days Holiday            
                $day_name = date("l", strtotime(date('Y-m-d')));

                if (!empty($holidays)) {
                    foreach ($holidays as $v_holiday) {
                        if ($v_holiday->day == $day_name) {
                            $yes_holiday[] = $day_name;
                        }
                    }
                }

                // get public holiday
                $public_holiday = $this->admin_model->check_by(array('start_date' => date('Y-m-d')), 'tbl_holiday');

                // auto update data after office hourse start +3 hourse
                $start_time = $working_hours_info->start_hours;
                $reload_time = strtotime("+3 hours", strtotime($start_time));
                $reload_time = date("H:i:s", $reload_time);
                $now = date('H:i:00', time());

                if (empty($public_holiday) || empty($yes_holiday)) {

                    if ($reload_time <= $now) {

                        if (!empty($all_attendance_info)) {
                            
                        } else {
                            // get leave info
                            $atdnc_data['employee_id'] = $v_employee->employee_id;
                            $atdnc_data['date_in'] = $date;
                            $atdnc_data['date_out'] = $date;
                            $atdnc_data['attendance_status'] = 0;
                            $this->admin_model->_table_name = 'tbl_attendance';
                            $this->admin_model->_primary_key = "attendance_id";
                            $this->admin_model->save($atdnc_data);
                        }
                    }
                }
            }
        }
    }

}
