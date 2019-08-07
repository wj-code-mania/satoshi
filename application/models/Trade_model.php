<?php
class Trade_model extends CI_Model {
	public $from_account;
	public $from_user_id;
	public $to_account;
	public $to_user_id;

	public $amount;
	public $box_id;
	public $download_key;
	public function __construct()
	{
		parent::__construct();
	}
	public function insert_entry()
	{
		$this->db->insert('tbl_trade', $this);
		return $this->db->insert_id();
	}
	public function ready_payment($box)
	{
		if($this->session->has_userdata(SESSION_NAME))
			$this->from_user_id=$this->session->userdata(SESSION_NAME)['PID'];
		//$this->to_account=$box->seller_account;
		$cookieData=get_cookie($this->config->item('sess_cookie_name'));
		$btcAddrInfo = $this->blockcypher->gen_btc_addr();

		$this->load->helper('string');
		$this->to_account = $box->seller_account;
		
		$this->to_user_id=$box->user_id;
		$this->box_id=$box->id;
		$this->amount=$box->price;
		$this->download_key = $cookieData;
		$this->private = $btcAddrInfo->private;
		$this->public = $btcAddrInfo->public;
		$this->address = $btcAddrInfo->address;
		$this->wif = $btcAddrInfo->wif;
		
		if($this->get_entries(array("download_key"=>$cookieData,"box_id"=>$box->id)))
		{
			
			$tradeRow = $this->get_entries(array("download_key"=>$cookieData,"box_id"=>$box->id),1);
			$this->db->update('tbl_trade', $this, "id = ".$tradeRow->id);
		}else{
			
			$this->db->insert('tbl_trade', $this);	
		}
		
		
		return $this->address;
	}
	public function get_entries($where=array(),$limit=NULl, $offset=NULl)
	{
			$query = $this->db->get_where('tbl_trade', $where, $limit, $offset);
			if($query->num_rows()==0) return false;
			if($limit==1) return $query->row();
			return $query->result();
	}
	/*
	function balance_list($user_id){
		$sql = "SELECT SUM(a.amount) balance
					FROM
					(
						SELECT -amount as amount FROM tbl_inout WHERE action_type='OUT' AND user_id = ?

						UNION ALL
						
						SELECT amount FROM tbl_inout WHERE action_type='IN' AND user_id = ?
						
						UNION ALL
						
						SELECT -amount as amount FROM tbl_trade WHERE is_purchased=1 AND from_user_id = ?

						UNION ALL
						
						SELECT amount FROM tbl_trade WHERE is_purchased=1 AND to_user_id = ?
					) AS a";
		$query = $this->db->query($sql, array($user_id, $user_id,$user_id, $user_id));
		return $query->result_array();
	}
*/
	function get_balance($user_id) {
		$sql = "SELECT SUM(a.amount) balance
				FROM
				(
					SELECT -amount as amount FROM tbl_inout WHERE action_type='OUT' AND user_id = ?

					UNION ALL
					
					SELECT amount FROM tbl_inout WHERE action_type='IN' AND user_id = ?
					
					UNION ALL

					SELECT -amount as amount FROM tbl_trade WHERE from_user_id = ?

					UNION ALL
					
					SELECT amount FROM tbl_trade WHERE to_user_id = ?
				) AS a";
		$query = $this->db->query($sql, array($user_id, $user_id,$user_id, $user_id));
		
		return $query->row_array()['balance'];
	}
}
?>