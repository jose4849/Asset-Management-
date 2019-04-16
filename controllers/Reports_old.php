<?php

class Reports extends CI_Controller {

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
        //$this->load->model('Bank_model');
    }

    /* ---====================company=====================---------- */

    public function company() {
        $data = array();
        $data['title'] = "Company Report";
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('reports/company_report_form', $data);
    }

    public function companyreports() {
        if ($_POST['view_type'] == 'lv') {
            $query = "select company_names AS COMPANY_NAME from companies";
            $this->get_report_list_view($query, 'companyreports');
        }

        if ($_POST['view_type'] == 'pv') {
            $query = "select id,company_names,short_name,owner_name,address,phone,mobile,fax,email,web  from companies";
            $this->get_report_print_view($query, 'Company Information', 'table{font-size:12px}h3{margin:0px;}h1{margin:0px;}');
        }

        if ($_POST['view_type'] == 'lv') {
            
        }
    }

    /* ---====================company end=====================---------- */
    /* ---====================complex start=====================---------- */

    public function complex() {
        $data = array();
        $data['title'] = "Complex Report";
        $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        $options[''] = 'Select Company';
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['options'] = $options;
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('reports/complex_report_form', $data);
    }

    public function complexreports() {
		$this->form_validation->set_rules('company_id', 'Company', 'required');
		$this->form_validation->set_rules('complex', 'Complex', 'required');
		$this->form_validation->set_rules('report_type', 'Report type', 'required');
		
		/* validation end*/
		if ($this->form_validation->run() == FALSE)
		{ $this->complex(); }
		else{	
				if ($_POST['view_type'] == 'lv') {
					$query = "select company_names AS COMPANY_NAME from companies";
					$this->get_report_list_view($query, 'companyreports');
				}
				if ($_POST['view_type'] == 'pv') {
					$company_id = $_POST['company_id'];
					$results = $this->db->query("select * from companies where id = $company_id");
					$res = $results->result();
					$company_names = $res[0]->company_names;
					$query = "select * from complex where company_id = $company_id";
					$this->get_report_print_view($query, "Complex Information: $company_names ", 'table{font-size:12px}h3{margin:0px;}h1{margin:0px;}');
				}

				if ($_POST['view_type'] == 'lv') {
					
				}		
		}
		
		
		
    }

    /* ---====================complex start=====================---------- */

    public function tenant() {

        $data = array();
        $data['title'] = "Tenant Report";
        $options = array();
        $results = $this->db->query("select * from complex");
        $result = $results->result();
        foreach ($result as $res) {
            $options[$res->complex_id] = $res->complex_name;
        }
        $data['options'] = $options;
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('reports/tenant_report_form', $data);
    }

    public function tenant_due() {

        $data = array();
        $data['title'] = "Tenant Due Report";
        $options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        $options[''] = 'Select Company';
		$options['all']='All';
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['options'] = $options;
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
       // $this->load->view('reports/complex_report_form', $data);
        $this->load->view('reports/tenant_report_form _due', $data);
    }
	function com_ten_due_report(){
	
			
		/* validation start*/
		$this->form_validation->set_rules('company_id', 'Company', 'required');
		$this->form_validation->set_rules('complex_id', 'Complex', 'required');
		/* validation end*/
		if ($this->form_validation->run() == FALSE)
		{
		$this->tenant_due();
		
		}
		else{
	
	
	
				if($_POST['company_id']=='all'){
				/* if company id is all */
				
                $selector = "
                shop.shop as shop,
                b_shop_id as b_shop_id,
                tenant_name,
                address,
                booking_date,
                tenant_mobile
                ";
			
                $query = $this->db->query("
                    select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id 
                ");
				$data['complex_name'] = "Complex of all company ";
				
                $resul = $query->result();
                $finalresult = array();
                foreach ($resul as $res) {
                    $shop_id = $res->b_shop_id;
                    $billstatus = $this->db->query("select shop_id ,count(*) as months ,sum(amount) as amount from monthly_bill where shop_id = $shop_id and bill_status = 0");
                    $b_result = $billstatus->result();
                    if (isset($b_result[0])) {
                        $res->due = $b_result[0]->amount;
                        $res->month = $b_result[0]->months;
                    }
                    $finalresult[] = $res;
                }
                $data['result'] = $finalresult;
                $this->load->view('reports/tenant_payment_due', $data);	
				/* if company id is all */
				}
				
				else{
				$complex_id = $_POST['complex_id'];	
				$company_id = $_POST['company_id'];	
				
			$com = $this->db->query("select * from companies where id =$company_id");
            $comp = $com->result();
            $company_names = $comp[0]->company_names;
			
			/* complex id all */
            $data['complex_name'] = "All complex of $company_names";
				
				
				
                $selector = "
                shop.shop as shop,
                b_shop_id as b_shop_id,
                tenant_name,
                address,
                booking_date,
                tenant_mobile
                ";
				if($complex_id=='all'){
				    $query = $this->db->query("
                    select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id where b_company_id = $company_id
                ");
				
				}
				else{
				
						
                $results = $this->db->query("select * from complex where complex_id = $complex_id");
                $result = $results->result();
                $complex_name = $result[0]->complex_name;
                $query = $this->db->query("
                    select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id where b_complex_id = $complex_id 
                ");
				$data['complex_name'] = $complex_name;
				
				}
                $resul = $query->result();
                $finalresult = array();
                foreach ($resul as $res) {
                    $shop_id = $res->b_shop_id;
                    $billstatus = $this->db->query("select shop_id ,count(*) as months ,sum(amount) as amount from monthly_bill where shop_id = $shop_id and bill_status = 0");
                    $b_result = $billstatus->result();
                    if (isset($b_result[0])) {
                        $res->due = $b_result[0]->amount;
                        $res->month = $b_result[0]->months;
                    }
                    $finalresult[] = $res;
                }
                $data['result'] = $finalresult;
                $this->load->view('reports/tenant_payment_due', $data);	
				
				}
				
				
			}	
				
	}
	
	
    public function tenantreports() {

        if ($_POST['view_type'] == 'lv') {
            $query = "select company_names AS COMPANY_NAME from companies";
            $this->get_report_list_view($query, 'companyreports');
        }

        if ($_POST['view_type'] == 'pv') {

            /* complex wise tenant report start */
            if (isset($_POST['com_ten_report'])) {
                $complex_id = $_POST['complex_id'];
                $results = $this->db->query("select * from complex where complex_id = $complex_id");
                $result = $results->result();
                $complex_name = $result[0]->complex_name;
                $selector = '
               shop.shop as shop,
                b_shop_id as ID,
                tenant_name,
                address,
                booking_date,
                tenant_mobile
                
                ';
                $query = "select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id where b_complex_id = $complex_id ";
                $this->get_report_print_view($query, "Complex: $complex_name", '');
            }
            /* complex wise tenant report end */
            if (isset($_POST['com_ten_due_report'])) {

                $complex_id = $_POST['complex_id'];
                $results = $this->db->query("select * from complex where complex_id = $complex_id");
                $result = $results->result();
                $complex_name = $result[0]->complex_name;
                $selector = "
                shop.shop as shop,
                b_shop_id as b_shop_id,
                tenant_name,
                address,
                booking_date,
                tenant_mobile
                ";
                $query = $this->db->query("
                    select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id where b_complex_id = $complex_id 
                ");
                $resul = $query->result();
                $finalresult = array();
                foreach ($resul as $res) {
                    $shop_id = $res->b_shop_id;
                    $billstatus = $this->db->query("select shop_id ,count(*) as months ,sum(amount) as amount from monthly_bill where shop_id = $shop_id and bill_status = 0");
                    $b_result = $billstatus->result();
                    if (isset($b_result[0])) {
                        $res->due = $b_result[0]->amount;
                        $res->month = $b_result[0]->months;
                    }
                    $finalresult[] = $res;
                }
                $data['complex_name'] = $complex_name;

                $data['result'] = $finalresult;

                $this->load->view('reports/tenant_payment_due', $data);
                //echo $reulttable = $this->tablemaking($controller, $method, $total_rows, $finalresult, $view, $title, ' ');
                /* variable parameter */
            }
            /* complex wise tenant report end */
        }

        if ($_POST['view_type'] == 'lv') {
            
        }
    }

    public function expense() {
        $data = array();
        $data['title'] = "Expense Report";
        $options = array();
        $results = $this->db->query("select * from expensecategory");
        $result = $results->result();
        $options['all'] = 'All';
        foreach ($result as $res) {
            $options[$res->cat_id] = $res->exp_category_name;
        }
        $data['options'] = $options;
		$options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        $options[''] = 'Select Company';
		$options['all']='All';
        foreach ($result as $res) {
            $options[$res->id] = $res->company_names;
        }
        $data['company'] = $options;
		
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('reports/expense_report_form', $data);
    }

    public function expensereports() {
	
		$catCon="";
		/* validation start*/
		$this->form_validation->set_rules('fromdate', 'fromdate', 'required');
		$this->form_validation->set_rules('todate', 'todate', 'required');
		$this->form_validation->set_rules('company_id', 'Company', 'required');
		if(isset($_POST['cat_id'])){
			if($_POST['cat_id']=='all'){}
			else{ $cat_id=$_POST['cat_id']; $catCon= "and (expense.expense_category = $cat_id)"; }
		}
		/* validation end*/
		if ($this->form_validation->run() == FALSE)
		{
		$this->expense();
		
		}
		else
		{
			
		   /* validation pass */
		   
		   $data['from'] = $fromdate = $_POST['fromdate'];
           $data['to'] = $todate = $_POST['todate'];
		   $fromdate=date('Y-m-d', strtotime($fromdate));
		   $todate=date('Y-m-d', strtotime($todate));
		   $selector = "*";
           $cssadd = 'table{ width:500px !important; }';
		   
		   if(($_POST['company_id']=='all') && ($_POST['complex_id']== 'all') ){		  
		   $data['report_title']="Name: All Company";
		   $query = "select $selector  from expense join expensecategory ON expensecategory.cat_id = expense.expense_category where (dateofexpense BETWEEN date('" . $fromdate . "') AND date('" . $todate . "') $catCon )";
		   }
		   

		   if(($_POST['company_id']=='all') && ($_POST['complex_id']==null) ){
		   $data['report_title']="Name: All Company";
		   $query = "select $selector  from expense join expensecategory ON expensecategory.cat_id = expense.expense_category where (dateofexpense BETWEEN date('" . $fromdate . "') AND date('" . $todate . "') $catCon )";  
		   }

			
		   if(($_POST['company_id']=='all') && ($_POST['complex_id']!= '') &&  ($_POST['complex_id']!= 'all')) {
		   $complex_id=$_POST['complex_id'];
		   $com = $this->db->query("select * from complex where complex_id=$complex_id");
           $comp = $com->result();
		   $data['report_title']="Name: ".$comp[0]->complex_name;
		   
		   $query = "select $selector  from expense join expensecategory ON expensecategory.cat_id = expense.expense_category where company = $company_id and (dateofexpense BETWEEN date('" . $fromdate . "') AND date('" . $todate . "') $catCon )";
		   }

		   if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== '')) {
		   $company_id=$_POST['company_id'];
		   $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
		   $data['report_title']="Name: ".$company_names;
		   
		   $query = "select $selector  from expense join expensecategory ON expensecategory.cat_id = expense.expense_category where company = $company_id and (dateofexpense BETWEEN date('" . $fromdate . "') AND date('" . $todate . "') $catCon )";  
		   }
		   
		   if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== 'all')) {
		   $company_id=$_POST['company_id'];
		   $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
		   $data['report_title']="Name: ".$company_names;
		   $query = "select $selector  from expense join expensecategory ON expensecategory.cat_id = expense.expense_category where company = $company_id and (dateofexpense BETWEEN date('" . $fromdate . "') AND date('" . $todate . "') $catCon )"; 
		   }		   
		   
		   if(($_POST['company_id']!='') && ($_POST['complex_id']!= '') && ($_POST['company_id']!='all') && ($_POST['complex_id']!= 'all')) {
		   $complex_id=$_POST['complex_id'];
		   $company_id=$_POST['company_id'];
		   
		   
		   $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
		   
		   $com = $this->db->query("select * from complex where complex_id=$complex_id");
           $comp = $com->result();
		   
		   $data['report_title']="Company: ".$company_names." Complex: ".$comp[0]->complex_name;
		   
		   
		   $query = "select $selector  from expense join expensecategory ON expensecategory.cat_id = expense.expense_category where company = $company_id and complex = $complex_id and (dateofexpense BETWEEN date('" . $fromdate . "') AND date('" . $todate . "') $catCon )"; 
		   }  
		   
		  
            $results = $this->db->query($query);
            $data['result'] = $results->result();
            $this->load->view('reports/expensereport', $data);		   
		}

		
    }

    public function bank() {
        $data = array();
        $data['title'] = "Bank Report";
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
        $this->load->view('reports/bank_report_form', $data);
    }

    public function bankreports() {
        if ($_POST['view_type'] == 'lv') {
            $query = "select company_names AS COMPANY_NAME from companies";
            $this->get_report_list_view($query, 'companyreports');
        }

        if ($_POST['view_type'] == 'pv') {
            $bank_id = $_POST['bank_id'];
            $results = $this->db->query("select * from bank where bank_id = $bank_id");
            $res = $results->result();
            $data['bank_name'] = $res[0]->bank_name;
            $data['branch_name'] = $res[0]->bank_name;
            $data['account_number'] = $res[0]->account_number;
            $data['balance'] = $res[0]->balance;
            $data['from'] = $fromdate = $_POST['fromdate'];
            $data['to'] = $todate = $_POST['todate'];
            $selector = "
                date,note,debit,credit                
             ";
            $cssadd = '
            table{ width:500px !important; } 
            ';
            $query = "select $selector  from bank_trans_history  where bank_id = $bank_id   AND (date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";
            $results = $this->db->query($query);
            $data['result'] = $results->result();
            $this->load->view('reports/bankstatment', $data);
            //$this->get_report_print_view($query, 'Bank Transections:', $cssadd);
        }

        if ($_POST['view_type'] == 'lv') {
            
        }
    }

    public function rentcollection() {
        $data = array();
        $data['title'] = "Rent collection";
		
		
		$options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        $options[''] = 'Select Company';
		$options['all']='All';
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
        $data['options'] = $options;
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('reports/rent_report_form', $data);
    }

	
	
	
	

    public function rentcollectionreports() {
		/* validation start*/
		$this->form_validation->set_rules('fromdate', 'fromdate', 'required');
		$this->form_validation->set_rules('todate', 'todate', 'required');
		$this->form_validation->set_rules('company_id', 'Company', 'required');	

		$resultset=$this->db->query("select * from complex");
		$resultdata=$resultset->result();
		$complexs=array();
		foreach($resultdata as $rd){
		$complexs[$rd->complex_id]=$rd->complex_name;
		}
		
		$data['complexs']=$complexs;
		
		
			
		/* validation end*/
		if ($this->form_validation->run() == FALSE)
		{
		$this->rentcollection();
		
		}
		else
		{
			
			
			
		   /* validation pass */
		   
		   $data['from'] = $fromdate = $_POST['fromdate'];
           $data['to'] = $todate = $_POST['todate'];
		   $fromdate=date('Y-m-d', strtotime($fromdate));
		   $todate=date('Y-m-d', strtotime($todate));
		   $selector = "*";
           $cssadd = 'table{ width:500px !important; }';
		   
		   if(($_POST['company_id']=='all') && ($_POST['complex_id']== 'all') ){
		  
		   $data['report_title']="Name: All Company";
		   $query = "select $selector  from monthly_bill join shop on shop.shop_id = monthly_bill.shop_id  where bill_status = 1 and(date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }

		   if(($_POST['company_id']=='all') && ($_POST['complex_id']!= 'all') && ($_POST['complex_id']!= null) ){
		  
		   $data['report_title']="Name: All Company";
		   $query = "select $selector  from monthly_bill join shop on shop.shop_id = monthly_bill.shop_id  where bill_status = 1 and(date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }
		   
		   if(($_POST['company_id']=='all') && ($_POST['complex_id']==null) ){
		   $data['report_title']="Name: All Company";
		   $query = "select $selector  from monthly_bill join shop on shop.shop_id = monthly_bill.shop_id  where bill_status = 1 and (date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }


		   if(($_POST['company_id']=='all') && ($_POST['complex_id']!= '') &&  ($_POST['complex_id']!= 'all')) {
		   $complex_id=$_POST['complex_id'];
		   $com = $this->db->query("select * from complex where complex_id=$complex_id");
           $comp = $com->result();
		   $data['report_title']="Name: ".$comp[0]->complex_name;
		   
		   $query = "select $selector  from monthly_bill join shop on shop.shop_id = monthly_bill.shop_id  where bill_status = 1 and (shop.complex = $complex_id) and(date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }

		   if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== '')) {
		   $company_id=$_POST['company_id'];
		   $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
		   $data['report_title']="Name: ".$company_names;
		   
		   $query = "select $selector  from monthly_bill join shop on shop.shop_id = monthly_bill.shop_id  where bill_status = 1 and (shop.company = $company_id) and(date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }
		   
		   if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== 'all')) {
		   $company_id=$_POST['company_id'];
		   $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
		   $data['report_title']="Name: ".$company_names;
		   $query = "select $selector  from monthly_bill join shop on shop.shop_id = monthly_bill.shop_id  where bill_status = 1 and (shop.company = $company_id) and(date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }		   
		   
		   if(($_POST['company_id']!='') && ($_POST['complex_id']!= '') && ($_POST['company_id']!='all') && ($_POST['complex_id']!= 'all')) {
		   $complex_id=$_POST['complex_id'];
		   $company_id=$_POST['company_id'];
		   
		   
		   $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
		   
		   $com = $this->db->query("select * from complex where complex_id=$complex_id");
           $comp = $com->result();
		   
		   $data['report_title']="Company: ".$company_names." Complex: ".$comp[0]->complex_name;
		   
		   
		   $query = "select $selector  from monthly_bill join shop on shop.shop_id = monthly_bill.shop_id  where bill_status = 1 and (shop.company = $company_id)  and (shop.complex = $complex_id) and(date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }		   
		  // die($query);
		  
            $results = $this->db->query($query);
            $data['result'] = $results->result();
            $this->load->view('reports/rent_collection', $data);		   
		}

    }

	
	
    public function utilitiescollection() {
        $data = array();
        $data['title'] = "Utilities collection";
		
		
		$options = array();
        $results = $this->db->query("select * from companies");
        $result = $results->result();
        $options[''] = 'Select Company';
		$options['all']='All';
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
        $data['options'] = $options;
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('reports/utilities_report_form', $data);
    }	
	

    public function utilitiescollectionreports() {
	
			/* validation start*/
		$this->form_validation->set_rules('fromdate', 'fromdate', 'required');
		$this->form_validation->set_rules('todate', 'todate', 'required');
		$this->form_validation->set_rules('company_id', 'Company', 'required');		
		/* validation end*/
		if ($this->form_validation->run() == FALSE)
		{
		$this->utilitiescollection();
		
		}
		else
		{
			
		   /* validation pass */
		   
		   $data['from'] = $fromdate = $_POST['fromdate'];
           $data['to'] = $todate = $_POST['todate'];
		   $fromdate=date('Y-m-d', strtotime($fromdate));
		   $todate=date('Y-m-d', strtotime($todate));
		   $selector = "*";
           $cssadd = 'table{ width:500px !important; }';
		   
		   if(($_POST['company_id']=='all') && ($_POST['complex_id']== 'all') ){
		  
		   $data['report_title']="Name: All Company";
		   $query = "select * from utility where (utility_date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }
		   
		   if(($_POST['company_id']=='all') && ($_POST['complex_id']==null) ){
		   $data['report_title']="Name: All Company";
		   $query = "select * from utility where (utility_date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }


		   if(($_POST['company_id']=='all') && ($_POST['complex_id']!= '') &&  ($_POST['complex_id']!= 'all')) {
		   $complex_id=$_POST['complex_id'];
		   $com = $this->db->query("select * from complex where complex_id=$complex_id");
           $comp = $com->result();
		   $data['report_title']="Name: ".$comp[0]->complex_name;
		   
		   $query = "select * from utility where comx = $complex_id and (utility_date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }

		   if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== '')) {
		   $company_id=$_POST['company_id'];
		   $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
		   $data['report_title']="Name: ".$company_names;
		   
		   $query = "select * from utility where com = $company_id and (utility_date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }
		   
		   if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== 'all')) {
		   $company_id=$_POST['company_id'];
		   $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
		   $data['report_title']="Name: ".$company_names;
		   $query = "select * from utility where com = $company_id and (utility_date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }		   
		   
		   if(($_POST['company_id']!='') && ($_POST['complex_id']!= '') && ($_POST['company_id']!='all') && ($_POST['complex_id']!= 'all')) {
		   $complex_id=$_POST['complex_id'];
		   $company_id=$_POST['company_id'];
		  
		   
		   $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
		   
		   $com = $this->db->query("select * from complex where complex_id=$complex_id");
           $comp = $com->result();
		   
		   $data['report_title']="Company: ".$company_names." , Complex: ".$comp[0]->complex_name;
		   
		   
		   $query = "select * from utility where com = $company_id and comx = $complex_id and (utility_date BETWEEN date('" . $fromdate . "') AND date('" . $todate . "'))";  
		   }

			$results = $this->db->query($query);
            $data['result'] = $results->result();
            $this->load->view('reports/utilitiescollectionreports', $data);		   
		   
		   }




    }
	
	
	
	
	
	
	
	
	
	
	
    /* ---------------------------------------------------------------------------------------------- */

    function get_report_list_view($query, $method) {
        // $this->load->model('reports_model');
        //$this->load->dbutil();
        //$this->load->helper('file');
        /* get the object   */


        /* fixed code */
        $start = $this->uri->segment(3);
        if ($start > 0) {
            $start = $start . " , ";
        } else {
            $start = '';
        }
        $perpage = PERPAGE;
        /* fixed code */



        $report = $this->db->query("$query LIMIT $start  $perpage");
        ;
        $results = $report->result();

        $data = array();
        /* variable parameter */
        $controller = 'reports';
        $method = $method;
        $view = 'List';
        $title = null;
        $total_rows = $this->db->count_all_results('companies');
        $reulttable = $this->tablemaking($controller, $method, $total_rows, $results, $view, $title);
        /* variable parameter */


        /* fixed code */
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $data['table'] = $reulttable;
        $this->load->view('reports/reports_view_all', $data);
        /* fixed code */

        /*

          die();

          /*  pass it to db utility function */
        //  $new_report = $this->dbutil->csv_from_result($report);
        /*  Now use it to write file. write_file helper function will do it */
        // write_file('csv_file.csv', $new_report);
        /*  Done    */
    }

    function get_report_print_view($query, $title, $cssadd) {
        $report = $this->db->query("$query");

        $results = $report->result();

        $data = array();
        /* variable parameter */
        $controller = 'reports';
        $method = 'get_report_print_view';
        $view = 'print';
        $total_rows = $this->db->count_all_results('companies');
        echo $reulttable = $this->tablemaking($controller, $method, $total_rows, $results, $view, $title, $cssadd);
        /* variable parameter */
    }

    function tablemaking($controller, $method, $total_rows, $results, $view, $title, $cssadd) {

        /* pagination */
        $datatable = array();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "$controller/$method/";
        $config['total_rows'] = $total_rows;
        $perpage = $config['per_page'] = PERPAGE;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $datatable['link'] = $this->pagination->create_links();
        /* pagination */
        $css = "
         <style>
         td{ 
         border-bottom:1px solid gray;
         height:30px;  
         text-align:left;
        } 
        th{ text-align:left; }
        .printhead{ font-size:13px;}
        body{font-family:arial;}
        table{width:100%;}
        $cssadd
        </style>   
        ";
        if ($title != '') {
            $datatable['title'] = $title;
            $datatable['css'] = $css;
        }

        $datatable['view'] = $view;
        $datatable['results'] = $results;
        return $this->load->view('reports/table', $datatable, true);
    }

    /* ============================================================================================
     * ============================================================================================ */

    function final_daytoday() {
        $data = array();
        $data['title'] = "Receipts & Paymnet Reports";
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
        $this->load->view('reports/final_daytoday', $data);
    }

    function final_generate() {
        if ($_POST['type'] == 0) {


            if ($_POST['view_type'] == 'pv') {

                $data['from'] = $fromdate = $_POST['fromdate'];
                $data['to'] = $todate = $_POST['todate'];
                $selector = " * ";
                $query = "select $selector  from monthly_bill join shop ON shop.shop_id = monthly_bill.shop_id join tenant ON tenant.tenant_id = monthly_bill.tenant_id where monthly_bill.bill_status = 1 AND (date  >= '" . $fromdate . "' AND date  <= '" . $todate . "')";
                $results = $this->db->query($query);
                $data['income'] = $results->result();

                $selector = "
               *
                ";

               $query = "select $selector  from expense  where (dateofexpense >= date('" . $fromdate . "') AND dateofexpense <= date('" . $todate . "'))";
                
				
				$results = $this->db->query($query);
                $data['expense'] = $results->result();

                $this->load->view('reports/receiptspayment', $data);
            }
        }
    }

    function final_report() {
        $data = array();


       // $data['from'] = $fromdate = '01-06-2010';
       // $data['to'] = $todate = '15-06-2020';
        $selector = " sum(amount) as amo ";
        $query = "select $selector  from monthly_bill join shop ON shop.shop_id = monthly_bill.shop_id join tenant ON tenant.tenant_id = monthly_bill.tenant_id where monthly_bill.bill_status = 1 ";
        $results = $this->db->query($query);
        $income = $results->result();
        $data['income']=$income[0]->amo;

        $selector = " sum(amount) as amo ";
        $query = "select $selector  from monthly_bill join shop ON shop.shop_id = monthly_bill.shop_id join tenant ON tenant.tenant_id = monthly_bill.tenant_id where monthly_bill.bill_status = 0";
        $results = $this->db->query($query);
        $income = $results->result();
        $data['due']=$income[0]->amo;        
        
        
        $selector = "
              sum(amount) as amo
                ";

        $query = "select $selector  from expense ";
        $results = $this->db->query($query);
        $expense = $results->result();
        $data['expense']=$expense[0]->amo;

        $res = $this->db->query("SELECT * FROM `setting_account` WHERE (`attribute`= 'cash_in_hand') ");
        $result = $res->result();
        $data['cash_in_hand'] = $result[0]->amount;
        $res = $this->db->query("SELECT sum(balance) as balance FROM `bank`  ");
        $result = $res->result();
        $data['balance'] = $result[0]->balance;
        $data['header'] = $this->load->view('header', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        $data['topbar'] = $this->load->view('topbar', $data, true);
        $data['sidebar'] = $this->load->view('sidebar', $data, true);
        $this->load->view('reports/final', $data);
    }

    function invoice() {
        $data = array();
        $invoice_id = $this->uri->segment(3);
        $res = $this->db->query("select * from tenant_invoice 
		join tenant ON tenant.tenant_id = tenant_invoice.tenant_id 
		join users on users.id = tenant_invoice.recived_by_id
		where (invoice_id = $invoice_id)");
        $data['result'] = $resultset = $res->result();
		//print_r($data['result']);
		//die();
        $itemsall=$resultset[0]->items;
		$items=explode(",",$itemsall);
		$monthyear='';
		$m=0;
		$yamo=array();
		foreach($items as $item){
		$itemres=$this->db->query("select * from monthly_bill where bill_id = $item");
		$resultitem=$itemres->result();
		$yamo[]=$resultitem[0]->year.$resultitem[0]->month;
		$monthNum = $resultitem[0]->month;
		 $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
		$shop_id=$resultitem[0]->shop_id;
		if($m==0){
		$monthyear=$monthyear."   ".$monthName."/".$resultitem[0]->year;
		}
		else{
		$monthyear=$monthyear.",".$monthName."/".$resultitem[0]->year;
		}
		
		
		}
		$data['yamo']=$yamo;
		$data['monthyear']=$monthyear;
		$resshop=$this->db->query("select * from shop
		join complex on complex.complex_id = shop.complex
		where shop_id = $shop_id");
		$resshopinfo=$resshop->result();
		$data['complex_name']=$resshopinfo[0]->complex_name;
		$data['complex_address']=$resshopinfo[0]->complex_address;
		$data['shop']=$resshopinfo[0]->shop;
		$data['square_feet']=$resshopinfo[0]->square_feet;
		$data['inword']=$this->convert_number_to_words($resultset[0]->amount);
		$shopdres=$this->db->query("select sum(amount) as amount from monthly_bill where shop_id = $shop_id and bill_status = 0");
		$shopdues=$shopdres->result();
		$data['due']=$shopdues[0]->amount;
        $this->load->view('reports/invoice', $data);
    }

	
	function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . $this->convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
	
}

?>