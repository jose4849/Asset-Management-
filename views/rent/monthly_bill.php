<table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
    <tr>
        <td colspan="6" align="center"><h1>Lion Asset Management System</h1>
           <?php echo ADDRESS; ?>
        </td>		
    </tr>
   
    <tr>
        <td colspan="3" style="vertical-align:top;">

            <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
                <tr>
                    <td>Date</td>
                     <td>Tenant name</td>
                    <td>Complex</td>
                    <td>Shop ID/Shop Number</td>
                   
                    <td>Month/Year</td>
                    <td>Amount</td>
                </tr>
                <?php $itotal=0; foreach($result as $in){ ?>
                <tr>
                    <td><?php echo $in->date; ?></td>
                    <td><?php echo $in->complex_name; ?></td>
                    <td><?php echo $in->tenant_name; ?></td>
                    <td><?php echo $in->shop_id; ?>/<?php echo $in->shop; ?></td>
                    <td><?php echo $in->month; ?>/<?php echo $in->year; ?></td>
                    <td><?php echo $amount=$in->amount; $itotal=$itotal+$amount ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td><?php echo $itotal; ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php //print_r($expanse); ?>