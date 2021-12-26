<?php
class Managers_work_logs_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_work_logs($columns='*',$data='')
	{

		$this->db->select($columns)->from('manager_work_logs mw');
		$this->db->join('managers m','m.manager_id=mw.manager_id');
		$this->db->join('sales_men s','s.sales_man_id=mw.sales_man_id');
		$this->db->join('localities l','l.locality_id=mw.locality_id','left');
		$this->db->join('location_districts ld','l.district_id=ld.district_id','left');
		$this->db->join('location_states ls','l.state_id=ls.state_id','left');


		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('m.delete_status','0');
		$this->db->where('mw.delete_status','0');


		$this->db->order_by('mw.work_log_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_work_log($data)
	{
		$query = $this->db->insert('manager_work_logs', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_work_log($data){
		$this->db->where('work_log_id', $data['work_log_id']);
		$query = $this->db->update('manager_work_logs', $data);
		return $query;
	}
	
	
}
?>
