<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locations extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Localities_model', 'Localities');

		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}
		else{
			$allowed_users = array('master_admin','manager','sales_man');
			if(!in_array($this->session->userdata('user_role'),$allowed_users)){
				redirect(base_url(),'refresh');
			}
		}

		$this->data['folder']='locations';

	}

	public function index()
	{
		$this->init();
	}

	public function init()
	{
		$this->data['page']='localities_list';
		$this->load->view('Index',$this->data);
	}


	public function create()
	{

		$data['state_id'] = $data2['l.state_id'] = $this->security->xss_clean($this->input->post('state'));
		$data['district_id'] = $data2['l.district_id'] = $this->security->xss_clean($this->input->post('district'));
		$data['locality_name'] = $data2['l.locality_name'] = $this->security->xss_clean($this->input->post('locality'));

		$count = $this->Localities->select_localities('*',$data2)->num_rows();

		if($count==0){

			$data['created_date'] = date('Y-m-d h:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			if($this->session->userdata('user_role')=='sales_man'){
				$data['locality_status'] = 0;
			}else{
				$data['locality_status'] = 1;
			}

			$result = $this->Localities->create_locality($data);

			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Locality Added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}
		}else{
			$flash_data['flashdata_msg'] = 'The locality already added !';
			$flash_data['flashdata_type'] = 'warning';
			$flash_data['alert_type'] = 'warning';
			$flash_data['flashdata_title'] = 'Duplicate !!';
		}

		echo json_encode($flash_data);

	}

	public function select_localities(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['state']) && $_POST['state']!='' && $_POST['state']!='all'){
			$data['l.state_id'] = $_POST['state'];
		}

		if(isset($_POST['district']) && $_POST['district']!='' && $_POST['district']!='all'){
			$data['l.district_id'] = $_POST['district'];
		}

		if($this->session->userdata('user_role')=='sales_man'){
			$localities = $this->session->userdata('sales_man_data')->localities;
			if($localities!=''){
				$query = '';
				foreach (explode(',', $localities) as $key => $value) {
					$query .='or l.locality_id='.$value.' ';
				}
				if($query!=''){
					$query = ltrim($query,'or');
					$query = "(".$query.")";
				}
				
				$this->db->where($query);
			}else{
				$this->db->where('l.delete_status',2);
			}
		}

		$result	= $this->Localities->select_localities("*,l.created_date as created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_edit = '<button data-toggle="modal" data-target="#locality_edit_modal" id="locality_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="locality_delete_btn" data-target="#locality_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			if($this->session->userdata('user_role')!='sales_man'){
				$btn_status = '<button data-toggle="modal" data-target="#locality_status_modal" id="locality_status_btn" class="btn btn-sm btn-info m-1"> <i class="flaticon flaticon2-check-mark"></i> </button>';
			}else{
				$btn_status = '';
			}

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			if($row->role!='master_admin'){
				$added_info .= '<br>'.$row->name.' ( '.$row->role_name.')';
			}

			if($row->locality_status==0){
				$locality_status = '<label class="label label-sm label-inline label-warning">Pending</lable>';
			}elseif ($row->locality_status==1) {
				$locality_status = '<label class="label label-sm label-inline label-success">Approved</lable>';
			}else{
				$locality_status = '<label class="label label-sm label-inline label-danger">Rejected</lable>';
			}
			$added_info .= '<br>'.$locality_status;

			$array[$j][]=$j+1;
			$array[$j][]=$row->locality_name;
			$array[$j][]=$row->district_name;
			$array[$j][]=$row->state_name;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_status.$btn_edit.$btn_delete;
			$array[$j][]=$row->locality_id;
			$array[$j][]=$row->district_id;
			$array[$j][]=$row->state_id;
			$array[$j][]=$row->locality_status;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['locality_id'] = $this->security->xss_clean($this->input->post('locality_id'));
		$data['delete_status'] = 1;

		$result = $this->Localities->update_locality($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Locality Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}


	public function update_status()
	{
		$data['locality_id'] = $this->security->xss_clean($this->input->post('locality_id'));
		$data['locality_status'] = $this->security->xss_clean($this->input->post('locality_approve_radio'));

		$result = $this->Localities->update_locality($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Locality updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}


	public function update()
	{
		$data['state_id'] = $data2['l.state_id'] = $this->security->xss_clean($this->input->post('state'));
		$data['district_id'] = $data2['l.district_id'] = $this->security->xss_clean($this->input->post('district'));
		$data['locality_name'] = $data2['l.locality_name'] = $this->security->xss_clean($this->input->post('locality'));
		$data['locality_id'] = $data2['l.locality_id!='] = $this->security->xss_clean($this->input->post('locality_id'));


		$count = $this->Localities->select_localities('*',$data2)->num_rows();

		if($count==0){

			$data['updated_date'] = date('Y-m-d h:i:s');
			$data['updated_by'] = $this->session->userdata('user_id');

			$result = $this->Localities->update_locality($data);

			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Locality Updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}
		}else{
			$flash_data['flashdata_msg'] = 'The locality already added !';
			$flash_data['flashdata_type'] = 'warning';
			$flash_data['alert_type'] = 'warning';
			$flash_data['flashdata_title'] = 'Duplicate !!';
		}

		echo json_encode($flash_data);

	}


	public function fetch_districts()
	{
		$data['d.state_id'] = $this->security->xss_clean($this->input->post('state_id'));
		$districts = $this->Localities->select_districts('*',$data);
		$districts_result = $districts->result();
		$districts_count = $districts->num_rows();

		$result['count'] = $districts_count;
		$result['data'] = $districts_result;

		echo json_encode($result);

	}
	
	public function fetch_localities()
	{
		$data['l.district_id'] = $this->security->xss_clean($this->input->post('district_id'));
		$data['l.locality_status'] = 1;

		if($this->session->userdata('user_role')=='sales_man'){
			$localities = $this->session->userdata('sales_man_data')->localities;
			if($localities!=''){
				$query = '';
				foreach (explode(',', $localities) as $key => $value) {
					$query .='or l.locality_id='.$value.' ';
				}
				if($query!=''){
					$query = ltrim($query,'or');
					$query = "(".$query.")";
				}
				
				$this->db->where($query);
			}else{
				$this->db->where('l.delete_status',2);
			}
		}

		$localities = $this->Localities->select_localities('*',$data);
		$localities_result = $localities->result();
		$localities_count = $localities->num_rows();

		$result['count'] = $localities_count;
		$result['data'] = $localities_result;

		echo json_encode($result);

	}
	


}