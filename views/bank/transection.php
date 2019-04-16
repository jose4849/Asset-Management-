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
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Bank</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="fa fa-laptop"></i>Add Bank</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row col-lg-6">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->

                <?php
                // Change the css classes to suit your needs    

                $attributes = array('class' => '', 'id' => '');
                echo form_open('bank/transctionsave', $attributes);
                ?>

                <p>
                    <label for="bank_name">Bank / Branch <span class="required">*</span></label>

                    <br /><?php echo form_dropdown('bank_id', $options, set_value('company'), 'class="form-control company"') ?>
                </p>

                <p>
                    <select class="form-control company" name="trans_type">
                        <option value="credit">Credit ( Deposit )</option>
                        <option value="debit">Debit ( Withdraw )</option>
                    </select>
                </p>

                <p>
                    <label for="amount">Amount<span class="required">*</span></label>
                    <?php echo form_error('amount'); ?>
                    <br /><input id="amount" type="text" class="form-control company" name="amount"  value="0"  />
                </p>
                <p>
                    <label for="note">Note<span class="required">*</span></label>
                    <?php echo form_error('note'); ?>
                    <br /><input id="note" type="text" class="form-control company" name="note"  value="No note yet"  />
                </p>
                <p>
                    <label for="date">Date<span class="required">*</span></label>
                    <?php echo form_error('date'); ?>
                    <br /><input id="date" type="text" class="form-control company  bs_datepicker bsd_format2" name="date"  value="<?php echo date('d-m-Y') ?>"  />
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