<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sample_Management {

	function __construct()
	{
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$CI =& get_instance();
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		$CI->load->model('User_model', 'User');
		$CI->load->model('Samples_model', 'Samples');

		
	}

	public function calculate_sample_quantities($sample_id='')
	{
		$data = array();
		if($sample_id!=''){
			$data['sa.sample_id'] = $sample_id;
		}
		$samples = $this->CI->Samples->select_samples('*',$data)->result();
		foreach ($samples as $key => $g) {
			$issued_samples = $this->CI->Samples->select_samples_issued('*',array('sai.sample_id'=>$g->sample_id))->result();
			$issued_quantity = $delivered_quantity = $balance_quantity = 0; 
			foreach ($issued_samples as $key => $ig) {
				$data2['sample_delivered_quantity'] = $this->CI->Samples->select_samples_delivered('COALESCE(SUM(sad.delivered_quantity),0) as total_delivered_quantity',array('sad.issue_id'=>$ig->issue_id))->row()->total_delivered_quantity;
				$data2['sample_balance_quantity'] = $ig->sample_issued_quantity - $data2['sample_delivered_quantity'];
				$data2['issue_id'] = $ig->issue_id;
				if($data2['sample_balance_quantity']==0){
					$data2['sample_issue_delivery_status'] = 1;
				}else{
					if($ig->sample_issued_quantity == $data2['sample_balance_quantity']){
						$data2['sample_issue_delivery_status'] = 0;
					}else{
						$data2['sample_issue_delivery_status'] = 2;
					}
				}
				$update = $this->CI->Samples->update_sample_issued($data2);
				$issued_quantity += $ig->sample_issued_quantity;
				$delivered_quantity += $data2['sample_delivered_quantity'];
				$balance_quantity += $data2['sample_balance_quantity'];
			}
			$data3['sample_id'] = $g->sample_id;
			$data3['issued_quantity'] = $issued_quantity;
			$data3['delivered_quantity'] = $delivered_quantity;
			$data3['balance_quantity'] = $g->sample_quantity - $balance_quantity;
			if($data3['balance_quantity']==0){
				$data3['sample_delivery_status'] = 1;
			}else{
				if($g->sample_quantity == $data3['balance_quantity']){
					$data3['sample_delivery_status'] = 0;
				}else{
					$data3['sample_delivery_status'] = 2;
				}
			}
			$update = $this->CI->Samples->update_sample($data3);
		}
	}







}


