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
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Complex</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="fa fa-laptop"></i>Add Complex</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row col-lg-6">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->

                <?php
                // Change the css classes to suit your needs    

                $attributes = array('class' => '', 'id' => '');
                echo form_open('complex', $attributes);
                ?>

                <p>
                    <label for="complex_name">Complex Name <span class="required">*</span></label>
                    <?php echo form_error('complex_name'); ?>
                    <br /><input id="complex_name" class="form-control" type="text" name="complex_name" maxlength="255" value="<?php echo set_value('complex_name'); ?>"  />
                </p>

                <p>
                    <label for="complex_address">Address <span class="required">*</span></label>
                    <?php echo form_error('complex_address'); ?>
                    <br />

                    <?php echo form_textarea(array('name' => 'complex_address', 'class' => 'form-control', 'rows' => '5', 'cols' => '80', 'value' => set_value('complex_address'))) ?>
                </p>
                <p>
                    <label for="complex_phone">Phone</label>
                    <?php echo form_error('complex_phone'); ?>
                    <br /><input id="complex_phone" class="form-control" type="text" name="complex_phone" maxlength="255" value="<?php echo set_value('complex_phone'); ?>"  />
                </p>

                <p>
                    <label for="complex_mobile">Mobile</label>
                    <?php echo form_error('complex_mobile'); ?>
                    <br /><input id="complex_mobile" class="form-control" type="text" name="complex_mobile" maxlength="255" value="<?php echo set_value('complex_mobile'); ?>"  />
                </p>

                <p>
                    <label for="fax">Fax</label>
                    <?php echo form_error('fax'); ?>
                    <br /><input id="fax" type="text" class="form-control" name="fax" maxlength="255" value="<?php echo set_value('fax'); ?>"  />
                </p>

                <p>
                    <label for="complex_email">Email</label>
                    <?php echo form_error('complex_email'); ?>
                    <br /><input id="complex_email" type="text" class="form-control" name="complex_email" maxlength="255" value="<?php echo set_value('complex_email'); ?>"  />
                </p>

                <p>
                    <label for="company_id">Company Name <span class="required">*</span></label>
                    
                    <?php echo form_error('company_id');
                   
                    ?>

                    <?php // Change the values in this array to populate your dropdown as required ?>
                   

                    <br /><?php echo form_dropdown('company_id', $options, set_value('company_id'), 'class="form-control"') ?>
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
<?php echo $footer; ?>