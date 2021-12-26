<?php
class Managers_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_managers($columns='*',$data='')
	{

		$this->db->select($columns)->from('managers m');
		$this->db->join('users u','m.user_id=u.user_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('m.delete_status','0');
		$this->db->where('u.delete_status','0');

		$this->db->order_by('m.manager_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_manager($data)
	{
		$query = $this->db->insert('managers', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_manager($data){
		$this->db->where('manager_id', $data['manager_id']);
		$query = $this->db->update('managers', $data);
		return $query;
	}
	
	
}
?>
