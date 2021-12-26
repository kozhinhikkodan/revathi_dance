<?php
class Sales_men_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_sales_men($columns='*',$data='')
	{

		$this->db->select($columns)->from('sales_men s');
		$this->db->join('users u2','s.user_id=u2.user_id');
		$this->db->join('managers m','s.manager_id=m.manager_id');
		$this->db->join('users u','s.created_by=u.user_id');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('s.delete_status','0');
		$this->db->where('u2.delete_status','0');

		$this->db->order_by('s.sales_man_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_sales_man($data)
	{
		$query = $this->db->insert('sales_men', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_sales_man($data){
		$this->db->where('sales_man_id', $data['sales_man_id']);
		$query = $this->db->update('sales_men', $data);
		return $query;
	}
	
	
}
?>
