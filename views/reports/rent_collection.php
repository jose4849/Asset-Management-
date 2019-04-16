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
					<td>Complex</td>
                    <td>Shop No</td>                   
					<td>Month/Year</td>
                    <td>Amount</td>
                </tr>
				<?php $itotal=0; foreach($result as $res){ ?>
                <tr>
					<td><?php echo $res->invoice_id; ?></td>
					<td><?php echo $res->pay_date; ?></td>
					<td><?php echo $res->comx_name; ?></td>
					<td><?php echo $res->shop_name; ?></td>
					<td><?php echo $res->month; ?></td>
					<td><?php echo $amt=$res->amount;$itotal=$itotal+$amt; ?></td>
				</tr>
				<?php } ?>
				<tr>
                    <td>Item: <?php echo count($result); ?></td>
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