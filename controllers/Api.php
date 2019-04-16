<?php
class Api extends CI_Controller {



public function jose() {
		
		
		
		$dataarray=array(
		'company'=>6,		
		'complex'=>16,
		'year'=>2015,
		'month'=>02
		);
		
        $company = $dataarray['company'];
            
        $complex = $dataarray['complex'];
        if($complex==''){ echo 'Select Complex..'; die();}
        $year = $dataarray['year'];
        $month = $dataarray['month'];
        $date = new DateTime();
        $group_invoice_id=$date->getTimestamp();
       
        // ---------------------------------------------------------
        $results = $this->db->query("select * from shop join booking ON shop.booking_id = booking.booking_id where complex = $complex AND bookstatus = 1");
        $result = $results->result();
       //main transection 
        foreach ($result as $res) {
                $shop=$res->shop_id;
                $data = array(
                    'shop_id' => $shop,
                    'year' => $year,
                    'month' => $month,
                    'group_invoice_id'=>$group_invoice_id,
                    'amount' => $res->totalrent,
                    'tenant_id' => $res->b_tenant_id
                   
                );

                $insert_query = $this->db->insert_string('monthly_bill', $data);
                $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
                $this->db->query($insert_query);
        }
            // main transection 
		
		echo time();
    }
    


}