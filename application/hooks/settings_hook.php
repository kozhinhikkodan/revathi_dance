<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_hook {

	function __construct()
	{
		
	}
	public function get_seetings()
	{

		if(file_exists(APPPATH.'config/config.php')){
			include(APPPATH.'config/config.php');

			$CI =& get_instance();
			$CI->load->library('session');
			$CI->load->model('User_model','User');
			$CI->load->model('Settings_model', 'Settings');
			$CI->load->model('Localities_model', 'Localities');
			$CI->load->model('Doctors_model', 'Doctors');
			$CI->load->model('Work_logs_model', 'Work_logs');

			if(empty($CI->session->userdata('user_id')) && strtolower($CI->router->fetch_class())!='login' && strtolower($CI->router->fetch_class())!='maintanance' && strtolower($CI->router->fetch_class())!='cron' ){
				redirect(base_url(),'refresh');
			}

			$settings = $CI->Settings->select_setting_config('*')->result();
			foreach ($settings as $key => $value) {
				$CI->config->set_item($value->setting_name,$value->value);
			}

			

		}

	}

}


