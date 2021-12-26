<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

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
		$this->load->model('Localities_model', 'Localities');


		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}
		else{
			// $allowed_users = array('master_admin','manager','sales_man');
			// if(!in_array($this->session->userdata('user_role'),$allowed_users)){
			// 	redirect(base_url(),'refresh');
			// }
		}

		$this->data['folder']='students';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['page']='students_list';
		$this->load->view('Index',$this->data);
	}

	public function register()
	{
		$this->data['page']='student_register';
		$this->load->view('Index',$this->data);
	}

	public function edit($edit_id='')
	{
		if(!empty($edit_id)){
			$this->data['edit_id']=$edit_id;
			$this->data['page']='student_edit';
			$this->load->view('Index',$this->data);
		}
		else{
			show_404();
		}
	}


	public function profile($id='')
	{
		// $allowed_users = array('master_admin','manager');
		// if(!in_array($this->session->userdata('user_role'),$allowed_users)){
		// 	redirect(base_url(),'refresh');
		// }

		// if($id!=''){
		// 	$sales_man_data = $this->Sales_men->select_sales_men('*,s.created_date as created_date,u.name as created_user,ur.role_name as created_user_role,s.localities as localities',array('s.sales_man_id'=>$id));
		// 	if($sales_man_data->num_rows()==1){

		// 		$this->data['sales_man_data'] = $sales_man_data->row();
		// 		$localities = array();

		// 		foreach (explode(',', $sales_man_data->row()->localities) as $key => $value) {
		// 			$locality = $this->Localities->select_localities('*',array('l.locality_id'=>$value));
		// 			if($locality->num_rows()==1){
		// 				$localities[] = $locality->row();
		// 			}
		// 		}


		// 		$this->data['sales_man_data']->localities = $localities;

		$this->data['page']='student_profile';
		$this->load->view('Index',$this->data);
		// 	}else{
		// 		show_404();
		// 	}
		// }else{
		// 	show_404();
		// }
	}

	public function update_profile(){

		$config['upload_path'] = './assets/media/sales_men/';
		$config['allowed_types'] = 'png||jpg||jpeg||svg';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 10000;
		$config['file_name'] = 'sales_man_photo_'.$this->session->userdata('sales_man_data')->sales_man_id; 
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('sales_man_photo')) {
			$data['profile_photo'] =  $this->upload->data('file_name');
			$data['sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;

			// exit(print_r($data));

			$result = $this->Sales_men->update_sales_man($data);

			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Profile updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$error = array('error' => $this->upload->display_errors());
			$flash_data['flashdata_msg'] = $error->error;
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}

	public function create()
	{

		$data['sales_man_name'] = $this->security->xss_clean($this->input->post('name'));
		$data['sales_man_location'] = $this->security->xss_clean($this->input->post('location'));
		$data['sales_man_email'] = $this->security->xss_clean($this->input->post('email'));
		$data['sales_man_contact'] = $this->security->xss_clean($this->input->post('contact'));
		$data['manager_id'] = $this->security->xss_clean($this->input->post('manager'));
		$data['sales_man_ta'] = $this->security->xss_clean($this->input->post('ta'));
		$data['sales_man_da'] = $this->security->xss_clean($this->input->post('da'));
		$data['sales_man_address'] = $this->security->xss_clean($this->input->post('address'));

		$localities = $this->security->xss_clean($this->input->post('localities[]'));
		if(isset($localities) && $localities!=''){
			$data['localities'] = implode(',', $localities);
		}else{
			$data['localities'] = '';
		}

		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$count = $this->User->select_user('u.user_id',array('u.username'=>$data['sales_man_email']))->num_rows();

		if($count==0){
			$data2['user_role'] = 3;
			$data2['username'] = $data['sales_man_email'];
			$data2['password'] = $this->Misc->generate_password();
			$data2['name'] = $data['sales_man_name'];

			$add_user = $this->User->create_user($data2);

			$data['user_id'] = $add_user['insert_id'];


			$result = $this->Sales_men->create_sales_man($data);

			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Sales man Added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'E Mail already in use !';
			$flash_data['flashdata_type'] = 'warning';
			$flash_data['alert_type'] = 'warning';
			$flash_data['flashdata_title'] = 'Duplicate !!';
		}

		echo json_encode($flash_data);

	}

	public function select_sales_men(){

		$json_data=array();
		$j=0;

		$data=array();


		if(isset($_POST['location']) && $_POST['location']!='' && $_POST['location']!='all'){
			$location = $_POST['location'];
			$this->db->where("FIND_IN_SET($location, s.localities)");
		}

		if(isset($_POST['manager']) && $_POST['manager']!='' && $_POST['manager']!='all'){
			$data['s.manager_id'] = $_POST['manager'];
		}

		$result	= $this->Sales_men->select_sales_men("*,u2.username as u2_username,u2.password as u2_password,u2.user_id as u2_user_id,s.localities as localities",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$whatsapp_message = 'Login to  :  '.config_item('app_name').' - '.base_url().' %0A username : '.$row->u2_username.' %0A Password : '.$row->u2_password;

			$copy_text = 'Login to  :  '.config_item('app_name').' - '.base_url().' username : '.$row->u2_username.' Password : '.$row->u2_password;

			$btn_copy = '<button class="btn btn-sm btn-info m-1" id="copy_login_btn"> <i class="flaticon2 flaticon2-copy"></i> </button>';

			$btn_whatsapp = '<a href="https://api.whatsapp.com/send?text='.$whatsapp_message.'" target="_blank" id="whatsapp_share_btn"  class="btn btn-sm btn-default m-1"> <i class="flaticon flaticon-whatsapp text-success icon-lg"></i> </a>';

			$btn_profile = '<a href="'.base_url().'sales_man/'.$row->sales_man_id.'" class="btn btn-sm btn-warning m-1"> <i class="flaticon flaticon-eye"></i> </a>';
			$btn_edit = '<button data-toggle="modal" data-target="#sales_man_edit_modal" id="sales_man_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="sales_man_delete_btn" data-target="#sales_man_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date)).'<br>By '.$row->name.'<br>'.'<span class="label label-lg label-dark label-inline mr-2">'.str_replace(' ', '&nbsp;', $row->role_name).'</span>';

			$array[$j][]=$j+1;
			$array[$j][]=$row->sales_man_name;
			$array[$j][]=$row->manager_name;
			$array[$j][]=$row->sales_man_location;
			$array[$j][]=$row->sales_man_email;
			$array[$j][]=$row->sales_man_contact;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_copy.$btn_whatsapp.$btn_profile.$btn_edit.$btn_delete;

			$array[$j][]=$row->sales_man_id;
			$array[$j][]=$row->u2_user_id;
			$array[$j][]=$row->manager_id;
			$array[$j][]=$row->sales_man_address;
			$array[$j][]=$row->sales_man_ta;
			$array[$j][]=$row->sales_man_da;
			$array[$j][]=$row->localities;
			$array[$j][]=$copy_text;



			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['sales_man_id'] = $this->security->xss_clean($this->input->post('sales_man_id'));
		$data2['user_id'] = $this->security->xss_clean($this->input->post('user_id'));
		$data['delete_status'] = $data2['delete_status'] = 1;

		$result = $this->Sales_men->update_sales_man($data);
		$result2 = $this->User->update_user($data2);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Sales Man Deleted Successfully!";
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
		$data['sales_man_id'] = $this->security->xss_clean($this->input->post('sales_man_id'));
		$data['user_id'] = $this->security->xss_clean($this->input->post('user_id'));

		$data['sales_man_name'] = $this->security->xss_clean($this->input->post('name'));
		$data['sales_man_location'] = $this->security->xss_clean($this->input->post('location'));
		$data['sales_man_email'] = $this->security->xss_clean($this->input->post('email'));
		$data['sales_man_contact'] = $this->security->xss_clean($this->input->post('contact'));
		$data['manager_id'] = $this->security->xss_clean($this->input->post('manager'));
		$data['sales_man_ta'] = $this->security->xss_clean($this->input->post('ta'));
		$data['sales_man_da'] = $this->security->xss_clean($this->input->post('da'));
		$data['sales_man_address'] = $this->security->xss_clean($this->input->post('address'));

		$localities = $this->security->xss_clean($this->input->post('localities[]'));
		if(isset($localities) && $localities!=''){
			$data['localities'] = implode(',', $localities);
		}else{
			$data['localities'] = '';
		}

		$data['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$data3['s.sales_man_email'] = $data4['u.username'] = $data['sales_man_email'];
		$data3['s.sales_man_id!='] = $data['sales_man_id'];
		$data4['u.user_id!='] = $data['user_id'];

		$count_sales_men = $this->Sales_men->select_sales_men('s.sales_man_id',$data3)->num_rows();
		$count_users = $this->User->select_user('u.user_id',$data4)->num_rows();

		if($count_sales_men==0 && $count_users==0){

			$data2['user_role'] = 3;
			$data2['username'] = $data['sales_man_email'];
			// $data2['password'] = $this->Misc->generate_password();
			$data2['name'] = $data['sales_man_name'];
			$data2['user_id'] = $data['user_id'];	

			$add_user = $this->User->update_user($data2);

			$data['user_id'] = $data['user_id'];

			$result = $this->Sales_men->update_sales_man($data);

			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Sales man updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'E Mail already in use !';
			$flash_data['flashdata_type'] = 'warning';
			$flash_data['alert_type'] = 'warning';
			$flash_data['flashdata_title'] = 'Duplicate !!';
		}

		echo json_encode($flash_data);


	}





	public function fetch_chart_data()
	{
		$data = array();

		$id = $this->security->xss_clean($this->input->post('id'));

		if($id!='all'){
			$data['s.sales_man_id'] = $id;
		}
		
		$start_date = date('Y-m-d',strtotime('-5 months',strtotime(date('Y-m-d'))));
		$end_date = date('Y-m-d',strtotime('+1 months',strtotime(date('Y-m-d'))));

		$interval = new DateInterval('P1M');
		$start = new DateTime($start_date);
		$end = new DateTime($end_date);
		$period = new DatePeriod($start, $interval, $end);

		$chart_data['sales_men'] = array();
		$chart_data['values'] = array();



		$sales_men=$this->Sales_men->select_sales_men('*',$data);
		// exit(print_r($members->num_rows()));
		foreach ($sales_men->result() as $key => $sales_man) {
			$chart_data['sales_men'][] =  $sales_man->sales_man_name;
			foreach ($period as $dt) {

				$data2['sw.sales_man_id'] = $sales_man->sales_man_id;
				$data2['sw.work_log_date>='] = $dt->format('Y-m-01');
				$data2['sw.work_log_date<'] = $dt->format('Y-m-t');

				$count = $this->Work_logs->select_work_logs('*',$data2)->num_rows();

				$chart_data['values'][$dt->format('Y F')][] = $count;

			}
		}


		echo json_encode($chart_data);
	}



}