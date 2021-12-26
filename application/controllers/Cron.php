<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

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
		$this->load->model('Managers_work_logs_model', 'Managers_work_logs');

		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}


		$this->data['folder']='dashboard';

	}

	public function calculate_daily_allowance()
	{

		// Sales Men

		$data['sw.work_log_date<='] = date('Y-m-d');
		$work_logs = $this->Work_logs->select_work_logs('*',$data)->result();
		$data2['e.expense_type'] = $data3['expense_type'] = 'da';
		$data2['e.expense_user_type'] = $data3['expense_user_type'] = 'sales_man';
		$data3['remarks'] = 'DA added automatically';
		$data3['created_date'] = date('Y-m-d H:i:s');
		foreach ($work_logs as $key => $log) {

			$sales_man = $this->Sales_men->select_sales_men('s.user_id',array('s.sales_man_id'=>$log->sales_man_id))->row();
			$data3['created_by'] = $sales_man->user_id;

			$data3['total_expense_amount'] = $sales_man->sales_man_da;

			$data2['e.expense_date'] = $data3['expense_date'] = $log->work_log_date;
			$data2['e.expense_user_id'] = $data3['expense_user_id'] = $log->sales_man_id;
			$count = $this->Expenses->select_expenses("e.expense_id",$data2)->num_rows();
			if($count==0){
				$result = $this->Expenses->create_expense($data3);
			}
		}

		$data = $data2 = $data3 = array();

		// manager
		$data['mw.work_log_date<='] = date('Y-m-d');
		$work_logs	= $this->Managers_work_logs->select_work_logs("*,mw.remarks as remarks",$data)->result();
		$data2['e.expense_type'] = $data3['expense_type'] = 'da';
		$data2['e.expense_user_type'] = $data3['expense_user_type'] = 'manager';
		$data3['remarks'] = 'DA added automatically';
		$data3['created_date'] = date('Y-m-d H:i:s');
		foreach ($work_logs as $key => $log) {

			$manager = $this->Managers->select_managers('m.user_id',array('m.manager_id'=>$log->manager_id))->row();
			$data3['created_by'] = $manager->user_id;
			$data3['total_expense_amount'] = c$manager->manager_da;


			$data2['e.expense_date'] = $data3['expense_date'] = $log->work_log_date;
			$data2['e.expense_user_id'] = $data3['expense_user_id'] = $log->manager_id;
			$count = $this->Expenses->select_expenses("e.expense_id",$data2)->num_rows();
			if($count==0){
				$result = $this->Expenses->create_expense($data3);
			}
		}

		echo "Success";
	}





}