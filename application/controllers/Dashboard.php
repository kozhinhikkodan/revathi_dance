<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
		$this->load->library('session');


		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Sales_men_model', 'Sales_men');
		$this->load->model('Work_logs_model', 'Work_logs');
		$this->load->model('Doctors_model', 'Doctors');
		$this->load->model('Tour_plan_model', 'Tour_plan');
		$this->load->model('Expenses_model', 'Expenses');
		$this->load->model('Managers_model', 'Managers');

		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1 && $this->session->userdata('user_role')!='developer'){
			redirect(base_url().'maintanance', 'refresh');
		}

		if($this->session->userdata('user_role')=='developer'){
			redirect(base_url().'settings/config', 'refresh');
		}

		$this->data['folder']='dashboard';

	}

	public function index()
	{

		if(empty($this->session->userdata('user_id'))){
			redirect(base_url().'login', 'refresh');
		}
		else{



			// if($this->session->userdata('user_role')=='sales_man'){
			// 	$data_tp['tp.sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
			// }
			// $data_tp['tp.tour_plan_status'] = 0;
			// $this->data['tour_plans_pending_count'] = $this->Tour_plan->select_tour_plans('tp.tour_plan_id',$data_tp)->num_rows();

			// $data_e = array();
			// if($this->session->userdata('user_role')=='sales_man'){
			// 	$data_e['e.expense_user_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
			// 	$data_e['e.expense_user_type'] = 'sales_man';
			// }
			// $this->data['total_expenses'] = $this->Expenses->select_expenses('COALESCE(SUM(e.total_expense_amount),0) as total_expense_amount',$data_e)->row()->total_expense_amount;
			// $this->data['managers_count'] = $this->Managers->select_managers('m.manager_id')->num_rows();



			// if($this->session->userdata('user_role')=='sales_man'){
			// 	$localities = $this->session->userdata('sales_man_data')->localities;
			// 	if($localities!=''){
			// 		$localities_array = explode(',', $localities);
			// 	//exit(print_r($localities_array));
			// 		$query = '';
			// 		foreach ($localities_array as $key => $value) {
			// 			$query .= 'or FIND_IN_SET('.$value.', d.localities) ';
			// 		}
			// 		if($query!=''){
			// 			$query = ltrim($query,'or');
			// 			$query = "(".$query.")";
			// 		}
					
			// 		$this->db->where($query);
			// 	}
			// 	else{
			// 		$this->db->where('d.delete_status',2);
			// 	}
			// }

			// $doc_result = $this->Doctors->select_doctors('d.doctor_id,d.visit_frequency');
			// $this->data['doctors_count'] = $doc_result->num_rows();


			// $missed_calls = array();
			// $missed_calls['count'] = $missed_calls['frequency'] = 0;

			// foreach ($doc_result->result() as $key => $d) {

			// 	$data_sw = array();

			// 	// exit(print_r($d));

			// 	$data_sw['sw.doctor_id'] = $d->doctor_id;
			// 	$data_sw['sw.work_log_date >='] = date('Y-m-01');
			// 	$data_sw['sw.work_log_date <='] = date('Y-m-t');
			// 	$work_logs_count = $this->Work_logs->select_work_logs('*',$data_sw)->num_rows();
			// 	$missed_calls['count'] += $work_logs_count;
			// 	$missed_calls['frequency'] += $d->visit_frequency;

			// }

			// if($missed_calls['frequency']!=0){
			// 	$missed_calls_text = $missed_calls['count'].' / '.$missed_calls['frequency'];
			// 	$missed_calls_percentage =  ($missed_calls['count']/$missed_calls['frequency'])*100;
			// }else{
			// 	$missed_calls_text = '-';
			// 	$missed_calls_percentage = 0;

			// }

			// $this->data['missed_calls_text'] = $missed_calls_text;
			// $this->data['missed_calls_percentage'] = $missed_calls_percentage;
 
			$this->data['page']='home';
			$this->load->view('Index',$this->data);
		}
	}




}