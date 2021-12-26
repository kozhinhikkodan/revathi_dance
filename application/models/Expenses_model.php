<?php
class Expenses_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_expenses($columns='*',$data='')
	{

		$this->db->select($columns)->from('expenses e');
		$this->db->join('users u','e.created_by=u.user_id');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('e.delete_status','0');
		$this->db->where('u.delete_status','0');

		$this->db->order_by('e.expense_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_expense($data)
	{
		$query = $this->db->insert('expenses', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_expense($data){
		$this->db->where('expense_id', $data['expense_id']);
		$query = $this->db->update('expenses', $data);
		return $query;
	}
	
	
}
?>
