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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Expense category</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><i class="fa fa-laptop"></i>Add Expense category</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row col-lg-6">
			<!--------------------------------------------------------Content will be start From Here ----------------------------------->
			
			<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('expense_category', $attributes); ?>

<p>
        <label for="exp_category_name">Category Name <span class="required">*</span></label>
        <?php echo form_error('exp_category_name'); ?>
        <br /><input id="exp_category_name" type="text" class="form-control" name="exp_category_name" maxlength="255" value="<?php echo set_value('exp_category_name'); ?>"  />
</p>

<p>
        <label for="cat_description">Description <span class="required">*</span></label>
        <?php echo form_error('cat_description'); ?>
        <br /><input id="cat_description" type="text" class="form-control" name="cat_description" maxlength="255" value="<?php echo set_value('cat_description'); ?>"  />
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