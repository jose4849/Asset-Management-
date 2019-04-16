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
			
			<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('bank', $attributes); ?>

<p>
        <label for="bank_name">Bank Name <span class="required">*</span></label>
        <?php echo form_error('bank_name'); ?>
        <br /><input id="bank_name" type="text" class="form-control company" name="bank_name" maxlength="255" value="<?php echo set_value('bank_name'); ?>"  />
</p>

<p>
        <label for="branch_name">Branch Name <span class="required">*</span></label>
        <?php echo form_error('branch_name'); ?>
        <br /><input id="branch_name" type="text" class="form-control company" name="branch_name"  value="<?php echo set_value('branch_name'); ?>"  />
</p>

<p>
        <label for="account_number">Account Number <span class="required">*</span></label>
        <?php echo form_error('account_number'); ?>
        <br /><input id="account_number" type="text" class="form-control company" name="account_number"  value="<?php echo set_value('account_number'); ?>"  />
</p>


<p>
        <?php echo form_submit( 'submit', 'Submit',"class='btn btn-danger'"); ?>
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