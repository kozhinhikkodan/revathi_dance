<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managers extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Misc_model', 'Misc');

		$this->load->model('Localities_model', 'Localities');
		$this->load->model('Managers_model', 'Managers');
		$this->load->model('Managers_work_logs_model', 'Managers_work_logs');




		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}
		else{
			$allowed_users = array('master_admin');
			if(!in_array($this->session->userdata('user_role'),$allowed_users)){
				redirect(base_url(),'refresh');
			}
		}

		$this->data['folder']='managers';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['localities'] = $this->Localities->select_localities('*',array('l.locality_status'=>1))->result();
		$this->data['page']='managers_list';
		$this->load->view('Index',$this->data);
	}

	public function profile($id='')
	{
		if($id!=''){
			$manager_data = $this->Managers->select_managers('*',array('m.manager_id'=>$id));
			if($manager_data->num_rows()==1){

				$this->data['manager_data'] = $manager_data->row();
				$localities = array();
				foreach (explode(',', $manager_data->row()->manager_localities) as $key => $value) {
					$localities[] = $this->Localities->select_localities('*',array('l.locality_id'=>$value))->row();
				}
				$this->data['manager_data']->localities = $localities;

				$this->data['page']='manager_profile';
				$this->load->view('Index',$this->data);

			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function create()
	{

		$data['manager_name'] = $this->security->xss_clean($this->input->post('name'));
		$data['manager_location'] = $this->security->xss_clean($this->input->post('location'));
		$data['manager_email'] = $this->security->xss_clean($this->input->post('email'));
		$data['manager_contact_no'] = $this->security->xss_clean($this->input->post('contact'));
		$data['manager_localities'] = implode(',', $this->security->xss_clean($this->input->post('localities[]')));
		$data['manager_address'] = $this->security->xss_clean($this->input->post('address'));
		$data['manager_ta'] = $this->security->xss_clean($this->input->post('ta'));
		$data['manager_da'] = $this->security->xss_clean($this->input->post('da'));
		$data['created_date'] = $data2['created_date'] = date('Y-m-d h:i:s');
		$data['created_by'] = $data2['created_by'] = $this->session->userdata('user_id');

		$count = $this->User->select_user('u.user_id',array('u.username'=>$data['manager_email']))->num_rows();

		if($count==0){
			$data2['user_role'] = 2;
			$data2['username'] = $data['manager_email'];
			$data2['password'] = $this->Misc->generate_password();
			$data2['name'] = $data['manager_name'];

			$add_user = $this->User->create_user($data2);

			$data['user_id'] = $add_user['insert_id'];

			$result = $this->Managers->create_manager($data);

			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Manager Added Successfully!";
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

	public function select_managers(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['location']) && $_POST['location']!='' && $_POST['location']!='all'){
			$location = $_POST['location'];
			$this->db->where("FIND_IN_SET($location, m.manager_localities)");
		}

		$result	= $this->Managers->select_managers("*,m.created_date as created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$whatsapp_message = 'Login to  :  '.config_item('app_name').' - '.base_url().' %0A username : '.$row->username.' %0A Password : '.$row->password;

			$copy_text = 'Login to  :  '.config_item('app_name').' - '.base_url().' username : '.$row->username.'  Password : '.$row->password;

			$btn_copy = '<button class="btn btn-sm btn-info m-1" id="copy_login_btn"> <i class="flaticon2 flaticon2-copy"></i> </button>';

			$btn_whatsapp = '<a href="https://api.whatsapp.com/send?text='.$whatsapp_message.'" target="_blank" id="whatsapp_share_btn"  class="btn btn-sm btn-default m-1"> <i class="flaticon flaticon-whatsapp text-success icon-lg"></i> </a>';

			$btn_profile = '<a href="'.base_url().'manager/'.$row->manager_id.'" class="btn btn-sm btn-warning m-1"> <i class="flaticon flaticon-eye"></i> </a>';
			$btn_edit = '<button data-toggle="modal" data-target="#manager_edit_modal" id="manager_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="manager_delete_btn" data-target="#manager_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			$array[$j][]=$j+1;
			$array[$j][]=$row->manager_name;
			$array[$j][]=$row->manager_location;
			$array[$j][]=$row->manager_email;
			$manager_localities = '';
			foreach (explode(',', $row->manager_localities) as $key => $value) {
				$locality = $this->Localities->select_localities('*',array('l.locality_id'=>$value))->row();
				$locality_name = str_replace(' ', '&nbsp;', $locality->locality_name);
				$district_name = str_replace(' ', '&nbsp;', $locality->district_name);
				$state_name = str_replace(' ', '&nbsp;', $locality->state_name);
				$manager_localities .= '<span class="label label-lg label-dark label-inline mb-2">'.$locality_name.'&nbsp;-&nbsp;'.$district_name.',&nbsp;'.$state_name.'</span><br>';
			}
			$array[$j][]=$manager_localities;
			$array[$j][]=$row->manager_contact_no;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_copy.$btn_whatsapp.$btn_profile.$btn_edit.$btn_delete;
			$array[$j][]=$row->manager_id;
			$array[$j][]=$row->user_id;
			$array[$j][]=$row->manager_address;
			$array[$j][]=$row->manager_localities;
			$array[$j][]=$row->manager_ta;
			$array[$j][]=$row->manager_da;
			$array[$j][]=$copy_text;



			
			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['manager_id'] = $this->security->xss_clean($this->input->post('manager_id'));
		$data2['user_id'] = $this->security->xss_clean($this->input->post('user_id'));
		$data['delete_status'] = $data2['delete_status'] = 1;

		$result = $this->Managers->update_manager($data);
		$result2 = $this->User->update_user($data2);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Manager Deleted Successfully!";
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
		$data['manager_id'] = $this->security->xss_clean($this->input->post('manager_id'));
		$data['user_id'] = $this->security->xss_clean($this->input->post('user_id'));

		$data['manager_name'] = $this->security->xss_clean($this->input->post('name'));
		$data['manager_location'] = $this->security->xss_clean($this->input->post('location'));
		$data['manager_email'] = $this->security->xss_clean($this->input->post('email'));
		$data['manager_contact_no'] = $this->security->xss_clean($this->input->post('contact'));
		$data['manager_localities'] = implode(',', $this->security->xss_clean($this->input->post('localities[]')));
		$data['manager_address'] = $this->security->xss_clean($this->input->post('address'));

		$data['manager_ta'] = $this->security->xss_clean($this->input->post('ta'));
		$data['manager_da'] = $this->security->xss_clean($this->input->post('da'));

		$data['updated_date'] = $data2['updated_date'] = date('Y-m-d h:i:s');
		$data['updated_by'] = $data2['updated_by'] = $this->session->userdata('user_id');


		$data3['m.manager_email'] = $data4['u.username'] = $data['manager_email'];
		$data3['m.manager_id!='] = $data['manager_id'];
		$data4['u.user_id!='] = $data['user_id'];

		$count_managers = $this->Managers->select_managers('m.manager_id',$data3)->num_rows();
		$count_users = $this->User->select_user('u.user_id',$data4)->num_rows();

		if($count_managers==0 && $count_users==0){
			$data2['username'] = $data['manager_email'];
			$data2['name'] = $data['manager_name'];
			$data2['user_id'] = $data['user_id'];

			$add_user = $this->User->update_user($data2);
			$result = $this->Managers->update_manager($data);

			if($result=1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Manager Updated Successfully!";
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
			$data['m.manager_id'] = $id;
		}
		
		$start_date = date('Y-m-d',strtotime('-5 months',strtotime(date('Y-m-d'))));
		$end_date = date('Y-m-d',strtotime('+1 months',strtotime(date('Y-m-d'))));

		$interval = new DateInterval('P1M');
		$start = new DateTime($start_date);
		$end = new DateTime($end_date);
		$period = new DatePeriod($start, $interval, $end);

		$chart_data['managers'] = array();
		$chart_data['values'] = array();



		$managers=$this->Managers->select_managers('*',$data);
		// exit(print_r($members->num_rows()));
		foreach ($managers->result() as $key => $manager) {
			$chart_data['managers'][] =  $manager->manager_name;
			foreach ($period as $dt) {

				$data2['mw.manager_id'] = $manager->manager_id;
				$data2['mw.work_log_date>='] = $dt->format('Y-m-01');
				$data2['mw.work_log_date<'] = $dt->format('Y-m-t');

				$count = $this->Managers_work_logs->select_work_logs('*',$data2)->num_rows();

				$chart_data['values'][$dt->format('Y F')][] = $count;

			}
		}


		echo json_encode($chart_data);
	}



}