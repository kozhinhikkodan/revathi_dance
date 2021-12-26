<?php
class Samples_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function select_samples($columns='*',$data='')
	{

		$this->db->select($columns)->from('samples sa');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('sa.delete_status','0');


		$this->db->order_by('sa.sample_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_sample($data)
	{
		$query = $this->db->insert('samples', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_sample($data){
		$this->db->where('sample_id', $data['sample_id']);
		$query = $this->db->update('samples', $data);
		return $query;
	}






	public function select_samples_issued($columns='*',$data='')
	{

		$this->db->select($columns)->from('samples_issued sai');
		$this->db->join('samples sa','sa.sample_id=sai.sample_id');
		$this->db->join('sales_men s','s.sales_man_id=sai.sales_man_id');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('sai.delete_status','0');
		$this->db->where('sa.delete_status','0');
		$this->db->where('s.delete_status','0');

		$this->db->order_by('sai.issue_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_sample_issued($data)
	{
		$query = $this->db->insert('samples_issued', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_sample_issued($data){
		$this->db->where('issue_id', $data['issue_id']);
		$query = $this->db->update('samples_issued', $data);
		return $query;
	}








	public function select_samples_delivered($columns='*',$data='')
	{

		$this->db->select($columns)->from('samples_delivered sad');

		$this->db->join('samples_issued sai','sai.issue_id=sad.issue_id');
		$this->db->join('sales_men s','s.sales_man_id=sai.sales_man_id');
		$this->db->join('samples sa','sa.sample_id=sai.sample_id');
		$this->db->join('doctors d','sad.doctor_id=d.doctor_id');


		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('sad.delete_status','0');
		$this->db->where('sai.delete_status','0');
		$this->db->where('sa.delete_status','0');


		$this->db->order_by('sad.delivery_id','asc');
		$query = $this->db->get();
		return $query;
	}


	public function create_sample_delivered($data)
	{
		$query = $this->db->insert('samples_delivered', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_sample_delivered($data){
		$this->db->where('delivery_id', $data['delivery_id']);
		$query = $this->db->update('samples_delivered', $data);
		return $query;
	}
	
	
}
?>
