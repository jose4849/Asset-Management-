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
                    <h3 class="page-header"><i class="fa fa-laptop"></i>Final Report</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="fa fa-laptop"></i>Final Report</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->



                <div class="col-lg-12">
                    <section class="panel" style="padding:10px; min-height:200px;">
                       
                            <h1 style="text-align: center; font-weight: bold; margin: 0px;">Lion Asset Management</h1>
                            <h3 style="text-align: center; font-weight: bold; margin: 0px;">Final Report at Glance</h3><br><br>
                       <table border="1" style="background-color:#FFFFCC;border-collapse:collapse;border:1px solid #FFCC00;color:#000000;width:100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Cash in HAND</td>
                <td>Bank</td>               
 		<td>Due</td>
                <td>Income</td>
		<td>Expense</td>
                <td>Profit/Loss</td>
	</tr>
	<tr>
                <td><?php echo $cash_in_hand; ?></td>
                <td><?php echo $balance; ?></td>
                <td><?php echo $due; ?></td>
		<td><?php echo $income; ?></td>
		<td><?php echo $expense; ?></td>
		<td><?php echo $income-$expense; ?></td>
		
		
	</tr>
</table>



                    </section>
                </div>




                <!--------------------------------------------------------Content will be End From Here ----------------------------------->	
            </div><!--/.row-->


            <!-- project team & activity end -->

        </section>
    </section>
    <!--main content end-->
</section>

<?php echo $footer; ?>
