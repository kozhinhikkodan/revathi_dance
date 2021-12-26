<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Misc_model', 'Misc');

		$this->load->model('Managers_model', 'Managers');
		$this->load->model('Sales_men_model', 'Sales_men');
		$this->load->model('Leaves_model', 'Leaves');



		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}
		else{
			$allowed_users = array('master_admin','manager','sales_man');
			if(!in_array($this->session->userdata('user_role'),$allowed_users)){
				redirect(base_url(),'refresh');
			}
		}

		$this->data['folder']='leaves';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['managers'] = $this->Managers->select_managers('*')->result();
		$this->data['sales_men']=$this->Sales_men->select_sales_men('*')->result();

		$this->data['page']='leaves_list';
		$this->load->view('Index',$this->data);
	}

	public function create()
	{
		$data['leave_dates'] = $this->security->xss_clean($this->input->post('leave_dates'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Leaves->create_leave($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Leave Requested Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
		
	}

	public function select_leaves(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
			$data['l.approve_status'] = $_POST['status'];
		}

		if(isset($_POST['sales_man']) && $_POST['sales_man']!='' && $_POST['sales_man']!='all'){
			$data['l.sales_man_id'] = $_POST['sales_man'];
		}

		$result	= $this->Leaves->select_leaves("*,l.created_date as created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):


			if($row->approve_status==0 && $this->session->userdata('user_role')=='sales_man'){

				// $btn_edit = '<button data-toggle="modal" data-target="#leave_edit_modal" id="leave_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

				$btn_edit = '';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="leave_delete_btn" data-target="#leave_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			}else{
				$btn_delete = $btn_edit = '';
			}

			if($this->session->userdata('user_role')=='manager'){
				$btn_status = '<button data-toggle="modal" data-target="#leave_status_modal" id="leave_status_btn" class="btn btn-sm btn-info m-1"> <i class="flaticon flaticon2-check-mark"></i> </button>';
			}else{
				$btn_status = '';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			$array[$j][]=$j+1;

			$leave_dates = explode(',', $row->leave_dates);
			$dates = '';
			foreach ($leave_dates as $key => $value) {
				$dates .= '<label class="label label-sm label-inline label-dark mx-2">'.$value.'</label>'; 
			}

			$array[$j][]=$dates;
			$array[$j][]=$row->sales_man_name;
			$array[$j][]=$row->remarks;

			if($row->approve_status==0){
				$approve_status = '<label class="label label-lg label-inline label-warning">Pending</lable>';
			}elseif ($row->approve_status==1) {
				$approve_status = '<label class="label label-lg label-inline label-success">Approved</lable>';
			}else{
				$approve_status = '<label class="label label-lg label-inline label-danger">Rejected</lable>';
			}
			$array[$j][]=$approve_status;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_status.$btn_edit.$btn_delete;
			$array[$j][]=$row->leave_id;
			$array[$j][]=$row->approve_status;
			$array[$j][]=$row->leave_dates;


			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function approve()
	{
		$data['leave_id'] = $this->security->xss_clean($this->input->post('leave_id'));

		$data['approve_status'] = $this->security->xss_clean($this->input->post('leave_approve_radio'));
		$data['approve_remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['approved_by'] = $this->session->userdata('manager_data')->manager_id;
		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_date'] = $this->session->userdata('user_id');

		$result = $this->Leaves->update_leave($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Leave Request updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
		
	}

	public function delete()
	{
		$data['leave_id'] = $this->security->xss_clean($this->input->post('leave_id'));
		$data['delete_status'] = 1;
		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_date'] = $this->session->userdata('user_id');

		$result = $this->Leaves->update_leave($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Leave Request deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);
		
	}



}