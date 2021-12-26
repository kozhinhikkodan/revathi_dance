<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('User_model','User');
		$this->load->model('Settings_model', 'Settings');
		$this->load->model('Misc_model', 'Misc');

		$this->load->model('Managers_model', 'Managers');
		$this->load->model('Sales_men_model', 'Sales_men');
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

		$this->data['folder']='reports';

	}

	public function index()
	{
		// $this->init();
	}

	public function coverage()
	{


		$allowed_users = array('master_admin','manager');
		if(!in_array($this->session->userdata('user_role'),$allowed_users)){
			redirect(base_url(),'refresh');
		}

		$this->data['managers'] = $this->Managers->select_managers('*')->result();
		$this->data['sales_men']=$this->Sales_men->select_sales_men('*')->result();

		$this->data['page']='coverage_report';
		$this->load->view('Index',$this->data);
	}

	public function missed_call()
	{
		$this->data['sales_men']=$this->Sales_men->select_sales_men('*')->result();

		$this->data['page']='missed_calls_report';
		$this->load->view('Index',$this->data);
	}


	public function select_coverage_report(){

		$json_data=array();
		$j=0;

		$data=array();
		$table_body = '';

		if(isset($_POST['sales_man_id']) && $_POST['sales_man_id']!='' && $_POST['sales_man_id']!='all'){
			$data['sw.sales_man_id'] = $_POST['sales_man_id'];
		}

		if(isset($_POST['date']) && $_POST['date']!=''){
			$date=array();
			$date=explode('-',$_POST['date']);
			$start_date=date('Y-m-d', strtotime($date[0]));
			$end_date=date('Y-m-d', strtotime($date[1]));
			$interval = new DateInterval('P1D');
			$realEnd = new DateTime($end_date);
			$realEnd->add($interval);
			$date_period = new DatePeriod(new DateTime($start_date), $interval, $realEnd);

			$array=array();
			$sl_no=0;

			foreach ($date_period as $key => $value) {

				$data['sw.work_log_date'] = $value->format('Y-m-d');

				$work_logs	= $this->Work_logs->select_work_logs("*,d.name as doctor_name,sw.created_date as created_date,sw.start_time as start_time,sw.duration as duration",$data);

				$work_logs_count = $work_logs->num_rows();

				if($work_logs_count>0){

					$work_logs = $work_logs->result();

					foreach ($work_logs as $key => $wl) {
						$array[$j][] = $j+1;
						$array[$j][] = $value->format('d F Y');
						$array[$j][] = $wl->sales_man_name;
						$array[$j][] = $wl->locality_name;
						$array[$j][] = $wl->full_name;

						if($wl->duration>=60){
							$duration = intdiv($wl->duration, 60).':'. ($wl->duration % 60).' Hours';
						}else{
							$duration = $wl->duration.' Minutes';
						}

						$array[$j][] = $duration;

						$j++;
					}

					
				}else{
					$array[$j][] = $j+1;
					$array[$j][] = $value->format('d F Y');
					$array[$j][] = '<span class="text-danger">No Work Log</span>';
					$array[$j][] = '';
					$array[$j][] = '';
					$array[$j][] = '';

					$j++;

				}

				
			}

			$json_data['data']=$array;
			echo json_encode($json_data);

		}


		
	}











	public function select_missed_call_report2(){

		$json_data=array();
		$j=0;

		$data=$array=array();
		$table_body = '';



		if($this->session->userdata('user_role')=='sales_man'){
			$localities = $this->session->userdata('sales_man_data')->localities;
			if($localities!=''){
				$localities_array = explode(',', $localities);
				//exit(print_r($localities_array));
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

		$doc_result = $this->Doctors->select_doctors('d.*');
		$doctors_count = $doc_result->num_rows();


		if($doctors_count>0){

			$total_work_logs_count = $total_visit_frequency = 0;
			foreach ($doc_result->result() as $key => $d) {

				$data_sw = array();

				if(isset($_POST['date']) && $_POST['date']!=''){
					$data_sw['sw.work_log_date >='] = date('Y-m-01', strtotime($_POST['date']));
					$data_sw['sw.work_log_date <='] = date('Y-m-t', strtotime($_POST['date']));
				}

				$data_sw['sw.doctor_id'] = $d->doctor_id;

				$work_logs_count = $this->Work_logs->select_work_logs('*',$data_sw)->num_rows();

				$total_work_logs_count += $work_logs_count;
				$total_visit_frequency += $d->visit_frequency;


				$array[$j][] = $j+1;
				$array[$j][] = date('F Y', strtotime($_POST['date']));
				$array[$j][] = $d->full_name.' '.$d->qualification;

				$locality_names = '';
				foreach (explode(',', $d->localities) as $key => $value) {
					$loc = $this->Localities->select_localities('*',array('l.locality_id'=>$value));
					if($loc->num_rows()==1){
						$locality_names .= $loc->row()->locality_name.'<br>';
					}
				}

				$array[$j][] = $locality_names;
				$array[$j][] = '<span class="text-success font-weight-boldest">'.$work_logs_count.'</span>';
				$array[$j][] = '<span class="text-primary font-weight-boldest">'.$d->visit_frequency.'</span>';

				$j++;


			}

			$array[$j][] = $j+1;
			$array[$j][] = '<span class="text-success font-weight-boldest">'.date('F Y', strtotime($_POST['date'])).'</span>';
			$array[$j][] = '';
			$array[$j][] = '<span class="text-success font-weight-boldest">Total</span>';;
			$array[$j][] = '<span class="text-success font-weight-boldest">'.$total_work_logs_count.'</span>';
			$array[$j][] = '<span class="text-primary font-weight-boldest">'.$total_visit_frequency.'</span>';

			$j++;

		}else{
			$array[$j][] = $j+1;
			$array[$j][] = '';
			$array[$j][] = '';
			$array[$j][] = '<span class="text-danger">No Doctors Added</span>';
			$array[$j][] = '';
			$array[$j][] = '';

			$j++;
		}

		$json_data['data']=$array;
		echo json_encode($json_data);
	}



	public function select_missed_call_report(){

		$json_data=array();
		$j=0;

		$data=$array=array();
		$table_body = '';



		if(isset($_POST['sales_man_id']) && $_POST['sales_man_id']!=''){
			$localities = $this->Sales_men->select_sales_men('*',array('s.sales_man_id'=>$_POST['sales_man_id']))->row()->localities;
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

		$doc_result = $this->Doctors->select_doctors('d.*');
		$doctors_count = $doc_result->num_rows();


		if($doctors_count>0){

			// $table_body .= '<tr><td class="font-weight-bold h4 text-dark text-center">Missed Call Report Of '.date('F Y',strtotime($_POST['date'])).'</td></tr>';

			$total_work_logs_count = $total_visit_frequency = 0;
			foreach ($doc_result->result() as $key => $d) {

				$data_sw = array();

				if(isset($_POST['date']) && $_POST['date']!=''){
					$data_sw['sw.work_log_date >='] = date('Y-m-01', strtotime($_POST['date']));
					$data_sw['sw.work_log_date <='] = date('Y-m-t', strtotime($_POST['date']));
				}

				$data_sw['sw.doctor_id'] = $d->doctor_id;

				$work_logs_count = $this->Work_logs->select_work_logs('*',$data_sw)->num_rows();

				$total_work_logs_count += $work_logs_count;
				$total_visit_frequency += $d->visit_frequency;

				$table_body .= '<tr>';
				$table_body .= '<td>'.($j+1).'</td>';
				$table_body .= '<td>'.date('F Y',strtotime($_POST['date'])).'</td>';
				$table_body .= '<td>'.$d->name.' '.$d->qualification.'</td>';

				$locality_names = '';
				foreach (explode(',', $d->localities) as $key => $value) {
					$loc = $this->Localities->select_localities('*',array('l.locality_id'=>$value));
					if($loc->num_rows()==1){
						$locality_names .= $loc->row()->locality_name.'<br>';
					}
				}

				$table_body .= '<td>'.$locality_names.'</td>';
				$table_body .= '<td>'.'<span class="text-success font-weight-boldest">'.$work_logs_count.'</span>'.'</td>';
				$table_body .= '<td>'.'<span class="text-primary font-weight-boldest">'.$d->visit_frequency.'</span>'.'</td>';
				$table_body .= '</tr>';

				$j++;


			}

			$table_body .= '<tr>';
			$table_body .= '<td>'.($j+1).'</td>';
			$table_body .= '<td>'.date('F Y',strtotime($_POST['date'])).'</td>';
			$table_body .= '<td></td>';
			$table_body .= '<td>'.'<span class="text-success font-weight-boldest">Total</span>'.'</td>';
			$table_body .= '<td>'.'<span class="text-success font-weight-boldest">'.$total_work_logs_count.'</span>'.'</td>';
			$table_body .= '<td>'.'<span class="text-primary font-weight-boldest">'.$total_visit_frequency.'</span>'.'</td>';

			$j++;

		}else{
			$table_body .= '<td>'.($j+1).'</td>';
			$table_body .= '<td></td>';
			$table_body .= '<td></td>';
			$table_body .= '<td><span class="text-danger">No Doctors Added</span></td>';
			$table_body .= '<td></td>';
			$table_body .= '<td></td>';

			$j++;
		}

		$json_data['data']=$table_body;
		echo json_encode($json_data);
	}




}