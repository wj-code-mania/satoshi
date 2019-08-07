<?php
class Rating_model extends CI_Model {

	public $box_id;
	public $rating;
	public $comment;
	
	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}
	public function get_entries($where=array(),$limit=NULl, $offset=NULl)
	{
			$query = $this->db->get_where('tbl_rating', $where, $limit, $offset);
			if($query->num_rows()==0) return false;
			if($limit==1) return $query->row();
			return $query->result();
	}

	public function insert_entry()
	{
		$this->db->insert('tbl_rating', $this);
		return $this->db->insert_id();
	}
	public function getUserRating($user_id)
	{
		$query = $this->db->get_where('tbl_box', array("user_id"=>$user_id));
		$boxIds = array();
		if($query->num_rows()>0){
			$rows = $query->result();
			foreach ($rows as $row) {
				$boxIds[]=$row->id;
			}
		}
		$this->db->select_avg('rating');
		$this->db->where_in('box_id', $boxIds);
		$query = $this->db->get('tbl_rating');
		if($query->num_rows()==0) return 0;
		$row=$query->row();
		return $row->rating;
	}
	public function getBoxRating($box_id)
	{
		$this->db->select_avg('rating');
		$query = $this->db->get_where('tbl_rating',array("box_id"=>$box_id));
		if($query->num_rows()==0) return 0;
		$row=$query->row();
		return $row->rating;
		
	}

}
?>