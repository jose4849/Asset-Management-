<table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
                                            <tbody>


                                                <tr>
                                                    <th>Bill ID</th>
                                                    <th>Shop Info</th>
                                                    <th>Year/Month</th>
                                                    <th>Amount</th>
                                                    <th>Generate Date</th>
                                                    <th>Status</th>

                                                </tr>
                                                <?php foreach ($billing_history as $bill) { ?>
                                                    <tr>
                                                        <td><?php echo $bill->bill_id; ?></td>
                                                        <td><?php echo $bill->complex_name."(".$bill->shop.")"; ?></td>
                                                        <td><?php echo $bill->year; ?>/<?php echo getMonthNumber($bill->month); ?></td>

                                                        <td><?php echo $bill->amount; ?></td>
                                                        <td><?php echo $bill->date; ?></td>
                                                        <td><?php
                                                            $bill_status = $bill->bill_status;
                                                            if ($bill_status == 1) {
                                                                echo 'Paid';
																 
                                                            } else {
                                                                echo '<a style="color:red;">Unpaid</a>';
																?>
																<a href="#" onclick="removebill('<?php echo $bill->bill_id; ?>')" class="btn btn-danger"><i class="icon_close_alt2"></i></a>
																<?php
                                                            }
                                                            ?></td>


                                                    </tr>
                                                <?php } ?>


                                            </tbody>
                                        </table>                                       
<?php

function getMonthNumber($monthStr) {
$m = trim($monthStr);
switch ($m) {
    case "01":
        $m = "Jan";
        break;
    case "02":
        $m = "Feb";
        break;
    case "03":
        $m = "Mar";
        break;
    case "04":
        $m = "Apr";
        break;
    case "05":
        $m = "May";
        break;
    case "06":
        $m = "Jun";
        break;
    case "07":
        $m = "Jul";
        break;
    case "08":
        $m = "Aug";
        break;
    case "09":
        $m = "Sep";
        break;
    case "10":
        $m = "Oct";
        break;
    case "11":
        $m = "Nov";
        break;
    case "12":
        $m = "Dec";
        break;
    default:
        break;
}
return $m;
}

?>