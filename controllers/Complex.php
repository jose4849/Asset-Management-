<?php

class Complex extends CI_Controller {

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
        $this->load->model('complex_model');
    }

    function index() {
        $this->form_validation->set_rules('complex_name', 'Complex Name', 'required|max_length[255]|is_unique[complex.complex_name]');
        $this->form_validation->set_rules('complex_address', 'Address', 'required|max_length[255]');
       // $this->form_validation->set_rules('complex_phone', 'Phone', 'max_length[255]');
       // $this->form_validation->set_rules('complex_mobile', 'Mobile', 'max_length[255]');
      // $this->form_validation->set_rules('fax', 'Fax', 'max_length[255]');
        $this->form_validation->set_rules('complex_email', 'Email', 'valid_email|max_length[255]');
        $this->form_validation->set_rules('company_id', 'Company Name', 'required');

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
            $data['options'] = $options;
            $this->load->view('complex/complex_view', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'complex_name' => set_value('complex_name'),
                'complex_address' => set_value('complex_address'),
                'complex_phone' => set_value('complex_phone'),
                'complex_mobile' => set_value('complex_mobile'),
                'fax' => set_value('fax'),
                'complex_email' => set_value('complex_email'),
                'company_id' => set_value('company_id')
            );

            // run insert model to write data to db

            if ($this->complex_model->SaveForm($form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('complex/allcomplex');   // or whatever logic needs to occur
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

    function allcomplex() {
        $data = array();
        /* pagination */
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'complex/allcomplex/';
        $config['total_rows'] = $this->db->count_all_results('complex');
        ;
        $perpage = $config['per_page'] = PERPAGE;
        $config['uri_segment'] = 3;
        $start = $this->uri->segment(3);

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


        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        /* pagination */
        if ($start > 0) {
            $start = $start . " , ";
        } else {
            $start = '';
        }
        $results = $this->db->query("select * from complex INNER JOIN companies ON complex.company_id = companies.id LIMIT $start  $perpage");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('complex/complex_view _all', $data);
    }

    function editcomplex() {
        $data = array();
        $id = $this->uri->segment(3);
        $results = $this->db->query("select * from complex where complex_id = $id");
        $data['results'] = $results->result();
        $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['options'] = $options;
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('complex/complex_add_edit', $data);
    }

    function update() {

        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('complex_name', 'Complex Name', 'required|max_length[255]');
        $this->form_validation->set_rules('complex_address', 'Address', 'required|max_length[255]');
       // $this->form_validation->set_rules('complex_phone', 'Phone', 'max_length[255]');
       // $this->form_validation->set_rules('complex_mobile', 'Mobile', 'max_length[255]');
       // $this->form_validation->set_rules('fax', 'Fax', 'max_length[255]');
        $this->form_validation->set_rules('complex_email', 'Email', 'valid_email|max_length[255]');
        $this->form_validation->set_rules('company_id', 'Company Name', 'required');

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
            $data['options'] = $options;
            $this->load->view('complex/complex_view', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'complex_name' => set_value('complex_name'),
                'complex_address' => set_value('complex_address'),
                'complex_phone' => set_value('complex_phone'),
                'complex_mobile' => set_value('complex_mobile'),
                'fax' => set_value('fax'),
                'complex_email' => set_value('complex_email'),
                'company_id' => set_value('company_id')
            );

            // run insert model to write data to db

            if ($this->complex_model->update($form_data, $id) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('complex/allcomplex');   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function complexdelete() {
        $id = $_POST['id'];
        $this->db->delete('complex', array('complex_id' => $id));
        if ($this->db->affected_rows() == '1') {
            echo "Complex Deleted successfully";
        } else {
            echo "Error to delete.";
        }
    }

}

?>