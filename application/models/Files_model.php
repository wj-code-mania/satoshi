<?php
class Files_model extends CI_Model {

	public $box_id;
	public $original_filename;
	public $converted_filename;
	public $full_path;
	public $directory_path;
	public $file_type;
	public $file_size;
	public $__ci_last_regenerate;

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}
	public function get_entries($where=array(),$limit=NULl, $offset=NULl)
	{
			$query = $this->db->get_where('tbl_files', $where, $limit, $offset);
			if($query->num_rows()==0)
				return false;
			if($limit==1)
				return $query->row();
			return $query->result();
	}

	public function insert_entry()
	{
		$this->db->insert('tbl_files', $this);
	}
	
	public function update_entry()
	{
			$this->title    = $_POST['title'];
			$this->content  = $_POST['content'];
			$this->date     = time();

			$this->db->update('entries', $this, array('id' => $_POST['id']));
	}
	public function delete_entry($where)
	{
		$this->db->delete('tbl_files', $where);
	}
	public function setBox($boxId,$__ci_last_regenerate)
	{
		$this->db->update('tbl_files', array('box_id'=>$boxId,), array('box_id'=>0,'__ci_last_regenerate' => $__ci_last_regenerate));
	}
}
?>