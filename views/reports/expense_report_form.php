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
                    <h3 class="page-header"><i class="fa fa-laptop"></i><?php echo $title; ?></h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="fa fa-laptop"></i>All <?php echo $title; ?></li>						  	
                    </ol>
                </div>
            </div>

            <div class="row">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->



                <div class="col-lg-12">
                    <section class="panel" style="padding:10px; min-height:200px;">
                        <header class="panel-heading">
Category Wise Day to Day Expense List
<b style="color:red;"><?php echo validation_errors(); ?></b>
                        </header>
                        <table border="0" >
                            <tr>
                                <td colspan="6"></td>
                            </tr>
<tr><td align="center">Company</td><td align="center">Complex</td><td align="center">Expense Head</td><td align="center">From</td><td align="center">To</td><td></td></tr>
                            <tr>
                            <form action="<?php echo base_url(); ?>reports/expensereports" method="POST" >
							<td>
							<?php echo form_dropdown('company_id', $company, set_value('company_id'), 'class="form-control company"') ?>
                            </td>
							<td>
							<select name="complex_id" class="form-control complex">
							<option value=''>Select Company First</option>
							</select>
							</td>
							<td>
							<?php echo form_dropdown('cat_id', $options, set_value('cat_id'), 'class="form-control cat_id"') ?>
							</td>                            														
                                <td>
                                    <input type='text' value='01-01-<?php echo date("Y"); ?>' name='fromdate' class='form-control bs_datepicker bsd_format2' />
                                </td>
                                <td>
                                    <input type='text' value='31-12-<?php echo date("Y"); ?>' name='todate' class='form-control bs_datepicker bsd_format2' />
                                </td>
                               								
                                <td>
                                    <select name="view_type" class="form-control">                                  
                                        <option value='pv'>Print</option>                                        
                                    </select>
                                </td>
                                <td><input style="width:100px" name='expanse'  type="submit"  class="form-control btn btn-danger"  value="Submit"  /></td>
                            </form>

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
<script>    
		$(document).ready(function() {
        /* for complex with company start */
        $(".company").change(function() {
		var company_id = $(".company").val();
		$.ajax({  
		type: "POST",
		url: "<?php echo base_url(); ?>shop/complex",
		data: {company_id: company_id}
		})
		.done(function(msg) {msg='<option value="all">All</option>'+msg; 
		$(".complex").html(msg);
		});
        });
        /* for complex with company start */ 
		});
		</script>
<?php echo $footer; ?>
