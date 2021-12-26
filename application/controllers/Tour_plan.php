<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tour_plan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        ini_set('max_execution_time', 5000);
        ini_set("memory_limit", "-1");
        date_default_timezone_set('Asia/Kolkata');

        $this->load->model('User_model', 'User');
        $this->load->model('Settings_model', 'Settings');
        $this->load->model('Managers_model', 'Managers');
        $this->load->model('Sales_men_model', 'Sales_men');

        $this->load->model('Tour_plan_model', 'Tour_plan');
        $this->load->model('Events_model', 'Events');

        $maintanance_mode = $this->Settings->select_setting_config('*', array('s.setting_name' => 'maintanance_mode'))->row()->value;
        if ($maintanance_mode == 1) {
            redirect(base_url() . 'maintanance', 'refresh');
        } else {
            $allowed_users = array('master_admin', 'manager', 'sales_man');
            if (!in_array($this->session->userdata('user_role'), $allowed_users)) {
                redirect(base_url(), 'refresh');
            }
        }

        $this->data['folder'] = 'tour_plan';

    }

    public function index()
    {
        $this->init();
    }

    public function init()
    {


        $this->data['sales_men'] = $this->Sales_men->select_sales_men('*')->result();

        if ($this->session->userdata('user_role') == 'sales_man') {
            $localities = $this->session->userdata('sales_man_data')->localities;
            if ($localities != '') {
                $query = '';
                foreach (explode(',', $localities) as $key => $value) {
                    $query .= 'or l.locality_id=' . $value . ' ';
                }
                if ($query != '') {
                    $query = ltrim($query, 'or');
                    $query = "(" . $query . ")";
                }

                $this->db->where($query);
            } else {
                $this->db->where('l.delete_status', 2);
            }
        }


        $this->data['localities'] = $this->Localities->select_localities('*', array('l.locality_status' => 1))->result();

        $this->data['page'] = 'tour_plan_calendar';
        $this->load->view('Index', $this->data);
    }

    public function create()
    {

        $data['sales_man_id'] = $data2['tp.sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;

        $data['start_date'] = $data2['tp.start_date<='] = $data2['tp.end_date>='] = date('Y-m-d', strtotime($this->security->xss_clean($this->input->post('start_date'))));

        if(config_item('tp_end_date_enabled')){
            $data['end_date'] = $data2['tp.start_date>='] = $data2['tp.end_date<='] = date('Y-m-d', strtotime($this->security->xss_clean($this->input->post('end_date'))));
        }else{
            $data['end_date'] = $data['start_date'];
        }

        if ($data['start_date'] <= $data['end_date']) {

            if ($data['start_date'] >= date('Y-m-d') && $data['end_date'] >= date('Y-m-d') && (($data['start_date'] <= date('Y-m-t') && $data['end_date'] <= date('Y-m-t')) or (date('d') >= 25 && $data['start_date'] <= date('Y-m-t', strtotime(date('Y-m-t') . ' + 1 months')) && $data['end_date'] <= date('Y-m-t', strtotime(date('Y-m-t') . ' + 1 months'))))) {

                // $data2['tp.tour_plan_status'] = 1;
                // $count = $this->Tour_plan->select_tour_plans('*', $data2)->num_rows();

                // if ($count == 0) {

                $localities = $this->security->xss_clean($this->input->post('locality[]'));

                // exit(print_r($localities));

                foreach ($localities as $key => $value) {

                    $data['locality_id'] = $value;

                    $data['notes'] = $this->security->xss_clean($this->input->post('notes'));
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $data['created_by'] = $this->session->userdata('user_id');

                    $result = $this->Tour_plan->create_tour_plan($data);

                    if ($result['status'] == 1) {
                        $flash_data['status'] = 1;
                        $flash_data['flashdata_type'] = 'success';
                        $flash_data['alert_type'] = 'info';
                        $flash_data['flashdata_title'] = 'Success !';
                        $flash_data['flashdata_msg'] = "Tour Plan Added Successfully!";
                    } else {
                        $flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
                        $flash_data['flashdata_type'] = 'error';
                        $flash_data['alert_type'] = 'danger';
                        $flash_data['flashdata_title'] = 'Error !!';
                    }


                }


                // } else {
                //     $flash_data['flashdata_msg'] = " Already requested & approved tour plan during this period ! ";
                //     $flash_data['flashdata_type'] = 'error';
                //     $flash_data['alert_type'] = 'danger';
                //     $flash_data['flashdata_title'] = 'Not allowed !!';
                // }

            } else {

                $flash_data['flashdata_msg'] = "Only allowed to request for dates in current month and future dates !";
                $flash_data['flashdata_type'] = 'error';
                $flash_data['alert_type'] = 'danger';
                $flash_data['flashdata_title'] = 'Invalid !!';

            }

        } else {

            $flash_data['flashdata_msg'] = "End Date must be greater than Start Date !";
            $flash_data['flashdata_type'] = 'error';
            $flash_data['alert_type'] = 'danger';
            $flash_data['flashdata_title'] = 'Invalid !!';

        }

        echo json_encode($flash_data);

    }

    public function approve()
    {
        $data['tour_plan_id'] = $this->security->xss_clean($this->input->post('tour_plan_id'));
        $data['tour_plan_status'] = $this->security->xss_clean($this->input->post('tour_plan_approve_radio'));
        $data['reply_note'] = $this->security->xss_clean($this->input->post('reply_note'));

        $data['responded_user_role'] = $this->session->userdata('user_role_id');
        if ($this->session->userdata('user_role') == 'master_admin') {
            $data['responded_by'] = 0;
        } else {
            $data['responded_by'] = $this->Managers->select_managers('*', array('m.user_id' => $this->session->userdata('user_id')))->row()->manager_id;
        }
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['created_by'] = $this->session->userdata('user_id');

        $result = $this->Tour_plan->update_tour_plan($data);

        if ($result == 1) {
            $flash_data['status'] = 1;
            $flash_data['flashdata_type'] = 'success';
            $flash_data['alert_type'] = 'info';
            $flash_data['flashdata_title'] = 'Success !';
            $flash_data['flashdata_msg'] = "Tour Plan updated Successfully!";
        } else {
            $flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
            $flash_data['flashdata_type'] = 'error';
            $flash_data['alert_type'] = 'danger';
            $flash_data['flashdata_title'] = 'Error !!';
        }

        echo json_encode($flash_data);

    }

    public function delete()
    {
        $data['tour_plan_id'] = $this->security->xss_clean($this->input->post('tour_plan_id'));
        $data['delete_status'] = 1;

        $result = $this->Tour_plan->update_tour_plan($data);

        if ($result == 1) {
            $flash_data['status'] = 1;
            $flash_data['flashdata_type'] = 'success';
            $flash_data['alert_type'] = 'info';
            $flash_data['flashdata_title'] = 'Success !';
            $flash_data['flashdata_msg'] = "Tour Plan deleted Successfully!";
        } else {
            $flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
            $flash_data['flashdata_type'] = 'error';
            $flash_data['alert_type'] = 'danger';
            $flash_data['flashdata_title'] = 'Error !!';
        }

        echo json_encode($flash_data);

    }

    public function fetch_calendar_events()
    {
        $data = array();

        if (isset($_POST['status']) && $_POST['status'] != '' && $_POST['status'] != 'all') {
            $data['tp.tour_plan_status'] = $_POST['status'];
        }

        if (isset($_POST['sales_man_id']) && $_POST['sales_man_id'] != '' && $_POST['sales_man_id'] != 'all') {
            $data['tp.sales_man_id'] = $_POST['sales_man_id'];
        }

        if (isset($_POST['locality']) && $_POST['locality'] != '' && $_POST['locality'] != 'all') {
            $data['tp.locality_id'] = $_POST['locality'];
        }

        $tour_plans = $this->Tour_plan->select_tour_plans('*', $data)->result();

        $events = array();
        $e = 0;

        foreach ($tour_plans as $key => $value) {
            $events[$e]['id'] = $e;

            if($this->session->userdata('user_role')=='sales_man'){
                $events[$e]['title'] = $events[$e]['description'] = $value->locality_name . ', ' . $value->district_name . ' - ' . $value->state_name;
            }else{
                $events[$e]['title'] = $events[$e]['description'] = $value->sales_man_name . ' - ' . $value->locality_name . ', ' . $value->district_name . ' - ' . $value->state_name;
            }

            $events[$e]['sub_key'] = 1;
            $events[$e]['start'] = $value->start_date;

            if(config_item('tp_end_date_enabled')){
                $events[$e]['end'] = date('Y-m-d', strtotime($value->end_date . " +1 day"));
            }else{
                $events[$e]['end'] = $value->start_date;
            }

            $events[$e]['url'] = '';

            if ($value->tour_plan_status == 0) {
                $className = "fc-event-solid-warning";
            } elseif ($value->tour_plan_status == 1) {
                $className = "fc-event-solid-success";
            } elseif ($value->tour_plan_status == 2) {
                $className = "fc-event-solid-danger";
            }

            $events[$e]['className'] = $className;

            // data

            $events[$e]['sales_man_name'] = $value->sales_man_name;
            $events[$e]['start_date'] = date('d-m-Y', strtotime($value->start_date));
            if(config_item('tp_end_date_enabled')){
                $events[$e]['end_date'] = $events[$e]['start_date'];
            }else{
                $events[$e]['end_date'] = date('d-m-Y', strtotime($value->end_date));
            }
            $events[$e]['state_name'] = $value->state_name;
            $events[$e]['district_name'] = $value->district_name;
            $events[$e]['locality_name'] = $value->locality_name;
            $events[$e]['notes'] = $value->notes;
            $events[$e]['tour_plan_id'] = $value->tour_plan_id;
            $events[$e]['tour_plan_status'] = $value->tour_plan_status;

            if ($value->responded_user_role != 0) {
                if ($value->responded_user_role == 1) {
                    $events[$e]['responded_user_role'] = '';
                    $events[$e]['responded_by'] = 'Mater Admin';
                } elseif ($value->responded_user_role == 2) {
                    $events[$e]['responded_user_role'] = 'Manager';
                    $events[$e]['responded_by'] = $this->Managers->select_managers('m.manager_name', array('m.manager_id' => $value->responded_by))->row()->manager_name;
                }

            }

            $events[$e]['reply_note'] = $value->reply_note;

            $e++;
        }

        $events_list = $this->Events->select_events('*')->result();

        foreach ($events_list as $key => $value) {
            $events[$e]['id'] = $e;
            $events[$e]['title'] = $value->event_title;
            $events[$e]['description'] = $value->event_description;
            $events[$e]['sub_key'] = 1;
            $events[$e]['start'] = $value->event_date;
            $events[$e]['end'] = date('Y-m-d', strtotime($value->event_date . " +1 day"));

            $events[$e]['url'] = '#';

            if ($value->event_date>date('Y-m-d')) {
                $className = "fc-event-solid-dark";
            } else {
                $className = "fc-event-solid-primary";
            }

            $events[$e]['className'] = $className;

            $events[$e]['sales_man_name'] = $events[$e]['start_date'] = $events[$e]['end_date'] = $events[$e]['state_name'] = $events[$e]['district_name'] = $events[$e]['locality_name'] = $events[$e]['notes'] = $events[$e]['tour_plan_id'] = $events[$e]['tour_plan_status'] = $events[$e]['responded_user_role'] = $events[$e]['responded_by'] = '';

            $e++;

        }


        echo json_encode($events);
    }











    public function fetch_tour_plans()
    {
        $data = array();

        if (isset($_POST['status']) && $_POST['status'] != '' && $_POST['status'] != 'all') {
            $data['tp.tour_plan_status'] = $_POST['status'];
        }

        if (isset($_POST['sales_man']) && $_POST['sales_man'] != '' && $_POST['sales_man'] != 'all') {
            $data['tp.sales_man_id'] = $_POST['sales_man'];
        }

        if (isset($_POST['locality']) && $_POST['locality'] != '' && $_POST['locality'] != 'all') {
            $data['tp.locality_id'] = $_POST['locality'];
        }

        if (isset($_POST['start_date']) && $_POST['start_date'] != '' && $_POST['start_date'] != 'all') {
            $data['tp.start_date >='] = date('Y-m-d', strtotime($_POST['start_date']));
        }

        if (isset($_POST['end_date']) && $_POST['end_date'] != '' && $_POST['end_date'] != 'all') {
            $data['tp.end_date <='] = date('Y-m-d', strtotime($_POST['end_date']));
        }



        $tour_plans = $this->Tour_plan->select_tour_plans('*', $data)->result();

        $events = array();
        $e = 0;

        foreach ($tour_plans as $key => $value) {
            $events[$e]['id'] = $e;

            if($this->session->userdata('user_role')=='sales_man'){
                $events[$e]['title'] = $events[$e]['description'] = $value->locality_name . ', ' . $value->district_name . ' - ' . $value->state_name;
            }else{
                $events[$e]['title'] = $events[$e]['description'] = $value->sales_man_name . ' - ' . $value->locality_name . ', ' . $value->district_name . ' - ' . $value->state_name;
            }

            $events[$e]['sub_key'] = 1;
            $events[$e]['start'] = $value->start_date;

            if(config_item('tp_end_date_enabled')){
                $events[$e]['end'] = date('Y-m-d', strtotime($value->end_date . " +1 day"));
            }else{
                $events[$e]['end'] = $value->start_date;
            }

            $events[$e]['url'] = '';

            if ($value->tour_plan_status == 0) {
                $className = "fc-event-solid-warning";
            } elseif ($value->tour_plan_status == 1) {
                $className = "fc-event-solid-success";
            } elseif ($value->tour_plan_status == 2) {
                $className = "fc-event-solid-danger";
            }

            $events[$e]['className'] = $className;

            // data

            $events[$e]['sales_man_name'] = $value->sales_man_name;
            $events[$e]['start_date'] = date('d-m-Y', strtotime($value->start_date));
            if(config_item('tp_end_date_enabled')){
                $events[$e]['end_date'] = $events[$e]['start_date'];
            }else{
                $events[$e]['end_date'] = date('d-m-Y', strtotime($value->end_date));
            }
            $events[$e]['state_name'] = $value->state_name;
            $events[$e]['district_name'] = $value->district_name;
            $events[$e]['locality_name'] = $value->locality_name;
            $events[$e]['notes'] = $value->notes;
            $events[$e]['tour_plan_id'] = $value->tour_plan_id;
            $events[$e]['tour_plan_status'] = $value->tour_plan_status;

            if ($value->responded_user_role != 0) {
                if ($value->responded_user_role == 1) {
                    $events[$e]['responded_user_role'] = '';
                    $events[$e]['responded_by'] = 'Mater Admin';
                } elseif ($value->responded_user_role == 2) {
                    $events[$e]['responded_user_role'] = 'Manager';
                    $events[$e]['responded_by'] = $this->Managers->select_managers('m.manager_name', array('m.manager_id' => $value->responded_by))->row()->manager_name;
                }

            }

            $events[$e]['reply_note'] = $value->reply_note;

            $e++;
        }




        echo json_encode($events);
    }


    public function approve_bulk()
    {
        $tour_plan_ids = explode(',', $this->security->xss_clean($this->input->post('tour_plan_ids')));

        // exit(print_r($tour_plan_ids));

        foreach ($tour_plan_ids as $key => $value) {

            $data['tour_plan_id'] = $value;
            $data['tour_plan_status'] = $this->security->xss_clean($this->input->post('tour_plan_bulk_approve_radio'));
            $data['reply_note'] = $this->security->xss_clean($this->input->post('reply_note'));

            $data['responded_user_role'] = $this->session->userdata('user_role_id');
            if ($this->session->userdata('user_role') == 'master_admin') {
                $data['responded_by'] = 0;
            } else {
                $data['responded_by'] = $this->Managers->select_managers('*', array('m.user_id' => $this->session->userdata('user_id')))->row()->manager_id;
            }
            $data['updated_date'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->userdata('user_id');

            // exit(print_r($data));

            $result = $this->Tour_plan->update_tour_plan($data);

        }

        if ($result == 1) {
            $flash_data['status'] = 1;
            $flash_data['flashdata_type'] = 'success';
            $flash_data['alert_type'] = 'info';
            $flash_data['flashdata_title'] = 'Success !';
            $flash_data['flashdata_msg'] = "Tour Plans updated Successfully!";
        } else {
            $flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
            $flash_data['flashdata_type'] = 'error';
            $flash_data['alert_type'] = 'danger';
            $flash_data['flashdata_title'] = 'Error !!';
        }

        echo json_encode($flash_data);

    }

}
