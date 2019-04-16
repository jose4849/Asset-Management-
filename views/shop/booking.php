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
                        <li><i class="fa fa-laptop"></i>Booking</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row col-lg-6">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->
<?php //echo validation_errors(); ?>

                <?php
                // Change the css classes to suit your needs    

                $attributes = array('class' => '', 'id' => '');
                echo form_open('shop/booking_insert', $attributes);
                ?>

                <p>
                    <label for="company">Company</label>
                    <?php echo form_error('b_company_id'); ?>

                    <?php // Change the values in this array to populate your dropdown as required ?>


                    <br /><?php echo form_dropdown('b_company_id', $company, set_value('b_company_id'), 'class="form-control company"') ?>
                </p>                                             

                <p>
                    <label for="complex">Complex</label>
                    <?php echo form_error('b_complex_id'); ?>

                    <?php // Change the values in this array to populate your dropdown as required ?>
                    <br /><?php echo form_dropdown('b_complex_id', $complex, set_value('b_complex_id'), 'class="form-control complex"') ?>
                </p>                                             
                <p>
                    <label for="complex">Shop Number</label>
                    <?php echo form_error('b_shop_id'); ?>

                    <?php // Change the values in this array to populate your dropdown as required ?>
                    <br /><?php echo form_dropdown('b_shop_id', $shop, '', 'class="form-control shop"') ?>
                </p>                                             

                <p>
                    <label for="shop">Tenant ID <span class="required">*</span></label>
                    <?php echo form_error('b_tenant_id'); ?>
                    <br /><?php echo form_dropdown('b_tenant_id', $tenant, set_value('b_tenant_id'), 'class="form-control"') ?>
                </p>

                <p style="display:none">
                    <label for="shop">Proprietor<span class="required">*</span></label>
                    <?php echo form_error('proprietor'); ?>
                    <br /><input id="shop" type="text" name="proprietor" value="none" class="form-control" maxlength="255" value="<?php echo set_value('proprietor'); ?>"  />
                </p>
                <p style="display:none">
                    <label for="b_address">Address</label>
                    <?php echo form_error('b_address'); ?>
                    <br />

                    <?php echo form_textarea(array('name' => 'b_address', 'class' => 'form-control', 'rows' => '5', 'cols' => '80', 'value' => set_value('b_address'))) ?>
                </p>
                
                
                

                <p>
                    <label for="floor">Booking Date</label>
                    
                    
                    
                    
                    
         
         <?php echo form_error('booking_date'); ?>
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input  class="form-control"  type="text" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
                <input required type="hidden" name="booking_date" id="dtp_input2" value="<?php echo date('d-m-Y') ?>" /><br/>
           
           
                    
                    
                    
            <!--                    
            <?php echo form_error('booking_date'); ?>
                                <br /><input id="booking_date" type="text" name="booking_date" class="form-control" maxlength="255" value="<?php echo set_value('booking_date'); ?>"  />-->
                </p>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <p>
                    <label for="rant">Rent (per feet)</label>
                    <?php echo form_error('rent'); ?>
                    <br /><input id="rant" required type="text" class="form-control" name="rent" maxlength="255" value="<?php echo set_value('rant'); ?>"  />
                </p>
                <p>
                    <label for="totalrent">Total Rent</label>
                    <?php echo form_error('totalrent'); ?>
                    <br /><input id="totalrent" required type="text" class="form-control" name="totalrent" maxlength="255" value="<?php echo set_value('totalrent'); ?>"  />
                </p>
                <p>
                    <label for="security_money">Security Money</label>
                    <?php echo form_error('security_money'); ?>
                    <br /><input id="square_feet" required type="text" class="form-control" name="security_money" maxlength="255" value="<?php echo set_value('security_money'); ?>"  />
                </p>
                <p>
                    <label for="advance_money">Advance Money</label>
                    <?php echo form_error('advance_money'); ?>
                    <br /><input id="advance_money" required type="text" class="form-control" name="advance_money" maxlength="255" value="<?php echo set_value('advance_money'); ?>"  />
                </p>
                <p>
                    <label for="advance_refund">Advance Refund</label>
                    <?php echo form_error('advance_refund'); ?>
                    <br /><input id="square_feet" required type="text" class="form-control" name="advance_refund" maxlength="255" value="<?php echo set_value('advance_refund'); ?>"  />
                </p>






                <p>
                    <?php echo form_submit('', 'Booked', "class='btn btn-danger'"); ?>
                </p>

                <?php echo form_close(); ?>

                <!--------------------------------------------------------Content will be End From Here ----------------------------------->	
            </div><!--/.row--			
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
                    .done(function(msg) {
                $(".complex").html(msg);
            });
        });
        /* for complex with company start */

        /* for complex with company start */
        $(".complex").change(function() {
            var complex_id = $(".complex").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>shop/shop_id",
                data: {complex_id: complex_id}
            })
                    .done(function(msg) {
                $(".shop").html(msg);
            });
        });
        /* for complex with company start */
    });
</script>
<?php echo $footer; ?>