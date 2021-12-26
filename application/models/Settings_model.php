<?php
class Settings_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function select_setting_config($columns='*',$data='',$join="")
	{
		$this->db->select($columns)->from('settings s');
		
		if(!empty($data)){
			$this->db->where($data);
		}
		$this->db->order_by('s.setting_id','asc');
		$query = $this->db->get();
		return $query;
	}


	public function update_config($data){
		$this->db->where('setting_name', $data['setting_name']);
		$query = $this->db->update('settings', $data);
		return $query;
	}

	public function update_config_by_id($data){
		$this->db->where('setting_id', $data['setting_id']);
		$query = $this->db->update('settings', $data);
		return $query;
	}

		public function select_app_modules($columns='*',$data='',$join="")
	{
		$this->db->select($columns)->from('app_modules am');
		
		if(!empty($data)){
			$this->db->where($data);
		}
		$this->db->order_by('am.module_id','asc');
		$query = $this->db->get();
		return $query;
	}

	
	
}
?>
