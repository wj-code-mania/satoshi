<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Settings_model extends CI_Model {
		public function __construct()
		{
				// Call the CI_Model constructor
				parent::__construct();
		}
		public function get_val($item)
		{
			$query = $this->db->get_where('tbl_settings', array('item'=>$item),1);
			if($query->num_rows()==0)
				return false;
			$row = $query->row();
			return $row->val;
		}
	}
?>