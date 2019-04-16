<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct()
	 {
	   parent::__construct();
	 }

	function index()
	{
	   $this->load->helper(array('form'));
	   $this->load->view('login_view');
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
	public function fc(){

		for($i=1;$i<910;$i++){
				echo $i.'<br>';
			 file_get_contents("http://user.liongroupasset.com/login/invoice/$i");
		}
		
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