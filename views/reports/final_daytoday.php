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

                        </header>
                        <table border="0" >
                            <tr>
                                <td colspan="2">Day to Day Final reports List</td>
                            </tr>

                            <tr>
                            <form action="<?php echo base_url(); ?>reports/final_generate" method="POST" >
                                <td>
                                    <input type='text' value='<?php echo date("Y"); ?>-01-01' name='fromdate' class='form-control bs_datepicker bsd_format1' />
                                </td>
                                <td>
                                    <input type='text' value='<?php echo date("Y"); ?>-12-31' name='todate' class='form-control bs_datepicker bsd_format1' />
                                </td>
                                <td>
                                    <select name="type" class="form-control">
                                        <option value="0" >Payment and Receipts</option>
                                    </select>
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

<?php echo $footer; ?>
