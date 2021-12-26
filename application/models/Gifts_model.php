<?php
class Gifts_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_gifts($columns='*',$data='')
	{

		$this->db->select($columns)->from('gifts g');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('g.delete_status','0');


		$this->db->order_by('g.gift_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_gift($data)
	{
		$query = $this->db->insert('gifts', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_gift($data){
		$this->db->where('gift_id', $data['gift_id']);
		$query = $this->db->update('gifts', $data);
		return $query;
	}






	public function select_gifts_issued($columns='*',$data='')
	{

		$this->db->select($columns)->from('gifts_issued gi');
		$this->db->join('gifts g','g.gift_id=gi.gift_id');
		$this->db->join('sales_men s','s.sales_man_id=gi.sales_man_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('gi.delete_status','0');
		$this->db->where('g.delete_status','0');
		$this->db->where('s.delete_status','0');

		$this->db->order_by('gi.issue_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_gift_issued($data)
	{
		$query = $this->db->insert('gifts_issued', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_gift_issued($data){
		$this->db->where('issue_id', $data['issue_id']);
		$query = $this->db->update('gifts_issued', $data);
		return $query;
	}








	public function select_gifts_delivered($columns='*',$data='')
	{

		$this->db->select($columns)->from('gifts_delivered gd');

		$this->db->join('gifts_issued gi','gi.issue_id=gd.issue_id');
		$this->db->join('sales_men s','s.sales_man_id=gi.sales_man_id');
		$this->db->join('gifts g','g.gift_id=gi.gift_id');
		$this->db->join('doctors d','gd.doctor_id=d.doctor_id');


		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('gd.delete_status','0');
		$this->db->where('gi.delete_status','0');
		$this->db->where('g.delete_status','0');


		$this->db->order_by('gd.delivery_id','asc');
		$query = $this->db->get();
		return $query;
	}


	public function create_gift_delivered($data)
	{
		$query = $this->db->insert('gifts_delivered', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_gift_delivered($data){
		$this->db->where('delivery_id', $data['delivery_id']);
		$query = $this->db->update('gifts_delivered', $data);
		return $query;
	}
	
	
}
?>
