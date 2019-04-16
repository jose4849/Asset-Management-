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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Company</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><i class="fa fa-laptop"></i>Add Company</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row col-lg-6">
			<!--------------------------------------------------------Content will be start From Here ----------------------------------->
			
			<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('company', $attributes); ?>

<p>
        <label for="company_name">Company Name <span class="required">*</span></label>
        <?php echo form_error('company_names'); ?>
        <br /><input id="company_name" class="form-control" type="text" name="company_names" maxlength="255" value="<?php echo set_value('company_name'); ?>"  />
</p>

<p>
        <label for="short_name">Short Name <span class="required"></span></label>
        <?php echo form_error('short_name'); ?>
        <br /><input id="short_name" class="form-control" type="text" name="short_name" maxlength="255" value="<?php echo set_value('short_name'); ?>"  />
</p>

<p>
        <label for="owner_name">Owner Name <span class="required">*</span></label>
        <?php echo form_error('owner_name'); ?>
        <br /><input id="owner_name" class="form-control" type="text" name="owner_name" maxlength="255" value="<?php echo set_value('owner_name'); ?>"  />
</p>

<p>
        <label for="address">Address <span class="required">*</span></label>
	<?php echo form_error('address'); ?>
	<br />
							
	<?php echo form_textarea( array( 'name' => 'address', 'rows' => '5', 'class' => 'form-control','cols' => '80', 'value' => set_value('address') ) )?>
</p>
<p>
        <label for="phone">Phone <span class="required"></span></label>
        <?php echo form_error('phone'); ?>
        <br /><input id="phone" type="text" class="form-control" name="phone" maxlength="255" value="<?php echo set_value('phone'); ?>"  />
</p>

<p>
        <label for="mobile">Mobile <span class="required">*</span></label>
        <?php echo form_error('mobile'); ?>
        <br /><input id="mobile" type="text" class="form-control" name="mobile" maxlength="255" value="<?php echo set_value('mobile'); ?>"  />
</p>

<p>
        <label for="fax">Fax <span class="required"></span></label>
        <?php echo form_error('fax'); ?>
        <br /><input id="fax" type="text" class="form-control" name="fax" maxlength="255" value="<?php echo set_value('fax'); ?>"  />
</p>

<p>
        <label for="email">E-Mail <span class="required">*</span></label>
        <?php echo form_error('email'); ?>
        <br /><input id="email" type="text" class="form-control" name="email" maxlength="255" value="<?php echo set_value('email'); ?>"  />
</p>

<p>
        <label for="web">Web <span class="required">*</span></label>
        <?php echo form_error('web'); ?>
        <br /><input id="web" type="text" class="form-control" name="web" maxlength="255" value="<?php echo set_value('web'); ?>"  />
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