<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Sales_men_model', 'Sales_men');
		$this->load->model('Localities_model', 'Localities');
		$this->load->model('Tour_plan_model', 'Tour_plan');
		$this->load->model('Doctors_model', 'Doctors');
		$this->load->model('Work_logs_model', 'Work_logs');
		$this->load->model('Managers_model', 'Managers');
		$this->load->model('Products_model', 'Products');

		$maintanance_mode = $this->Settings->select_setting_config('*',array('s.setting_name' => 'maintanance_mode' ))->row()->value;
		if($maintanance_mode==1){
			redirect(base_url().'maintanance', 'refresh');
		}
		

		$this->data['folder']='courses';

	}

	public function index()
	{
		$this->init();
	}

	public function fee()
	{
	
		$this->data['page']='fee_list';
		$this->load->view('Index',$this->data);
	}

	public function receipt()
	{
	
		$this->data['page']='invoice_view';
		$this->load->view('Index',$this->data);
	}


	public function init()
	{
	
		$this->data['page']='courses_list';
		$this->load->view('Index',$this->data);
	}


	public function surveys()
	{
		$this->data['managers'] = $this->Managers->select_managers('*')->result();
		$this->data['doctors'] = $this->Doctors->select_doctors('*',array('d.doctor_status'=>1))->result();
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
		$this->data['localities_2'] = $this->Localities->select_localities('*',array('l.locality_status'=>1))->result();


		$this->data['page']='surveys_list';
		$this->load->view('Index',$this->data);
	}


	public function create()
	{

		$data['sales_man_id'] = $data2['sw.sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
		$data['locality_id'] = $data2['sw.locality_id'] = $this->security->xss_clean($this->input->post('locality'));
		$data['doctor_id'] = $data2['sw.doctor_id'] = $this->security->xss_clean($this->input->post('doctor'));
		$data['work_log_date'] = $data2['sw.work_log_date'] = date('Y-m-d');

		$count = $this->Work_logs->select_work_logs('*',$data2)->num_rows();
		if($count==0){

			$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
			$data['created_date'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_id');

			$result = $this->Work_logs->create_work_log($data);

			if($result['status']==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Work Log Added Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{

			$flash_data['flashdata_msg'] = 'Work Log already added with this data!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Duplicate !!';
		}

		echo json_encode($flash_data);

	}

	public function select_work_logs(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['date']) && $_POST['date']!=''){
			$date=array();
			$date=explode('-',$_POST['date']);
			$start_date=date('Y-m-d', strtotime($date[0]));
			$end_date=date('Y-m-d', strtotime($date[1]));
			$data["STR_TO_DATE(sw.work_log_date,'%Y-%m-%d') <="]= $end_date;
			$data["STR_TO_DATE(sw.work_log_date,'%Y-%m-%d') >="]= $start_date;
		}

		if(isset($_POST['locality']) && $_POST['locality']!='' && $_POST['locality']!='all'){
			$data['sw.locality_id'] = $_POST['locality'];
		}

		if(isset($_POST['doctor']) && $_POST['doctor']!='' && $_POST['doctor']!='all'){
			$data['sw.doctor_id'] = $_POST['doctor'];
		}

		if(isset($_POST['sales_man']) && $_POST['sales_man']!='' && $_POST['sales_man']!='all'){
			$data['sw.sales_man_id'] = $_POST['sales_man'];
		}

		if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
			if($_POST['status']==0){
				$data['sw.duration'] = '';
			}else{
				$data['sw.duration>'] = 0;
			}
		}

		$result	= $this->Work_logs->select_work_logs("*,d.name as doctor_name,sw.created_date as created_date,sw.start_time as start_time,sw.duration as duration",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			if($this->session->userdata('user_role')=='sales_man'){
				$btn_gallery = '<button id="gallery_btn" class="btn btn-sm btn-dark m-1"> <i class="flaticon flaticon2-photograph"></i> </button>';
				$btn_note = '<button data-toggle="modal" id="note_add_btn" data-target="#note_add_modal"  class="btn btn-sm btn-info m-1"> <i class="flaticon flaticon2-list-3"></i> </button>';
			}else{
				$btn_gallery = $btn_note = '';
			}

			
			$btn_edit = '<button data-toggle="modal" data-target="#work_log_edit_modal" id="work_log_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
			$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="work_log_delete_btn" data-target="#work_log_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';

			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));
			// $added_info = $row->created_date;

			$array[$j][]=$j+1;
			$array[$j][]=date('d-m-Y',strtotime($row->work_log_date));
			$array[$j][]=$row->sales_man_name;
			$array[$j][]=$row->locality_name.' - '.$row->district_name.', '.$row->state_name;
			$array[$j][]=$row->doctor_name.' '.$row->qualification;
			if($row->start_time!='0000-00-00 00:00:00'){
				$array[$j][]=$row->start_time;
			}else{
				$array[$j][]='<label class="label label-sm label-warning label-inline">Not&nbsp;Started</label>';
			}

			if($row->end_time!='0000-00-00 00:00:00'){

				if($row->duration>=60){
					$duration = intdiv($row->duration, 60).':'. ($row->duration % 60).'&nbsp;Hours';
				}else{
					$duration = $row->duration.'&nbsp;Minutes';
				}

				$array[$j][]=$row->end_time.'<br><label class="label label-sm label-inline label-dark">'.$duration.'</lable>';
			}else{
				$array[$j][]='<label class="label label-sm label-warning label-inline">Not&nbsp;Ended</label>';
			}

			$array[$j][]=nl2br($row->notes);
			$array[$j][]=$added_info;
			$array[$j][]=$btn_gallery.$btn_note.$btn_edit.$btn_delete;
			$array[$j][]=$row->work_log_id;
			$array[$j][]=$row->locality_id;
			$array[$j][]=$row->doctor_id;
			$array[$j][]=$row->sales_man_id;
			$array[$j][]=$row->notes;

			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}

	public function delete()
	{
		$data['work_log_id'] = $this->security->xss_clean($this->input->post('work_log_id'));
		$data['delete_status'] = 1;

		$result = $this->Work_logs->update_work_log($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Work Log Deleted Successfully!";
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
		$data['work_log_id'] = $data2['sw.work_log_id!='] = $this->security->xss_clean($this->input->post('work_log_id'));

		$data['sales_man_id'] = $data2['sw.sales_man_id'] = $this->security->xss_clean($this->input->post('sales_man_id'));
		$data['locality_id'] = $data2['sw.locality_id'] = $this->security->xss_clean($this->input->post('locality'));
		$data['doctor_id'] = $data2['sw.doctor_id'] = $this->security->xss_clean($this->input->post('doctor'));
		$data['work_log_date'] = $data2['sw.work_log_date'] = date('Y-m-d');

		$count = $this->Work_logs->select_work_logs('*',$data2)->num_rows();
		if($count==0){

			$data['remarks'] = $this->security->xss_clean($this->input->post('remarks'));
			$data['updated_date'] = date('Y-m-d H:i:s');
			$data['updated_by'] = $this->session->userdata('user_id');

			$result = $this->Work_logs->update_work_log($data);

			if($result==1){
				$flash_data['status'] = 1;
				$flash_data['flashdata_type'] = 'success';
				$flash_data['alert_type'] = 'info';
				$flash_data['flashdata_title'] = 'Success !';
				$flash_data['flashdata_msg'] = "Work Log Updated Successfully!";
			}else{
				$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
				$flash_data['flashdata_type'] = 'error';
				$flash_data['alert_type'] = 'danger';
				$flash_data['flashdata_title'] = 'Error !!';
			}

		}else{

			$flash_data['flashdata_msg'] = 'Work Log already added with this data!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Duplicate !!';
		}

		echo json_encode($flash_data);

	}

	public function start_timer()
	{
		$data['work_log_id'] = $this->security->xss_clean($this->input->post('work_log_id'));
		$start_time = $this->Work_logs->select_work_logs('*,sw.start_time as start_time',$data)->row()->start_time;
		if($start_time=='0000-00-00 00:00:00' || $start_time=='' || $start_time==null){
			$data['start_time'] = date('Y-m-d H:i:s');
			$result = $this->Work_logs->update_work_log($data);
			if($result==1){
				$flash_data['status'] = 1;
			}else{
				$flash_data['status'] = 0;
			}
		}else{
			$flash_data['status'] = 2;
		}
		echo json_encode($flash_data);
	}	


	public function update_note()
	{
		$data['work_log_id'] = $this->security->xss_clean($this->input->post('work_log_id'));
		$work_log_data = $this->Work_logs->select_work_logs('*,sw.start_time as start_time',$data)->row();
		$start_time = $work_log_data->start_time;
		if($start_time!='0000-00-00 00:00:00' && $start_time!='' && $start_time!=null){
			$data['end_time'] = date('Y-m-d H:i:s');
			$start_time = strtotime($work_log_data->start_time);
			$end_time = strtotime($data['end_time']);
			$data['duration'] = round(($end_time-$start_time)/60);
		}

		$data['notes'] = $this->security->xss_clean($this->input->post('notes'));
		$data['updated_date'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Work_logs->update_work_log($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Note Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}


	public function create_survey()
	{

		$data['sales_man_id'] = $this->session->userdata('sales_man_data')->sales_man_id;
		$data['locality_id'] = $this->security->xss_clean($this->input->post('locality'));
		$data['doctor_id'] = $this->security->xss_clean($this->input->post('doctor'));
		$data['survey_date'] = date('Y-m-d');
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$data['chemist_1'] = $this->security->xss_clean($this->input->post('chemist_1'));
		$data['chemist_2'] = $this->security->xss_clean($this->input->post('chemist_2'));

		$item_array = $this->security->xss_clean($this->input->post('survey_item'));
		$new_items_array = array();
		foreach (array_keys($item_array) as $key) {
			foreach ($item_array[$key] as $key2 => $value) {
				$new_items_array[$key2][$key] = $value; 
			}
		}

		$data['survey_items'] = serialize($new_items_array);

		$result = $this->Work_logs->create_survey($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Work Log Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}



		echo json_encode($flash_data);

	}


	public function select_surveys(){

		$json_data=array();
		$j=0;

		$data=array();

		if(isset($_POST['date']) && $_POST['date']!=''){
			$date=array();
			$date=explode('-',$_POST['date']);
			$start_date=date('Y-m-d', strtotime($date[0]));
			$end_date=date('Y-m-d', strtotime($date[1]));
			$data["STR_TO_DATE(su.survey_date,'%Y-%m-%d') <="]= $end_date;
			$data["STR_TO_DATE(su.survey_date,'%Y-%m-%d') >="]= $start_date;
		}

		if(isset($_POST['locality']) && $_POST['locality']!='' && $_POST['locality']!='all'){
			$data['su.locality_id'] = $_POST['locality'];
		}

		if(isset($_POST['doctor']) && $_POST['doctor']!='' && $_POST['doctor']!='all'){
			$data['su.doctor_id'] = $_POST['doctor'];
		}

		if(isset($_POST['sales_man']) && $_POST['sales_man']!='' && $_POST['sales_man']!='all'){
			$data['su.sales_man_id'] = $_POST['sales_man'];
		}

		$result	= $this->Work_logs->select_surveys("*,su.created_date as created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

			if($this->session->userdata('user_role')=='sales_man'){
				$btn_info = '';
				$btn_edit = '<button data-toggle="modal" data-target="#survey_edit_modal" id="survey_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
				$btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="survey_delete_btn" data-target="#survey_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';
			}else{
				$btn_info = '<button data-toggle="modal" data-target="#survey_info_modal" id="survey_info_btn" class="btn btn-sm btn-info m-1"> <i class="flaticon flaticon-list"></i> </button>';
				$btn_edit = $btn_delete = '';
			}

			
			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

			$array[$j][]=$j+1;
			$array[$j][]=date('d-m-Y',strtotime($row->survey_date));
			$array[$j][]=$row->sales_man_name;

			$doctor_name = 'NA';
			if($row->doctor_id!=0){
				$d_data = $this->Doctors->select_doctors('d.name as name',array('d.doctor_id'=>$row->doctor_id));
				if($d_data->num_rows()==1){
					$doctor_name = $d_data->row()->name;
				}
			}

			$array[$j][]= $doctor_name; 
			$array[$j][]=$row->locality_name.' - '.$row->district_name.', '.$row->state_name;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_info.$btn_edit.$btn_delete;
			$array[$j][]=$row->survey_id;
			$array[$j][]=json_encode(unserialize($row->survey_items));
			$array[$j][]=$row->doctor_id;
			$array[$j][]=$row->locality_id;
			$array[$j][]=$row->chemist_1;
			$array[$j][]=$row->chemist_2;




			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}


	public function delete_survey()
	{
		$data['survey_id'] = $this->security->xss_clean($this->input->post('survey_id'));
		$data['delete_status'] = 1;

		$result = $this->Work_logs->update_survey($data);
		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Survey Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}
		echo json_encode($flash_data);
	}

	public function update_survey()
	{

		$data['survey_id'] = $this->security->xss_clean($this->input->post('survey_id'));

		$data['locality_id'] = $this->security->xss_clean($this->input->post('locality'));
		$data['doctor_id'] = $this->security->xss_clean($this->input->post('doctor'));
		$data['updated_date'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$data['chemist_1'] = $this->security->xss_clean($this->input->post('chemist_1'));
		$data['chemist_2'] = $this->security->xss_clean($this->input->post('chemist_2'));


		$item_array = $this->security->xss_clean($this->input->post('survey_item'));
		$new_items_array = array();
		foreach (array_keys($item_array) as $key) {
			foreach ($item_array[$key] as $key2 => $value) {
				$new_items_array[$key2][$key] = $value; 
			}
		}

		$data['survey_items'] = serialize($new_items_array);

		$result = $this->Work_logs->update_survey($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Survey Added Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}



		echo json_encode($flash_data);

	}



}