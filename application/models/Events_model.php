<?php
class Events_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function select_events($columns='*',$data='')
	{

		$this->db->select($columns)->from('events e');
		$this->db->join('users u','u.user_id=e.created_by');
		$this->db->join('user_roles ur','ur.role_id=u.user_role');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('e.delete_status','0');

		$this->db->order_by('e.event_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_event($data)
	{
		$query = $this->db->insert('events', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_event($data){
		$this->db->where('event_id', $data['event_id']);
		$query = $this->db->update('events', $data);
		return $query;
	}
	
	
}
?>
