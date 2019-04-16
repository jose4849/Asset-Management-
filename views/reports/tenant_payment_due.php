<table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
    <tr>
        <td colspan="6" align="center"><h1 style="margin:0px;">Lion Asset Management System</h1>
            Complex Wise Tenant Payment (DUE)<br>
            <b>Complex Name:</b> <?php echo $complex_name; ?><br>
          
        </td>		
    </tr>
   
    <tr>
        <td colspan="3" style="vertical-align:top;">

            <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
                <tr>
                    <td>Shop No</td>
					<td style="width:100px;">Complex</td>
                    <td>Tenant Name</td>
                    <td>Address</td>
                    <td>Booking Date</td>
                    <td style="width:110px" >Tenant Mobile No</td>
                    <td>Due</td>
                    <td>Month</td>
                </tr>
                <?php $itotal=0; foreach($result as $in){
					
					
					
				if(($amount=$in->due)>0){
				?>
                <tr>
                    <td><?php echo $in->shop; ?></td>
					<td><?php echo   $string=$in->complex_name;
					
					?></td>
                    <td ><p ><?php echo $in->tenant_name; ?></p></td>
                    <td><?php echo $in->address; ?></td>
                    <td><?php echo $in->booking_date; ?></td>
                    <td><?php echo $in->tenant_mobile; ?></td>
                    <td><?php echo $amount=$in->due; $itotal=$itotal+$amount ?></td>
                    <td><?php echo $in->month; ?></td>
                </tr>
                <?php } } ?>
                <tr><td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total:</td>
                    <td><?php echo $itotal; ?></td>
                    <td></td>
                </tr>
            </table>





        </td>
        

    </tr>

   
</table>
<?php //print_r($expanse); ?>