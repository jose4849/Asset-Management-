<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        $this->load->view('welcome_message');
    }

    public function reset2() {
        $this->db->trans_start();
        $this->db->truncate('bank');
        $this->db->truncate('bank_trans_history');
        $this->db->truncate('booking');
        $this->db->truncate('companies');
        $this->db->truncate('complex');
        $this->db->truncate('employee');
        $this->db->truncate('employee_bill_history');
        $this->db->truncate('expanse');
        $this->db->truncate('expansecategory');
        $this->db->truncate('monthly_bill');
        $this->db->truncate('setting_account');
        $this->db->truncate('shop');
        $this->db->truncate('tenant');
        $this->db->truncate('tenant_invoice');
        $this->db->truncate('users');

        $this->db->query("INSERT INTO `setting_account` (`id`, `attribute`, `amount`)
                              VALUES (1, 'cash_in_hand', 0)");
        $this->db->query("
            INSERT INTO `users` (`id`,`user_level`, `username`, `user_full_name`, `user_email`,
            `designation`, `user_address`, `user_phone`, `password`, `login`, `user_status`,
            `create_date`) VALUES (1,1, 'admin', 'Administration', 'admin@example.com', 'Admin',
            'Admin default address', '+880 121 121 121
            ', '1', '0', '0', CURRENT_TIMESTAMP);   
            ");

        $this->db->query("
            INSERT INTO `companies` (`id`, `company_names`, `short_name`,
            `owner_name`, `address`, `phone`, `mobile`, `fax`, `email`, `web`, `login`, 
            `created_date`) VALUES (NULL, 'Lion Group Ltd', 'LGL', 'Khalaque', 'Lion Group,
            Corporate Office: 126-131 Manipuripara, Tejgaon, Dhaka - 1215, Bangladesh',
            '+8802X00000', '+880171X000000', '+8802X00000', 'lam@example.com', 'www.example.com', 
            '1', CURRENT_TIMESTAMP);    
            ");
        $this->db->query("
         INSERT INTO `complex` (`complex_id`, `complex_name`, `complex_address`, `complex_phone`, `complex_mobile`, `fax`, `complex_email`, `company_id`, `login`, `create_date`) VALUES (NULL, 'Lion Group Ltd', 'Tejgaon, Dhaka - 1215, Bangladesh', '+8802X00000', '+880171X000000', '+8802X00000', 'lam@example.com', '1', '1', CURRENT_TIMESTAMP);   
        ");
        $this->db->query("
        INSERT INTO `expansecategory` (`cat_id`, `exp_category_name`, `cat_description`) VALUES (1, 'salary', 'salary'); 
        ");
        $this->db->trans_complete();
        echo "Successfullly Reset Thanks";
    }
    public function reset() {
        $this->db->trans_start();
        $this->db->truncate('bank');
        $this->db->truncate('bank_trans_history');
        $this->db->truncate('booking');
        $this->db->truncate('companies');
        $this->db->truncate('complex');
        $this->db->truncate('employee');
        $this->db->truncate('employee_bill_history');
        $this->db->truncate('expanse');
        $this->db->truncate('expansecategory');
        $this->db->truncate('monthly_bill');
        $this->db->truncate('setting_account');
        $this->db->truncate('shop');
        $this->db->truncate('tenant');
        $this->db->truncate('tenant_invoice');
        $this->db->truncate('users');

        $this->db->query("INSERT INTO `setting_account` (`id`, `attribute`, `amount`)
                              VALUES (1, 'cash_in_hand', 0)");
        $this->db->query("
            INSERT INTO `users` (`id`,`user_level`, `username`, `user_full_name`, `user_email`,
            `designation`, `user_address`, `user_phone`, `password`, `login`, `user_status`,
            `create_date`) VALUES (1,1, 'admin', 'Administration', 'admin@example.com', 'Admin',
            'Admin default address', '+880 121 121 121
            ', '1', '0', '0', CURRENT_TIMESTAMP);   
            ");

        
        $this->db->trans_complete();
        echo "Successfullly Reset Thanks";
    }

}
