<?php

class Shop extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('shop_model');
    }

    function index() {
        $this->form_validation->set_rules('company', 'Company', 'max_length[111]');
        $this->form_validation->set_rules('complex', 'Complex', 'max_length[111]');
        $this->form_validation->set_rules('shop', 'Shop', 'required|max_length[255]');
        $this->form_validation->set_rules('square_feet', 'Square feet', 'max_length[255]');
        $this->form_validation->set_rules('floor', 'Floor', 'max_length[255]');
        $this->form_validation->set_rules('description', 'Description', 'max_length[255]');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $options = array();
            $results = $this->db->query("select * from companies");
            $result = $results->result();
            $options[''] = "Select Company";
            foreach ($result as $res) {
                $options[$res->id] = $res->company_names;
            }
            $data['company'] = $options;

            $options = array();

            $options['select'] = 'Select Company First';
            $data['complex'] = $options;

            $this->load->view('shop/shop_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'company' => set_value('company'),
                'complex' => set_value('complex'),
                'shop' => set_value('shop'),
                'square_feet' => set_value('square_feet'),
                'floor' => set_value('floor'),
                'description' => set_value('description')
            );

            // run insert model to write data to db

            if ($this->shop_model->SaveForm($form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('shop/allshop');   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function success() {
        echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
    }

    function complex() {
        $company_id = $_POST['company_id'];
        $results = $this->db->query("select * from complex where company_id = $company_id");
        $result = $results->result();
        foreach ($result as $res) {
            echo '<option value="' . $res->complex_id . '" >' . $res->complex_name . "</option>";
        }
    }

    function tenants() {
        $company_id = $_POST['company_id'];
        $complex_id = $_POST['complex_id'];
        $results = $this->db->query("select * from booking join tenant on tenant.tenant_id = booking.b_tenant_id where b_company_id = $company_id and b_complex_id = $complex_id group by tenant_id order by tenant.tenant_name");
        $result = $results->result();
        foreach ($result as $res) {
            echo '<option value="' . $res->tenant_id . '" >' . $res->tenant_name . "</option>";
        }
    }

    function tenant() {
        $company_id = $_POST['company_id'];
        $complex_id = $_POST['complex_id'];
        $shop_no = $_POST['shop_no'];
        $results = $this->db->query("
		select * from shop
		join booking on shop.shop_id = booking.b_shop_id
		join tenant on booking.b_tenant_id = tenant.tenant_id
		where company = $company_id
		and complex = $complex_id
		and shop.shop = $shop_no
		
		");
        $result = $results->result();
        foreach ($result as $res) {
            echo '<option value="' . $res->tenant_id . '" >' . $res->tenant_name . "</option>";
        }
    }	
	
    function allshop() {
        $condition = '';

        if (!empty($_POST)) {

            $condition = 'where id = ' . $_POST['company'];
            if ($_POST['company'] != '') {
                $condition = $condition . ' AND company = ' . $_POST['company'];
            }
            if ($_POST['complex'] != '') {
                $condition = $condition . ' AND complex = ' . $_POST['complex'];
            }
            if ($_POST['shop'] != '') {
                $condition = $condition . ' AND shop = ' . $_POST['shop'];
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
        $result = array();
        $count = $this->db->query("select  *  from shop  INNER JOIN companies ON shop.company = companies.id  INNER JOIN complex ON shop.complex=complex.complex_id $condition");
        $config['total_rows'] = count($count->result());
        $perpage = $config['per_page'] = PERPAGE;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = "<ul style='margin-left:20px;' class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $start = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        /* pagination */
        if ($start > 0) {
            $start = $start . " , ";
        } else {
            $start = '';
        }
        $result = array();
        $results = $this->db->query("select  *  from shop  INNER JOIN companies ON shop.company = companies.id  INNER JOIN complex ON shop.complex=complex.complex_id $condition  LIMIT $start  $perpage");
        $data['results'] = $results->result();


        // print_r($data['results']);
        $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        $options[''] = 'Select Company';
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['company'] = $options;

        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('shop/shop_view _all', $data);
    }

	
	
    function editshop() {
        $data = array();
        $id = $this->uri->segment(3);
        $results = $this->db->query("select * from shop where shop_id = $id");
        $data['results'] = $results->result();

        $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['company'] = $options;



        if (isset($data['results'][0])) {
            $company_id = $data['results'][0]->company;
        } else {
            $company_id = '';
        }




        $options = array();
        $results = $this->db->query("select * from complex where company_id = $company_id ");
        $result = $results->result();
        foreach ($result as $res) {
            $options[$res->complex_id] = $res->complex_name;
        }
        $data['complex'] = $options;


        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('shop/shop_add_edit', $data);
    }

    function update() {
        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('company', 'Company', 'max_length[111]');
        $this->form_validation->set_rules('complex', 'Complex', 'max_length[111]');
        $this->form_validation->set_rules('shop', 'Shop', 'required|max_length[255]');
        $this->form_validation->set_rules('square_feet', 'Square feet', 'max_length[255]');
        $this->form_validation->set_rules('floor', 'Floor', 'max_length[255]');
        $this->form_validation->set_rules('description', 'Description', 'max_length[255]');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $options = array();
            $results = $this->db->query("select * from companies");
            $result = $results->result();
            foreach ($result as $res) {
                $options[$res->id] = $res->company_names;
            }
            $data['company'] = $options;

            $options = array();

            $options['select'] = 'Select Company First';
            $data['complex'] = $options;

            $this->load->view('shop/shop_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'company' => set_value('company'),
                'complex' => set_value('complex'),
                'shop' => set_value('shop'),
                'square_feet' => set_value('square_feet'),
                'floor' => set_value('floor'),
                'description' => set_value('description')
            );

            // run insert model to write data to db

            if ($this->shop_model->update($form_data, $id) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('shop/allshop');   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function shopdelete() {
        $id = $_POST['id'];
        $this->db->delete('shop', array('shop_id' => $id));
        if ($this->db->affected_rows() == '1') {
            echo "Shop Deleted successfully";
        } else {
            echo "Error to delete.";
        }
    }

    function booking() {
        $data = array();

        $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['company'] = $options;


        $options = array();
        $results = $this->db->query("select * from complex");
        $result = $results->result();
        $options[''] = "Select Complex";
        foreach ($result as $res) {
            $options[$res->complex_id] = $res->complex_name;
        }
        $data['complex'] = $options;
        $options = array();
        $options[''] = 'Select Shop ID';
        $data['shop'] = $options;

        $options = array();
        $results = $this->db->query("select * from tenant order by `tenant_name`");
        $result = $results->result();
        foreach ($result as $res) {
            $id = $res->tenant_id;
            $name = $res->tenant_name;
            $options[$res->tenant_id] = $id . "(" . $name . ")";
        }
        $data['tenant'] = $options;

        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('shop/booking', $data);
    }
	
	function rentdetails($id,$booking){
		
		$results = $this->db->query("select * from monthly_bill join shop ON shop.shop_id = monthly_bill.shop_id join complex ON shop.complex = complex.complex_id  where shop.shop_id = $id and shop.booking_id= $booking");
        $data['billing_history'] = $results->result();		
		$this->load->view('shop/rentdetails', $data);
	}
	
    function bookingupdate(){
	//print_r($_POST);
	$bookingid=$_POST['booking_id'];
	$this->db->where('booking_id',$bookingid);
	$res=$this->db->update('booking',$_POST);
	if($res==1){ echo "Update successful."; } else{ echo "Cannot update. Try again."; }
	}
	
    function shop_id() {
        $complex_id = $_POST['complex_id'];
        $results = $this->db->query("select * from shop where complex = $complex_id and bookstatus = 0");
        $result = $results->result();
        echo '<option value="" >Select Shop Number</option>';
        foreach ($result as $res) {
            echo '<option value="' . $res->shop_id . '" >' . $res->shop . "</option>";
        }
    }

    function booked() {
        $data = array();
        $id = $this->uri->segment(3);
        $results = $this->db->query("select * from booking where booking_id = $id");
        $data['results'] = $results->result();

        $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['company'] = $options;


        $options = array();
        $results = $this->db->query("select * from complex");
        $result = $results->result();
        foreach ($result as $res) {
            $options[$res->complex_id] = $res->complex_name;
        }
        $data['complex'] = $options;

        $options = array();
        $b_shop_id = $data['results'][0]->b_shop_id;
        $options[$b_shop_id] = $b_shop_id;
        $data['shop'] = $options;

        $options = array();
        $results = $this->db->query("select * from tenant");
        $result = $results->result();
        foreach ($result as $res) {
            $id = $res->tenant_id;
            $name = $res->tenant_name;
            $options[$res->tenant_id] = $id . "(" . $name . ")";
        }
        $data['tenant'] = $options;

        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('shop/booking_edit', $data);
    }

    function booking_insert() {
        $formdatas = $_POST;
        /* print_r($formdatas);

        foreach ($formdatas as $key => $value) {
            $this->form_validation->set_rules("$key", "", 'required');
        }
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();

            $options = array();
            $results = $this->db->query("select * from companies");
            $result = $results->result();
            foreach ($result as $res) {
                $options[$res->id] = $res->company_names;
            }
            $data['company'] = $options;


            $options = array();
            $results = $this->db->query("select * from complex");
            $result = $results->result();
            foreach ($result as $res) {
                $options[$res->complex_id] = $res->complex_name;
            }
            $data['complex'] = $options;
            $options = array();
            $options[''] = 'Select Shop ID';
            $data['shop'] = $options;

            $options = array();
            $results = $this->db->query("select * from tenant");
            $result = $results->result();
            foreach ($result as $res) {
                $id = $res->tenant_id;
                $name = $res->tenant_name;
                $options[$res->tenant_id] = $id . "(" . $name . ")";
            }
            $data['tenant'] = $options;

            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('shop/booking', $data);
        } else { */
        //die('False');
            $this->db->insert('booking', $formdatas);
            $insert_id = $this->db->insert_id();
            $b_shop_id = $_POST['b_shop_id'];
            $this->db->where('shop_id', $b_shop_id);
            $shop = array('bookstatus' => 1, 'booking_id' => $insert_id);
            $this->db->update('shop', $shop);
            $results = $this->db->query("select * from booking  join companies ON booking.b_company_id = companies.id join complex ON booking.b_complex_id = complex.complex_id  join shop ON shop.shop_id = booking.b_shop_id   where booking.booking_id = $insert_id");
            $result = $results->result();
            $data = array();
            $data['result'] = $result;
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('shop/booking_print', $data);
            $this->load->helper('url');
            redirect("shop/booking_id_show?id=$insert_id");
       // }
    }

    function booking_id_show() {

        $insert_id = $_GET['id'];
        $results = $this->db->query("select * from booking  join companies ON booking.b_company_id = companies.id join complex ON booking.b_complex_id = complex.complex_id  join shop ON shop.shop_id = booking.b_shop_id join
tenant on booking.b_tenant_id=tenant.tenant_id where booking.booking_id = $insert_id");
        $result = $results->result();
        $data = array();
        $data['result'] = $result;
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('shop/booking_print', $data);
    }

    function booking_update() {
        $formdatas = $_POST;
        $id = $this->uri->segment(3);
        foreach ($formdatas as $key => $value) {
            $this->form_validation->set_rules("$key", "", 'required');
        }
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            redirect("/shop/booking/$id", 'refresh');
        } else {
            $this->db->where('booking_id', $id);
            $this->db->update('booking', $formdatas);
            $insert_id = $this->db->insert_id();
            $b_shop_id = $_POST['b_shop_id'];
            $this->db->where('shop_id', $b_shop_id);
            $shop = array('bookstatus' => 1, 'booking_id' => $insert_id);
            $this->db->update('shop', $shop);
            echo "Insert succussfully";
        }
    }

    /* booking advance update */

    function add_advance() {
        //print_r($_POST);
        $booking_id = $_POST['booking_id'];
        $amount_op = $_POST['amount_op'];
        $session_data = $this->session->userdata('logged_in');
             $session_data['username'];
        
        
        $this->db->query("UPDATE booking SET security_money = security_money + '$amount_op' WHERE booking_id = $booking_id");
        if ($this->db->affected_rows() >= 0) {
            $this->db->query("update setting_account set amount = amount + $amount_op WHERE (`attribute`= 'cash_in_hand')");
            $data = array(
                'tenant_id' => $_POST['tenant_id'],
                'amount' => $amount_op,
                'pay_date' => date('d-m-Y'),
                'recived_by_id'=> $session_data['id'],
                'type' => 'cash',
                'note' => 'New Advance amount Added.',
            );
            $this->db->insert('tenant_invoice', $data);
            echo $this->db->insert_id();
            //echo "Advanced Add Successfully";
        } else {
            echo "Sorry Advanced Cannot Add";
        }
    }

    function refaund() {
        //print_r($_POST);
         $session_data = $this->session->userdata('logged_in');
             $session_data['username'];
        $booking_id = $_POST['booking_id'];
        $amount_op = $_POST['amount_op'];
        $this->db->query("UPDATE booking SET security_money = security_money - '$amount_op' WHERE booking_id = $booking_id");
        if ($this->db->affected_rows() >= 0) {
            $this->db->query("update setting_account set amount = amount +  $amount_op WHERE (`attribute`= 'cash_in_hand')");
            $data = array(
                'tenant_id' => $_POST['tenant_id'],
                'amount' => $amount_op,
                'pay_date' => date('d-m-Y'),
                 'recived_by_id'=> $session_data['id'],
                'type' => 'cash',
                'note' => 'Advanced Refund.',
            );
            $this->db->insert('tenant_invoice', $data);
            echo $this->db->insert_id();

//echo "Refaund Successfully";
        } else {
            echo "Sorry Cannot Refaund";
        }
    }

    function unbooked() {
        $booking_id = $_POST['booking_id'];
        $res = $this->db->query("select * from booking where booking_id = $booking_id");
        $result = $res->result();
        if (isset($result[0])) {
            $security_money = $result[0]->security_money;
            if ($security_money == 0) {
                $shop_id = $result[0]->b_shop_id;
                $update = array(
                    'bookstatus' => 0,
                    'booking_id' => 9999999
                );
                $this->db->where('shop_id', $shop_id);
                $this->db->update('shop', $update);

                $this->db->where('booking_id', $booking_id);
                $this->db->delete('booking');
                if ($this->db->affected_rows() >= 0) {
                    echo "Unbooked Successfully";
                } else {
                    echo "Sorry Cannot Unbooked";
                }
            } else {
                echo "Security Money Need Refaund First";
            }
        } else {
            echo "Booking ID Not Found.";
        }
    }

    /* booking advance update */
}

?>