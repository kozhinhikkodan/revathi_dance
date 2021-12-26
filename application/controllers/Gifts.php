<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gifts extends CI_Controller {

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
		$this->load->model('Gifts_model', 'Gifts');

		$this->load->library('Gift_Management', 'gift_management');


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

		$this->data['folder']='gifts';

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

		$this->data['page']='gifts_list';
		$this->load->view('Index',$this->data);
	}

	public function issued()
	{
		$this->data['sales_men'] = $this->Sales_men->select_sales_men('*')->result();
		$this->data['gifts2'] = $this->Gifts->select_gifts('*')->result();

		$this->data['page']='gifts_issued';
		$this->load->view('Index',$this->data);
	}

	public function delivered()
	{
		$this->data['sales_men'] = $this->Sales_men->select_sales_men('*')->result();
		$this->data['gifts2'] = $this->Gifts->select_gifts('*')->result();

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


		$this->data['page']='gifts_delivered';
		$this->load->view('Index',$this->data);
	}



	public function list()
	{

		$this->data['sales_men'] = $this->Sales_men->select_sales_men('*')->result();

		$this->data['gifts_balance_qty'] = 0;
		if($this->session->userdata('user_role')=='sales_man'){

			$this->data['gifts'] = $this->Gifts->select_gifts('*',array('g.sales_man_id'=>$this->session->userdata('sales_man_data')->sales_man_id,'g.gift_delivery_status!='=>1))->result();

			$this->data['gifts_balance_qty'] = $this->Gifts->select_gifts('*,COALESCE(SUM(g.balance_quantity),0) as total_balance_quantity',array('g.sales_man_id'=>$this->session->userdata('sales_man_data')->sales_man_id))->row()->total_balance_quantity;

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

		



		$this->data['page']='gifts_list';
		$this->load->view('Index',$this->data);
	}

	public function create()
	{

		$data['gift_name'] = $this->security->xss_clean($this->input->post('gift_name'));
		$data['gift_quantity'] = $data['balance_quantity'] = $this->security->xss_clean($this->input->post('quantity'));
		$data['issued_quantity'] = 0;
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));


		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Gifts->create_gift($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Gift Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function select_gifts(){

		$json_data=array();
		$j=0;

		$data=array();


		if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
			$data['g.gift_delivery_status'] = $_POST['status'];
		}

		$result	= $this->Gifts->select_gifts("*,g.created_date as created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			if($this->session->userdata('user_role')=='master_admin'){

				$btn_edit = '<button data-toggle="modal" data-target="#gift_edit_modal" id="gift_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="gift_delete_btn" data-target="#gift_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			}else{
				$btn_delete = $btn_edit = '';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			if($row->gift_delivery_status==0){
				$gift_delivery_status = '<label class="label label-sm label-inline label-danger">Not&nbsp;Issuesd</lable>';
			}elseif ($row->gift_delivery_status==1) {
				$gift_delivery_status = '<label class="label label-sm label-inline label-success">Issuesd</lable>';
			}else{
				$gift_delivery_status = '<label class="label label-sm label-inline label-warning">Pending</lable>';
			}

			$quantities = 'Total - <strong>'.$row->gift_quantity.'</strong><br>'.'Issued - <strong>'.$row->issued_quantity.'</strong><br>'.'Balance - <strong>'.$row->balance_quantity.'</strong>';

			$array[$j][]=$j+1;
			$array[$j][]=$row->gift_name;
			$array[$j][]=$quantities.'<br>'.$gift_delivery_status;
			$array[$j][]=$row->remarks;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->gift_id;
			$array[$j][]=$row->gift_quantity;





			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['gift_id'] = $this->security->xss_clean($this->input->post('gift_id'));
		$data['delete_status'] = 1;

		$result = $this->Gifts->update_gift($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Gift Deleted Successfully!";
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
		$data['gift_id'] = $this->security->xss_clean($this->input->post('gift_id'));

		$data['gift_name'] = $this->security->xss_clean($this->input->post('gift_name'));
		$data['gift_quantity'] = $this->security->xss_clean($this->input->post('quantity'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));


		$data['updated_date'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Gifts->update_gift($data);

		if($result==1){

			$this->gift_management->calculate_gift_quantities($data['gift_id']);

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Gift Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function fetch_pending_gifts()
	{		
		$data['g.balance_quantity>'] = 0;
		$result	= $this->Gifts->select_gifts("*,g.created_date as created_date",$data);
		$output = $result->result();
		echo json_encode($output);
	}











	public function create_issued_gift()
	{

		$data['sales_man_id'] = $this->security->xss_clean($this->input->post('sales_man'));

		$data['gift_id'] = $this->security->xss_clean($this->input->post('gift'));
		$data['gift_issued_quantity'] = $this->security->xss_clean($this->input->post('quantity'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['due_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('due_date'))));

		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Gifts->create_gift_issued($data);

		if($result['status']==1){

			$this->gift_management->calculate_gift_quantities($data['gift_id']);

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Gift Issued Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}
	public function select_gifts_issued(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['gift']) && $_POST['gift']!='' && $_POST['gift']!='all'){
			$data['gi.gift_id'] = $_POST['gift'];
		}

		if(isset($_POST['sales_man']) && $_POST['sales_man']!='' && $_POST['sales_man']!='all'){
			$data['gi.sales_man_id'] = $_POST['sales_man'];
		}

		if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
			$data['gi.gift_issue_delivery_status'] = $_POST['status'];
		}

		if(isset($_POST['due_status']) && $_POST['due_status']!='' && $_POST['due_status']!='all'){
			$due_status = $_POST['due_status'];
			$data['gi.due_date!='] = '';
			if($due_status==0){
				$data['gi.due_date>'] = date('Y-m-d');
			}else{
				$data['gi.due_date<='] = date('Y-m-d');
			}
		}

		$result	= $this->Gifts->select_gifts_issued("*,gi.created_date as created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			if($this->session->userdata('user_role')=='master_admin'){

				$btn_edit = '<button data-toggle="modal" data-target="#gift_issue_update_modal" id="gift_issue_update_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="gift_issue_delete_btn" data-target="#gift_issue_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

				$btn_receive = ' ';

			}else{

				$btn_receive = '<button data-toggle="modal" data-target="#gift_issue_receive_modal" id="gift_issue_receive_btn" class="btn btn-sm btn-success m-1"> <i class="flaticon flaticon2-check-mark"></i> </button>';

				$btn_delete = $btn_edit = '';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			$quantities = 'Issued - <strong>'.$row->gift_issued_quantity.'</strong><br>'.'Delivered - <strong>'.$row->gift_delivered_quantity.'</strong><br>'.'Balance - <strong>'.$row->gift_balance_quantity.'</strong>';

			if($row->gift_issue_delivery_status==0){
				$gift_delivery_status = '<label class="label label-sm label-inline label-danger">Not&nbsp;Delivered</label>';
			}elseif ($row->gift_issue_delivery_status==1) {
				$gift_delivery_status = '<label class="label label-sm label-inline label-success">Delivered</label>';
			}else{
				$gift_delivery_status = '<label class="label label-sm label-inline label-warning">Pending&nbsp;Delivery</label>';
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
			$array[$j][]=$row->gift_name;
			$array[$j][]=$quantities;
			$array[$j][]=$received_status.'<br>'.$gift_delivery_status.$due_status;
			$array[$j][]=$row->sales_man_name;
			$array[$j][]=$row->remarks;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_receive.$btn_edit.$btn_delete;
			$array[$j][]=$row->issue_id;
			$array[$j][]=$row->sales_man_id;
			$array[$j][]=$row->gift_id;
			$array[$j][]=$row->gift_issued_quantity+$row->balance_quantity;
			$array[$j][]=($row->due_date!='') ? date('d-m-Y',strtotime($row->due_date)) : '' ;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function fetch_pending_gifts_issued()
	{
		if(isset($_POST['issue_id']) && $_POST['issue_id']!='' && $_POST['issue_id']!='all'){
			$data['gi.issue_id'] = $_POST['issue_id'];
		}

		if($this->session->userdata('user_role')=='sales_man'){
			$data['gi.sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
		}

		$data['gi.gift_balance_quantity>'] = 0;
		$result	= $this->Gifts->select_gifts_issued("*,gi.created_date as created_date",$data);
		$output = $result->result();
		echo json_encode($output);
	}

	public function get_issued_gift_info()
	{
		if(isset($_POST['issue_id']) && $_POST['issue_id']!='' && $_POST['issue_id']!='all'){
			$data['gi.issue_id'] = $_POST['issue_id'];
		}

		$result	= $this->Gifts->select_gifts_issued("*,gi.created_date as created_date",$data);

		$output = array();

		if($result->num_rows()==1){
			$output['gift'] = $result->row();
			$output['status'] = 1;
		}else{
			$output['gift'] = array();
			$output['status'] = 0;
		}
		echo json_encode($output);
	}



	public function delete_issued_gift()
	{
		$data['issue_id'] = $this->security->xss_clean($this->input->post('issue_id'));
		$data['delete_status'] = 1;

		$result = $this->Gifts->update_gift_issued($data);
		if($result==1){

			$gift_id = $this->security->xss_clean($this->input->post('gift_id'));
			$this->gift_management->calculate_gift_quantities($gift_id);

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Gift Issued Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}


	public function update_issued_gift()
	{
		$data['issue_id'] = $this->security->xss_clean($this->input->post('issue_id'));

		// $data['gift_id'] = $this->security->xss_clean($this->input->post('gift'));
		$data['gift_issued_quantity'] = $this->security->xss_clean($this->input->post('quantity'));
		$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
		$data['due_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('due_date'))));

		$data['updated_date'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Gifts->update_gift_issued($data);

		if($result==1){

			$gift_id = $this->security->xss_clean($this->input->post('gift_id'));
			// $data['gift_id'] = $this->security->xss_clean($this->input->post('gift'));

			$this->gift_management->calculate_gift_quantities($gift_id);
			// $this->gift_management->calculate_gift_quantities($gift_id);


			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Gift Issued Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}


	// receive_gift_issued

	public function receive_gift_issued()
	{
		$data['issue_id'] = $this->security->xss_clean($this->input->post('issue_id'));

		$data['received_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('received_date'))));
		$data['received_status'] = 1;

		$data['updated_date'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Gifts->update_gift_issued($data);

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


















	public function create_gift_delivery()
	{

		$data['issue_id'] = $this->security->xss_clean($this->input->post('issue_id'));
		
		$issue_row = $this->Gifts->select_gifts_issued('gi.gift_balance_quantity,gi.gift_id',$data)->row();
		$gift_balance_quantity = $issue_row->gift_balance_quantity;
		$gift_id = $issue_row->gift_id;

		$data['delivered_quantity'] = $this->security->xss_clean($this->input->post('quantity'));

		if($data['delivered_quantity']<=$gift_balance_quantity){

			$data['doctor_id'] = $this->security->xss_clean($this->input->post('doctor'));
			$data['delivered_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('delivered_date'))));

			$data['delivery_remarks'] = $this->security->xss_clean($this->input->post('remarks'));

			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			$result = $this->Gifts->create_gift_delivered($data); 

			if($result['status']==1){

				$this->gift_management->calculate_gift_quantities($gift_id);

				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Gift Delivery Added Successfully!";
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


	public function select_gifts_delivered(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['gift']) && $_POST['gift']!='' && $_POST['gift']!='all'){
			$data['gi.gift_id'] = $_POST['gift'];
		}

		if(isset($_POST['doctor']) && $_POST['doctor']!='' && $_POST['doctor']!='all'){
			$data['gd.doctor_id'] = $_POST['doctor'];
		}

		if(isset($_POST['sales_man']) && $_POST['sales_man']!='' && $_POST['sales_man']!='all'){
			$data['gi.sales_man_id'] = $_POST['sales_man'];
		}

		$result	= $this->Gifts->select_gifts_delivered("*,gd.created_date as created_date,d.name as name",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			if($this->session->userdata('user_role')=='sales_man'){

				$btn_edit = '<button data-toggle="modal" data-target="#gift_delivery_edit_modal" id="gift_delivery_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="gift_delivery_delete_btn" data-target="#gift_delivery_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';
			}else{
				$btn_delete = $btn_edit = '';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			
			$array[$j][]=$j+1;
			$array[$j][]=$row->name;
			$array[$j][]=$row->gift_name;
			$array[$j][]=$row->delivered_quantity;
			$array[$j][]=$row->sales_man_name;
			$array[$j][]=$row->delivery_remarks;
			$array[$j][]=date('d-m-Y',strtotime($row->delivered_date));
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->gift_id;
			$array[$j][]=$row->delivery_id;
			$array[$j][]=$row->doctor_id;
			$array[$j][]=$row->gift_balance_quantity+$row->delivered_quantity;


			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}


	public function delete_delivery()
	{
		$data['delivery_id'] = $this->security->xss_clean($this->input->post('delivery_id'));
		$data['delete_status'] = 1;

		$result = $this->Gifts->update_gift_delivered($data);
		if($result==1){

			$gift_id = $this->security->xss_clean($this->input->post('gift_id'));
			$this->gift_management->calculate_gift_quantities($gift_id);

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Gift Delivery Deleted Successfully!";
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


		$data['gift_id'] = $this->security->xss_clean($this->input->post('gift'));
		
		$gift_balance_quantity = $this->Gifts->select_gifts('g.balance_quantity',$data)->row()->balance_quantity;
		$data['transferred_quantity'] = $this->security->xss_clean($this->input->post('transfer_quantity'));

		if($data['transferred_quantity']<=$gift_balance_quantity){

			$data['transfer_id'] = $this->security->xss_clean($this->input->post('transfer_id'));

			$data['sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
			$data['doctor_id'] = $this->security->xss_clean($this->input->post('doctor'));
			$data['transferred_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('transfer_date'))));

			$data['transfer_remarks'] = $this->security->xss_clean($this->input->post('remarks'));

			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $this->session->userdata('user_id');

			$result = $this->Gifts->update_gift_delivered($data);

			if($result==1){

				$this->gift_management->calculate_gift_quantities($data['gift_id']);
				$gift_id = $this->security->xss_clean($this->input->post('gift_id'));
				$this->gift_management->calculate_gift_quantities($gift_id);


				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Gift Transfer Added Successfully!";
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


	public function fetch_gift_info()
	{
		$data['g.gift_id'] = $this->security->xss_clean($this->input->post('gift_id'));
		$gift = $this->Gifts->select_gifts("*",$data);
		$result['count'] = $gift->num_rows();
		$result['gift'] = $gift->row();
		echo json_encode($result);
	}

}