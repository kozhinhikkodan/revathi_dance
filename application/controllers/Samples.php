<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Samples extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Doctors_model', 'Doctors');
		$this->load->model('Sales_men_model', 'Sales_men');
		$this->load->model('Samples_model', 'Samples');

		$this->load->library('Sample_Management', 'Sample_management');


		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}
		else{
			$allowed_users = array('master_admin','sales_man');
			if(!in_array($this->session->userdata('user_role'),$allowed_users)){
				redirect(base_url(),'refresh');
			}
		}

		$this->data['folder']='samples';

	}

	public function index()
	{
		$this->init();

	}


	public function init()
	{
		$allowed_users = array('master_admin');
		if(!in_array($this->session->userdata('user_role'),$allowed_users)){
			redirect(base_url(),'refresh');
		}

		$this->data['page']='samples_list';
		$this->load->view('Index',$this->data);
	}

	public function issued()
	{
		$this->data['sales_men'] = $this->Sales_men->select_sales_men('*')->result();
		$this->data['samples2'] = $this->Samples->select_samples('*')->result();

		$this->data['page']='samples_issued';
		$this->load->view('Index',$this->data);
	}

	public function delivered()
	{
		$this->data['sales_men'] = $this->Sales_men->select_sales_men('*')->result();
		$this->data['samples2'] = $this->Samples->select_samples('*')->result();

		if($this->session->userdata('user_role')=='sales_man'){

			$localities = $this->session->userdata('sales_man_data')->localities;
			if($localities!=''){
				$localities_array = explode(',', $localities);
				$query = '';
				foreach ($localities_array as $key => $value) {
					$query .= 'or FIND_IN_SET('.$value.', d.localities) ';
				}
				if($query!=''){
					$query = ltrim($query,'or');
					$query = "(".$query.")";
				}
				
				$this->db->where($query);
			}
			else{
				$this->db->where('d.delete_status',2);
			}

		}

		$this->data['doctors'] = $this->Doctors->select_doctors('*,d.name as name')->result();


		$this->data['page']='samples_delivered';
		$this->load->view('Index',$this->data);
	}



	public function list()
	{

		$this->data['sales_men'] = $this->Sales_men->select_sales_men('*')->result();

		$this->data['samples_balance_qty'] = 0;
		if($this->session->userdata('user_role')=='sales_man'){

			$this->data['samples'] = $this->Samples->select_samples('*',array('sa.sales_man_id'=>$this->session->userdata('sales_man_data')->sales_man_id,'sa.sample_delivery_status!='=>1))->result();

			$this->data['samples_balance_qty'] = $this->Samples->select_samples('*,COALESCE(SUM(sa.balance_quantity),0) as total_balance_quantity',array('sa.sales_man_id'=>$this->session->userdata('sales_man_data')->sales_man_id))->row()->total_balance_quantity;

			$localities = $this->session->userdata('sales_man_data')->localities;
			if($localities!=''){
				foreach (explode(',', $localities) as $key => $value) {
					$this->db->where("FIND_IN_SET($value, d.localities)");
				}
			}else{
				$this->db->where('d.delete_status',2);
			}

			$this->data['doctors'] = $this->Doctors->select_doctors('*')->result();

		}

		



		$this->data['page']='samples_list';
		$this->load->view('Index',$this->data);
	}

	public function create()
	{

		$data['sample_name'] = $this->security->xss_clean($this->input->post('sample_name'));
		$data['sample_quantity'] = $data['balance_quantity'] = $this->security->xss_clean($this->input->post('quantity'));
		$data['issued_quantity'] = 0;
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));


		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Samples->create_sample($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "sample Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function select_samples(){

		$json_data=array();
		$j=0;

		$data=array();


		if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
			$data['sa.sample_delivery_status'] = $_POST['status'];
		}

		$result	= $this->Samples->select_samples("*,sa.created_date as created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			if($this->session->userdata('user_role')=='master_admin'){

				$btn_edit = '<button data-toggle="modal" data-target="#sample_edit_modal" id="sample_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="sample_delete_btn" data-target="#sample_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			}else{
				$btn_delete = $btn_edit = '';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			if($row->sample_delivery_status==0){
				$sample_delivery_status = '<label class="label label-sm label-inline label-danger">Not&nbsp;Issuesd</lable>';
			}elseif ($row->sample_delivery_status==1) {
				$sample_delivery_status = '<label class="label label-sm label-inline label-success">Issuesd</lable>';
			}else{
				$sample_delivery_status = '<label class="label label-sm label-inline label-warning">Pending</lable>';
			}

			$quantities = 'Total - <strong>'.$row->sample_quantity.'</strong><br>'.'Issued - <strong>'.$row->issued_quantity.'</strong><br>'.'Balance - <strong>'.$row->balance_quantity.'</strong>';

			$array[$j][]=$j+1;
			$array[$j][]=$row->sample_name;
			$array[$j][]=$quantities.'<br>'.$sample_delivery_status;
			$array[$j][]=$row->remarks;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->sample_id;
			$array[$j][]=$row->sample_quantity;





			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['sample_id'] = $this->security->xss_clean($this->input->post('sample_id'));
		$data['delete_status'] = 1;

		$result = $this->Samples->update_sample($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "sample Deleted Successfully!";
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
		$data['sample_id'] = $this->security->xss_clean($this->input->post('sample_id'));

		$data['sample_name'] = $this->security->xss_clean($this->input->post('sample_name'));
		$data['sample_quantity'] = $this->security->xss_clean($this->input->post('quantity'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));


		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Samples->update_sample($data);

		if($result==1){

			$this->sample_management->calculate_sample_quantities($data['sample_id']);

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "sample Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function fetch_pending_samples()
	{		
		$data['sa.balance_quantity>'] = 0;
		$result	= $this->Samples->select_samples("*,sa.created_date as created_date",$data);
		$output = $result->result();
		echo json_encode($output);
	}











	public function create_issued_sample()
	{

		$data['sales_man_id'] = $this->security->xss_clean($this->input->post('sales_man'));

		$data['sample_id'] = $this->security->xss_clean($this->input->post('sample'));
		$data['sample_issued_quantity'] = $this->security->xss_clean($this->input->post('quantity'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['due_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('due_date'))));

		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Samples->create_sample_issued($data);

		if($result['status']==1){

			$this->sample_management->calculate_sample_quantities($data['sample_id']);

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "sample Issued Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}
	public function select_samples_issued(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['sample']) && $_POST['sample']!='' && $_POST['sample']!='all'){
			$data['sai.sample_id'] = $_POST['sample'];
		}

		if(isset($_POST['sales_man']) && $_POST['sales_man']!='' && $_POST['sales_man']!='all'){
			$data['sai.sales_man_id'] = $_POST['sales_man'];
		}

		if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
			$data['sai.sample_issue_delivery_status'] = $_POST['status'];
		}

		if(isset($_POST['due_status']) && $_POST['due_status']!='' && $_POST['due_status']!='all'){
			$due_status = $_POST['due_status'];
			$data['sai.due_date!='] = '';
			if($due_status==0){
				$data['sai.due_date>'] = date('Y-m-d');
			}else{
				$data['sai.due_date<='] = date('Y-m-d');
			}
		}

		$result	= $this->Samples->select_samples_issued("*,sai.created_date as created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			if($this->session->userdata('user_role')=='master_admin'){

				$btn_edit = '<button data-toggle="modal" data-target="#sample_issue_update_modal" id="sample_issue_update_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="sample_issue_delete_btn" data-target="#sample_issue_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

				$btn_receive = ' ';

			}else{

				$btn_receive = '<button data-toggle="modal" data-target="#sample_issue_receive_modal" id="sample_issue_receive_btn" class="btn btn-sm btn-success m-1"> <i class="flaticon flaticon2-check-mark"></i> </button>';

				$btn_delete = $btn_edit = '';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			$quantities = 'Issued - <strong>'.$row->sample_issued_quantity.'</strong><br>'.'Delivered - <strong>'.$row->sample_delivered_quantity.'</strong><br>'.'Balance - <strong>'.$row->sample_balance_quantity.'</strong>';

			if($row->sample_issue_delivery_status==0){
				$sample_delivery_status = '<label class="label label-sm label-inline label-danger">Not&nbsp;Delivered</label>';
			}elseif ($row->sample_issue_delivery_status==1) {
				$sample_delivery_status = '<label class="label label-sm label-inline label-success">Delivered</label>';
			}else{
				$sample_delivery_status = '<label class="label label-sm label-inline label-warning">Pending&nbsp;Delivery</label>';
			}


			if($row->received_status==1){
				$btn_receive = '';
				$received_status = '<label class="label label-sm label-inline label-success">Received&nbsp;on&nbsp;'.date('d-m-Y',strtotime($row->received_date)).'</label>';
			}else{
				$received_status = '<label class="label label-sm label-inline label-danger">Not&nbsp;Received</label>';
			}

			if($row->due_date!='' && $row->due_date<date('Y-m-d')){
				$due_status = '<br><label class="label label-sm label-inline label-danger">Delivery&nbsp;Due</label>';
			}else{
				$due_status = '';
			}

			$array[$j][]=$j+1;
			$array[$j][]=$row->sample_name;
			$array[$j][]=$quantities;
			$array[$j][]=$received_status.'<br>'.$sample_delivery_status.$due_status;
			$array[$j][]=$row->sales_man_name;
			$array[$j][]=$row->remarks;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_receive.$btn_edit.$btn_delete;
			$array[$j][]=$row->issue_id;
			$array[$j][]=$row->sales_man_id;
			$array[$j][]=$row->sample_id;
			$array[$j][]=$row->sample_issued_quantity+$row->balance_quantity;
			$array[$j][]=($row->due_date!='') ? date('d-m-Y',strtotime($row->due_date)) : '' ;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function fetch_pending_samples_issued()
	{
		if(isset($_POST['issue_id']) && $_POST['issue_id']!='' && $_POST['issue_id']!='all'){
			$data['sai.issue_id'] = $_POST['issue_id'];
		}

		if($this->session->userdata('user_role')=='sales_man'){
			$data['sai.sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
		}

		$data['sai.sample_balance_quantity>'] = 0;
		$result	= $this->Samples->select_samples_issued("*,sai.created_date as created_date",$data);
		$output = $result->result();
		echo json_encode($output);
	}

	public function get_issued_sample_info()
	{
		if(isset($_POST['issue_id']) && $_POST['issue_id']!='' && $_POST['issue_id']!='all'){
			$data['sai.issue_id'] = $_POST['issue_id'];
		}

		$result	= $this->Samples->select_samples_issued("*,sai.created_date as created_date",$data);

		$output = array();

		if($result->num_rows()==1){
			$output['sample'] = $result->row();
			$output['status'] = 1;
		}else{
			$output['sample'] = array();
			$output['status'] = 0;
		}
		echo json_encode($output);
	}



	public function delete_issued_sample()
	{
		$data['issue_id'] = $this->security->xss_clean($this->input->post('issue_id'));
		$data['delete_status'] = 1;

		$result = $this->Samples->update_sample_issued($data);
		if($result==1){

			$sample_id = $this->security->xss_clean($this->input->post('sample_id'));
			$this->sample_management->calculate_sample_quantities($sample_id);

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "sample Issued Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}


	public function update_issued_sample()
	{
		$data['issue_id'] = $this->security->xss_clean($this->input->post('issue_id'));

		// $data['sample_id'] = $this->security->xss_clean($this->input->post('sample'));
		$data['sample_issued_quantity'] = $this->security->xss_clean($this->input->post('quantity'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['due_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('due_date'))));

		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Samples->update_sample_issued($data);

		if($result==1){

			$sample_id = $this->security->xss_clean($this->input->post('sample_id'));
			// $data['sample_id'] = $this->security->xss_clean($this->input->post('sample'));

			$this->sample_management->calculate_sample_quantities($sample_id);
			// $this->sample_management->calculate_sample_quantities($sample_id);


			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "sample Issued Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}


	// receive_sample_issued

	public function receive_sample_issued()
	{
		$data['issue_id'] = $this->security->xss_clean($this->input->post('issue_id'));

		$data['received_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('received_date'))));
		$data['received_status'] = 1;

		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Samples->update_sample_issued($data);

		if($result==1){

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Received Date Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}


















	public function create_sample_delivery()
	{

		$data['issue_id'] = $this->security->xss_clean($this->input->post('issue_id'));
		
		$issue_row = $this->Samples->select_samples_issued('sai.sample_balance_quantity,sai.sample_id',$data)->row();
		$sample_balance_quantity = $issue_row->sample_balance_quantity;
		$sample_id = $issue_row->sample_id;

		$data['delivered_quantity'] = $this->security->xss_clean($this->input->post('quantity'));

		if($data['delivered_quantity']<=$sample_balance_quantity){

			$data['doctor_id'] = $this->security->xss_clean($this->input->post('doctor'));
			$data['delivered_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('delivered_date'))));

			$data['delivery_remarks'] = $this->security->xss_clean($this->input->post('remarks'));

			$data['created_date'] = date('Y-m-d h:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			$result = $this->Samples->create_sample_delivered($data); 

			if($result['status']==1){

				$this->sample_management->calculate_sample_quantities($sample_id);

				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "sample Delivery Added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Delivered quanity exceeds the balance quantity !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}


	public function select_samples_delivered(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['sample']) && $_POST['sample']!='' && $_POST['sample']!='all'){
			$data['sai.sample_id'] = $_POST['sample'];
		}

		if(isset($_POST['doctor']) && $_POST['doctor']!='' && $_POST['doctor']!='all'){
			$data['gd.doctor_id'] = $_POST['doctor'];
		}

		if(isset($_POST['sales_man']) && $_POST['sales_man']!='' && $_POST['sales_man']!='all'){
			$data['sai.sales_man_id'] = $_POST['sales_man'];
		}

		$result	= $this->Samples->select_samples_delivered("*,sad.created_date as created_date,d.name as name,sad.delivered_quantity as delivered_quantity",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			if($this->session->userdata('user_role')=='sales_man'){

				$btn_edit = '<button data-toggle="modal" data-target="#sample_delivery_edit_modal" id="sample_delivery_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="sample_delivery_delete_btn" data-target="#sample_delivery_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';
			}else{
				$btn_delete = $btn_edit = '';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			
			$array[$j][]=$j+1;
			$array[$j][]=$row->name;
			$array[$j][]=$row->sample_name;
			$array[$j][]=$row->delivered_quantity;
			$array[$j][]=$row->sales_man_name;
			$array[$j][]=$row->delivery_remarks;
			$array[$j][]=date('d-m-Y',strtotime($row->delivered_date));
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->sample_id;
			$array[$j][]=$row->delivery_id;
			$array[$j][]=$row->doctor_id;
			$array[$j][]=$row->sample_balance_quantity+$row->delivered_quantity;


			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}


	public function delete_delivery()
	{
		$data['delivery_id'] = $this->security->xss_clean($this->input->post('delivery_id'));
		$data['delete_status'] = 1;

		$result = $this->Samples->update_sample_delivered($data);
		if($result==1){

			$sample_id = $this->security->xss_clean($this->input->post('sample_id'));
			$this->sample_management->calculate_sample_quantities($sample_id);

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "sample Delivery Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}



	public function update_transfer()
	{


		$data['sample_id'] = $this->security->xss_clean($this->input->post('sample'));
		
		$sample_balance_quantity = $this->Samples->select_samples('sa.balance_quantity',$data)->row()->balance_quantity;
		$data['transferred_quantity'] = $this->security->xss_clean($this->input->post('transfer_quantity'));

		if($data['transferred_quantity']<=$sample_balance_quantity){

			$data['transfer_id'] = $this->security->xss_clean($this->input->post('transfer_id'));

			$data['sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
			$data['doctor_id'] = $this->security->xss_clean($this->input->post('doctor'));
			$data['transferred_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('transfer_date'))));

			$data['transfer_remarks'] = $this->security->xss_clean($this->input->post('remarks'));

			$data['updated_date'] = date('Y-m-d h:i:s');
			$data['updated_by'] = $this->session->userdata('user_id');

			$result = $this->Samples->update_sample_delivered($data);

			if($result==1){

				$this->sample_management->calculate_sample_quantities($data['sample_id']);
				$sample_id = $this->security->xss_clean($this->input->post('sample_id'));
				$this->sample_management->calculate_sample_quantities($sample_id);


				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "sample Transfer Added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Transfer quanity exceeds the balance quantity !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}


	public function fetch_sample_info()
	{
		$data['sa.sample_id'] = $this->security->xss_clean($this->input->post('sample_id'));
		$sample = $this->Samples->select_samples("*",$data);
		$result['count'] = $sample->num_rows();
		$result['sample'] = $sample->row();
		echo json_encode($result);
	}

}