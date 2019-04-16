<?php

class Employee extends CI_Controller {

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
        $this->load->model('Employee_model');
    }

    function index() {
        $this->form_validation->set_rules('employee_name', 'Employee Name', 'required|max_length[255]');
        $this->form_validation->set_rules('father_name', 'Father Name', 'required|max_length[255]');
        $this->form_validation->set_rules('emp_husband_name', 'Husband Name', 'max_length[255]');
        $this->form_validation->set_rules('emp_mother_name', 'Mother Name', 'required|max_length[255]');
        $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required|max_length[255]');
        $this->form_validation->set_rules('nationality', 'Nationality', 'required|max_length[255]');
        $this->form_validation->set_rules('blood_group', 'Blood group', 'max_length[255]');
        $this->form_validation->set_rules('marital_status', 'Marital Status', 'max_length[255]');
        $this->form_validation->set_rules('qualification', 'Qualification', 'required|max_length[255]');
        $this->form_validation->set_rules('designation', 'Designation', 'required|max_length[255]');
        $this->form_validation->set_rules('job_status', 'Job Status', 'required|max_length[255]');
        $this->form_validation->set_rules('salary', 'Salary', 'required|max_length[21]');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required|max_length[255]');
        $this->form_validation->set_rules('emp_email', 'Email', 'valid_email');
        $this->form_validation->set_rules('joining_date', 'Joining Date', 'required|max_length[255]');
        $this->form_validation->set_rules('present_address', 'Present Address', 'required|max_length[255]');
        $this->form_validation->set_rules('permanent_address', 'Permanent  Address', 'required|max_length[255]');

        $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            // validation hasn't been passed
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('employee/employee_add', $data);
        } else { // passed validation proceed to post success logic
            // build array for the model
            $form_data = array(
                'employee_name' => set_value('employee_name'),
                'father_name' => set_value('father_name'),
                'emp_husband_name' => set_value('emp_husband_name'),
                'emp_mother_name' => set_value('emp_mother_name'),
                'date_of_birth' => set_value('date_of_birth'),
                'nationality' => set_value('nationality'),
                'blood_group' => set_value('blood_group'),
                'marital_status' => set_value('marital_status'),
                'qualification' => set_value('qualification'),
                'designation' => set_value('designation'),
                'job_status' => set_value('job_status'),
                'salary' => set_value('salary'),
                'contact_number' => set_value('contact_number'),
                'emp_email' => set_value('emp_email'),
                'joining_date' => set_value('joining_date'),
                'present_address' => set_value('present_address'),
                'permanent_address' => set_value('permanent_address')
            );

            // run insert model to write data to db
           
            if ($this->db->affected_rows() >= 0) {
                $this->db->insert('employee', $form_data);
            $id = $this->db->insert_id();
            redirect("employee/dashboard/$id");
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
            $config['base_url'] = base_url() . 'employee/view/';
            $config['total_rows'] = $this->db->count_all_results('employee');
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
            $results = $this->db->query("select * from employee LIMIT $start  $perpage");
            $data['results'] = $results->result();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('employee/employee_view _all', $data);
        }

        function edit_employee() {
            $data = array();
            $id = $this->uri->segment(3);
            $results = $this->db->query("select * from employee where employee_id = $id");
            $data['results'] = $results->result();
            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('employee/employee_add_edit', $data);
        }

        function update() {
            $id = $this->uri->segment(3);
            $this->form_validation->set_rules('employee_name', 'Employee Name', 'required|max_length[255]');
            $this->form_validation->set_rules('father_name', 'Father Name', 'required|max_length[255]');
            $this->form_validation->set_rules('emp_husband_name', 'Husband Name', 'max_length[255]');
            $this->form_validation->set_rules('emp_mother_name', 'Mother Name', 'required|max_length[255]');
            $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required|max_length[255]');
            $this->form_validation->set_rules('nationality', 'Nationality', 'required|max_length[255]');
            $this->form_validation->set_rules('blood_group', 'Blood group', 'max_length[255]');
            $this->form_validation->set_rules('marital_status', 'Marital Status', 'max_length[255]');
            $this->form_validation->set_rules('qualification', 'Qualification', 'required|max_length[255]');
            $this->form_validation->set_rules('designation', 'Designation', 'required|max_length[255]');
            $this->form_validation->set_rules('job_status', 'Job Status', 'required|max_length[255]');
            $this->form_validation->set_rules('salary', 'Salary', 'required|max_length[21]');
            $this->form_validation->set_rules('contact_number', 'Contact Number', 'required|max_length[255]');
            $this->form_validation->set_rules('emp_email', 'Email', 'valid_email');
            $this->form_validation->set_rules('joining_date', 'Joining Date', 'required|max_length[255]');
            $this->form_validation->set_rules('present_address', 'Present Address', 'required|max_length[255]');
            $this->form_validation->set_rules('permanent_address', 'Permanent  Address', 'required|max_length[255]');

            $this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

            if ($this->form_validation->run() == FALSE) {
                $data = array();
                // validation hasn't been passed
                $data['header'] = $this->load->view('header', $data, true);
                $data['footer'] = $this->load->view('footer', $data, true);
                $data['topbar'] = $this->load->view('topbar', $data, true);
                $data['sidebar'] = $this->load->view('sidebar', $data, true);
                $this->load->view('employee/employee_add', $data);
            } else { // passed validation proceed to post success logic
                // build array for the model
                $form_data = array(
                    'employee_name' => set_value('employee_name'),
                    'father_name' => set_value('father_name'),
                    'emp_husband_name' => set_value('emp_husband_name'),
                    'emp_mother_name' => set_value('emp_mother_name'),
                    'date_of_birth' => set_value('date_of_birth'),
                    'nationality' => set_value('nationality'),
                    'blood_group' => set_value('blood_group'),
                    'marital_status' => set_value('marital_status'),
                    'qualification' => set_value('qualification'),
                    'designation' => set_value('designation'),
                    'job_status' => set_value('job_status'),
                    'salary' => set_value('salary'),
                    'contact_number' => set_value('contact_number'),
                    'emp_email' => set_value('emp_email'),
                    'joining_date' => set_value('joining_date'),
                    'present_address' => set_value('present_address'),
                    'permanent_address' => set_value('permanent_address')
                );

                // run insert model to write data to db

                if ($this->Employee_model->update($form_data, $id) == TRUE) { // the information has therefore been successfully saved in the db
                    redirect('employee/success');   // or whatever logic needs to occur
                } else {
                    echo 'An error occurred saving your information. Please try again later';
                    // Or whatever error handling is necessary
                }
            }
        }

        function employee_delete() {
            $id = $_POST['id'];
            $this->db->delete('employee', array('Employee_id' => $id));
            if ($this->db->affected_rows() == '1') {
                echo "Employee Deleted successfully";
            } else {
                echo "Error to delete.";
            }
        }

        function dashboard() {
            $data = array();

            $id = $this->uri->segment(3);
            $results = $this->db->query("select * from employee where employee_id = $id");
            $data['basic'] = $results->result();


            $id = $this->uri->segment(3);
            $results = $this->db->query("select * from employee_bill_history where employee_id = $id");
            $data['billing_history'] = $results->result();

            $results = $this->db->query("SELECT sum(debit) debit_amount FROM `employee_bill_history` WHERE `employee_id` = $id ");
            $result = $results->result();

            $data['debit_amount'] = '0';
            if (isset($result[0])) {
                $data['debit_amount'] = $result[0]->debit_amount;
                if ($data['debit_amount'] == '') {
                    $data['debit_amount'] = '0';
                }
            }

            $results = $this->db->query("SELECT sum(credit) credit_amount FROM `employee_bill_history` WHERE `employee_id` = $id ");
            $result = $results->result();



            $data['credit_amount'] = '0';
            if (isset($result[0])) {
                $data['credit_amount'] = $result[0]->credit_amount;
                if ($data['credit_amount'] == '') {
                    $data['credit_amount'] = '0';
                }
            }

            $data['header'] = $this->load->view('header', $data, true);
            $data['footer'] = $this->load->view('footer', $data, true);
            $data['topbar'] = $this->load->view('topbar', $data, true);
            $data['sidebar'] = $this->load->view('sidebar', $data, true);
            $this->load->view('employee/dashboard', $data);
        }

        function invoice() {

		$session_data = $this->session->userdata('logged_in');
	   $_POST['expanse_by']=$session_data['id'];
	   $_POST['expanse_by_name']=$session_data['fullname'];
            $type = $_POST['transection_type'];
            $debit = 0;
            $credit = 0;
            $amount = 0;
            if ($type == 'debit') {
                $amount = $debit = $_POST['amount'];
                $exp=array(
                    'expanse_name'=>'Salary-'.$_POST['employee_id'],
                    'expanse_category'=>1,
                    'amount'=>$_POST['amount'],
                    'dateofexpanse'=>$_POST['date'],
                    'expanse_note'=>$_POST['note'],
                    'expanse_by'=>$_POST['expanse_by'],
                    'expanse_by_name'=>$_POST['expanse_by_name']
                );
                $this->db->insert('expanse',$exp);
                
            }
            if ($type == 'credit') {
                $credit = $_POST['amount'];
            }
            $data = array(
                'employee_id' => $_POST['employee_id'],
                'transection_type' => $_POST['transection_type'],
                'payment_type' => $_POST['type'],
                'debit' => $debit,
                'credit' => $credit,
                'amount' => $_POST['amount'],
                'note' => $_POST['note'],
                'date' => $_POST['date'],
            );
            $this->db->query("update setting_account set amount = amount - $amount WHERE (`attribute`= 'cash_in_hand')");
            $this->db->insert('employee_bill_history', $data);
            echo "Transection Successfull";
        }

    }

?>