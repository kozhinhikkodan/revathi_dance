<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managers_work_logs extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Sales_men_model', 'Sales_men');
		$this->load->model('Localities_model', 'Localities');
		$this->load->model('Managers_work_logs_model', 'Managers_work_logs');
		$this->load->model('Managers_model', 'Managers');


		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}
		else{
			$allowed_users = array('master_admin','manager');
			if(!in_array($this->session->userdata('user_role'),$allowed_users)){
				redirect(base_url(),'refresh');
			}
		}

		$this->data['folder']='manager_works_log';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['sales_men']=$this->Sales_men->select_sales_men('*')->result();
		$this->data['localities'] = $this->Localities->select_localities('*',array('l.locality_status'=>1))->result();
		$this->data['managers'] = $this->Managers->select_managers("*")->result();

		$this->data['page']='managers_work_logs';
		$this->load->view('Index',$this->data);
	}


	public function create()
	{
		$data['sales_man_id'] = $this->security->xss_clean($this->input->post('sales_man'));
		$data['locality_id'] = $this->security->xss_clean($this->input->post('locality'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['manager_id'] = $this->session->userdata('manager_data')->manager_id;
		$data['work_log_date'] = date('Y-m-d');
		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Managers_work_logs->create_work_log($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Work Log Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);		
	}

	public function select_work_logs(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['date']) && $_POST['date']!=''){
			$date=array();
			$date=explode('-',$_POST['date']);
			$start_date=date('Y-m-d', strtotime($date[0]));
			$end_date=date('Y-m-d', strtotime($date[1]));
			$data["STR_TO_DATE(mw.work_log_date,'%Y-%m-%d') <="]= $end_date;
			$data["STR_TO_DATE(mw.work_log_date,'%Y-%m-%d') >="]= $start_date;
		}

		if(isset($_POST['manager_id']) && $_POST['manager_id']!='' && $_POST['manager_id']!='all'){
			$data['mw.manager_id'] = $_POST['manager_id'];
		}

		if(isset($_POST['sales_man_id']) && $_POST['sales_man_id']!='' && $_POST['sales_man_id']!='all'){
			$data['mw.sales_man_id'] = $_POST['sales_man_id'];
		}

		if(isset($_POST['locality_id']) && $_POST['locality_id']!='' && $_POST['locality_id']!='all'){
			$data['mw.locality_id'] = $_POST['locality_id'];
		}

		$result	= $this->Managers_work_logs->select_work_logs("*,mw.remarks as remarks",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_edit = '<button data-toggle="modal" data-target="#manager_work_log_edit_modal" id="manager_work_log_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="manager_work_log_delete_btn" data-target="#manager_work_log_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date)).'</span>';

			$array[$j][]=$j+1;
			$array[$j][]=$row->manager_name;
			$array[$j][]=$row->sales_man_name;
			$array[$j][]=$row->locality_name.' - '.$row->district_name.', '.$row->state_name;
			$array[$j][]=$row->remarks;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->manager_id;
			$array[$j][]=$row->sales_man_id;
			$array[$j][]=$row->locality_id;
			$array[$j][]=$row->work_log_id;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['work_log_id'] = $this->security->xss_clean($this->input->post('work_log_id'));
		$data['delete_status'] = 1;
		$result = $this->Managers_work_logs->update_work_log($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Work Log Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}

	public function update()
	{
		$data['work_log_id'] = $this->security->xss_clean($this->input->post('work_log_id'));
		$data['sales_man_id'] = $this->security->xss_clean($this->input->post('sales_man'));
		$data['locality_id'] = $this->security->xss_clean($this->input->post('locality'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Managers_work_logs->update_work_log($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Work Log Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);		
	}

}