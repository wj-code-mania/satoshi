<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// project by KSTAR.
class Upload extends SC_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->model('Files_model');

    }	

    function index()
    {

		$this->load->helper('form');
		$this->load->model('Files_model');
		//$this->load->model('Servercoin_model');
		
		$this->load->helper('form');
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/jquery.validate.min.js';
        $this->header_param['scripts'][] = 'assets/global/plugins/jquery-validation/js/additional-methods.min.js';
		$this->header_param['styles'][] = 'assets/global/plugins/dropzone/dropzone.min.css';
		$this->header_param['scripts'][] = 'assets/global/plugins/dropzone/dropzone.min.js';
		$this->header_param['scripts'][] = 'assets/global/plugins/inputmask/jquery.inputmask.bundle.js';

		$this->footer_param['scripts'][] = 'assets/pages/scripts/upload_index.js';
		$this->header_param['styles'][] = 'assets/pages/css/upload_index.css';
		$this->common_param['upload_files'] = $this->Files_model->get_entries(array('box_id'=>0,'__ci_last_regenerate'=>$this->session->userdata(SESSION_REGENERATE)));
		//$this->common_param['server_coins'] =$this->Servercoin_model->get_entries();
		//$this->common_param['max_upload_size'] =$this->Settings_model->get_val('max_upload_size');
		$configUpload = $this->config->item('upload');
		$max_size =$configUpload['max_size'];
		$this->common_param['max_upload_size'] = $max_size/1024;
		$this->common_param['cur_rate'] = $this->get_current_rate();
		$this->load->view('header',$this->header_param);
		$this->load->view('upload/index',$this->common_param);
		$this->load->view('footer',$this->footer_param);

    }
	
	function send()
	{
		header('Content-type: application/json');
		$this->load->helper('string');
		
		$config = $this->config->item('upload');
		$config['upload_path'] .= $this->session->userdata(SESSION_REGENERATE);
		$config['file_name'] = increment_string($this->session->userdata(SESSION_REGENERATE),'_').".".$this->config->item('encryption_key');
		$this->load->library('upload', $config);
		
		if($this->upload->validate_upload_path()==false)
		{
			if (!mkdir($config['upload_path'], DIR_WRITE_MODE, true))
			{
				$error = array('error' => 'Failed to create folders...');
				echo json_encode(array('status'=>0,$error));
				exit;
			}
		}

		if ( ! $this->upload->do_upload('file'))
		{
			echo json_encode(array('status'=>0,'error' => $this->upload->display_errors('','')));
		}
		else
		{
			$this->Files_model->box_id = 0;
			$this->Files_model->original_filename=sanitize_filename($this->upload->data('client_name'));
			$this->Files_model->converted_filename =$this->upload->data('file_name');
			$this->Files_model->directory_path=$config['upload_path'];
			$this->Files_model->full_path=$this->upload->data('full_path');
			$this->Files_model->file_type=$this->upload->data('file_type');
			$this->Files_model->file_size=$this->upload->data('file_size');
			//Files:session data , BOX : Cookie data
			$this->Files_model->__ci_last_regenerate=$this->session->userdata(SESSION_REGENERATE);
			//$this->Files_model->__ci_last_regenerate=get_cookie($this->config->item('ci_session'));
			$this->Files_model->insert_entry();
			//$data = array('upload_data' => $this->upload->data());
			echo json_encode(array('status'=>1,'id'=>$this->db->insert_id()));
		}
	}
	function remove()
	{
		header('Content-type: application/json');
		//$this->load->helper('file');
		$id = $this->input->post('id');
		$files = $this->Files_model->get_entries(array('id'=>$id));
		if(count($files)>0)
		{
			foreach($files as $file)
			{
				unlink($file->full_path);
			}
			$this->Files_model->delete_entry(array('id'=>$id));
		}
		//$upload_files = $this->Files_model->get_entries(array('__ci_last_regenerate'=>$this->session->userdata(SESSION_REGENERATE)));
		echo json_encode(array('status'=>0));
	}
	/**
		This is current rate from Internet
		You can change this under code to insert $cur_Rate.
	**/
	function get_current_rate(){
		$cur_rate = $this->blockcypher->get_btc_rate();//this code
		return $cur_rate;
		// echo json_encode(array('cur_rate'=>$cur_rate));
	}
}