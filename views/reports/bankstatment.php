<table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
    <tr>
        <td colspan="6" align="center"><h1>Lion Asset Management System</h1><br>
            Rent collection Reports<br>
            <b>Bank Name:</b> <?php echo $bank_name; ?><br>
            <b>Branch Name:</b> <?php echo $branch_name; ?><br>
            <b>Account Number:</b> <?php echo $account_number; ?><br>
            <b>Current Balance:</b> <?php echo $balance; ?><br>
            From: <?php echo $from; ?> To: <?php echo $to; ?>
        </td>		
    </tr>
   
    <tr>
        <td colspan="3" style="vertical-align:top;">

            <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
                <tr>
                    <td>Date</td>
                    <td>Note</td>
                    <td>Debit</td>
                    <td>Credit</td>
                </tr>
                <?php $itotal=0;$dtotal=0; foreach($result as $in){ ?>
                <tr>
                    <td><?php echo $in->date; ?></td>
                    <td><?php echo $in->note; ?></td>
                    <td><?php echo $damount=$in->debit; $dtotal=$dtotal+$damount ?></td>
                    <td><?php echo $amount=$in->credit; $itotal=$itotal+$amount ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><?php echo $dtotal; ?></td>
                    <td><?php echo $itotal; ?></td>
                </tr>
            </table>





        </td>
        

    </tr>

   
</table>
<?php //print_r($expanse); ?>