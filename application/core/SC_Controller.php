<?php
class SC_Controller extends CI_Controller
{
    var $header_param = array();
	var $footer_param = array();
	var $common_param = array();
	function __construct()
    {
        $this->header_param['scripts'] = array();
		$this->header_param['styles'] = array();
		$this->footer_param['styles'] = array();
		$this->footer_param['scripts'] = array();
		parent::__construct();
		$this->load->model('Settings_model');
		/***********UPLOAD MAX SIZE***********/
		if ((int)ini_get('post_max_size')!=$this->Settings_model->get_val('max_upload_size')) {
			@ini_set('post_max_size', $this->Settings_model->get_val('max_upload_size')*1024);
		}
		if ((int)ini_get('upload_max_filesize')!=$this->Settings_model->get_val('max_upload_size')) {
			@ini_set('upload_max_filesize', $this->Settings_model->get_val('max_upload_size'));
		}
		//echo ((int)ini_get("post_max_size")<(int)ini_get("upload_max_filesize") ? (int)ini_get("post_max_size") : (int)ini_get("upload_max_filesize"))*1024;
		/*************************************/
		if($this->session->has_userdata(SESSION_REGENERATE)==false)
			$this->session->set_userdata(SESSION_REGENERATE,now());
		//$this->load->library('user_agent');
		//$this->agent->agent_string().$this->input->ip_address()
		$rsegs=$this->uri->rsegment_array();
		$segs=$this->uri->segment_array();
		$public_url = $this->config->item('public_url');
		if (count($segs)!=0){
			if (!array_key_exists($rsegs[1],$public_url) && !$this->session->has_userdata(SESSION_NAME))
				redirect('/');
			else if(!array_key_exists($rsegs[1],$public_url))
				$public_url[$rsegs[1]] = array();
			if (!in_array($rsegs[2], $public_url[$rsegs[1]]) && !$this->session->has_userdata(SESSION_NAME))
				redirect('/');
		}

		$this->load->library('Blockcypher_Library');
		$this->blockcypher = new Blockcypher_Library();
	}
}