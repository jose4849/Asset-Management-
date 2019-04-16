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
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Tenant</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="fa fa-laptop"></i>Add Tenant</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row col-lg-6">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->

                <?php
                // Change the css classes to suit your needs    

                $attributes = array('class' => '', 'id' => '');
                echo form_open('tenant', $attributes);
                ?>

                <p>
                    <label for="tenant_name">Tenant Name <span class="required">*</span></label>
                    <?php echo form_error('tenant_name'); ?>
                    <br /><input id="tenant_name" class="form-control" type="text" name="tenant_name" maxlength="255" value="<?php echo set_value('tenant_name'); ?>"  />
                </p>

                <p>
                    <label for="father_hasband">Father/Hasband <span class="required">*</span></label>
                    <?php echo form_error('father_hasband'); ?>
                    <br /><input id="father_hasband" class="form-control" type="text" name="father_hasband" maxlength="255" value="<?php echo set_value('father_hasband'); ?>"  />
                </p>

                <p>
                    <label for="mother_name">Mother Name <span class="required">*</span></label>
                    <?php echo form_error('mother_name'); ?>
                    <br /><input id="mother_name" class="form-control" type="text" name="mother_name" maxlength="255" value="<?php echo set_value('mother_name'); ?>"  />
                </p>
                <p>
                    <label for="tenant_created_date">Date</label>
                    <?php echo form_error('tenant_created_date'); ?>
                    <br />
                    <!-- <input id="tenant_created_date" class="form-control" type="text" name="tenant_created_date" maxlength="255" value="<?php echo set_value('tenant_created_date'); ?>"  />-->

                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                    <input  class="form-control"  type="text" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
                    <span class="add-on"><i class="icon-th"></i></span>
                </div>
                <input required type="hidden" name="tenant_created_date" id="dtp_input2" value="<?php echo date('d-m-Y') ?>" /><br/>



                </p>
                <p>
                    <label for="proprietor_name">Proprietor Name <span class="required"></span></label>
                    <?php echo form_error('proprietor_name'); ?>
                    <br /><input id="proprietor_name" class="form-control" type="text" name="proprietor_name" maxlength="255" value="<?php echo set_value('proprietor_name'); ?>"  />
                </p>

                <p>
                    <label for="address">Address <span class="required">*</span></label>
                    <?php echo form_error('address'); ?>
                    <br />

                    <?php echo form_textarea(array('name' => 'address', 'class' => 'form-control', 'rows' => '5', 'cols' => '80', 'value' => set_value('address'))) ?>
                </p>
                <p>
                    <label for="tenant_phone">Phone</label>
                    <?php echo form_error('tenant_phone'); ?>
                    <br /><input id="tenant_phone" class="form-control" type="text" name="tenant_phone" maxlength="255" value="<?php echo set_value('tenant_phone'); ?>"  />
                </p>

                <p>
                    <label for="tenant_mobile">Mobile</label>
                    <?php echo form_error('tenant_mobile'); ?>
                    <br /><input id="tenant_mobile" class="form-control" type="text" name="tenant_mobile" maxlength="255" value="<?php echo set_value('tenant_mobile'); ?>"  />
                </p>

                <p>
                    <label for="tenant_fax">Fax</label>
                    <?php echo form_error('tenant_fax'); ?>
                    <br /><input id="tenant_fax" class="form-control" type="text" name="tenant_fax" maxlength="255" value="<?php echo set_value('tenant_fax'); ?>"  />
                </p>

                <p>
                    <label for="tenant_web">Web</label>
                    <?php echo form_error('tenant_web'); ?>
                    <br /><input id="tenant_web" class="form-control" type="text" name="tenant_web" maxlength="255" value="<?php echo set_value('tenant_web'); ?>"  />
                </p>



                <p>
                    <label for="tenant_status">Status <span class="required">*</span></label>
                    <?php echo form_error('tenant_status'); ?>
                    <br />
                    <?php // Change or Add the radio values/labels/css classes to suit your needs  ?>
                    <input id="tenant_status" name="tenant_status" type="radio" class="" value="1" <?php echo $this->form_validation->set_radio('tenant_status', '1'); ?> />
                    <label for="tenant_status" class="">Active</label>

                    <input id="tenant_status" name="tenant_status" type="radio" class="" value="0" <?php echo $this->form_validation->set_radio('tenant_status', '0'); ?> />
                    <label for="tenant_status" class="">Inactive</label>
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