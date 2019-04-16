<?php

class Bank extends CI_Controller {

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
        $this->form_validation->set_rules('bank_name', 'Bank Name', 'required|max_length[255]');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
        $this->form_validation->set_rules('account_number', 'Account Number', 'required');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('bank/bank_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'bank_name' => set_value('bank_name'),
                'branch_name' => set_value('branch_name'),
                'account_number' => set_value('account_number')
            );

            // run insert model to write data to db

            if ($this->Bank_model->SaveForm($form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('bank/view');   // or whatever logic needs to occur
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

    function view() {
        $data = array();
        /* pagination */
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'bank/view/';
        $config['total_rows'] = $this->db->count_all_results('bank');
        ;
        $perpage = $config['per_page'] = PERPAGE;
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
        $results = $this->db->query("select * from bank LIMIT $start  $perpage");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('bank/bank_view _all', $data);
    }

    function edit_bank() {
        $data = array();
        $id = $this->uri->segment(3);
        $results = $this->db->query("select * from bank where bank_id = $id");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('bank/bank_add_edit', $data);
    }

    function update() {
        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('bank_name', 'Bank Name', 'required|max_length[255]');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
        $this->form_validation->set_rules('account_number', 'Account Number', 'required');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('bank/bank_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'bank_name' => set_value('bank_name'),
                'branch_name' => set_value('branch_name'),
                'account_number' => set_value('account_number')
            );

            // run insert model to write data to db

            if ($this->Bank_model->update($form_data, $id) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('bank/success');   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function bank_delete() {
        $id = $_POST['id'];
        $this->db->delete('bank', array('bank_id' => $id));
        if ($this->db->affected_rows() == '1') {
            echo "Bank Deleted successfully";
        } else {
            echo "Error to delete.";
        }
    }

    function transection() {
        $data = array();
        $options = array();
        $results = $this->db->query("select * from bank");
        $result = $results->result();
        foreach ($result as $res) {
            $options[$res->bank_id] = $res->shortname . '[' . $res->account_number . ']---' . $res->branch_name;
        }
        $data['options'] = $options;

        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('bank/transection', $data);
    }

    public function transctionsave() {
        $bank_id = $_POST['bank_id'];
        $type = $_POST['trans_type'];
        $debit = 0;
        $credit = 0;
        if ($type == 'debit') {
            $debit = $_POST['amount'];
            $this->db->query("UPDATE bank SET balance = balance - '" . $debit . "'  WHERE bank_id = '" . $bank_id . "'");
        }
        if ($type == 'credit') {
            $credit = $_POST['amount'];
            $this->db->query("UPDATE bank SET balance = balance + '" . $credit . "'  WHERE bank_id = '" . $bank_id . "'");
            $this->db->query("update setting_account set amount = amount - $credit WHERE (`attribute`= 'cash_in_hand')");

            
        }
        $data = array(
            'bank_id' => $_POST['bank_id'],
            'trans_type' => $_POST['trans_type'],
            'amount' => $_POST['amount'],
            'debit' => $debit,
            'credit' => $credit,
            'note' => $_POST['note'],
            'date' => $_POST['date'],
        );
        $this->db->insert('bank_trans_history', $data);
        $inser_id=$this->db->insert_id(); 
        redirect("bank/traansction_view/?id=$inser_id");   

        echo "Transection Successfull";
    }

    function traansction_view() {
        $data=array();
        $id=$_GET['id'];
        $results=$this->db->query("select * from bank_trans_history join bank on bank_trans_history.bank_id = bank.bank_id where bank_trans_history.trans_id = $id");
        $data['result']=$results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('bank/bank_print', $data); 
    }

}

?>