<?php
class Box_model extends CI_Model {

	public $category;
	public $title;
	public $box_name;
	public $price;

	public $seller_account;
	public $user_id;
	public $description;
	public $is_show;
	public $__ci_last_regenerate;

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}
	public function get_entries($where=array(),$limit=NULl, $offset=NULl)
	{
			$query = $this->db->get_where('tbl_box', $where, $limit, $offset);
			if($query->num_rows()==0) return false;
			if($limit==1) return $query->row();
			return $query->result();
	}

	public function insert_entry()
	{
		$this->db->insert('tbl_box', $this);
		return $this->db->insert_id();
	}

	public function update_entry($values, $where)
    {
        $this->db->update('tbl_box', $values, $where);
    }

	public function delete_entry($where)
	{
		$this->db->delete('tbl_box', $where);
	}
}
?>