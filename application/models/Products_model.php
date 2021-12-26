<?php
class Products_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_products($columns='*',$data='')
	{

		$this->db->select($columns)->from('products p');
		$this->db->join('users u','p.created_by=u.user_id');
		$this->db->join('user_roles ur','u.user_role=ur.role_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('p.delete_status','0');
		$this->db->where('u.delete_status','0');

		$this->db->order_by('p.product_id','asc');
		$query = $this->db->get();
		return $query;
	}

		public function select_product_categories($columns='*',$data='')
	{

		$this->db->select($columns)->from('product_categories pc');

		if(!empty($data)){
			$this->db->where($data);
		}

		$this->db->where('pc.delete_status','0');

		
		$this->db->order_by('pc.category_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_product($data)
	{
		$query = $this->db->insert('products', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_product($data){
		$this->db->where('product_id', $data['product_id']);
		$query = $this->db->update('products', $data);
		return $query;
	}


	public function create_product_category($data)
	{
		$query = $this->db->insert('product_categories', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_product_category($data){
		$this->db->where('category_id', $data['category_id']);
		$query = $this->db->update('product_categories', $data);
		return $query;
	}
	
	
}
?>
