<?php
class Work_logs_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_work_logs($columns='*',$data='')
	{

		$this->db->select($columns)->from('sales_man_work_logs sw');

		$this->db->join('localities l','l.locality_id=sw.locality_id','left');
		$this->db->join('location_districts ld','l.district_id=ld.district_id','left');
		$this->db->join('location_states ls','l.state_id=ls.state_id','left');

		$this->db->join('sales_men s','sw.sales_man_id=s.sales_man_id');

		$this->db->join('doctors d','sw.doctor_id=d.doctor_id');

		$this->db->join('users u','sw.created_by=u.user_id');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('sw.delete_status','0');
		$this->db->where('u.delete_status','0');
		$this->db->where('s.delete_status','0');


		$this->db->order_by('sw.work_log_id','dsc');
		$query = $this->db->get();
		return $query;
	}

	public function create_work_log($data)
	{
		$query = $this->db->insert('sales_man_work_logs', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_work_log($data){
		$this->db->where('work_log_id', $data['work_log_id']);
		$query = $this->db->update('sales_man_work_logs', $data);
		return $query;
	}
	
	


	public function select_surveys($columns='*',$data='')
	{

		$this->db->select($columns)->from('surveys su');

		$this->db->join('localities l','l.locality_id=su.locality_id','left');
		$this->db->join('location_districts ld','l.district_id=ld.district_id','left');
		$this->db->join('location_states ls','l.state_id=ls.state_id','left');

		$this->db->join('sales_men s','su.sales_man_id=s.sales_man_id');


		$this->db->join('users u','su.created_by=u.user_id');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('su.delete_status','0');
		$this->db->where('u.delete_status','0');
		// $this->db->where('s.delete_status','0');


		$this->db->order_by('su.survey_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_survey($data)
	{
		$query = $this->db->insert('surveys', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_survey($data){
		$this->db->where('survey_id', $data['survey_id']);
		$query = $this->db->update('surveys', $data);
		return $query;
	}
	


}
?>
