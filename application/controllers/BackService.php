<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackService extends CI_Controller
{
    function __construct(){
        parent::__construct();

        $this->load->library('Blockcypher_Library');
        $this->blockcypher = new Blockcypher_Library();

        $this->load->model('PM_Model');
        $this->load->model('Settings_model');
        $this->load->model('Inout_model');
        $this->load->model('User_model');
        //$this->load->model('Servercoin_model');
    }

    function test_get_balance() {

        $addr = '14Q39PYo66Czq6FPqk7zGKzj8xD97oHeor';

        print_r($this->blockcypher->get_btc_balance($addr));
    }

    function test_send_btc() {

        $fromAddr = '14Q39PYo66Czq6FPqk7zGKzj8xD97oHeor';
        $fromPrivKey = 'cbf2bb455f0b9ecd429de7156132a94dfacc59ada9f415fc3e8bd6a98235f172';
        $toAddr = '16GAP2qniD6sW8KGhGpDKqaexq81TXGiti';
        $amount = 1000;

        print_r($this->blockcypher->send_btc($fromAddr, $fromPrivKey, $toAddr, $amount));
    }

    function checker()
    {
        print_r('back service start.');

        // get trade items by time descending, is_purchased 0
        $trades = $this->PM_Model->get_list('tbl_trade', 0, 'is_purchased = "0"', 'reg_date', 'DESC');
        print_r('<br>');
        print_r('Unconfirmed Trades List: ');
        print_r('<br>');
        print_r($trades);

        $adminBtcAddr = $this->Settings_model->get_val('owner_btc_address');

        if (empty($adminBtcAddr)) {
            print_r('<br>');
            print_r('Admin Address is not exist. exiting!');
            return;
        }

        $adminBtcFee = $this->Settings_model->get_val('owner_btc_fee');

        if (empty($adminBtcFee)) {
            print_r('<br>');
            print_r('Admin Fee is not exist. exiting!');
            return;
        }

        print_r('<br>');
        print_r('Admin Address: '. $adminBtcAddr);
        print_r('<br>');
        print_r('Admin Fee: '. $adminBtcFee);

        foreach ($trades as $tradeItem) {

            print_r('<br>');
            print_r('Trade Detail: ');
            print_r('<br>');
            print_r($tradeItem);

            if (empty($tradeItem['to_user_id']) && empty($tradeItem['to_account'])) {

                print_r('<br>');
                print_r('To user id & account is empty. So skipped!');

                continue;
            }

            // check balance 
            $balInfo = $this->blockcypher->get_btc_balance($tradeItem['address']);
            if (!$balInfo) {
                print_r('<br>');
                print_r('Getting balance is failed. So skipped!');

                continue;
            }
            
            $curBalance = $balInfo->final_balance;
            $targetAmt = $tradeItem['amount'] * (10 ^ 8);

            if ($curBalance < $targetAmt) {
                print_r('<br>');
                print_r('Current Balance is small than target amount. So skipped!');

                continue;
            }

            $sendToAdmin = $targetAmt * $adminBtcFee / 100;
            $sendToOwner = $curBalance - $sendToAdmin;

            // if user id set, then all send to admin and update seller balance
            if (isset($tradeItem['to_user_id'])) {

                print_r('<br>');
                print_r('To User ID is set. so sent all btc to admin wallet, and update seller balance.');

                // check user
                $userInfo = $this->User_model->get_entries(array('PID'=>$tradeItem['to_user_id']));
                if (empty($userInfo)) {
                    print_r('<br>');
                    print_r('To user is not exist. So skipped!');

                    continue;
                }

                // send coin
                if (!$this->blockcypher->send_btc($tradeItem['address'], $tradeItem['private'], $adminBtcAddr, $curBalance)) {

                    print_r('<br>');
                    print_r('BTC send failed! So skipped!');

                    continue;
                }

                // update balance
                $updatedBalance = $userInfo->balance + ($sendToOwner / (10 ^ 8));
                $this->User_model->update_entry(array("balance"=>$updatedBalance),"PID=".$tradeItem['to_user_id']);

                // insert inout model
                $this->Inout_model->user_id=$tradeItem['to_user_id'];
                
                $this->Inout_model->amount=$coin_balance;
                $this->Inout_model->action_type="IN";
                $this->Inout_model->coin_address="";
                $this->Inout_model->insert_entry();

            } else {

                print_r('<br>');
                print_r('To User ID is not set.');

                // send coin to account 
                if (!$this->blockcypher->send_btc($tradeItem['address'], $tradeItem['private'], $tradeItem['to_account'], $sendToOwner)) {

                    print_r('<br>');
                    print_r('BTC send failed! So skipped!');

                    continue;
                }

                if (!$this->blockcypher->send_btc($tradeItem['address'], $tradeItem['private'], $adminBtcAddr, $sendToAdmin)) {

                    print_r('<br>');
                    print_r('BTC send failed! So skipped!');

                    continue;
                }

            }

            // update purchase flag.
            $this->db->where('id', $tradeItem['id']);
            $this->db->set('is_purchased', 1);
            $this->db->update('tbl_trade');
        }

    }
   
}