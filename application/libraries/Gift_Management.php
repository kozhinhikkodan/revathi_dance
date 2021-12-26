<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gift_Management {

	function __construct()
	{
		ini_set('max_execution_time', 5000);
		ini_set("memory_limit", "-1");
		date_default_timezone_set('Asia/Kolkata');

		$CI =& get_instance();
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		$CI->load->model('User_model', 'User');
		$CI->load->model('Gifts_model', 'Gifts');

		
	}

	public function calculate_gift_quantities($gift_id='')
	{
		$data = array();
		if($gift_id!=''){
			$data['g.gift_id'] = $gift_id;
		}
		$gifts = $this->CI->Gifts->select_gifts('*',$data)->result();
		foreach ($gifts as $key => $g) {
			$issued_gifts = $this->CI->Gifts->select_gifts_issued('*',array('gi.gift_id'=>$g->gift_id))->result();
			$issued_quantity = $delivered_quantity = $balance_quantity = 0; 
			foreach ($issued_gifts as $key => $ig) {
				$data2['gift_delivered_quantity'] = $this->CI->Gifts->select_gifts_delivered('COALESCE(SUM(gd.delivered_quantity),0) as total_delivered_quantity',array('gd.issue_id'=>$ig->issue_id))->row()->total_delivered_quantity;
				$data2['gift_balance_quantity'] = $ig->gift_issued_quantity - $data2['gift_delivered_quantity'];
				$data2['issue_id'] = $ig->issue_id;
				if($data2['gift_balance_quantity']==0){
					$data2['gift_issue_delivery_status'] = 1;
				}else{
					if($ig->gift_issued_quantity == $data2['gift_balance_quantity']){
						$data2['gift_issue_delivery_status'] = 0;
					}else{
						$data2['gift_issue_delivery_status'] = 2;
					}
				}
				$update = $this->CI->Gifts->update_gift_issued($data2);
				$issued_quantity += $ig->gift_issued_quantity;
				$delivered_quantity += $data2['gift_delivered_quantity'];
				$balance_quantity += $data2['gift_balance_quantity'];
			}
			$data3['gift_id'] = $g->gift_id;
			$data3['issued_quantity'] = $issued_quantity;
			$data3['delivered_quantity'] = $delivered_quantity;
			$data3['balance_quantity'] = $g->gift_quantity - $balance_quantity;
			if($data3['balance_quantity']==0){
				$data3['gift_delivery_status'] = 1;
			}else{
				if($g->gift_quantity == $data3['balance_quantity']){
					$data3['gift_delivery_status'] = 0;
				}else{
					$data3['gift_delivery_status'] = 2;
				}
			}
			$update = $this->CI->Gifts->update_gift($data3);
		}
	}







}


