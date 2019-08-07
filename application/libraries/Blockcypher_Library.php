<?php
	
	use BlockCypher\Api\TX;
	use BlockCypher\Auth\SimpleTokenCredential;
	use BlockCypher\Rest\ApiContext;
	use BlockCypher\Client\TXClient;
	use BlockCypher\Client\AddressClient;
	use BlockCypher\Client\paymentForwardClient;
	
    class Blockcypher_Library
    {
        public function __construct()
        {
            log_message('Debug', 'Blockcypher class is loaded.');
        }

		public function getNewAddress($coin, $blockcypherToken)
        {
			require APPPATH . '../assets/blockcypher/php-client/autoload.php';
			$apiContext = ApiContext::create(
				'main', $coin, 'v1',
				new SimpleTokenCredential($blockcypherToken),
				array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
			);
			$addressClient = new AddressClient($apiContext);
			$addressKeyChain = $addressClient->generateAddress();
			return $addressKeyChain;
		}

		public function signer($tosign, $privateKey)
        {
			require APPPATH . '../assets/blockcypher/php-client/autoload.php';
            try {
                $signature = BlockCypher\Crypto\Signer::sign($tosign, $privateKey);
            } catch (Exception $ex) {
                ResultPrinter::printError("Sign", "toSign", null, json_encode($tosign), $ex);
                exit(1);
            }
            return $signature;
		}

		public function deletePaymentForwardAddress($addressId)
		{
			require APPPATH . '../assets/blockcypher/php-client/autoload.php';
			$apiContext = ApiContext::create(
				'main',
				'btc',
				'v1',
				new SimpleTokenCredential('7c34777a04354e7ea5d02ddee36a9a91'),
				array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
			);
			$ForwardClient = new paymentForwardClient($apiContext);
			$result = $ForwardClient->deleteForwardingAddress($addressId);
			return $result;
		}
		
        public function NewTransactionEndpoint($coin, $blockcypherToken, $from_address, $to_address, $amount, $privatekey)
        {
			require APPPATH . '../assets/blockcypher/php-client/autoload.php';
			if($coin == 'btc'){
				$apiContext = ApiContext::create(
					'main',
					$coin,
					'v1',
					new SimpleTokenCredential($blockcypherToken),
					array('log.LogEnabled' => true, 'log.FileName' => 'BlockCypher.log', 'log.LogLevel' => 'DEBUG')
				);
				$tx = new TX();
				$input = new \BlockCypher\Api\TXInput();
				$input->addAddress($from_address);
				$tx->addInput($input);
				$output = new \BlockCypher\Api\TXOutput();
				$output->addAddress($to_address);
				$tx->addOutput($output);
				$output->setValue($amount);

				$txClient = new TXClient($apiContext);
				$txSkeleton = $txClient->create($tx);
				$txSkeleton = $txClient->sign($txSkeleton, $privatekey);
				$txSkeleton = $txClient->send($txSkeleton);
				return $txSkeleton;
			}else if($coin == 'eth'){
				$url = "https://api.blockcypher.com/v1/eth/main/txs/new?token=" . $blockcypherToken;
				$ch = curl_init();
				$postData = '{"inputs":[{"addresses": ["' . $from_address . '"]}],"outputs":[{"addresses": ["' . $to_address . '"], "value": ' . $amount . '}]}';
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				try {
					$result = curl_exec($ch);
				} catch (Exception $ex) {
				}
				curl_close($ch);
				$post_data = json_decode($result);
				$tosign = $post_data->tosign[0];
				try {
					$signature = BlockCypher\Crypto\Signer::sign($tosign, $privatekey);
				} catch (Exception $ex) {
				}
				$post_data->signatures[0] = $signature;
				$post_data = json_encode($post_data);
				$ch = curl_init();
				$url = "https://api.blockcypher.com/v1/eth/main/txs/send?token=" . $blockcypherToken;
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				try {
					$result = curl_exec($ch);
				} catch (Exception $ex) {
				}
				curl_close($ch);
				$api_result = json_decode($result);
				return $api_result;
			}
        }


        //--------------------------------------------------------------2019-05-01

        function send_curl_request($url, $post = 0, $postData = false)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, $post);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			if($post == 1){
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = json_decode(curl_exec($ch));
			curl_close($ch);
			return $result;
		}

        public function gen_btc_addr(){
        	$newAddrInfo = $this->send_curl_request('https://api.blockcypher.com/v1/btc/main/addrs', 1, '');
        	if(isset($newAddrInfo->error)){
        		return false;
        	}else{
        		// $address = $newAddrInfo->address;
        		// $private = $newAddrInfo->private;
        		// $public = $newAddrInfo->public;
        		// $wif = $newAddrInfo->wif;
        		return $newAddrInfo;
        	}        	
        }

        public function send_btc($fromAddr, $fromAddrPrivKey, $toAddr, $amount, $blockcypherToken = 'c9991312729a43058e58e1d7d51061ad'){ //amount : satoshi
        	$tx_result = $this->NewTransactionEndpoint('btc', $blockcypherToken, $fromAddr, $toAddr, $amount, $fromAddrPrivKey);
        	if(isset($tx_result->error)){
        		return false;
        	}else{
        		// $txHash = $tx_result->hash;
        		// https://www.blockcypher.com/dev/bitcoin/?shell#customizing-transaction-requests
        		return $tx_result;
        	}    
        }

        public function get_btc_balance($addr){
        	$addrBalanceInfo = $this->send_curl_request('https://api.blockcypher.com/v1/btc/main/addrs/'.$addr.'/balance');
        	if(isset($addrBalanceInfo->error)){
        		return false;
        	}else{
        		// $balance = $addrBalanceInfo->final_balance;
        		// $total_received = $addrBalanceInfo->total_received;
        		// $total_sent = $addrBalanceInfo->total_sent;
        		// $unconfirmed_balance = $addrBalanceInfo->unconfirmed_balance;
        		// https://www.blockcypher.com/dev/bitcoin/?shell#address-balance-endpoint
        		return $addrBalanceInfo;
        	}  
        }

        public function get_btc_rate(){
			$rateInfo = $this->send_curl_request('https://blockchain.info/tobtc?currency=USD&value=10000');
			return 10000 / $rateInfo;
        }
    }
?>
