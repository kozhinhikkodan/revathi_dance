<?php
class Localities_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_states($columns='*',$data='')
	{

		$this->db->select($columns)->from('location_states s');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('s.status','Active');

		$this->db->order_by('s.state_id','asc');
		$query = $this->db->get();
		return $query;
	}


	public function select_districts($columns='*',$data='')
	{

		$this->db->select($columns)->from('location_districts d');
		$this->db->join('location_states s','d.state_id=s.state_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('d.district_status','Active');

		$this->db->order_by('d.district_id','asc');
		$query = $this->db->get();
		return $query;
	}


	public function select_localities($columns='*',$data='')
	{

		$this->db->select($columns)->from('localities l');
		$this->db->join('location_districts d','l.district_id=d.district_id','left');
		$this->db->join('location_states s','l.state_id=s.state_id','left');
		$this->db->join('users u','l.created_by=u.user_id');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('d.district_status','Active');
		$this->db->where('s.status','Active');
		$this->db->where('l.delete_status','0');

		$this->db->order_by('l.locality_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_locality($data)
	{
		$query = $this->db->insert('localities', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_locality($data){
		$this->db->where('locality_id', $data['locality_id']);
		$query = $this->db->update('localities', $data);
		return $query;
	}
	
	
}
?>
