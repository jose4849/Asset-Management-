<?php

class Rent extends CI_Controller {

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

    function index() {

        $condition = '';

        if (!empty($_POST)) {

            $condition = 'where id = ' . $_POST['company'];
            if ($_POST['complex'] != '') {
                $condition = $condition . ' AND complex_id = ' . $_POST['complex'];
            }
            if ($_POST['shop_id'] != '') {
                $condition = $condition . ' AND shop_id = ' . $_POST['shop_id'];
            }
            if ($_POST['status'] != '') {
                $condition = $condition . ' AND bookstatus = ' . $_POST['status'];
            }
            $condition;
        }

        $data = array();
        /* pagination */
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'shop/allshop/';
        $config['total_rows'] = $this->db->count_all_results('shop');
        ;
        $perpage = $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $start = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        /* pagination */
        if ($start > 0) {
            $start = $start . " , ";
        } else {
            $start = '';
        }
        $results = $this->db->query("select  *  from shop  INNER JOIN companies ON shop.company = companies.id  INNER JOIN complex ON shop.complex=complex.complex_id $condition  LIMIT $start  $perpage");
        $data['results'] = $results->result();


        // print_r($data['results']);
        $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        $options[''] = "Select Company";
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['company'] = $options;

        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('rent/rent_view _all', $data);
    }

    function monthlybill() {
        $company = $_POST['company'];
        $shop_id = $_POST['shop_id'];      
        $complex = $_POST['complex'];
        if($complex==''){ echo 'Select Complex..'; die();}
        $year = $_POST['year'];
        $month = $_POST['month'];
        $date = new DateTime();
        $group_invoice_id=$date->getTimestamp();
        if($shop_id!=null){
		    // echo '<pre>';
		    // print_r($_POST);
            $results = $this->db->query("select * from shop join booking ON shop.booking_id = booking.booking_id where shop.complex = $complex AND shop.shop  = '$shop_id' AND  bookstatus = 1");
            $result = $results->result();
			
			
			if(isset($result[0])){
			 if ($month != null) {           
					foreach($month as $mon){
						$data = array(
							'shop_id' => $result[0]->shop_id,
							'year' => $year,
							'month' => $mon,
							'group_invoice_id'=>$group_invoice_id,
							'amount' => $result[0]->totalrent,
							'tenant_id' => $result[0]->b_tenant_id
							
						);
						 $insert_query = $this->db->insert_string('monthly_bill', $data);
						$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
						$this->db->query($insert_query);
					}		
			}
			}
        }
        else{
        /* ---------------------------------------------------------*/
        $results = $this->db->query("select * from shop join booking ON shop.booking_id = booking.booking_id where complex = $complex AND bookstatus = 1");
        $result = $results->result();
        if ($month != null) {           
            foreach($month as $mon){
               
            /* main transection */
            foreach ($result as $res) {
                $shop=$res->shop_id;
                $data = array(
                    'shop_id' => $shop,
                    'year' => $year,
                    'month' => $mon,
                    'group_invoice_id'=>$group_invoice_id,
                    'amount' => $res->totalrent,
                    'tenant_id' => $res->b_tenant_id
                   
                );

                $insert_query = $this->db->insert_string('monthly_bill', $data);
                $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
                $this->db->query($insert_query);
            }
            /* main transection */
            }  
        } else {
            echo 'Plz select Month. From Month List.';
            die();
        }
        /* ---------------------------------------------------------*/
        }
        echo $group_invoice_id;
        //echo 'Successfully Generated. Thank You.';
    }
	function removebill(){
		$bill_id=$_POST['bill_id'];
		$this->db->where('bill_id',$bill_id);
		$this->db->delete('monthly_bill'); 
	}
	
    function group_invoice_print(){
       $id=$_GET['id'];
       $data = array();
        /* pagination */
      
        $results = $this->db->query("select  *  from monthly_bill 
        join shop on shop.shop_id = monthly_bill.shop_id
        join tenant on tenant.tenant_id = monthly_bill.tenant_id
        join complex on complex.complex_id = shop.complex
        where group_invoice_id = $id ");
        $data['result'] = $results->result();
        $this->load->view('rent/monthly_bill', $data);
    }
	function all_bill(){
		$data = array();
        /* pagination */
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'rent/all_bill/';
        $config['total_rows'] = $this->db->count_all_results('shop');
        ;
        $perpage = $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $start = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        /* pagination */
        if ($start > 0) {
            $start = $start . " , ";
        } else {
            $start = '';
        }
        $results = $this->db->query("select  *  from shop  INNER JOIN companies ON shop.company = companies.id  INNER JOIN complex ON shop.complex=complex.complex_id $condition  LIMIT $start  $perpage");
        $data['results'] = $results->result();


        // print_r($data['results']);
        $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        $options[''] = "Select Company";
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['company'] = $options;

        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('rent/rent_view _all', $data);
	}
	function collections(){
	    
	    $data=array();		
	    $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        $options[''] = "Select Company";
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['company'] = $options;
	
	
	
	    $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('rent/collections', $data);
	}
}

?>