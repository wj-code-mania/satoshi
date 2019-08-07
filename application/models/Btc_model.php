<?php
class Btc_model extends CI_Model {

	public $access_token = "";

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();

		$this->load->library('Blockcypher_Library');
	}

	public function generate_new_addr() {

		$url = 'https://api.blockcypher.com/v1/btc/main/addrs';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = json_decode(curl_exec($ch));

		curl_close($ch);

		return $this->send_curl($url);

	}

	public function get_balance($addr) {

	}

	public function is_valid_addr($addr) {

		$url = 'https://api.blockcypher.com/v1/btc/main/addrs/' . $to_address;
		$result = $this->send_curl($url);

		if (isset($result->error) || !isset($result->address)) {
			return 0;
		} else {
			return 1;
		}

	}

	public function send_btc($fromAddr, $toAddr, $ammount, $privKey) {

		$txResult = $this->blockcypher_library->NewTransactionEndpoint('btc', $this->access_token, $fromAddr, $toAddr, $ammount, $privKey);

		if (isset($txResult->error)) {
			return 0;
		} else {
			return $txResult->hash;
		}

	}

	public function get_usd_rate () {

	}


}
?>