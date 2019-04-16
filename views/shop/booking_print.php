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
		<td>Booking ID</td>
		<td><?php echo $result[0]->booking_id; ?></td>
	</tr>
	<tr>
		<td>Complex Name</td>
		<td><?php echo $result[0]->complex_name; ?></td>
	</tr>
	<tr>
		<td>Owner Name</td>
		<td><?php echo $result[0]->owner_name; ?></td>
	</tr>
	<tr>
		<td>Shop Number</td>
		<td><?php echo $result[0]->shop; ?></td>
	</tr>
	<tr>
		<td>Proprietor</td>
		<td><?php echo $result[0]->tenant_name; ?></td>
	</tr>
	<tr>
		<td>Shop Address</td>
		<td><?php echo $result[0]->complex_address; ?></td>
	</tr>
	<tr>
		<td>Total rent</td>
		<td><?php echo $result[0]->totalrent; ?></td>
	</tr>
	<tr>
		<td>Security Money</td>
		<td><?php echo $result[0]->security_money; ?></td>
	</tr>
	<tr>
		<td>Advance Money</td>
		<td><?php echo $result[0]->advance_money; ?></td>
	</tr>
	<tr>
		<td>Booking Date</td>
		<td><?php echo $result[0]->booking_date; ?></td>
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