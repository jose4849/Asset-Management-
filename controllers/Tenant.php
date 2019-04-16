<?php

class Tenant extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('tenant_model');
    }

    function index() {
        $this->form_validation->set_rules('tenant_name', 'Tenant Name', 'required|max_length[255]');
        $this->form_validation->set_rules('father_hasband', 'Father/Hasband', 'required|max_length[255]');
       // $this->form_validation->set_rules('proprietor_name', 'Proprietor Name', 'required|max_length[255]');
        $this->form_validation->set_rules('mother_name', 'Mother Name', 'required|max_length[255]');
        $this->form_validation->set_rules('address', 'Address', 'required|max_length[255]');
        $this->form_validation->set_rules('tenant_phone', 'tenant_phone', 'max_length[255]');
        $this->form_validation->set_rules('tenant_mobile', 'tenant_mobile', 'max_length[255]');
        $this->form_validation->set_rules('tenant_fax', 'tenant_fax', 'max_length[255]');
        $this->form_validation->set_rules('tenant_web', 'tenant_web', 'max_length[255]');
        $this->form_validation->set_rules('tenant_created_date', 'tenant_created_date', 'max_length[255]');


        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('tenant/tenant_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'tenant_name' => set_value('tenant_name'),
                'father_hasband' => set_value('father_hasband'),
                'proprietor_name' => set_value('proprietor_name'),
                'mother_name' => set_value('mother_name'),
                'address' => set_value('address'),
                'tenant_phone' => set_value('tenant_phone'),
                'tenant_mobile' => set_value('tenant_mobile'),
                'tenant_fax' => set_value('tenant_fax'),
                'tenant_web' => set_value('tenant_web'),
                'tenant_created_date' => set_value('tenant_created_date'),
                'tenant_status' => set_value('tenant_status')
            );
            $inser_id = $this->tenant_model->SaveForm($form_data);
            redirect("tenant/dashboard/$inser_id");
        }
    }

    function success() {
        echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
			sessions have not been used and would need to be added in to suit your app';
    }

    function alltenant() {
        $data = array();
        /* pagination */
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'tenant/alltenant/';
        $config['total_rows'] = $this->db->count_all_results('tenant');
        ;
        $perpage = $config['per_page'] = 20;
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


        if (isset($_GET['s']) && !empty($_GET['s'])) {
            $lookfor = (string) $_GET['s'];
            $results = $this->db->query("select  *  from tenant WHERE tenant_name LIKE '%".$lookfor."%'");
        } else {

            $start = $this->uri->segment(3);
            $this->pagination->initialize($config);
            $data['link'] = $this->pagination->create_links();
            /* pagination */
            if ($start > 0) {
                $start = $start . " , ";
            } else {
                $start = '';
            }

            $results = $this->db->query("select  *  from tenant  LIMIT $start  $perpage");
        } 

        // $results = $this->db->query("select  *  from tenant  LIMIT $start  $perpage");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('tenant/tenant_view _all', $data);
    }

    function edittenant() {
        $data = array();
        $id = $this->uri->segment(3);
        $results = $this->db->query("select * from tenant where tenant_id = $id");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('tenant/tenant_add_edit', $data);
    }

    function update() {
        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('tenant_name', 'Tenant Name', 'required|max_length[255]');
        $this->form_validation->set_rules('father_hasband', 'Father/Hasband', 'required|max_length[255]');
       // $this->form_validation->set_rules('proprietor_name', 'Proprietor Name', 'required|max_length[255]');
        $this->form_validation->set_rules('mother_name', 'Mother Name', 'required|max_length[255]');
        $this->form_validation->set_rules('address', 'Address', 'required|max_length[255]');
        $this->form_validation->set_rules('tenant_phone', 'tenant_phone', 'max_length[255]');
        $this->form_validation->set_rules('tenant_mobile', 'tenant_mobile', 'max_length[255]');
        $this->form_validation->set_rules('tenant_fax', 'tenant_fax', 'max_length[255]');
        $this->form_validation->set_rules('tenant_web', 'tenant_web', 'max_length[255]');
        $this->form_validation->set_rules('tenant_created_date', 'tenant_created_date', 'max_length[255]');


        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('tenant/tenant_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'tenant_name' => set_value('tenant_name'),
                'father_hasband' => set_value('father_hasband'),
                'proprietor_name' => set_value('proprietor_name'),
                'mother_name' => set_value('mother_name'),
                'address' => set_value('address'),
                'tenant_phone' => set_value('tenant_phone'),
                'tenant_mobile' => set_value('tenant_mobile'),
                'tenant_fax' => set_value('tenant_fax'),
                'tenant_web' => set_value('tenant_web'),
                'tenant_created_date' => set_value('tenant_created_date'),
                'tenant_status' => set_value('tenant_status')
            );

            // run insert model to write data to db
            $this->db->where('tenant_id', $id);
            $this->db->update('tenant', $form_data);
            if ($this->db->affected_rows() == '1') {
               redirect("tenant/dashboard/$id");
            }
           else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function tenantdelete() {
        $id = $_POST['id'];
        $this->db->delete('tenant', array('tenant_id' => $id));
        if ($this->db->affected_rows() == '1') {
            echo "Tenant Deleted successfully";
        } else {
            echo "Error to delete.";
        }
    }

    function dashboard() {
        $data = array();
        $id = $this->uri->segment(3);
        $results = $this->db->query("select * from tenant where tenant_id = $id");
        $data['basic'] = $results->result();

        $id = $this->uri->segment(3);
        $results = $this->db->query("select * from booking join companies on companies.id = booking.b_company_id join shop ON booking.b_shop_id = shop.shop_id join complex on complex.complex_id = booking.b_complex_id  where b_tenant_id = $id");
        $data['booking'] = $results->result();

        $results = $this->db->query("select * from monthly_bill join shop ON shop.shop_id = monthly_bill.shop_id join complex ON shop.complex = complex.complex_id  where tenant_id = $id  ORDER BY monthly_bill.bill_status");
        $data['billing_history'] = $results->result();

        $results = $this->db->query("select * from monthly_bill join shop ON shop.shop_id = monthly_bill.shop_id join complex ON shop.complex = complex.complex_id where monthly_bill.tenant_id = $id and monthly_bill.bill_status = 0 ORDER BY monthly_bill.shop_id");
        $data['billing_unpaid'] = $results->result();



        $results = $this->db->query("SELECT sum(amount) asamount FROM `monthly_bill` WHERE `tenant_id` = $id and bill_status = 1");
        $result = $results->result();
        $data['asamount'] = '0';
        if (isset($result[0])) {
            $data['asamount'] = $result[0]->asamount;

            if ($data['asamount'] == '') {
                $data['asamount'] = '0';
            }
        }

        $results = $this->db->query("SELECT sum(amount) asamount FROM `monthly_bill` WHERE `tenant_id` = $id and bill_status = 0");
        $result = $results->result();
        $data['dueamount'] = '0';
        if (isset($result[0])) {
            $data['dueamount'] = $result[0]->asamount;

            if ($data['dueamount'] == '') {
                $data['dueamount'] = '0';
            }
        }

        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('tenant/dashboard', $data);
    }

    function invoice() {
		//$this->db->trans_start();
	    unset($_POST['pay_date']);
        $token=$_POST['token'];
		
		$tokenres=$this->db->query("select * from formcheck where token = '$token'");
		$tokres=$tokenres->result();
		if(isset($tokres[0])){
		//token found
		echo 'found';
        //token found		
		}
        else{
        //token not found //
        unset($_POST['token']);		
		$data = $_POST;
		//print_r($data);
		
		
		
		$session_data = $this->session->userdata('logged_in');	
		$data['recived_by_id']=$session_data['id'];
        $bill_ids = explode(',', $data['items']);
        
         $this->db->insert('tenant_invoice', $data);
		$isd = $this->db->insert_id();
        
        foreach ($bill_ids as $bill_id) {
            $bill = array('bill_status' => 1,'invoice_id'=>$isd);
            $this->db->where('bill_id', $bill_id);
            $this->db->update('monthly_bill', $bill);
        }
       
		if(($data['utility'])==1){
			$utility=array(
			'com'=>$data['com'],
			'comx'=>$data['comx'],
			'shop'=>$data['shop'],
			'month'=>$data['month'],
			'year'=>$data['year'],
			'service'=>$data['service'],
			'electrical'=>$data['electrical'],
			'water'=>$data['water'],
			'gas'=>$data['gas'],
			'recived_by_id'=>$data['recived_by_id']
			);
			
			//print_r($utility);
			$this->db->insert('utility',$utility);
		}
		
		
        
        $amount = $_POST['amount'];
        $this->db->query("update setting_account set amount = amount + $amount WHERE (`attribute`= 'cash_in_hand')");
        echo $isd;
		$tokenarray=array(
		'invoice_id'=>$isd,
		'token'=>$token
		);
		$this->db->insert('formcheck',$tokenarray);
        // token not found		
		}
		//$this->db->trans_commit();
    }

    function invoice_list() {
        
    }

}

?>