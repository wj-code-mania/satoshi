<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Servercoin_model extends CI_Model {
		public $coin_type;
		public $coin_address;
		
		public function __construct()
		{
				// Call the CI_Model constructor
				parent::__construct();
		}
		public function get_entries($where=null, $limit=null, $offset=null)
		{
			$query = $this->db->get_where('tbl_servercoin', $where, $limit, $offset);
			if($query->num_rows()==0)
				return false;
			if($limit==1)
				return $query->row();
			return $query->result();
        }
		
	}
?>