<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// project by KSTAR.
class Download extends SC_Controller
{
    function __construct(){

        parent::__construct();
        $this->load->helper('email');
        $this->load->model('User_model');

    }

    function index(){	
    }
	function box($box_name=null)
	{
		$this->load->model('Box_model');
		$this->load->model('Files_model');
		$this->load->model('Rating_model');
		//$this->load->model('Servercoin_model');
		$this->load->model('Trade_model');
		$this->load->helper('form');
		$box = $this->Box_model->get_entries(array('box_name'=>strtolower($box_name)),1);
		if ($box)
			if($box->redirect_url)
				redirect($box->redirect_url);
		if($this->input->post('comment_action',0) && $this->input->post('comment')!="" )
		{
			$this->Rating_model->comment=$this->input->post('comment');
			$this->Rating_model->box_id=$this->input->post('box_id');
			$this->Rating_model->insert_entry();
		}
		if(!$box)
		{
			$this->load->view('header',$this->header_param);
			$this->common_param['box_name'] = $box_name;
			$this->load->view('download/unknown',$this->common_param);
			$this->load->view('footer',$this->footer_param);
		}else{
			$cookieData=get_cookie($this->config->item('sess_cookie_name'));
			if($this->session->has_userdata(SESSION_NAME))
				$tradeData = $this->Trade_model->get_entries("(download_key='".$cookieData."' OR from_user_id=".$this->session->userdata(SESSION_NAME)['PID'].") AND is_purchased=1 AND amount >0 AND box_id=".$box->id,1);
			else
				$tradeData = $this->Trade_model->get_entries("download_key='".$cookieData."' AND is_purchased=1 AND amount >0 AND box_id=".$box->id,1);
			if($tradeData)
			{
				$download_data = $tradeData->download_key."_".$tradeData->box_id;
				redirect('purchased/'.bin2hex($download_data));
			}	
			
			$this->load->view('header',$this->header_param);
			$this->common_param['box'] = $box;
			$this->common_param['comments'] = $this->Rating_model->get_entries(array('box_id'=>$box->id));
			$this->Box_model->update_entry(array("views_cnt"=>$box->views_cnt+1),array('id'=>$box->id));
			$this->common_param['files'] = $this->Files_model->get_entries(array('box_id'=>$box->id));
			$this->common_param['seller'] = $this->User_model->get_entries(array('PID'=>$box->user_id));
			$this->common_param['escrow']=0;
			$this->common_param['tradeData'] = $tradeData;
			if($this->session->has_userdata(SESSION_NAME))
			{
				$userData = $this->User_model->get_entries("PID='".$this->session->userdata(SESSION_NAME)['PID']."'", 1); 
				$this->common_param['escrow']=$userData->balance;
				
				
			}
			$this->load->view('download/box',$this->common_param);
			$this->footer_param['scripts'][] = 'assets/pages/scripts/download_box.js';
			$this->load->view('footer',$this->footer_param);
		}
	}
	function show_pay_info($id)
	{

		$this->load->helper('form');
		$this->load->model('Box_model');
		$this->load->model('Trade_model');
		//$this->load->model('Inout_model');
		$box=$this->Box_model->get_entries(array("id"=>$id),1);
		$coin_address = $this->Trade_model->ready_payment($box);
		$this->load->view('download/payinfo',array('box'=>$box,'coin_address'=>$coin_address));
    }
	function paycheck($boxId)
	{
		header('Content-type: application/json');
		$cookieData=get_cookie($this->config->item('sess_cookie_name'));
		$this->load->model('Trade_model');
		$this->load->model('Box_model');
		//$this->load->model('Servercoin_model');
		$box=$this->Box_model->get_entries(array("id"=>$boxId),1);
		$tradeData = $this->Trade_model->get_entries(array("download_key"=>$cookieData,"is_purchased"=>1,"amount >"=>0,"box_id"=>$boxId),1);
		if($tradeData){
			
			if($this->session->has_userdata(SESSION_NAME)){
				
				$user_id = $this->session->userdata(SESSION_NAME)['PID'];
				
			}
			if($box->user_id)
			{
				$user_id = $box->user_id;
				
				$userData = $this->User_model->get_entries("PID='".$user_id."'", 1); 
				
				$adminBtcFee = $this->Settings_model->get_val('owner_btc_fee');
				$currentBalance = $userData->balance+$box->price*(1-$adminBtcFee/100);
				$this->User_model->update_entry(array("balance"=>$currentBalance),"PID=".$user_id);
			}
			echo json_encode(array('status'=>true,'box_id'=>$boxId,'cookieData'=>$cookieData,'dlcode'=>bin2hex($cookieData."_".$boxId)));
			
		}else
			echo json_encode(array('status'=>false,'box_id'=>$boxId,'cookieData'=>$cookieData));
	}
/*
	function purchase(){
		$this->load->model('Trade_model');
		$this->load->model('Box_model');
		//$this->load->library('encrypt');
		$this->Trade_model->from_account = 'buyer address';
		if($this->session->has_userdata(SESSION_NAME))
			$this->Trade_model->from_user_id = $this->session->userdata(SESSION_NAME)['PID'];
		$this->Trade_model->to_account=$this->input->post('to_address');
		$box=$this->Box_model->get_entries(array("id"=>$this->input->post('box_id')),1);
		
		if($box){
			$this->Trade_model->to_user_id=$box->user_id;
			$this->Trade_model->server_coin_id=$box->server_coin_id;
			$this->Trade_model->amount=$box->price;
			$this->Trade_model->box_id=$box->id;
		}
		$download_data = "buyeraddress_".$this->input->post('box_id');
		//$this->Trade_model->download_key = $this->encrypt->encode($download_data);
		$this->Trade_model->download_key = bin2hex($download_data);
		$tradeId = $this->Trade_model->insert_entry();
		if($this->session->has_userdata(SESSION_NAME)){
			
			$user_id = $this->session->userdata(SESSION_NAME)['PID'];
			$coin_id = $box->server_coin_id;
			$currentBalance = $this->Trade_model->get_balance($user_id,$coin_id);
			$this->User_model->update_entry(array("balance"=>$currentBalance),"PID=".$user_id);
		}
		redirect('purchased/'.$this->Trade_model->download_key);
	}
*/
	function files($download_key){
		$download_data = explode('_',hex2bin($download_key));
		$this->load->model('Box_model');
		$this->load->model('Files_model');
		$this->load->model('Rating_model');
		$this->load->model('Trade_model');
		if($this->input->post('comment_action',0) && $this->input->post('comment')!="" && $this->input->post('ratingVal')!="0" )
		{
			$this->Rating_model->comment=$this->input->post('comment');
			$this->Rating_model->box_id=$this->input->post('box_id');
			$this->Rating_model->rating=$this->input->post('ratingVal');
			$this->Rating_model->insert_entry();
		}
		$box = $this->Box_model->get_entries(array('id'=>$download_data[1]),1);
		if(!$box)
		{
			$this->load->view('header',$this->header_param);
			$this->common_param['box_name'] = 'unknown box';
			$this->load->view('download/unknown',$this->common_param);
			$this->load->view('footer',$this->footer_param);
		}else{
			$cookieData=get_cookie($this->config->item('sess_cookie_name'));
			if($this->session->has_userdata(SESSION_NAME))
				$tradeData = $this->Trade_model->get_entries("(download_key='".$cookieData."' OR from_user_id=".$this->session->userdata(SESSION_NAME)['PID'].") AND box_id=".$box->id,1);
			else
				$tradeData = $this->Trade_model->get_entries("download_key='".$cookieData."' AND box_id=".$box->id,1);
			if(!$tradeData)
			{
				redirect('error');
			}
			
			$this->header_param['scripts'][]="assets/global/plugins/knob/jquery.knob.min.js";
			$this->load->view('header',$this->header_param);
			$this->common_param['box'] = $box;
			$this->common_param['comments'] = $this->Rating_model->get_entries(array('box_id'=>$box->id));
			$this->Box_model->update_entry(array("views_cnt"=>$box->views_cnt+1),array('id'=>$box->id));
			$this->common_param['files'] = $this->Files_model->get_entries(array('box_id'=>$box->id));
			$this->common_param['user'] = $this->User_model->get_entries(array('PID'=>$box->user_id),1);
			$this->common_param['user_rating'] = $this->Rating_model->getUserRating($box->user_id);
			$this->common_param['seller'] = $this->User_model->get_entries(array('PID'=>$box->user_id));
			$this->load->view('download/available',$this->common_param);
			$this->footer_param['scripts'][] = 'assets/pages/scripts/download_box.js';
			$this->load->view('footer',$this->footer_param);
		}
	}
	function escrow_purchase(){
		
		$this->load->model('Trade_model');
		$this->load->model('Box_model');
		$this->load->model('User_model');
		//$this->load->model('Servercoin_model');
		//$this->load->library('encrypt');
		$box=$this->Box_model->get_entries(array("id"=>$this->input->post('box_id')),1);
		
		$userData = $this->User_model->get_entries("PID='".$this->session->userdata(SESSION_NAME)['PID']."'", 1); 
		$balance = $userData->balance;
		if($balance<$box->price)
			redirect($box->box_name);
		$existTrade = $this->Trade_model->get_entries(array('from_user_id'=>$this->session->userdata(SESSION_NAME)['PID'],'box_id'=>$box->id),1);
		if($existTrade)
		{
			
			$download_data = $existTrade->download_key."_".$existTrade->box_id;
			redirect('purchased/'.bin2hex($download_data));
		}
		//user trade
		$this->Trade_model->from_account = $this->Settings_model->get_val('owner_btc_address');
		$this->Trade_model->from_user_id = $this->session->userdata(SESSION_NAME)['PID'];
		$this->Trade_model->to_user_id=$box->user_id;
		
		if($box->user_id)
			$this->Trade_model->to_account=$this->Settings_model->get_val('owner_btc_address');
		else
			$this->Trade_model->to_account=$box->seller_account;
		
		$adminBtcFee = $this->Settings_model->get_val('owner_btc_fee');
		$this->Trade_model->amount=$box->price*(1-$adminBtcFee/100);
		$this->Trade_model->box_id=$box->id;
		$this->Trade_model->is_purchased=1;
		
		
		$download_data = get_cookie($this->config->item('sess_cookie_name'))."_".$this->input->post('box_id');
		//$this->Trade_model->download_key = $this->encrypt->encode($download_data);
		$this->Trade_model->download_key = get_cookie($this->config->item('sess_cookie_name'));
		
		$this->Trade_model->insert_entry();
		//server trade
		if($adminBtcFee/100>0){
			$this->Trade_model->from_account =$this->Settings_model->get_val('owner_btc_address');
			$this->Trade_model->from_user_id = 0;
			$this->Trade_model->to_user_id=0;
			$this->Trade_model->to_account=$this->Settings_model->get_val('owner_btc_address');
			
			$this->Trade_model->amount=$box->price*$adminBtcFee/100;
			$this->Trade_model->box_id=$box->id;
			$this->Trade_model->insert_entry();
		}
		if($this->session->has_userdata(SESSION_NAME)){
				
				$user_id = $this->session->userdata(SESSION_NAME)['PID'];
				
				$userData = $this->User_model->get_entries("PID='".$this->session->userdata(SESSION_NAME)['PID']."'", 1); 
				$currentBalance = $userData->balance-$box->price;
				$this->User_model->update_entry(array("balance"=>$currentBalance),"PID=".$user_id);
		}
		if($box->user_id)
		{
			$user_id = $box->user_id;
			
			$userData = $this->User_model->get_entries("PID='".$user_id."'", 1); 
			
			$currentBalance = $userData->balance+$box->price*(1-$adminBtcFee/100);
			$this->User_model->update_entry(array("balance"=>$currentBalance),"PID=".$user_id);
		}
		redirect('purchased/'.bin2hex($download_data));
	}
	function force($id)
	{
		$this->load->model('Files_model');
		$this->load->model('Trade_model');
		$file=$this->Files_model->get_entries(array('id'=>$id),1);
		$cookieData=get_cookie($this->config->item('sess_cookie_name'));
		if($this->session->has_userdata(SESSION_NAME))
			$tradeData = $this->Trade_model->get_entries("(download_key='".$cookieData."' OR from_user_id=".$this->session->userdata(SESSION_NAME)['PID'].") AND amount>0 AND box_id=".$file->box_id,1);
		else
			$tradeData = $this->Trade_model->get_entries("download_key='".$cookieData."' AND amount>0 AND box_id=".$file->box_id,1);
		if(!$tradeData)
		{
			exit;
		}
		
		
		$this->load->helper('download');
		$this->load->helper('file');
		force_download($file->original_filename, read_file($file->full_path));
		//force_download($file->full_path,null);
	}
}