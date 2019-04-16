<?php

class Expense extends CI_Controller {

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
        $this->load->model('Expense_model');
    }

    function index() {

            $data = array();
            $results = $this->db->query('select * from expensecategory');
            $result = $results->result();
            $options=array();
            foreach ($result as $res) {
                $options[$res->cat_id] = $res->exp_category_name;
            }
            $data['expoptions'] = $options;

            $options = array();
            $results = $this->db->query("select * from companies");
            $result = $results->result();
            $options[''] = 'Select Company';
            foreach ($result as $res) {
                $options[$res->id] = $res->company_names;
            }
            $data['company'] = $options;
            $options = array();
            $options['select'] = 'Select Company First';
            $data['complex'] = $options;

            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('expense/expense_add', $data);
    
    }

	function view() {
        $data = array();
        /* pagination */
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'expense/view/';
        $config['total_rows'] = $this->db->count_all_results('expense');
        ;
        $perpage = $config['per_page'] = PERPAGE;
        $config['uri_segment'] = 3;
        $start = $this->uri->segment(3);
        $this->pagination->initialize($config);

        if (isset($_GET['date']) && !empty($_GET['date'])) {
            $theday = new DateTime($_GET['date']);
            $theday = $theday->format('Y-m-d');
            $results = $this->db->query("select * from expense where (`dateofexpense` >= '" . $theday . " 00:00:00' and `dateofexpense` <= '" . $theday . " 23:59:59' )");
        } elseif (isset($_GET['from']) && !empty($_GET['from']) && isset($_GET['to']) && !empty($_GET['to'])) {
            $fromdate = new DateTime($_GET['from']);
            $todate = new DateTime($_GET['to']);
            $fromdate = $fromdate->format('Y-m-d');
            $todate = $todate->format('Y-m-d');
            $results = $this->db->query("select * from expense where (`dateofexpense` >= '" . $fromdate . " 00:00:00' and `dateofexpense` <= '" . $todate . " 23:59:59' ) ORDER BY dateofexpense desc");
        } else {
            $data['link'] = $this->pagination->create_links();
            /* pagination */
            if ($start > 0) {
                $start = $start . " , ";
            } else {
                $start = '';
            }
            $results = $this->db->query("select * from expense ORDER BY dateofexpense desc LIMIT $start  $perpage ");
        }
        $data['results'] = $results->result();

        $results = $this->db->query("select id, company_names from companies");
        $results = $results->result();
        
        $companydata=array();
        foreach ($results as $result) {
            $companydata[$result->id]=$result->company_names;
        }
        $data['company'] = $companydata;
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('expense/expense_all', $data);
    }
	
    function save() {

	   $session_data = $this->session->userdata('logged_in');
	   $_POST['expense_by']=$session_data['id'];
	   $_POST['expense_by_name']=$session_data['fullname'];
       $this->db->insert('expense',$_POST);
       $amount=$_POST['amount'];
        $this->db->query("update setting_account set amount = amount - $amount WHERE (`attribute`= 'cash_in_hand')");
        if ($this->db->affected_rows() == '1') {
            echo 'Save successfully';
        }
        else{
            echo 'Cannot save. Try Again. Thank you.';
        }
    }

    function expense_delete() {
        $id = $_POST['id'];
        $this->db->delete('expense', array('expense_id' => $id));
        if ($this->db->affected_rows() == '1') {
            echo "Expense Deleted successfully";
        } else {
            echo "Error to delete.";
        }
    }	
	
}

?>