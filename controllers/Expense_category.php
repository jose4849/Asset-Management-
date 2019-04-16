<?php

class Expense_category extends CI_Controller {

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
        $this->load->model('Expensecategory_model');
    }

    function index() {
        $this->form_validation->set_rules('exp_category_name', 'Category Name', 'required|max_length[255]');
        $this->form_validation->set_rules('cat_description', 'Description', 'required|max_length[255]');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('expense/category_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
        	$form_data = array(
					       	'exp_category_name' => set_value('exp_category_name'),
					       	'cat_description' => set_value('cat_description')
						);

            // run insert model to write data to db

            if ($this->Expensecategory_model->SaveForm($form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('expense_category/view');   // or whatever logic needs to occur
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
        $config['base_url'] = base_url() . 'expense_category/view/';
        $config['total_rows'] = $this->db->count_all_results('expensecategory');
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
        $results = $this->db->query("select * from expensecategory LIMIT $start  $perpage");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('expense/category_view _all', $data);
    }

    function edit_Expense_category() {
        $data = array();
        $id = $this->uri->segment(3);
        $results = $this->db->query("select * from expensecategory where cat_id = $id");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('expense/category_add_edit', $data);
    }

    function update() {
        $id = $this->uri->segment(3);
         $this->form_validation->set_rules('exp_category_name', 'Category Name', 'required|max_length[255]');
        $this->form_validation->set_rules('cat_description', 'Description', 'required|max_length[255]');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('expense/category_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
        	$form_data = array(
					       	'exp_category_name' => set_value('exp_category_name'),
					       	'cat_description' => set_value('cat_description')
						);

            // run insert model to write data to db

            if ($this->Expensecategory_model->update($form_data,$id) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('expense_category/view');   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function Expense_category_delete() {
        $id = $_POST['id'];
        $this->db->delete('expensecategory', array('cat_id' => $id));
        if ($this->db->affected_rows() == '1') {
            echo "Expense_category Deleted successfully";
        } else {
            echo "Error to delete.";
        }
    }

}

?>