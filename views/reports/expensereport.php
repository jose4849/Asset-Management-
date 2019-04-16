<table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
    <tr>
        <td colspan="6" align="center"><h1>Lion Asset Management System</h1><br>
            Expense Reports<br>          
            <?php echo $report_title; ?>
            From: <?php echo $from; ?> To: <?php echo $to; ?>
        </td>		
    </tr>
   
    <tr>
        <td colspan="3" style="vertical-align:top;">

            <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
                <tr>
                    <td>Date</td>
                    <td>Category</td>
                    <td>Name</td>
                    <td>Amount</td>
                </tr>
                <?php $itotal=0; foreach($result as $in){ ?>
                <tr>
                    <td><?php echo $in->dateofexpense; ?></td>
                    <td><?php echo $in->exp_category_name; ?></td>
                    <td><?php echo $in->expense_name; ?></td>
                    <td><?php echo $amount=$in->amount; $itotal=$itotal+$amount ?></td>
                </tr>
                <?php } ?>
                <tr>
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