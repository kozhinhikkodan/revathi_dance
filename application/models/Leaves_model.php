<?php
class Leaves_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_leaves($columns='*',$data='')
	{

		$this->db->select($columns)->from('leaves l');
		$this->db->join('sales_men s','s.sales_man_id=l.sales_man_id');
		$this->db->join('users u','s.created_by=u.user_id');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('l.delete_status','0');
		$this->db->where('s.delete_status','0');

		$this->db->order_by('l.leave_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_leave($data)
	{
		$query = $this->db->insert('leaves', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_leave($data){
		$this->db->where('leave_id', $data['leave_id']);
		$query = $this->db->update('leaves', $data);
		return $query;
	}
	
	
}
?>
