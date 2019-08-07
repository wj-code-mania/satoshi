<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Box extends SC_Controller
{
    function __construct(){

        parent::__construct();
        $this->load->helper('email');
        $this->load->model('User_model');

    }

    function index(){
		$this->load->library('user_agent');
    }
	function save()
	{
		$this->load->model('Box_model');
		$this->load->model('Files_model');
		//$this->load->model('Servercoin_model');
		$this->Box_model->box_name = do_hash(now().$this->session->userdata(SESSION_REGENERATE),'md5');
		$this->Box_model->price =$this->input->post('price_btc');

        // var_dump($this->Box_model->price);
        // exit;

		
		//$this->Servercoin_model->get_entries(array(),1)->id;
		
		$this->Box_model->is_show =($this->input->post('is_show'))?0:1;
		$this->Box_model->seller_account=$this->input->post('pay_address');
		if($this->session->has_userdata(SESSION_NAME))
			$this->Box_model->user_id = $this->session->userdata(SESSION_NAME)['PID'];
		if($this->Box_model->is_show==1 && $this->session->has_userdata(SESSION_NAME))
		{
			$this->Box_model->category=$this->input->post('category');
			$this->Box_model->title=$this->input->post('title');
			$this->Box_model->description=$this->input->post('description');
			$upload_config = $this->config->item('upload');
			$upload_config['upload_path'] .= "images";
			$upload_config['file_name'] = sanitize_filename($this->Box_model->title."_thumbnail");
			$this->load->library('upload', $upload_config);
			if($this->upload->validate_upload_path()==false)
			{
				$error = array('error' => 'Failed to create folders...');
				
				
			}
			if ( ! $this->upload->do_upload('box_image'))
			{
				$error = array('error' => $this->upload->display_errors());
				
			}
			else
			{
				/*
				$thumb_config['image_library'] = 'gd2';
				$thumb_config['source_image'] = $this->upload->data('full_path');
				$thumb_config['create_thumb'] = TRUE;
				$thumb_config['maintain_ratio'] = TRUE;
				$thumb_config['width']         = 75;
				$thumb_config['height']       = 50;
				$this->load->library('image_lib', $thumb_config);
				$this->image_lib->resize();*/
				$this->Box_model->box_image=$this->upload->data('file_name');
			}
		}
		//$this->Box_model->__ci_last_regenerate=$this->session->userdata(SESSION_REGENERATE);
		$this->Box_model->__ci_last_regenerate=get_cookie($this->config->item('sess_cookie_name'));
		
		$files = $this->Files_model->get_entries(array('box_id'=>0,'__ci_last_regenerate'=>$this->session->userdata(SESSION_REGENERATE)));
		
		if(!$files) redirect("/");
		//$this->Files_model->setBox($this->Box_model->insert_entry(),$this->session->userdata(SESSION_REGENERATE));
		$this->Files_model->setBox($this->Box_model->insert_entry(),$this->session->userdata(SESSION_REGENERATE));
		redirect("/".$this->Box_model->box_name);
	}
	function update()
	{
		$this->load->model('Box_model');
		$box = $this->Box_model->get_entries(array('id'=>$this->input->post('box_id',0)),1);
		if(!$box) redirect("/");
		
		$update_box=array();
		$update_box['is_show'] =($this->input->post('is_show'))?0:1;
		$update_box['description']=$this->input->post('description');
		$update_box['msg_customers']=$this->input->post('msg_customers');
		if($update_box['is_show']==1)
		{
			$update_box['category']=$this->input->post('category');
			$update_box['title']=$this->input->post('title');
			$upload_config = $this->config->item('upload');
			$upload_config['upload_path'] .= 'images';
			$upload_config['file_name'] = sanitize_filename($update_box['title']."_thumbnail");
			$this->load->library('upload', $upload_config);
			if($this->upload->validate_upload_path()==false)
			{
				$error = array('error' => 'Failed to create folders...');
				
				
			}
			if ( ! $this->upload->do_upload('box_image'))
			{
				$error = array('error' => $this->upload->display_errors());
				//echo $upload_config['upload_path'];
				//print_r($error);
				//exit;
			}
			else
			{
				/*
				$thumb_config['image_library'] = 'gd2';
				$thumb_config['source_image'] = $this->upload->data('full_path');
				$thumb_config['create_thumb'] = TRUE;
				$thumb_config['maintain_ratio'] = TRUE;
				$thumb_config['width']         = 75;
				$thumb_config['height']       = 50;
				$this->load->library('image_lib', $thumb_config);
				$this->image_lib->resize();*/
				$update_box['box_image']=$this->upload->data('file_name');
			}
		}
		$this->Box_model->update_entry($update_box,array('id'=>$box->id));
		redirect("box/boxedit/".$box->id);
	}
	
    function signin(){

        $this->load->helper('form');
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/additional-methods.min.js';
		$this->footer_param['scripts'][] = 'assets/pages/scripts/user_signin.js';
        
        
        $this->load->view('header', $this->header_param);
        $this->load->view('user/signin.php');
        $this->load->view('footer', $this->footer_param);

    }

    function signup(){   

        $this->load->helper('form');
        
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/additional-methods.min.js';
        $this->footer_param['scripts'][] = 'assets/pages/scripts/user_signup.js';

        $this->load->view('header', $this->header_param);
        $this->load->view('user/signup.php');
        $this->load->view('footer', $this->footer_param);

    }

    function signout(){
        $this->session->unset_userdata(SESSION_NAME);
        redirect('/');
    }

    // show 'You account' menu contents
    function boxedit($box_id = 0){
		if($box_id==0)
			redirect('user/boxes');
        $this->common_param['box_id'] = $box_id;
        $this->common_param['present_menu_type'] = 'add_manage_box';

        //the operation to get Box details from box_id
        $this->load->model('Box_model');
        $box = $this->Box_model->get_entries(array('id'=>$box_id),1);
        $this->common_param['box'] = $box;
        //end operation        

        $this->load->helper('form');        

        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/additional-methods.min.js';

        $this->footer_param['scripts'][] = 'assets/pages/scripts/box_edit.js';
        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
        $this->load->view('box/boxedit', $this->common_param);
        $this->load->view('footer', $this->footer_param);
    }


    // show 'Manage Box' menu contents
    function share_embed($box_id = 0){
        $this->common_param['box_id'] = $box_id;
        $this->common_param['present_menu_type'] = 'add_manage_box';

        //the operation to get current paymentURL from box_id
        $this->load->model('Box_model');
        $box = $this->Box_model->get_entries(array('id'=>$box_id),1);
        $this->common_param['box_name'] = $box->box_name;
        //end operation

        $this->footer_param['scripts'][] = 'assets/pages/scripts/share_embed.js';
        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
        $this->load->view('box/share_embed');
        $this->load->view('footer', $this->footer_param);
    }

    function box_details($box_id = 0){
        $this->common_param['box_id'] = $box_id;
        $this->common_param['present_menu_type'] = 'add_manage_box';

        $this->footer_param['scripts'][] = 'assets/pages/scripts/box_details.js';
        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
        $this->load->view('box/box_details');
        $this->load->view('footer', $this->footer_param);
    }

    function redirect_box($box_id = 0){
        $this->common_param['box_id'] = $box_id;
        $this->common_param['present_menu_type'] = 'add_manage_box';

        //the operation to get current redirect URL from box_id
        $this->load->model('Box_model');
        $box = $this->Box_model->get_entries(array('id'=>$box_id),1);

        $this->common_param['current_redirect_url'] = $box->redirect_url;
        //end opertaion

        // using in redirect_box view 
        $this->load->helper('form');

        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/additional-methods.min.js';

        $this->footer_param['scripts'][] = 'assets/pages/scripts/redirect_box.js';
        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
        $this->load->view('box/redirect_box', $this->common_param);
        $this->load->view('footer', $this->footer_param);
    }

    function sell_once_only($box_id = 0){
        $this->common_param['box_id'] = $box_id;
        $this->common_param['present_menu_type'] = 'add_manage_box';

        //the operation to get current redirect URL from box_id
        $this->load->model('Box_model');
        $box = $this->Box_model->get_entries(array('id'=>$box_id),1);
        $this->common_param['current_once_only'] = $box->is_once_only;
        //end opertaion

        // using in redirect_box view 
        $this->load->helper('form');

        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/additional-methods.min.js';
        $this->footer_param['scripts'][] = 'assets/pages/scripts/sell_once_only.js';
        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
        $this->load->view('box/sell_once_only');
        $this->load->view('footer', $this->footer_param);
    }

    function delete_content($box_id = 0){
        $this->common_param['box_id'] = $box_id;    
        $this->common_param['present_menu_type'] = 'add_manage_box';

        $this->load->helper('form');

        $this->footer_param['scripts'][] = 'assets/pages/scripts/delete_content.js';
        $this->load->view('header', $this->header_param);
        $this->load->view('menu', $this->common_param);
        $this->load->view('box/delete_content');
        $this->load->view('footer', $this->footer_param);
    }

    function delete_box_from_box_id(){
        $this->load->model('Box_model');
        $this->Box_model->delete_entry(
            array(
                'id'      => $this->input->post('box_id')
            )
        );
        redirect('user/boxes');
    }

    function save_redirect_url(){

        $this->load->model('Box_model');

        $this->Box_model->update_entry(
            array(
                'redirect_url' => $this->input->post('redirect_url')
            ),
            array(
                     'id'      => $this->input->post('box_id')
            )
        );
        echo 'success';
    }

    function save_sell_once_only_state(){

        $this->load->model('Box_model');

        echo "asdfasdf";
        echo $this->input->post('check_state');
        exit;

        $this->Box_model->update_entry(
            array(
                'is_once_only' => $this->input->post('check_state')
            ),
            array(
                     'id'      => $this->input->post('box_id')
            )
        );
        echo 'success';
    }
}