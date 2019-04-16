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
		//$this->form_validation->set_rules('company_id', 'Company', 'required');
		//$this->form_validation->set_rules('complex_id', 'Complex', 'required');
		/* validation end*/
		//if ($this->form_validation->run() == FALSE)
		//{
		//$this->tenant_due();
		
		//}
//		else{
	
	//echo "<pre>";
	
$shop_no = (isset($_POST['shop_no']) && !empty($_POST['shop_no'])) ? (int)$_POST['shop_no'] : false; 

if (isset($shop_no) && !empty($shop_no)) {
    $shop_id_filter_query = $this->db->query("select shop_id from shop where shop =$shop_no");
    $shop_id_filter_result = $shop_id_filter_query->result();
    $shop_id_filter = $shop_id_filter_result[0]->shop_id;

                
                if($_POST['company_id']=='all'){
                /* if company id is all */
                
            
                
                $selector = "
                complex_id,
                complex_name,
                shop.shop as shop,
                b_shop_id as b_shop_id,
                tenant_name,
                address,
                booking_date,
                tenant_mobile
                ";
            
                $query = $this->db->query("
                    select $selector from booking   join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id join complex on shop.complex = complex.complex_id where booking.b_shop_id = $shop_id_filter
                 order by complex_id");
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
                    complex_id,
                    complex_name,
                    shop.shop as shop,
                    b_shop_id as b_shop_id,
                    tenant_name,
                    address,
                    booking_date,
                    tenant_mobile
                    ";
                        if($complex_id=='all'){
                        $query = $this->db->query("
                        select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id join complex on shop.complex = complex.complex_id  where b_company_id = $company_id
                        order by complex_id
                        ");
                    
                        }
                        else{
                        
                                
                        $results = $this->db->query("select * from complex where complex_id = $complex_id");
                        $result = $results->result();
                        $complex_name = $result[0]->complex_name;
                        $query = $this->db->query("
                            select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id join complex on shop.complex = complex.complex_id  where shop.complex = $complex_id 
                        order by complex_id
                        ");
                        $data['complex_name'] = $complex_name;
                        
                        }

                
                $resul = $query->result();
                
                //echo "<pre>";
                //print_r($resul);
                //die();
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
}else{
                if($_POST['company_id']=='all'){
                /* if company id is all */
                
            
                
                $selector = "
                complex_id,
                complex_name,
                shop.shop as shop,
                b_shop_id as b_shop_id,
                tenant_name,
                address,
                booking_date,
                tenant_mobile
                ";
            
                $query = $this->db->query("
                    select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id join complex on shop.complex = complex.complex_id 
                 order by complex_id");
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
                    complex_id,
                    complex_name,
                    shop.shop as shop,
                    b_shop_id as b_shop_id,
                    tenant_name,
                    address,
                    booking_date,
                    tenant_mobile
                    ";
                        if($complex_id=='all'){
                        $query = $this->db->query("
                        select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id join complex on shop.complex = complex.complex_id  where b_company_id = $company_id
                        order by complex_id
                        ");
                    
                        }
                        else{
                        
                                
                        $results = $this->db->query("select * from complex where complex_id = $complex_id");
                        $result = $results->result();
                        $complex_name = $result[0]->complex_name;
                        $query = $this->db->query("
                            select $selector from booking join tenant ON booking.b_tenant_id = tenant.tenant_id join shop ON shop.shop_id = booking.b_shop_id join complex on shop.complex = complex.complex_id  where shop.complex = $complex_id 
                        order by complex_id
                        ");
                        $data['complex_name'] = $complex_name;
                        
                        }

                
                $resul = $query->result();
                
                //echo "<pre>";
                //print_r($resul);
                //die();
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


				
				
		//	}	
				
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
           $shop_no = (isset($_POST['shop_no']) && !empty($_POST['shop_no'])) ? (int)$_POST['shop_no'] : false; 
           // $tenant_name = (isset($_POST['tenant_name']) && !empty($_POST['tenant_name'])) ? (string)$_POST['tenant_name'] :(string) false; 
           $selector = "*";
           $cssadd = 'table{ width:500px !important; }';
           
		   
		   
		   
		   if (isset($shop_no) && !empty($shop_no)) {

               if(($_POST['company_id']=='all') && ($_POST['complex_id']== 'all') ){
              
               $data['report_title']="Name: All Company";
               $query = "
               select * from tenant_invoice where shop_name = $shop_no and
               (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
               ";  
               }

               if(($_POST['company_id']=='all') && ($_POST['complex_id']!= 'all') && ($_POST['complex_id']!= null) ){
              
               $data['report_title']="Name: All Company";
               $query = "
               select * from tenant_invoice where shop_name = $shop_no and
               (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
               "; 
               }
           
               if(($_POST['company_id']=='all') && ($_POST['complex_id']==null) ){
               $data['report_title']="Name: All Company";
               $query = "
               select * from tenant_invoice where shop_name = $shop_no and
               (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
               ";  
               }


               if(($_POST['company_id']=='all') && ($_POST['complex_id']!= '') &&  ($_POST['complex_id']!= 'all')) {
               $complex_id=$_POST['complex_id'];
               $com = $this->db->query("select * from complex where complex_id=$complex_id");
               $comp = $com->result();
               $data['report_title']="Name: ".$comp[0]->complex_name;
               
                       $query = "
               select * from tenant_invoice where comx = $complex_id and shop_name = $shop_no and
               (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
               "; 
               }

               if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== '')) {
               $company_id=$_POST['company_id'];
               $com = $this->db->query("select * from companies where id =$company_id");
               $comp = $com->result();
               $company_names = $comp[0]->company_names;
               $data['report_title']="Name: ".$company_names;
               
                  $query = "
               select * from tenant_invoice where com= $company_id and shop_name = $shop_no and
               (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
               ";
               }
           
               if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== 'all')) {
               $company_id=$_POST['company_id'];
               $com = $this->db->query("select * from companies where id =$company_id");
               $comp = $com->result();
               $company_names = $comp[0]->company_names;
               $data['report_title']="Name: ".$company_names;
               
               $query = "
               select * from tenant_invoice where com= $company_id and shop_name = $shop_no and
               (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
               "; 
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
                   $query = "
                   select * from tenant_invoice where com= $company_id and comx = $complex_id and shop_name = $shop_no and
                   (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
                   "; 
                
                }

           }else{
                       if(($_POST['company_id']=='all') && ($_POST['complex_id']== 'all') ){
          
           $data['report_title']="Name: All Company";
           $query = "
           select * from tenant_invoice where
           (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
           ";  
           }

           if(($_POST['company_id']=='all') && ($_POST['complex_id']!= 'all') && ($_POST['complex_id']!= null) ){
          
           $data['report_title']="Name: All Company";
           $query = "
           select * from tenant_invoice where
           (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
           "; 
           }
           
           if(($_POST['company_id']=='all') && ($_POST['complex_id']==null) ){
           $data['report_title']="Name: All Company";
           $query = "
           select * from tenant_invoice where
           (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
           ";  
           }


           if(($_POST['company_id']=='all') && ($_POST['complex_id']!= '') &&  ($_POST['complex_id']!= 'all')) {
           $complex_id=$_POST['complex_id'];
           $com = $this->db->query("select * from complex where complex_id=$complex_id");
           $comp = $com->result();
           $data['report_title']="Name: ".$comp[0]->complex_name;
           
                   $query = "
           select * from tenant_invoice where comx = $complex_id and
           (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
           "; 
           
            
           }

           if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== '')) {
           $company_id=$_POST['company_id'];
           $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
           $data['report_title']="Name: ".$company_names;
           
              $query = "
           select * from tenant_invoice where com= $company_id and
           (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
           "; 
           
           
           
           }
           
           if(($_POST['company_id']!='') && ($_POST['company_id']!='all') && ($_POST['complex_id']== 'all')) {
           $company_id=$_POST['company_id'];
           $com = $this->db->query("select * from companies where id =$company_id");
           $comp = $com->result();
           $company_names = $comp[0]->company_names;
           $data['report_title']="Name: ".$company_names;
           
           $query = "
           select * from tenant_invoice where com= $company_id and
           (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
           "; 
           
           
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
           $query = "
           select * from tenant_invoice where com= $company_id and comx = $complex_id and
           (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $todate . " 23:59:59' )
           "; 
            
            }
           }
		   

		   //echo $query;
		  
           $results = $this->db->query($query);
           $result=$data['result'] = $results->result();
          
		   
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
				$dStart = new DateTime($fromdate);
			    $dEnd  = new DateTime($todate);
			    $dDiff = $dStart->diff($dEnd);
			    $diffInDays = (int)$dDiff->format("%r%a"); // use for point out relation: smaller/greater
			    $count = $dDiff->days+1;
				$resultarray=array();
				$x=0;

                    $tilldate=$dStart->format('Y-m-d');

                    //Till Income
                    $query = "select sum(amount) as amount from tenant_invoice where `pay_date` <= '" . $tilldate . " 00:00:00'";
                    $results = $this->db->query($query);
                    $till_income = $results->result();
                    $till_income = (int) $till_income[0]->amount;

                    //Till Expense
                    $query = "select sum(amount) as amount from expense where `dateofexpense` <= '" . $tilldate . " 00:00:00'";
                    $results = $this->db->query($query);
                    $till_expense = $results->result();
                    $till_expense = (int) $till_expense[0]->amount;

                    // if(isset($income[0])){$in=$income[0]->amount; if($in==null){ $in=0; } }else{ $in=0; }
                    $data['opening']= $till_income - $till_expense;

                for($c=0;$c<$count;$c++){
                    $datetime = new DateTime($fromdate);
                    if($x!=0){$datetime->modify('+1 day');  }else{ $x=1;}                   
                    $fromdate=$datetime->format('Y-m-d');
					$resultarray[$c]['edate']=$fromdate;
					
					//for income //
					$query = "select sum(amount) as amount from tenant_invoice where  (`pay_date` >= '" . $fromdate . " 00:00:00' and `pay_date` <= '" . $fromdate . " 23:59:59' )";
					$results = $this->db->query($query);
                    $income = $results->result();
					if(isset($income[0])){$in=$income[0]->amount; if($in==null){ $in=0; } }else{ $in=0; }
					$resultarray[$c]['income']=$in;
					//for income //

					//for expense //
					$query = "select sum(amount) as amount from expense where  (`dateofexpense` >= '" . $fromdate . " 00:00:00' and `dateofexpense` <= '" . $fromdate . " 23:59:59' )";
					$results = $this->db->query($query);
                    $expense = $results->result();
					if(isset($expense[0])){$ex=$expense[0]->amount; if($ex==null){ $ex=0; } }else{ $ex=0; }
					$resultarray[$c]['expense']=$ex;
					//for expense //					
					
					
				}
                $data['resultarray']=($resultarray);
                $this->load->view('reports/receiptspayment', $data);
            }
        }
    }

    function final_report() {
        $data = array();

        // ALL TIMES REPORT-------------------

       // $data['from'] = $fromdate = '01-06-2010';
       // $data['to'] = $todate = '15-06-2020';
        $selector = " sum(amount) as amo ";
		
		//income //
		$query = "select $selector from tenant_invoice";
		$results = $this->db->query($query);
        $income = $results->result();
        $data['income']=$incomes=$income[0]->amo;
		//income //
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
        $data['expense']=$expense=$expense[0]->amo;

        
        
        $res = $this->db->query("SELECT sum(balance) as balance FROM `bank`  ");
        $result = $res->result();
        $data['balance'] = $bank=$result[0]->balance;
		
		$data['cash_in_hand'] = $incomes-$expense-$bank;

        
        // This months report-----------------
        $fromdate_monthreport = date('Y-m-01');
        $todate_monthreport = date('Y-m-d', strtotime('today'));
        // $fromdate_monthreport = '2016-06-01';
        // $todate_monthreport = '2016-10-24';
        $selector = " sum(amount) as amo ";
        
        //income //
        $query = "select $selector from tenant_invoice where (`pay_date` >= '" . $fromdate_monthreport . " 00:00:00' and `pay_date` <= '" . $todate_monthreport . " 23:59:59' )";
        $results = $this->db->query($query);
        $income_month = $results->result();
        $data['income_month']=$incomes_month=$income_month[0]->amo;
        //income //
        $selector = " sum(amount) as amo ";
        $query = "select $selector  from monthly_bill join shop ON shop.shop_id = monthly_bill.shop_id join tenant ON tenant.tenant_id = monthly_bill.tenant_id where monthly_bill.bill_status = 0";
        $results = $this->db->query($query);
        $income_month = $results->result();
        $data['due_month']=$income_month[0]->amo;        
        
        
        $selector = "
              sum(amount) as amo
                ";

        $query = "select $selector  from expense where (`dateofexpense` >= '" . $fromdate_monthreport . " 00:00:00' and `dateofexpense` <= '" . $todate_monthreport . " 23:59:59' )";
        $results = $this->db->query($query);
        $expense_month = $results->result();
        $data['expense_month']=$expense_month=$expense_month[0]->amo;

        
      
        $data['cash_in_hand_month'] = $incomes_month-$expense_month;

        // Yesterdays report------------------
        $fromdate_dayreport = date('Y-m-d', strtotime('yesterday'));
        $todate_dayreport = date('Y-m-d', strtotime('yesterday'));
        // $fromdate_dayreport = '2016-06-01';
        // $todate_dayreport = '2016-10-24';
        $selector = " sum(amount) as amo ";
        
        //income //
        $query = "select $selector from tenant_invoice where (`pay_date` >= '" . $fromdate_dayreport . " 00:00:00' and `pay_date` <= '" . $todate_dayreport . " 23:59:59' )";
        $results = $this->db->query($query);
        $income_day = $results->result();
        $data['income_day']=$incomes_day=$income_day[0]->amo;
        //income //
        $selector = " sum(amount) as amo ";
        $query = "select $selector  from monthly_bill join shop ON shop.shop_id = monthly_bill.shop_id join tenant ON tenant.tenant_id = monthly_bill.tenant_id where monthly_bill.bill_status = 0";
        $results = $this->db->query($query);
        $income_day = $results->result();
        $data['due_day']=$income_day[0]->amo;        
        
        
        $selector = "
              sum(amount) as amo
                ";

        $query = "select $selector  from expense where (`dateofexpense` >= '" . $fromdate_dayreport . " 00:00:00' and `dateofexpense` <= '" . $todate_dayreport . " 23:59:59' )";
        $results = $this->db->query($query);
        $expense_day = $results->result();
        $data['expense_day']=$expense_day=$expense_day[0]->amo;

        
      
        $data['cash_in_hand_day'] = $incomes_day-$expense_day;

		
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
		//print_r($resshopinfo[0]);
		$data['complex_name']=$resshopinfo[0]->complex_name;
		$data['complex_address']=$resshopinfo[0]->complex_address;
		$data['shop']=$shopname=$resshopinfo[0]->shop;
		$data['square_feet']=$resshopinfo[0]->square_feet;
		$data['inword']=$this->convert_number_to_words($resultset[0]->amount);
		$shopdres=$this->db->query("select sum(amount) as amount from monthly_bill where shop_id = $shop_id and bill_status = 0");
		
		//echo $resshopinfo[0]->complex_id;
		//die();


		$complex_id=$resshopinfo[0]->complex_id;
		$r1=$this->db->query("select company_id from complex where complex_id = $complex_id");
		$complx=$r1->result();

		$company_id=$complx[0]->company_id;
		$r2=$this->db->query("select company_names from companies where id = $company_id");
		$compa=$r2->result();
		
		$ymstring='';	
		natcasesort($yamo);		
		foreach($yamo as $va){
		$year=substr($va,0,4);
		$month=substr($va, 4, 2); 
		$ymstring=$ymstring.$this->getMonthString($month)."/".$year." "; 
		}
		
		
		$update=array(
		'shop'=>$shop_id,
		'comx'=>$resshopinfo[0]->complex_id,
		'com'=>$complx[0]->company_id,
		'com_name'=>$compa[0]->company_names,
		'shop_name'=>$shopname,
		'month'=>$ymstring,
		'comx_name'=>$resshopinfo[0]->complex_name
		);
		
		
		
		$this->db->where('invoice_id',$invoice_id);
		$this->db->update('tenant_invoice',$update);
		$shopdues=$shopdres->result();
		$data['due']=$shopdues[0]->amount;
        $this->load->view('reports/invoice', $data);
    }
    
    
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}	
	
	
function getMonthString($m){
    if($m==01){
        return "Jan";
    }else if($m=='02'){
        return "Feb";
    }else if($m=='03'){
        return "Mar";
    }else if($m=='04'){
        return "Apr";
    }else if($m=='05'){
        return "May";
    }else if($m=='06'){
        return "Jun";
    }else if($m=='07'){
        return "Jul";
    }else if($m=='08'){
        return "Aug";
    }else if($m=='09'){
        return "Sep";
    }else if($m=='10'){
        return "Oct";
    }else if($m=='11'){
        return "Nov";
    }else if($m=='12'){
        return "Dec";
    }
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