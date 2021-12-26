<?php
class Doctors_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

 
	public function select_doctors($columns='*',$data='')
	{

		$this->db->select($columns)->from('doctors d');
		$this->db->join('users u','u.user_id=d.created_by');
		$this->db->join('user_roles ur','ur.role_id=u.user_role');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('d.delete_status','0');

		$this->db->order_by('d.name','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_doctor($data)
	{
		$query = $this->db->insert('doctors', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_doctor($data){
		$this->db->where('doctor_id', $data['doctor_id']);
		$query = $this->db->update('doctors', $data);
		return $query;
	}
	


	public function select_qualifications($columns='*',$data='')
	{

		$this->db->select($columns)->from('qualifications q');
		$this->db->join('users u','u.user_id=q.created_by');
		$this->db->join('user_roles ur','ur.role_id=u.user_role');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('q.delete_status','0');

		$this->db->order_by('q.qualification_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_qualification($data)
	{
		$query = $this->db->insert('qualifications', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_qualification($data){
		$this->db->where('qualification_id', $data['qualification_id']);
		$query = $this->db->update('qualifications', $data);
		return $query;
	}
	


		public function select_specialities($columns='*',$data='')
	{

		$this->db->select($columns)->from('specialities s');
		$this->db->join('users u','u.user_id=s.created_by');
		$this->db->join('user_roles ur','ur.role_id=u.user_role');

		if(!empty($data)){
			$this->db->where($data);
		}
		
		$this->db->where('s.delete_status','0');

		$this->db->order_by('s.speciality_id','asc');
		$query = $this->db->get();
		return $query;
	}

	public function create_speciality($data)
	{
		$query = $this->db->insert('specialities', $data);
		$result=array();
		$result['insert_id']=$this->db->insert_id();
		$result['status']=$query;
		return $result;
	}
	public function update_speciality($data){
		$this->db->where('speciality_id', $data['speciality_id']);
		$query = $this->db->update('specialities', $data);
		return $query;
	}
		
}
?>
