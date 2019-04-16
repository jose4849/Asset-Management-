<html>
<head>
<title>Memo</title>
<style>
body{font-family:arial;font-size:13px;border:0px solid red;}
td{font-size:14px;line-height:28px;}
b{font-size:14px;}



</style>
</head>
<body>
<?php
    $ymstring='';
	natcasesort($yamo);
	//print_r($yamo);
	
	foreach($yamo as $va){
	$year=substr($va,0,4);
	$month=substr($va, 4, 2); 
	$ymstring=$ymstring.getMonthString($month)."/".$year." "; 
	}
?>
<table border="0" width="100%" class="page" >
	<tr>
		<td colspan="2" style="text-align: left;" ><b>Memo No: <?php echo $result[0]->invoice_id; ?></b></td>
		<td colspan="2" style="text-align: center;" >
		<h2>Money Receipts</h2>
		<?php echo $result[0]->note; ?>
		</td>
		<td colspan="2" style="text-align: right;"><b>Date:</b><?php echo $result[0]->pay_date; ?></td>
		
	</tr>
        <tr>
            <td colspan="3">
                <b>Complex Name:</b> <?php echo $complex_name; ?><br>
            </td>
            <td colspan="3">
                <b>Address:</b> <?php echo $complex_address; ?><br>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <b>Flat/shop:</b> <?php echo $shop; ?>
            </td>
            <td colspan="3">
                <b>Room/Flat Area(sft):</b> <?php echo $square_feet; ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
               <b> Land Lord:</b> Mirza Abdul Khaleque of 47, Sayed Awlad Hossain Lane, Islampur,Dhaka -1211
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <b>Ordinary Monthly Ejectable Tenant Name :</b> <?php echo $result[0]->tenant_name; ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <b>Father/Husband/Proprietor Name :</b> <?php echo $result[0]->father_hasband; ?><br>
                <b>Address:</b> <?php echo $result[0]->address; ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <b>For Invoice/Month :</b> <?php echo $ymstring;
 //echo $monthyear; ?><br>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <b>Total Due Amount :</b><?php  echo $due; ?>.00 TK<br>
            </td>
            <td colspan="3">
                <b>Total Pay Amount :</b> <?php echo $result[0]->amount; ?>.00 TK<br>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <b>Net Receive : </b><?php echo $result[0]->amount; ?>.00 , <a style="text-transform:uppercase;"><?php  echo $inword; ?> Only</a><br>
            </td>
            
        </tr>
        <tr>
<td colspan="6">
<b>Electricity: </b><?php echo $result[0]->electrical; ?>&nbsp;&nbsp;TK&nbsp;&nbsp;
<b>Water : </b><?php echo $result[0]->water; ?>&nbsp;&nbsp;TK&nbsp;&nbsp;
<b>GAS : </b><?php echo $result[0]->gas; ?>&nbsp;&nbsp;TK&nbsp;&nbsp;
<b>Service: </b><?php echo $result[0]->service; ?>&nbsp;&nbsp;TK&nbsp;&nbsp;
</td>
</tr>
<tr >
<td colspan="6" >
<p>&nbsp;</p>
</td>
</tr>

	<tr>
		<td colspan="2" style="text-align: left;font-style: italic;">
<div style="text-align: left; height: 14px; margin-top: 40px; padding-left: 0px;"><?php echo $result[0]->user_full_name; ?></div>
<a style=" text-decoration: overline;">Name &amp; Signature of Rent collector</a>
		
		<br><br></td>
		<td colspan="2" style="text-align: center;font-style: italic;"><br><br><a style=" text-decoration: overline;">Signature of Tenant</a><br><br></td>
		<td colspan="2" style="text-align: right;font-style: italic;"><br><br><a style=" text-decoration: overline;">Signature of Land Lord</a><br><br></td>	
	</tr>
	
</table>
</body>
</html>

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