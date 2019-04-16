<?php

class Billgenerator extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Bank_model');
    }
    
    public function index(){
    	$this->db->trans_start();
       $result=$this->db->query('select * from complex');
       $resultarray=$result->result();
       $date = new DateTime();
       $group_invoice_id=$date->getTimestamp();
       foreach($resultarray as $re){
           $complex=$re->complex_id;
           //$complex=$re->company_id;
           $mon=date('m');
           $year=date('Y');   
           $result=array();  
            echo '<pre>';  
         /* ---------------------------------------------------------*/
        $results = $this->db->query("select * from shop join booking ON shop.booking_id = booking.booking_id where complex = $complex AND bookstatus = 1");
        $x=0;
        $result = $results->result();              
            /* main transection */
            
          
            
            foreach ($result as $res) {
                $x++;
                $shop=$res->shop_id;
                $data = array(
                    'shop_id' => $shop,
                    'year' => $year,
                    'month' => $mon,
                    'group_invoice_id'=>$group_invoice_id,
                    'amount' => $res->totalrent,
                    'tenant_id' => $res->b_tenant_id
                   
                );
//print_r($result);
               $insert_query = $this->db->insert_string('monthly_bill', $data);
               
                
                
               echo  $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
                echo $this->db->query($insert_query);
               die();
            }
            /* main transection */         
        /* ---------------------------------------------------------*/          
       }
       $this->db->trans_complete();
       //echo $x."<br>";
       //echo $group_invoice_id;
      // redirect("rent/group_invoice_print?id=$group_invoice_id", 'refresh');
       
       
       
    }
    
    
}    