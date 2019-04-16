<?php

class Users extends CI_Controller {

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
        $this->load->model('users_model');
    }

    function index() {
        $this->form_validation->set_rules('user_full_name', 'Full Name', 'required|max_length[255]');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|max_length[255]');
        $this->form_validation->set_rules('designation', 'Designation', 'required|max_length[255]');
        $this->form_validation->set_rules('user_address', 'Address', 'required|max_length[255]');
        $this->form_validation->set_rules('user_phone', 'Phone', 'required|max_length[255]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[255]');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);

            $this->load->view('user/users_view', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model

            $form_data = array(
                'user_full_name' => set_value('user_full_name'),
                'user_email' => set_value('user_email'),
                'designation' => set_value('designation'),
                'user_address' => set_value('user_address'),
                'user_phone' => set_value('user_phone'),
                'password' => set_value('password')
            );

            // run insert model to write data to db

            if ($this->users_model->SaveForm($form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('users/alluser');   // or whatever logic needs to occur
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

    function alluser() {
        $data = array();
        /* pagination */
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'users/alluser/';
        $config['total_rows'] = $this->db->count_all_results('users');
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
        $results = $this->db->query("select * from users LIMIT $start  $perpage");
        $data['results'] = $results->result();
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('user/users_view _all', $data);
    }

    function edituser() {
	
	$data = array();
	$id = $this->uri->segment(3);
	if(isset($_POST['access'])){
	$accesslevel = json_encode($_POST);
	$information=array(
	'access'=>$accesslevel
	);
	$this->db->where('id',$id);
	$this->db->update('users',$information);
	}
	
        $options=array();
        $options['0']='No Access';
        $options['1']='Administration';
        $options['2']='Executive';
        $options['3']='Manager';
        $options['4']='Accounts';     
        $data['user_level'] = $options;        

        $results = $this->db->query("select * from users where id = $id");
        $res=$data['results'] = $results->result();
		if(isset($res[0])){
		$accessl=$res[0]->access;
		$access=json_decode($accessl,true);
				foreach($access as $key=>$dat){
				$data[$key]=$dat;
				}		
		}
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('user/users_view_edit', $data);
    }

    function update() {
        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('user_full_name', 'Full Name', 'required|max_length[255]');
        $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|max_length[255]');
        $this->form_validation->set_rules('designation', 'Designation', 'required|max_length[255]');
        $this->form_validation->set_rules('user_address', 'Address', 'required|max_length[255]');
        $this->form_validation->set_rules('user_phone', 'Phone', 'required|max_length[255]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[255]');
        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            $data = array();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);

            $this->load->view('user/users_view_edit', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model

            $form_data = array(
                'user_full_name' => set_value('user_full_name'),
                'user_email' => set_value('user_email'),
                'user_level' => set_value('user_level'),
                'designation' => set_value('designation'),
                'user_address' => set_value('user_address'),
                'user_phone' => set_value('user_phone'),
                'password' => set_value('password')
            );

            // run insert model to write data to db

            if ($this->users_model->update($form_data, $id) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('users/alluser');   // or whatever logic needs to occur
            } else {
                echo 'An error occurred saving your information. Please try again later';
                // Or whatever error handling is necessary
            }
        }
    }

    function userdelete() {
        $id = $_POST['id'];
        $this->db->delete('users', array('id' => $id));
        if ($this->db->affected_rows() == '1') {
            echo "User Deleted successfully";
        } else {
            echo "Error to delete.";
        }
    }

    function userstatus() {
        $id = $_POST['id'];
        $data['user_status'] = $_POST['status'];
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        if ($this->db->affected_rows() == '1') {
            echo "User Status successfully";
        } else {
            echo "Error to update.";
        }
    }

}

?>