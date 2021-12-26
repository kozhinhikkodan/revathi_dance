<?php
class Tour_plan_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_tour_plans($columns='*',$data='')
	{

		$this->db->select($columns)->from('tour_plans tp');

		$this->db->join('localities l','l.locality_id=tp.locality_id','left');
		$this->db->join('location_districts ld','l.district_id=ld.district_id','left');
		$this->db->join('location_states ls','l.state_id=ls.state_id','left');

		$this->db->join('sales_men s','tp.sales_man_id=s.sales_man_id');
		$this->db->join('users u','tp.created_by=u.user_id');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('tp.delete_status','0');
		$this->db->where('s.delete_status','0');

		$this->db->order_by('tp.tour_plan_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_tour_plan($data)
	{
		$query = $this->db->insert('tour_plans', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_tour_plan($data){
		$this->db->where('tour_plan_id', $data['tour_plan_id']);
		$query = $this->db->update('tour_plans', $data);
		return $query;
	}
	
	
}
?>
