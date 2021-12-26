<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');

		$this->load->model('Expenses_model', 'Expenses');
		$this->load->model('Managers_model', 'Managers');
		$this->load->model('Sales_men_model', 'Sales_men');



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

		$this->data['folder']='expenses';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['managers'] = $this->Managers->select_managers("*")->result();
		$this->data['sales_men']=$this->Sales_men->select_sales_men('*')->result();

		$this->data['page']='expenses_list';
		$this->load->view('Index',$this->data);
	}


	public function create()
	{

		$data['expense_type'] = $this->security->xss_clean($this->input->post('expense_type'));
		$data['expense_user_type'] = $this->session->userdata('user_role');
		$data['expense_date'] = date('Y-m-d');

		if($this->session->userdata('user_role')=='manager'){
			$data['expense_user_id'] = $this->session->userdata('manager_data')->manager_id;
		}elseif ($this->session->userdata('user_role')=='sales_man') {
			$data['expense_user_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
		}

		if($data['expense_type']=='other'){
			$data['total_expense_amount'] = $this->security->xss_clean($this->input->post('other_expense_amount'));
		}else{

			$item_array = $this->security->xss_clean($this->input->post('ta_items'));
			$new_items_array = array();
			foreach (array_keys($item_array) as $key) {
				foreach ($item_array[$key] as $key2 => $value) {
					$new_items_array[$key2][$key] = $value; 
				}
			}

			$data['expense_details'] = serialize($new_items_array);

			$data['total_expense_amount'] = $this->security->xss_clean($this->input->post('total_expense_amount'));

		}

		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Expenses->create_expense($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Expense Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}


	public function select_expenses(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['date']) && $_POST['date']!=''){
			$date=array();
			$date=explode('-',$_POST['date']);
			$start_date=date('Y-m-d', strtotime($date[0]));
			$end_date=date('Y-m-d', strtotime($date[1]));
			$data["STR_TO_DATE(e.expense_date,'%Y-%m-%d') <="]= $end_date;
			$data["STR_TO_DATE(e.expense_date,'%Y-%m-%d') >="]= $start_date;
		}

		if(isset($_POST['type']) && $_POST['type']!='' && $_POST['type']!='all'){
			$data['e.expense_type'] = $_POST['type'];
		}

		if(isset($_POST['manager']) && $_POST['manager']!='' && $_POST['manager']!='all'){
			$data['e.expense_user_id'] = $_POST['manager'];
			$data['e.expense_user_type'] = 'manager';
		}

		if(isset($_POST['sales_man']) && $_POST['sales_man']!='' && $_POST['sales_man']!='all'){
			$data['e.expense_user_id'] = $_POST['sales_man'];
			$data['e.expense_user_type'] = 'sales_man';
		}

		if($this->session->userdata('user_role')=='sales_man'){
			$data['e.expense_user_type'] = 'sales_man';
			$data['e.expense_user_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
		}


		$result	= $this->Expenses->select_expenses("*,e.created_date as e_created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		$total_expense_amount = 0;	

		foreach($result_array as $row):

			if( ( $this->session->userdata('user_role')=='manager' && $this->session->userdata('manager_data')->manager_id == $row->expense_user_id ) || $this->session->userdata('user_role')=='master_admin' && $row->expense_type=='ta'){

				$btn_edit = '<button data-toggle="modal" data-target="#expense_edit_modal" id="expense_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
				
				$btn_edit = '';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="expense_delete_btn" data-target="#expense_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';
			}else{
				$btn_delete = $btn_edit = '';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->e_created_date));

			$array[$j][]=$j+1;
			
			if($row->expense_type=='ta'){
				$array[$j][]='<span class="label label-md label-inline font-weight-bold label-rounded label-info">TA</span>';
			}elseif ($row->expense_type=='da') {
				$array[$j][]='<span class="label label-md label-inline font-weight-bold label-rounded label-success">DA</span>';
			}else{
				$array[$j][]='<span class="label label-md label-inline font-weight-bold label-rounded label-primary">OTHER</span>';
			}

			$expense_details = unserialize($row->expense_details);
			if(!empty($expense_details)){
				$route = '';
				$i=1;
				foreach ($expense_details as $key => $ed) {
					$route .= $i.'. '.$ed["starting_point"].' to '.$ed["ending_point"].'<br><br>';
					$i++;
				}
				$array[$j][]=$route;
			}else{
				$array[$j][]='NA';
			}

			$array[$j][]=$row->name.' <span class="label label-md label-inline  font-weight-bold label-rounded label-dark">'.$row->role_name.'</span>';

			

			$array[$j][]=$row->total_expense_amount;	
			$array[$j][]=nl2br($row->remarks);
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->expense_id;
			$array[$j][]=$row->expense_type;
			$array[$j][]=json_encode($expense_details);

			$total_expense_amount += $row->total_expense_amount;

			$j++;
		endforeach;


		$array[$j][]=$j+1;
		$array[$j][]='';
		$array[$j][]='Total Amount';
		$array[$j][]='';
		$array[$j][]='<strong class="text-danger">'.$total_expense_amount.'</strong>';
		$array[$j][]='';
		$array[$j][]='';
		$array[$j][]='';
		$array[$j][]='';
		$array[$j][]='';
		$array[$j][]='';

		$json_data['data']=$array;
		echo json_encode($json_data);
	}


	public function update()
	{
		$data['expense_id'] = $this->security->xss_clean($this->input->post('expense_id'));
		$data['expense_type'] = $this->security->xss_clean($this->input->post('expense_type_edit'));

		if($data['expense_type']=='other'){
			$data['total_expense_amount'] = $this->security->xss_clean($this->input->post('other_expense_amount'));
		}else{

			$item_array = $this->security->xss_clean($this->input->post('ta_items'));
			$new_items_array = array();
			foreach (array_keys($item_array) as $key) {
				foreach ($item_array[$key] as $key2 => $value) {
					$new_items_array[$key2][$key] = $value; 
				}
			}

			$data['expense_details'] = serialize($new_items_array);

			$data['total_expense_amount'] = $this->security->xss_clean($this->input->post('total_expense_amount'));

		}

		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['updated_date'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Expenses->update_expense($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Expense Updated Successfully!";
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
		$data['expense_id'] = $this->security->xss_clean($this->input->post('expense_id'));
		$data['delete_status'] = 1;

		$result = $this->Expenses->update_expense($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Expense Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}


}