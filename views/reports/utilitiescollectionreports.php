<table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
    <tr>
        <td colspan="6" align="center"><h1 style="padding:0px;margin:0px;" >Lion Asset Management System</h1>
            Utilities Reports<br>
            <b><?php echo $report_title; ?></b><br>
            From: <?php echo $from; ?> To: <?php echo $to; ?>
        </td>		
    </tr>
   
    <tr>
        <td colspan="3" style="vertical-align:top;">

            <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
                <tr>
                    <td>Date</td>
                    <td>Shop</td>
                    <td>Electricity</td>
                    <td>Gas</td>
                    <td>Water</td>
                    <td>Service</td>
                    <td>Amount</td>
                </tr>
                <?php $itotal=0; $ie=0; $iw=0;$ig=0;$is=0;foreach($result as $in){ ?>
                <tr>
                    <td><?php echo $in->utility_date; ?></td>
                    <td><?php echo $in->shop; ?></td>
                    <td><?php echo $in->electrical;$ie=$ie+$in->electrical; ?></td>
                    <td><?php echo $in->gas; $ig=$ig+$in->gas;?></td>
                    <td><?php echo $in->water;$iw=$iw+$in->water; ?></td>
                    <td><?php echo $in->service;$is=$is+$in->service; ?></td>
                    <td><?php echo $amount=(($in->electrical)+($in->gas)+($in->water)+($in->service)); $itotal=$itotal+$amount; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><?php echo $ie; ?></td>
                    <td><?php echo $ig; ?></td>
                    <td><?php echo $iw; ?></td>
                    <td><?php echo $is; ?></td>
                    <td><?php echo $itotal; ?></td>
                </tr>
            </table>





        </td>
        

    </tr>

   
</table>
<?php //print_r($expanse); ?>