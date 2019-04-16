<?php echo $header; ?>
<section id="container" class="">     
    <?php echo $topbar; ?>
    <?php echo $sidebar; ?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">            
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Shop</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="fa fa-laptop"></i>Booking Informations</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row col-lg-6">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->
<?php
//echo '<pre>';
//print_r($result);
?>
                <table border="1" style="background-color:FFFFCC;border-collapse:collapse;border:1px solid FFCC00;color:000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Transection ID</td>
		<td><?php echo $result[0]->trans_id; ?></td>
	</tr>
	<tr>
		<td>Bank/Branch</td>
		<td>
                    <?php echo $result[0]->bank_name; ?><br>
                    <?php echo $result[0]->branch_name; ?><br>
                </td>
	</tr>
	<tr>
		<td>Account Number</td>
		<td>
                    <?php echo $result[0]->account_number; ?><br>
                    
                </td>
	</tr>
	<tr>
		<td>Amount</td>
		<td>
                    <?php echo $result[0]->trans_type; ?>: <?php echo $result[0]->amount; ?><br>                  
                </td>
	</tr>
	

</table>

                
                
                <!--------------------------------------------------------Content will be End From Here ----------------------------------->	
            </div><!--/.row--			
            <!-- project team & activity end -->

        </section>
    </section>
    <!--main content end-->
</section>

<?php echo $footer; ?>