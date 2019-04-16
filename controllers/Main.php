<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    public function index() {
        $data = array();
                $data = array();


        $data['from'] = $fromdate = date("Y")."-".date("m")."-"."01";
        $data['to'] = $todate = date("Y")."-".date("m")."-"."31";
        $selector = " sum(amount) as amo ";
        $query = "select sum(amount) as amo from tenant_invoice where  (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )";
       
		$results = $this->db->query($query);
        $income = $results->result();
        $data['income']=$income[0]->amo;

        $selector = " sum(amount) as amo ";
        $query = "select $selector  from monthly_bill join shop ON shop.shop_id = monthly_bill.shop_id join tenant ON tenant.tenant_id = monthly_bill.tenant_id where monthly_bill.bill_status = 0 AND (date BETWEEN '" . $fromdate . "' AND '" . $todate . "')";
        $results = $this->db->query($query);
        $income = $results->result();
        $data['due']=$income[0]->amo;        
        
        
        $selector = "
              sum(amount) as amo
                ";

        $query = "select sum(amount) as amo from expense where  (`dateofexpense` >= '" . $fromdate . " 00:00:00' and `dateofexpense` <= '" . $todate . " 23:59:59' )";
        $results = $this->db->query($query);
        $expense = $results->result();
        $data['expense']=$expense[0]->amo;

        $res = $this->db->query("SELECT * FROM `setting_account` WHERE (`attribute`= 'cash_in_hand') ");
        $result = $res->result();
        $data['cash_in_hand'] = $result[0]->amount;
        $res = $this->db->query("SELECT sum(balance) as balance FROM `bank`  ");
        $result = $res->result();
        $data['balance'] = $result[0]->balance;
        
        
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('main', $data);
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login', 'refresh');
    }

}
