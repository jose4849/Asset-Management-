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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Users</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><i class="fa fa-laptop"></i>Add Users</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row col-lg-6">
			<!--------------------------------------------------------Content will be start From Here ----------------------------------->
			
			<?php // Change the css classes to suit your needs    

			$attributes = array('class' => '', 'id' => '');
			echo form_open('users', $attributes); ?>

			<p>
					<label for="user_full_name">Full Name <span class="required">*</span></label>
					<?php echo form_error('user_full_name'); ?>
					<br /><input id="user_full_name"  class="form-control" type="text" name="user_full_name" maxlength="255" value="<?php echo set_value('user_full_name'); ?>"  />
			</p>

			<p>
					<label for="user_email">Email <span class="required">*</span></label>
					<?php echo form_error('user_email'); ?>
					<br /><input id="user_email" type="text" class="form-control" name="user_email" maxlength="255" value="<?php echo set_value('user_email'); ?>"  />
			</p>

			<p>
					<label for="designation">Designation <span class="required">*</span></label>
					<?php echo form_error('designation'); ?>
					<br /><input id="designation" type="text" class="form-control" name="designation" maxlength="255" value="<?php echo set_value('designation'); ?>"  />
			</p>

			<p>
					<label for="user_address">Address <span class="required">*</span></label>
				<?php echo form_error('user_address'); ?>
				<br />
										
				<?php echo form_textarea( array( 'name' => 'user_address', 'rows' => '5', 'cols' => '80','class' => 'form-control', 'value' => set_value('user_address') ) )?>
			</p>
			<p>
					<label for="user_phone">Phone <span class="required">*</span></label>
					<?php echo form_error('user_phone'); ?>
					<br /><input id="user_phone" type="text" class="form-control" name="user_phone" maxlength="255" value="<?php echo set_value('user_phone'); ?>"  />
			</p>

			<p>
					<label for="password">Password <span class="required">*</span></label>
					<?php echo form_error('password'); ?>
					<br /><input id="password" type="password" class="form-control" name="password" maxlength="255" value="<?php echo set_value('password'); ?>"  />
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