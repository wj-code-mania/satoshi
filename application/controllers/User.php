<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// project by KSTAR.
class User extends SC_Controller
{
    function __construct(){

        parent::__construct();
        $this->load->helper('email');
        $this->load->model('User_model');
        $this->load->model('Trade_model');
		$this->load->model('Inout_model');
		
        //$this->load->model('Servercoin_model');
    }

    function index(){	
    }

    function signin(){

        $this->load->helper('form');
        $this->load->view('user/signin.php');
    
    }

    function signup(){   
        $this->load->view('user/signup.php');
    }

    function signout(){
        $this->session->unset_userdata(SESSION_NAME);
        redirect('/');
    }

    function boxes(){
		$this->load->helper('form');
		$this->load->model('Box_model');
        $this->common_param['boxes'] = $this->Box_model->get_entries(array('user_id'=>$this->session->userdata(SESSION_NAME)['PID']));;
        // $this->footer_param['scripts'][] = 'assets/pages/scripts/yourboxes.js';
        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
		
		$this->common_param['last_boxes'] = $this->Box_model->get_entries(array('user_id'=>NULL,'__ci_last_regenerate'=>get_cookie($this->config->item('sess_cookie_name'))));
        $this->load->view('user/boxes',$this->common_param);
        $this->load->view('footer', $this->footer_param);
    }
	function importBox(){
		$boxId=$this->input->post('id');
		$this->load->model('Box_model');
		$this->Box_model->update_entry(array('user_id'=>$this->session->userdata(SESSION_NAME)['PID']),array('id'=>$boxId));
		redirect('user/boxes');
	}
    function withdrawal(){
        $this->load->helper('form');
        $this->common_param = array("present_menu_type" => 'delete_manage_box');

        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/additional-methods.min.js';
        $this->footer_param['scripts'][] = 'assets/pages/scripts/withdrawal.js';

        if ($this->input->post('coin_id') && 
            $this->input->post('address')) {
            $coin_balance = $this->Trade_model->get_balance($this->session->userdata[SESSION_NAME]['PID']);

            if ($coin_balance > 0) {
                //$server_coin_info = $this->Servercoin_model->get_entries(array("id" => $this->input->post('coin_id')), 1);

                $this->Inout_model->user_id=$this->session->userdata[SESSION_NAME]['PID'];
				
				$this->Inout_model->amount=$coin_balance;
				$this->Inout_model->action_type="OUT";
				$this->Inout_model->coin_address=$this->input->post('address');
				$this->Inout_model->insert_entry();
				if($this->session->has_userdata(SESSION_NAME)){
					$user_id = $this->session->userdata(SESSION_NAME)['PID'];
					$currentBalance = $this->Trade_model->get_balance($user_id);
					$this->User_model->update_entry(array("balance"=>$currentBalance),"PID=".$user_id);
				}
			}
        }
		//$DataParam['balance_list'] = $this->Trade_model->balance_list($this->session->userdata[SESSION_NAME]['PID']);
		$DataParam['userdata'] = $this->User_model->get_entries("PID='".$this->session->userdata(SESSION_NAME)['PID']."'", 1); 
        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
        $this->load->view('user/withdrawal', $DataParam);
        $this->load->view('footer', $this->footer_param);
    }

    function changepassword(){
        $this->load->helper('form');
        $this->common_param = array("present_menu_type" => 'delete_manage_box');

        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/additional-methods.min.js';
        $this->footer_param['scripts'][] = 'assets/pages/scripts/changepassword.js';

        $dataParams['is_changed'] = 0;

        if ($this->input->post('curpassword') && 
            $this->input->post('password') && 
            $this->input->post('repassword')) {
            $this->User_model->update_entry(
                array(
                    'password' => do_hash($this->input->post('password'), 'md5')
                ),
                array(
                    'email'    => $this->session->userdata(SESSION_NAME)['email'],
                    'password' => do_hash($this->input->post('curpassword'), 'md5')
                )
            );

            $dataParams['is_changed'] = 1;
        }

        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
        $this->load->view('user/changepassword', $dataParams);
        $this->load->view('footer', $this->footer_param);
    }

    function changeemail(){
        $this->load->helper('form');
        $this->common_param = array("present_menu_type" => 'delete_manage_box');

        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/additional-methods.min.js';
        $this->footer_param['scripts'][] = 'assets/pages/scripts/changeemail.js';
        
        $dataParams['is_changed'] = 0;
		
        if ($this->input->post('email')) {
            $this->User_model->update_entry(
                array(
                    'email' => $this->input->post('email'),
                    'payment_notice' => $this->input->post('payment_notice') == 'on' ? 0 : 1
                ),
                array(
                    'email'    => $this->session->userdata(SESSION_NAME)['email'],
                )
            );
		    $userdata = $this->session->userdata(SESSION_NAME);
            $userdata['email'] = $this->input->post('email');

            $this->session->set_userdata(SESSION_NAME,$userdata);

            $dataParams['is_changed'] = 1;
        }
        
        $dataParams['userdata'] = $this->User_model->get_entries("email='".$this->session->userdata(SESSION_NAME)['email']."'", 1);

        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
        $this->load->view('user/changeemail', $dataParams);
        $this->load->view('footer', $this->footer_param);
    }

  	protected function _session_register($userModel){
    	$session=array();
		$session['PID']=$userModel->PID;
		$session['user_name']=$userModel->user_name;
		$session['email']=$userModel->email;
		$this->session->set_userdata(SESSION_NAME,$session);
    }
    
    function login(){
        $email = $this->input->post('email');
		$passwd = do_hash($this->input->post('passwd'), 'md5');
        $user = $this->User_model->get_entries("email='".$email."' AND password='".$passwd."'",1);
		if($user==false)
			echo json_encode(array('accessGranted'=>false,'errors'=>'Your email or password are incorrect.'));
		else if($user->email_verified!='1'){
			echo json_encode(array('accessGranted'=>false,'errors'=>'At first,You need verify you email account.'));
		}else{
			$this->_session_register($user);
			echo json_encode(array('accessGranted'=>true));
			//redirect('user/boxes');
		}
	}
    
	function verify($code){
		$user = $this->User_model->get_entries(array('verify_code'=>$code),1);
		if($user)
			$this->User_model->update_entry(array('email_verified'=>'1','verify_code'=>null),array('PID'=>$user->PID));
	//	else

        $this->common_param['state_verify'] = 1;

        $this->load->view('header',$this->header_param);
        
        $this->load->view('user/verify',$this->common_param);
        $this->load->view('footer',$this->footer_param);
	}

    function ajax_register(){
		header('Content-type: application/json');
        $email = $this->input->post('email');
        $where = "email = '" . $email . "'";

        if (isset($this->session->userdata(SESSION_NAME)['email'])) {
            $where .= " AND email != '" . $this->session->userdata(SESSION_NAME)['email'] . "'";
        }
        
        $user = $this->User_model->get_entries($where,1);
        if($user){
            echo json_encode(array("accessGranted" => false,"errors"=>"This email address was used."));
			exit;
		}
		$this->User_model->user_name   =  $this->input->post('user_name');
		$this->User_model->password    =  do_hash($this->input->post('passwd'), 'md5');
		
		$this->User_model->email       =  $this->input->post('email');
		$this->User_model->email_verified = '0';

        $this->load->helper('string');

		$this->User_model->verify_code =  random_string('alnum', 16);
		$this->User_model->insert_entry();
        
		//send EMAIL
		/*
		$this->load->library('email');
		$this->email->from('servicer@pzion.com', 'Servicer');
		$this->email->to($email);
		$this->email->subject('Welcome to pzion.');
		$this->email->message('Please verify on '.site_url('/user/verify/'.$this->User_model->verify_code));
		$this->email->send();
		*/
		//$this->load->helper('email');
		//send_email($email, 'Welcome to pzion.', 'Please verify on '.site_url('/user/verify/'.$this->User_model->verify_code));

		mail($email, 'Welcome to pzion.', 'Please verify on '.site_url('/user/verify/'.$this->User_model->verify_code));

		echo json_encode(array("accessGranted" => true));
    }

	function ajax_email_available(){
        $email = $this->input->post('email');
        $where = "email = '" . $email . "'";

        if (isset($this->session->userdata(SESSION_NAME)['email'])) {
            $where .= " AND email != '" . $this->session->userdata(SESSION_NAME)['email'] . "'";
        }
        
        $user = $this->User_model->get_entries($where,1);
        if($user==false)
            echo json_encode(array("state" => 0));
        else
            echo json_encode(array("state" => 1));
    }
    function ajax_curpassword_available() {
		header('Content-type: application/json');
        $password = do_hash($this->input->post('curpassword'),'md5');
        $user = $this->User_model->get_entries("email='".$this->session->userdata(SESSION_NAME)['email']."' AND password='".$password."'",1);
        if($user==false)
            echo json_encode(array("state" => 0));
        else
            echo json_encode(array("state" => 1));
    }
}