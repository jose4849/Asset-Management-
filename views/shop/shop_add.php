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
                        <li><i class="fa fa-laptop"></i>Add Shop</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row col-lg-6">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->

                <?php
                // Change the css classes to suit your needs    

                $attributes = array('class' => '', 'id' => '');
                echo form_open('shop', $attributes);
                ?>

                <p>
                    <label for="company">Company</label>
                    <?php echo form_error('company'); ?>

                    <?php // Change the values in this array to populate your dropdown as required ?>


                    <br /><?php echo form_dropdown('company', $company, set_value('company'), 'class="form-control company"') ?>
                </p>                                             

                <p>
                    <label for="complex">Complex</label>
                    <?php echo form_error('complex'); ?>

                    <?php // Change the values in this array to populate your dropdown as required ?>
                    <br /><?php echo form_dropdown('complex', $complex, set_value('complex'), 'class="form-control complex"') ?>
                </p>                                             

                <p>
                    <label for="shop">Shop No.<span class="required">*</span></label>
                    <?php echo form_error('shop'); ?>
                    <br /><input id="shop" type="text" name="shop" class="form-control" maxlength="255" value="<?php echo set_value('shop'); ?>"  />
                </p>

                <p>
                    <label for="square_feet">Square feet</label>
                    <?php echo form_error('square_feet'); ?>
                    <br /><input id="square_feet" type="text" class="form-control" name="square_feet" maxlength="255" value="<?php echo set_value('square_feet'); ?>"  />
                </p>




                <p>
                    <label for="floor">Floor</label>
                    <?php echo form_error('floor'); ?>
                    <br />
                    
                    <select name="floor" class="form-control" required>
                        <option value="">Select Floor</option>
                        <option value="00">Ground Floor</option>
                        <option value="01">1st Floor</option>
                        <option value="02">2nd Floor</option>
                        <option value="03">3rd Floor</option>
                        <option value="04">4th Floor</option>
                        <option value="05">5th Floor</option>
                        <option value="06">6th Floor</option>
                        <option value="07">7th Floor</option>
                        <option value="08">8th Floor</option>
                        <option value="09">9th Floor</option>
                        <option value="10">10th Floor</option>
                        <option value="11">11th Floor</option>
                        <option value="12">12th Floor</option>
                        <option value="13">13th Floor</option>
                        <option value="14">14th Floor</option>
                        <option value="15">15th Floor</option>
                        <option value="16">16th Floor</option>
                        <option value="17">17th Floor</option>
                        <option value="18">18th Floor</option>
                        <option value="19">19th Floor</option>
                        <option value="20">20th Floor</option>
                        <option value="21">21th Floor</option>
                        <option value="22">22th Floor</option>
                        <option value="23">23th Floor</option>
                        <option value="24">24th Floor</option>
                        <option value="25">25th Floor</option>
                        <option value="-1">Ground-1 Floor</option>
                        <option value="-2">Ground-2 Floor</option>
                        
                    </select>
                </p>

                <p>
                    <label for="description">Description</label>
                    <?php echo form_error('description'); ?>
                    <br />

                    <?php echo form_textarea(array('name' => 'description', 'class' => 'form-control', 'rows' => '5', 'cols' => '80', 'value' => set_value('description'))) ?>
                </p>

                <p>
                    <?php echo form_submit('submit', 'Submit', "class='btn btn-danger'"); ?>
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
       
        
    });
    
    
         
            
          
</script>
<?php echo $footer; ?>