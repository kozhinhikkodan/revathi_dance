<?php
class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_user($columns='*',$data='')
	{
		$this->db->select($columns)->from('users u');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');
		
		if(!empty($data)){
			$this->db->where($data);
		}
		$this->db->where('u.delete_status',0);
		$this->db->order_by('u.user_id','desc');
		$query = $this->db->get();
		return $query;
	}
	public function create_user($data)
	{
		$query = $this->db->insert('users', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_user($data){
		$this->db->where('user_id', $data['user_id']);
		$query = $this->db->update('users', $data);
		return $query;
	}
	
	public function select_user_roles($columns='*',$data='')
	{
		$this->db->select($columns)->from('user_roles ur');
		
		if(!empty($data)){
			$this->db->where($data);
		}
		$this->db->order_by('ur.role_id','asc');
		$query = $this->db->get();
		return $query;
	}
	
	
}
?>
