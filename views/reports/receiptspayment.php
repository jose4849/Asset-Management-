<table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="5" cellspacing="5">
    <tr>
        <td colspan="5" align="center"><h1>Lion Asset Management System</h1><br>
            Receipts and Payments Reports<br>
            From: <?php echo $from; ?> To: <?php echo $to; ?>
        </td>		
    </tr>
    <tr>
        <td>Date</td>
        <td>Opening</td>
        <td>Income</td>
        <td>Expense</td>
        <td>Closing</td>
    </tr>
    <?php $tin=0;$tex=0; foreach($resultarray as $res){ 
	if(($res['income']==0)&&($res['expense']==0)){}else{
	?>
    <tr>
        <td><?php echo $res['edate']; ?></td>
        <td><?php echo $opening; ?></td>
        <td><?php echo $in=$res['income']; $tin=$tin+$in; ?></td>
        <td><a href="<?php echo site_url(); ?>/expense/view?date=<?php echo $res['edate']; ?>"><?php echo $ex=$res['expense'];$tex=$tex+$ex;  ?></a></td>
        <td><?php echo $opening=$opening+$in-$ex; ?></td>
    </tr>
    <?php } } ?>
	    <tr>
        <td>Total</td>
        <td></td>
        <td><?php echo $tin; ?></td>
        <td><?php echo $tex; ?></td>
        <td></td>
    </tr>
</table>

<?php 
    var_dump($opening);
?>

<?php //print_r($expanse); ?>