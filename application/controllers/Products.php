<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Products_model', 'Products');


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

		$this->data['folder']='products';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['product_categories'] = $this->Products->select_product_categories('*')->result();
		
		$this->data['page'] = 'products_list';
		$this->load->view('Index',$this->data);
	}

	public function categories()
	{		
		$this->data['page'] = 'product_categories_list';
		$this->load->view('Index',$this->data);
	}


	public function create()
	{

		$data['product_name'] = $this->security->xss_clean($this->input->post('name'));
		$data['product_category'] = $this->security->xss_clean($this->input->post('category'));

		if (isset($_FILES['product_image']) && $_FILES['product_image']["size"] > 0) {
			$config['upload_path']   = 'uploads/products/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['overwrite']      = FALSE;
			$config['encrypt_name']    = TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('product_image')) {
				$error = array('error' => $this->upload->display_errors());
				$file_error = 1;
				$flash_data['flashdata_msg'] = $error['error'];
				$flash_data['flashdata_type'] = "warning";
				$flash_data['flashdata_title'] = "Uploaded File Error";
				$flash_data['status'] = 2;
			}else {
				$file_data = $this->upload->data();
				$data['product_file_name'] = $file_data['file_name'];
			}
		}

		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		if($this->session->userdata('user_role')=='sales_man'){
			$data['product_status'] = 0;
		}else{
			$data['product_status'] = 1;
		}

		$result = $this->Products->create_product($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Product Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function select_products(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['category']) && $_POST['category']!='' && $_POST['category']!='all'){
			$data['p.product_category'] = $_POST['category'];
		}

		if($this->session->userdata('user_role')=='sales_man'){
			$data['p.product_status'] = 1;
		}

		$result	= $this->Products->select_products("*,p.created_date as created_date,p.product_status as product_status",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_edit = '<button data-toggle="modal" data-target="#product_edit_modal" id="product_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="product_delete_btn" data-target="#product_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date)).'<br>By '.$row->name.'<br>'.'<span class="label label-lg label-dark label-inline mr-2">'.str_replace(' ', '&nbsp;', $row->role_name).'</span>';


			if($row->product_status==0){
				$product_status = '<label class="label label-sm label-inline label-warning">Pending</lable>';
			}elseif ($row->product_status==1) {
				$product_status = '<label class="label label-sm label-inline label-success">Approved</lable>';
			}else{
				$product_status = '<label class="label label-sm label-inline label-danger">Rejected</lable>';
			}
			$added_info .= '<br>'.$product_status;

			$array[$j][]=$j+1;
			$array[$j][]='<span class="label label-md label-inline  font-weight-bold label-rounded label-dark">'.str_replace(' ', '&nbsp;', $row->product_category).'</span>';
			$array[$j][]=$row->product_name;
			$array[$j][]='<a href="'.base_url().'uploads/products/'.$row->product_file_name.'" ><img src="'.base_url().'uploads/products/'.$row->product_file_name.'" width="50%" ></a>';
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->product_id;
			$array[$j][]=$row->product_file_name;
			$array[$j][]=$row->product_category;
			$array[$j][]=$row->product_status;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['product_id'] = $this->security->xss_clean($this->input->post('product_id'));
		$data['delete_status'] = 1;

		$result = $this->Products->update_product($data);
		if($result==1){

			$filename = $this->security->xss_clean($this->input->post('product_file_name'));
			if($filename!='' && file_exists(FCPATH . 'uploads/products/'.$filename)){
				unlink(FCPATH . 'uploads/products/'.$filename);
			}

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Product Deleted Successfully!";
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
		$data['product_id'] = $this->security->xss_clean($this->input->post('product_id'));

		$data['product_name'] = $this->security->xss_clean($this->input->post('name'));
		$data['product_category'] = $this->security->xss_clean($this->input->post('category'));

		if (isset($_FILES['product_image']) && $_FILES['product_image']["size"] > 0) {
			$config['upload_path']   = 'uploads/products/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['overwrite']      = FALSE;
			$config['encrypt_name']    = TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('product_image')) {
				$error = array('error' => $this->upload->display_errors());
				$file_error = 1;
				$flash_data['flashdata_msg'] = $error['error'];
				$flash_data['flashdata_type'] = "warning";
				$flash_data['flashdata_title'] = "Uploaded File Error";
				$flash_data['status'] = 2;
			}else {
				$file_data = $this->upload->data();
				$data['product_file_name'] = $file_data['file_name'];
			}
		}

		$data['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		if($this->session->userdata('user_role')!='sales_man'){
			$data['product_status'] = $this->security->xss_clean($this->input->post('product_status_radio'));
		}

		$result = $this->Products->update_product($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Product Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}









	public function select_product_categories(){

		$json_data=array();
		$j=0;

		$data=array();

		$result	= $this->Products->select_product_categories("*",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_edit = '<button data-toggle="modal" data-target="#product_category_edit_modal" id="product_category_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="product_category_delete_btn" data-target="#product_category_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';



			$array[$j][]=$j+1;
			$array[$j][]=$row->category_name;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->category_id;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}


	public function create_category()
	{

		$data['category_name'] = $this->security->xss_clean($this->input->post('name'));
		$count	= $this->Products->select_product_categories("*",$data)->num_rows();
		
		if($count==0){

			$result = $this->Products->create_product_category($data);

			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Product Category Added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'This Category already added!';
			$flash_data['flashdata_type'] = 'warning';
			$flash_data['alert_type'] = 'warning';
			$flash_data['flashdata_title'] = 'Duplicate !!';
		}

		echo json_encode($flash_data);

	}


	public function update_category()
	{

		$data['category_name'] = $data2['category_name'] = $this->security->xss_clean($this->input->post('name'));
		$data['category_id'] = $data2['category_id!='] = $this->security->xss_clean($this->input->post('category_id'));

		$count	= $this->Products->select_product_categories("*",$data2)->num_rows();
		
		if($count==0){

			$result = $this->Products->update_product_category($data);

			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Product Category Updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'This Category already added!';
			$flash_data['flashdata_type'] = 'warning';
			$flash_data['alert_type'] = 'warning';
			$flash_data['flashdata_title'] = 'Duplicate !!';
		}

		echo json_encode($flash_data);

	}


	public function delete_category()
	{
		$data['category_id'] = $this->security->xss_clean($this->input->post('category_id'));
		$data['delete_status'] = 1;

		$result = $this->Products->update_product_category($data);
		if($result==1){

			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Product Category Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}





}