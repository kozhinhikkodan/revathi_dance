<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{

    public function __construct()
    { 
        parent::__construct();

        ini_set('max_execution_time', 5000);
        ini_set("memory_limit", "-1");
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('session');

        $this->load->model('Settings_model', 'Settings');
        $this->load->model('Events_model', 'Events');
      

        $maintanance_mode = $this->Settings->select_setting_config('*', array('s.setting_name' => 'maintanance_mode'))->row()->value;
        if ($maintanance_mode == 1) {
            redirect(base_url() . 'maintanance', 'refresh');
        }else{
        	$allowed_users = array('master_admin','manager');
			if(!in_array($this->session->userdata('user_role'),$allowed_users)){
				redirect(base_url(),'refresh');
			}
        }

        $this->data['folder'] = 'events';

    }

    public function index()
    {
        $this->init();
    }

    public function init()
    {
        $this->data['page'] = 'events_list';
        $this->load->view('Index', $this->data);
    }

    
	public function select_events(){

		$json_data=array();
		$j=0;

		$data=array();


		// if(isset($_POST['status']) && $_POST['status']!='' && $_POST['status']!='all'){
		// 	$data['g.event_delivery_status'] = $_POST['status'];
		// }

		$result	= $this->Events->select_events("*,e.created_date as created_date",$data);
		$result_array=$result->result();

		$json_data['draw']=5;
		$json_data['recordsTotal']=$result->num_rows();
		$json_data['recordsFiltered']=$result->num_rows();
		$array=array();

		foreach($result_array as $row):

            $btn_edit = '<button data-toggle="modal" data-target="#event_edit_modal" id="event_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>';
            $btn_delete = '<button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="event_delete_btn" data-target="#event_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button>';


			$added_info = date('d-m-Y h:i A',strtotime($row->created_date));

		
			$array[$j][]=$j+1;
			$array[$j][]=date('d-m-Y',strtotime($row->event_date));
			$array[$j][]=$row->event_title;
			$array[$j][]=$row->event_description;
			$array[$j][]=$added_info;
			$array[$j][]=$btn_edit.$btn_delete;
			$array[$j][]=$row->event_id;





			$j++;
		endforeach;

		$json_data['data']=$array;
		echo json_encode($json_data);
	}


    public function create()
	{

		$data['event_title'] = $this->security->xss_clean($this->input->post('event_title'));
		$data['event_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('event_date'))));
		$data['event_description'] = $this->security->xss_clean($this->input->post('event_description'));
		

		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata('user_id');

		$result = $this->Events->create_event($data);

		if($result['status']==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Event Added Successfully!";
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

		$data['event_id'] = $this->security->xss_clean($this->input->post('event_id'));
		$data['event_title'] = $this->security->xss_clean($this->input->post('event_title'));
		$data['event_date'] = date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('event_date'))));
		$data['event_description'] = $this->security->xss_clean($this->input->post('event_description'));
		
 
		$data['updated_date'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Events->update_event($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Event Updated Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}


    
    public function delete()
	{

		$data['event_id'] = $this->security->xss_clean($this->input->post('event_id'));
		$data['delete_status'] = 1;

		$data['updated_date'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('user_id');

		$result = $this->Events->update_event($data);

		if($result==1){
			$flash_data['status'] = 1;
			$flash_data['flashdata_type'] = 'success';
			$flash_data['alert_type'] = 'info';
			$flash_data['flashdata_title'] = 'Success !';
			$flash_data['flashdata_msg'] = "Event Deleted Successfully!";
		}else{
			$flash_data['flashdata_msg'] = 'Sorry.. There Have been Some Error Occurred. Please Try Again!';
			$flash_data['flashdata_type'] = 'error';
			$flash_data['alert_type'] = 'danger';
			$flash_data['flashdata_title'] = 'Error !!';
		}

		echo json_encode($flash_data);

	}

}
