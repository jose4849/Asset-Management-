<?php

class Company extends CI_Controller {

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
        $this->load->model('company_model');
    }

    function index() {
        $this->form_validation->set_rules('company_names', 'Company Name', 'required|max_length[255]|is_unique[companies.company_names]');
        //$this->form_validation->set_rules('short_name', 'Short Name', 'required|max_length[255]');
        $this->form_validation->set_rules('owner_name', 'Owner Name', 'required|max_length[255]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        //$this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'max_length[255]');
        //$this->form_validation->set_rules('fax', 'Fax', 'required|max_length[255]');
        $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email|max_length[255]');
        $this->form_validation->set_rules('web', 'Web', 'required|max_length[255]');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('company/company_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'company_names' => set_value('company_names'),
                'short_name' => set_value('short_name'),
                'owner_name' => set_value('owner_name'),
                'address' => set_value('address'),
                'phone' => set_value('phone'),
                'mobile' => set_value('mobile'),
                'fax' => set_value('fax'),
                'email' => set_value('email'),
                'web' => set_value('web')
            );

            // run insert model to write data to db

            if ($this->company_model->SaveForm($form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('company/view');   // or whatever logic needs to occur
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
        $config['base_url'] = base_url() . 'company/view/';
        $config['total_rows'] = $this->db->count_all_results('companies');
        ;
        $perpage = $config['per_page'] = PERPAGE;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = "<ul style='margin-left:10px;' class='pagination'>";
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
        $results = $this->db->query("select * from companies LIMIT $start  $perpage");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('company/company_view _all', $data);
    }

    function edituser() {
        $data = array();
        $id = $this->uri->segment(3);
        $results = $this->db->query("select * from companies where id = $id");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('company/company_add_edit', $data);
    }

    function update() {
        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('company_names', 'Company Name', 'required|max_length[255]');
        //$this->form_validation->set_rules('short_name', 'Short Name', 'required|max_length[255]');
        $this->form_validation->set_rules('owner_name', 'Owner Name', 'required|max_length[255]');
        $this->form_validation->set_rules('address', 'Address', 'required');
       // $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'max_length[255]');
       // $this->form_validation->set_rules('fax', 'Fax', 'required|max_length[255]');
        $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email|max_length[255]');
        $this->form_validation->set_rules('web', 'Web', 'required|max_length[255]');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('company/company_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'company_names' => set_value('company_names'),
                'short_name' => set_value('short_name'),
                'owner_name' => set_value('owner_name'),
                'address' => set_value('address'),
                'phone' => set_value('phone'),
                'mobile' => set_value('mobile'),
                'fax' => set_value('fax'),
                'email' => set_value('email'),
                'web' => set_value('web')
            );

            // run insert model to write data to db

            if ($this->company_model->update($form_data, $id) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('company/view');   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function companydelete() {
        $id = $_POST['id'];
        $this->db->delete('companies', array('id' => $id));
        if ($this->db->affected_rows() == '1') {
            echo "Company Deleted successfully";
        } else {
            echo "Error to delete.";
        }
    }

}

?>