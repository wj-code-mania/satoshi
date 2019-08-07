<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulletin extends SC_Controller
{
    function __construct(){

        parent::__construct();
        $this->load->helper('email');
        $this->load->model('User_model');

    }

    function index(){
		$this->load->model('Box_model');
		$this->common_param['boxes']=$this->Box_model->get_entries(array('is_show'=>1));
		$this->load->view('header', $this->header_param);
        $this->load->view('bulletin/index',$this->common_param);
        $this->load->view('footer', $this->footer_param);
    }
}