<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User_model extends CI_Model {

                public $user_name;
                public $password;
                public $email;
				
                public function __construct()
                {
                        // Call the CI_Model constructor
                        parent::__construct();
                }

                public function get_entries($where=null, $limit=null, $offset=null)
                {
                    
			$query = $this->db->get_where('tbl_user', $where, $limit, $offset);
			if($query->num_rows()==0)
				return false;
			if($limit==1)
				return $query->row();
			$query->result();
                }
				

                public function insert_entry()
                {
			$this->db->insert('tbl_user', $this);
			return $this->db->insert_id();
                }

                public function update_entry($values, $where)
                {
                        $this->db->update('tbl_user', $values, $where);
                }
                public function get_userinfo(){

                        $this->user_name = $this->input->post('name_email');
                        $this->email = $this->input->post('name_email');
                        $this->password = $this->input->post('password');

                        $sql = "SELECT tbl_user.'PID' FROM 'tbl_user' WHERE (tbl_user.user_name = ".$this->user_name." OR tbl_user.email = ".$this->email.") AND tbl_user.'password' = ".$this->password;

                        $query = $this->db->query($sql);

                        return $this->row_array();
                }
				
	}
?>