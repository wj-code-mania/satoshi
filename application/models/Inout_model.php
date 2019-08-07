<?php
class Inout_model extends CI_Model {
	public $user_id;

	public $amount;
	public $action_type;
	public $coin_address;
	
	public function __construct()
	{
		parent::__construct();
	}
	public function insert_entry()
	{
		$this->db->insert('tbl_inout', $this);
		return $this->db->insert_id();
	}
	
}
?>