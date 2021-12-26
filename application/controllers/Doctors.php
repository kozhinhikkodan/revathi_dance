<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Localities_model', 'Localities');
		$this->load->model('Doctors_model', 'Doctors');
		$this->load->model('Sales_men_model', 'Sales_men');


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

		$this->data['folder']='doctors';

	}

	public function index()
	{
		$this->init();

	}

	public function init()
	{


		$this->data['sales_men']=$this->Sales_men->select_sales_men('*')->result();

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

		$this->db->order_by('l.locality_name','dsc');

		$this->data['localities'] = $this->Localities->select_localities('*',array('l.locality_status'=>1))->result();


		$this->data['page']='doctors_list';
		$this->load->view('Index',$this->data);
	}

	public function profile($id='')
	{
		if($id!=''){
			$doc_data = $this->Doctors->select_doctors('*,d.name as doctor_name,d.created_date as created_date',array('d.doctor_id'=>$id,'d.doctor_status'=>1));
			if($doc_data->num_rows()==1){

				$this->data['doc_data'] = $doc_data->row();
				$localities = array();
				foreach (explode(',', $doc_data->row()->localities) as $key => $value) {
					$localities[] = $this->Localities->select_localities('*',array('l.locality_id'=>$value))->row();
				}
				$this->data['doc_data']->localities = $localities;

				$data_sw['sw.doctor_id'] = $id;
				$data_sw['sw.work_log_date >='] = date('Y-m-01');
				$data_sw['sw.work_log_date <='] = date('Y-m-t');
				$missed_calls = array();
				$work_logs_count = $this->Work_logs->select_work_logs('*',$data_sw)->num_rows();
				$missed_calls['count'] = $work_logs_count;
				$missed_calls['frequency'] = $doc_data->row()->visit_frequency;
				$missed_calls['doctor'] = $doc_data->row();
				$this->data['missed_calls'] = $missed_calls;


				$this->data['page']='doctor_profile';
				$this->load->view('Index',$this->data);

			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function create()
	{

		$data['name'] = $this->security->xss_clean($this->input->post('name'));
		$data['full_name'] = $this->security->xss_clean($this->input->post('full_name'));

		$specialities = $this->security->xss_clean($this->input->post('specialities[]'));
		$data['specialities'] = implode(',', $specialities);
		$qualification = $this->security->xss_clean($this->input->post('qualification[]'));
		$data['qualification'] = implode(',', $qualification);

		$data['hospital'] = $this->security->xss_clean($this->input->post('hospital'));
		$data['hospital_location'] = $this->security->xss_clean($this->input->post('hospital_location'));
		$localities = $this->security->xss_clean($this->input->post('localities[]'));
		if(isset($localities) && $localities!=''){
			$data['localities'] = implode(',', $localities);
		}else{
			$data['localities'] = '';
		}
		$data['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
		$data['phone'] = $this->security->xss_clean($this->input->post('phone'));
		$data['email'] = $this->security->xss_clean($this->input->post('email'));
		$data['dob'] = $this->security->xss_clean($this->input->post('dob'));
		$data['wedding_date'] = $this->security->xss_clean($this->input->post('wedding_date'));
		$data['visit_frequency'] = $this->security->xss_clean($this->input->post('visit_frequency'));
		$data['address'] = $this->security->xss_clean($this->input->post('address'));

		if($this->session->userdata('user_role')=='sales_man'){
			$data['doctor_status'] = 0;
		}else{
			$data['doctor_status'] = 1;
		}


		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Doctors->create_doctor($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Doctor Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function select_doctors(){

		// $this->output->enable_profiler(TRUE);
		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['location']) && $_POST['location']!='' && $_POST['location']!='all'){
			$location = $_POST['location'];
			$this->db->where("FIND_IN_SET($location, d.localities)");
		}

		if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
			$data['d.doctor_status'] = $_POST['status'];
		}

		if(isset($_POST['sales_man_id']) && $_POST['sales_man_id']!='' && $_POST['sales_man_id']!='all'){
			$sales_man_id = $_POST['sales_man_id'];
			$localities = $this->Sales_men->select_sales_men('*',array('s.sales_man_id'=>$sales_man_id))->row()->localities;
			if($localities!=''){
				$localities_array = explode(',', $localities);
				$query = '';
				foreach ($localities_array as $key => $value) {
					$query .= 'or FIND_IN_SET('.$value.', d.localities) ';
				}
				if($query!=''){
					$query = ltrim($query,'or');
					$query = "(".$query.")";
				}
				
				$this->db->where($query);
			}
			else{
				$this->db->where('d.delete_status',2);
			}
		}



		
		if($this->session->userdata('user_role')=='sales_man'){
			$localities = $this->session->userdata('sales_man_data')->localities;
			if($localities!=''){
				$localities_array = explode(',', $localities);
				$query = '';
				foreach ($localities_array as $key => $value) {
					$query .= 'or FIND_IN_SET('.$value.', d.localities) ';
				}
				if($query!=''){
					$query = ltrim($query,'or');
					$query = "(".$query.")";
				}
				
				$this->db->where($query);
			}
			else{
				$this->db->where('d.delete_status',2);
			}
		}


		$result	= $this->Doctors->select_doctors("*,d.name as doctor_name,d.created_date as created_date,d.created_by as created_by",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			// if(( $this->session->userdata('user_role')=='sales_man' && $row->doctor_status==1 ) || $this->session->userdata('user_role')!='sales_man' ){

			// exit(print_r($this->session->userdata('sales_man_data')->user_id));

			$show = 0;
			if($this->session->userdata('user_role')=='sales_man'){
				if($row->doctor_status==1 || $row->created_by == $this->session->userdata('sales_man_data')->user_id){
					$show = 1;
				}
			}else{
				$show = 1;
			}

			if($show == 1){

				$btn_profile = '<a href="'.base_url().'doctor/'.$row->doctor_id.'" class="btn btn-sm btn-warning m-1"> <i class="flaticon flaticon-eye"></i> </a>';

				$btn_edit = '<button data-toggle="modal" data-target="#doctor_edit_modal" id="doctor_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="doctor_delete_btn" data-target="#doctor_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

				$added_info = date('d-m-Y h:i A',strtotime($row->created_date)).'<br>By '.$row->name.'<br>'.'<span class="label label-lg label-dark label-inline mr-2">'.str_replace(' ', '&nbsp;', $row->role_name).'</span>';

				if($row->doctor_status==0){
					$doctor_status = '<label class="label label-sm label-inline label-warning">Pending</lable>';

					$btn_profile = '';

				}elseif ($row->doctor_status==1) {
					$doctor_status = '<label class="label label-sm label-inline label-success">Approved</lable>';
				}else{
					$doctor_status = '<label class="label label-sm label-inline label-danger">Rejected</lable>';

					$btn_profile = '';

				}
				$added_info .= '<br>'.$doctor_status;


				$localities = '';
				$sales_men_list = '';
				foreach (explode(',', $row->localities) as $key => $value) {

					$locality_query = $this->Localities->select_localities('l.locality_name,l.locality_id',array('l.locality_id'=>$value));

					if($locality_query->num_rows()==1){
						$locality = $locality_query->row()->locality_name;
						$locality_id = $locality_query->row()->locality_id;

						$localities .= $locality.'<br>';

						$this->db->where("FIND_IN_SET($locality_id, s.localities)");

						$sales_man_data = $this->Sales_men->select_sales_men('*,s.localities as localities')->result();

						foreach ($sales_man_data as $key => $value) {
							$sales_men_list .= '<label class="label label-lg label-inline label-dark mb-1">'.str_replace(' ', '&nbsp;', $value->sales_man_name).'</label><br>'; 
						}


					}


				} 

				$specialities = '';
				foreach (explode(',', $row->specialities) as $key => $value) { 
					if($value!=''){
						$specialities .= '<label class="label label-lg label-inline label-dark mb-1">'.str_replace(' ', '&nbsp;', $value).'</label><br>';
					}
				}


				$array[$j][]=$j+1;
				$array[$j][]=strtoupper($row->doctor_name);
				$array[$j][]=rtrim($localities,'<br>');
				$array[$j][]=$specialities;
				$array[$j][]=$sales_men_list;
				$array[$j][]=$row->mobile.'<br>'.$row->phone;
				$array[$j][]=$added_info;
				$array[$j][]=$btn_profile.$btn_edit.$btn_delete;
				$array[$j][]=$row->doctor_id;
				$array[$j][]=$row->full_name;
				$array[$j][]=$row->qualification;
				$array[$j][]=$row->specialities;
				$array[$j][]=$row->hospital;
				$array[$j][]=$row->hospital_location;
				$array[$j][]=$row->localities;
				$array[$j][]=($row->dob!='0000-00-00') ? date('d-m-Y',strtotime($row->dob)) : '';
				$array[$j][]=($row->wedding_date!='0000-00-00') ? date('d-m-Y',strtotime($row->wedding_date)) : '';
				$array[$j][]=$row->visit_frequency;
				$array[$j][]=$row->address;
				$array[$j][]=$row->mobile;
				$array[$j][]=$row->phone;
				$array[$j][]=$row->doctor_status;
				$array[$j][]=$row->email;


				$j++;

			}

		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}



	public function delete()
	{
		$data['doctor_id'] = $this->security->xss_clean($this->input->post('doctor_id'));
		$data['delete_status'] = 1;

		$result = $this->Doctors->update_doctor($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Doctor Deleted Successfully!";
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
		$data['doctor_id'] = $this->security->xss_clean($this->input->post('doctor_id'));

		$data['name'] = $this->security->xss_clean($this->input->post('name'));
		$data['full_name'] = $this->security->xss_clean($this->input->post('full_name'));
		
		$specialities = $this->security->xss_clean($this->input->post('specialities[]'));
		$data['specialities'] = implode(',', $specialities);
		$qualification = $this->security->xss_clean($this->input->post('qualification[]'));
		$data['qualification'] = implode(',', $qualification);

		$data['hospital'] = $this->security->xss_clean($this->input->post('hospital'));
		$data['hospital_location'] = $this->security->xss_clean($this->input->post('hospital_location'));
		$localities = $this->security->xss_clean($this->input->post('localities[]'));
		if(isset($localities) && $localities!=''){
			$data['localities'] = implode(',', $localities);
		}else{
			$data['localities'] = '';
		}
		$data['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
		$data['phone'] = $this->security->xss_clean($this->input->post('phone'));
		$data['email'] = $this->security->xss_clean($this->input->post('email'));
		$data['dob'] = $this->security->xss_clean($this->input->post('dob'));
		$data['wedding_date'] = $this->security->xss_clean($this->input->post('wedding_date'));
		$data['visit_frequency'] = $this->security->xss_clean($this->input->post('visit_frequency'));
		$data['address'] = $this->security->xss_clean($this->input->post('address'));

		if($this->session->userdata('user_role')!='sales_man') { 
			$data['doctor_status'] = $this->security->xss_clean($this->input->post('doctor_approve_radio'));
		}


		$data['updated_date'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Doctors->update_doctor($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Doctor updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}




	public function fetch_doctors()
	{
		$locality_id = $this->security->xss_clean($this->input->post('locality_id'));
		if($locality_id!=''){
			$this->db->where("FIND_IN_SET($locality_id, d.localities)");
			$doctors = $this->Doctors->select_doctors('*,d.name as name');
			$doctors_result = $doctors->result();
			$doctors_count = $doctors->num_rows();

			$result['count'] = $doctors_count;
			$result['data'] = $doctors_result;

			echo json_encode($result);
		}
	}




	public function qualifications()
	{
		$this->data['page']='qualifications_list';
		$this->load->view('Index',$this->data);
	}


	public function create_qualification()
	{

		$data['qualification'] = $this->security->xss_clean($this->input->post('qualification'));

		$count = $this->Doctors->select_qualifications('*',$data)->num_rows();

		if($count==0){

			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			$result = $this->Doctors->create_qualification($data);

			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Qualification Added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. This item already added !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function update_qualification()
	{

		$data['qualification_id'] = $data2['qualification_id!='] = $this->security->xss_clean($this->input->post('qualification_id'));

		$data['qualification'] = $data2['qualification'] = $this->security->xss_clean($this->input->post('qualification'));

		$count = $this->Doctors->select_qualifications('*',$data2)->num_rows();

		if($count==0){

			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $this->session->userdata('user_id');

			$result = $this->Doctors->update_qualification($data);

			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Qualification Updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. This item already added !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function delete_qualification()
	{
		$data['qualification_id'] = $this->security->xss_clean($this->input->post('qualification_id'));
		$data['delete_status'] = 1;

		$result = $this->Doctors->update_qualification($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Qualification Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}

	public function select_qualifications(){

		// $this->output->enable_profiler(TRUE);
		$json_data=array();
		$j=0;

		$data=array();

		$result	= $this->Doctors->select_qualifications("*,q.created_by as created_by",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_edit = '<button data-toggle="modal" data-target="#qualification_edit_modal" id="qualification_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="qualification_delete_btn" data-target="#qualification_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date)).'<br>By '.$row->name.'<br>'.'<span class="label label-lg label-dark label-inline mr-2">'.str_replace(' ', '&nbsp;', $row->role_name).'</span>';



			$array[$j][]=$j+1;
			$array[$j][]=$row->qualification;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->qualification_id;


			$j++;

		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}


	public function specialities()
	{
		$this->data['page']='specialities_list';
		$this->load->view('Index',$this->data);
	}


	public function create_speciality()
	{

		$data['speciality'] = $this->security->xss_clean($this->input->post('speciality'));

		$count = $this->Doctors->select_specialities('*',$data)->num_rows();

		if($count==0){

			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			$result = $this->Doctors->create_speciality($data);

			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "speciality Added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. This item already added !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function update_speciality()
	{

		$data['speciality_id'] = $data2['speciality_id!='] = $this->security->xss_clean($this->input->post('speciality_id'));

		$data['speciality'] = $data2['speciality'] = $this->security->xss_clean($this->input->post('speciality'));

		$count = $this->Doctors->select_specialities('*',$data2)->num_rows();

		if($count==0){

			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $this->session->userdata('user_id');

			$result = $this->Doctors->update_speciality($data);



			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "speciality Updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. This item already added !';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

	public function delete_speciality()
	{
		$data['speciality_id'] = $this->security->xss_clean($this->input->post('speciality_id'));
		$data['delete_status'] = 1;

		$result = $this->Doctors->update_speciality($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "speciality Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}

	public function select_specialities(){

		// $this->output->enable_profiler(TRUE);
		$json_data=array();
		$j=0;

		$data=array();

		$result	= $this->Doctors->select_specialities("*,s.created_by as created_by",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			$btn_edit = '<button data-toggle="modal" data-target="#speciality_edit_modal" id="speciality_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';

			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="speciality_delete_btn" data-target="#speciality_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date)).'<br>By '.$row->name.'<br>'.'<span class="label label-lg label-dark label-inline mr-2">'.str_replace(' ', '&nbsp;', $row->role_name).'</span>';



			$array[$j][]=$j+1;
			$array[$j][]=$row->speciality;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->speciality_id;


			$j++;

		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}



}