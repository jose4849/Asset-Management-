<?php
//echo '<pre>';
//print_r($result);

?>

<table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
    <tr>
        <td colspan="6" align="center"><h1 style="margin:0px;">Lion Asset Management System</h1>
            Rent collection Reports<br>
            <?php echo $report_title; ?><br>
            From: <?php echo $from; ?> To: <?php echo $to; ?>
        </td>		
    </tr>
   
    <tr>
        <td colspan="3" style="vertical-align:top;">

            <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
                <tr>
                    <td>ID</td>
                    <td>Date</td>
                    <td>Bill ID</td>
					<td>Complex</td>
                    <td>Shop No</td>
                    
					<td>Month/Year</td>
                    <td>Amount</td>
                </tr>
                <?php 
				
$resulta = array();
foreach($result as $in){ 

	  if($resulta[$in->invoice_id]==null){  
		  $resulta[$in->invoice_id]['invoice_id']=$in->invoice_id;
		  $resulta[$in->invoice_id]['count']=0;
		  $resulta[$in->invoice_id]['date']='';
		  $resulta[$in->invoice_id]['bill_id']='';
		  $resulta[$in->invoice_id]['shop']='';
		  $resulta[$in->invoice_id]['complex']='';
		  $resulta[$in->invoice_id]['month']='';
		  $resulta[$in->invoice_id]['year']='';
		  $resulta[$in->invoice_id]['amount']=0;
		  $resulta[$in->invoice_id]['bill']='';
		  $resulta[$in->invoice_id]['amt']='';
		  $resulta[$in->invoice_id]['monthyear']='';
	  }
	  
	  
  $resulta[$in->invoice_id]['invoice_id']=$in->invoice_id;
  $resulta[$in->invoice_id]['count']=$resulta[$in->invoice_id]['count']+1;
  $resulta[$in->invoice_id]['date']=$in->date;
  $resulta[$in->invoice_id]['bill_id']=$in->bill_id;
  $resulta[$in->invoice_id]['bill']=$resulta[$in->invoice_id]['bill'].",".$in->bill_id;
  $resulta[$in->invoice_id]['amt']=$resulta[$in->invoice_id]['amount'].",".$in->amount;
  $resulta[$in->invoice_id]['shop']=$in->shop;
  $resulta[$in->invoice_id]['complex']=$in->complex;
  $resulta[$in->invoice_id]['month']=$in->month;
  $resulta[$in->invoice_id]['year']=$in->year;
  $resulta[$in->invoice_id]['monthyear'][]=$in->year.$in->month;
  $resulta[$in->invoice_id]['amount']=$resulta[$in->invoice_id]['amount'] + $in->amount;
}
//echo '<pre>';
//print_r($resulta);
//die();

ksort($resulta);

				
				
				$itotal=0; 
				foreach($resulta as $in){ 
				
				?>
                <tr>
                    <td><?php echo $in['invoice_id']; ?></td>
                    <td><?php echo $in['date']; ?></td>
                    <td ><?php 
					echo $in['bill_id'];
					//	echo "".$in['bill'];
					//	echo "".$in['amt'];
					?></td>
					<td><?php $complex_id=$in['complex']; if(isset($complexs[$complex_id])){ echo $complexs[$complex_id]; } ?></td>
                    <td><?php echo $in['shop']; ?></td>
					<td style="width:200px;overflow:hidden"  ><?php
					//echo $in['monthyear']; //echo getMonthString($in['month']); ?><?php //echo $in['year']; 
					//$pieces = explode(",",$in['monthyear']);
					$arr=$in['monthyear'];
					natcasesort($arr);
					foreach($arr as $va){
					$year=substr($va,0,4);
					$month=substr($va, 4, 2); 
					echo getMonthString($month)."/".$year." "; 
					}
					
					
					//print_r($arr);
					?></td>
                    <td><?php echo $amount=$in['amount']; $itotal=$itotal+$amount ?></td>
                </tr>
                <?php }  ?>
                <tr>
                    <td>Item: <?php echo count($resulta); ?></td>
                    <td></td>
                    <td></td>
					<td></td>
					<td></td>
                    <td>Total:</td>
                    <td><?php  echo $itotal; ?></td>
                </tr>
            </table>





        </td>
        

    </tr>

   
</table>
<?php //print_r($expanse);

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

 ?>