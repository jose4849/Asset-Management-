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
                        <li><i class="fa fa-laptop"></i>Edit Shop</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row col-lg-6">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->

                <?php
                // Change the css classes to suit your needs    

                $attributes = array('class' => '', 'id' => '');
                $id=$this->uri->segment(3);
                echo form_open("shop/update/$id", $attributes);
                ?>

                <p>
                    <label for="company">Company</label>
                    <?php echo form_error('company'); ?>

                    <?php // Change the values in this array to populate your dropdown as required ?>


                    <br /><?php echo form_dropdown('company', $company, $results[0]->company , 'class="form-control company"') ?>
                </p>                                             

                <p>
                    <label for="complex">Complex</label>
                    <?php echo form_error('complex'); ?>

                    <?php // Change the values in this array to populate your dropdown as required ?>
                    <br /><?php echo form_dropdown('complex', $complex, $results[0]->complex, 'class="form-control complex"') ?>
                </p>                                             

                <p>
                    <label for="shop">Shop <span class="required">*</span></label>
                    <?php echo form_error('shop'); ?>
                    <br /><input id="shop" type="text" name="shop" class="form-control" maxlength="255" value="<?php echo $results[0]->shop; ?>"  />
                </p>

                <p>
                    <label for="square_feet">Square feet</label>
                    <?php echo form_error('square_feet'); ?>
                    <br /><input id="square_feet" type="text" class="form-control" name="square_feet" maxlength="255" value="<?php echo $results[0]->square_feet; ?>"  />
                </p>




                <p>
                    <label for="floor">Floor</label>
                    <?php echo form_error('floor'); ?>
                    <br /><input id="floor" type="text" name="floor" class="form-control" maxlength="255" value="<?php echo $results[0]->floor; ?>"  />
                </p>

                <p>
                    <label for="description">Description</label>
                    <?php echo form_error('description'); ?>
                    <br />

                    <?php echo form_textarea(array('name' => 'description', 'class' => 'form-control', 'rows' => '5', 'cols' => '80', 'value' => $results[0]->description)) ?>
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