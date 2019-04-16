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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Employee</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><i class="fa fa-laptop"></i>Add Employee</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row col-lg-6">
			<!--------------------------------------------------------Content will be start From Here ----------------------------------->
			
			<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
$id=$this->uri->segment(3);
echo form_open("employee/update/$id", $attributes); ?>

<p>
        <label for="employee_name">Employee Name <span class="required">*</span></label>
        <?php echo form_error('employee_name'); ?>
        <br /><input id="employee_name" class="form-control" type="text" name="employee_name" maxlength="255" value="<?php echo set_value('employee_name',$results[0]->employee_name); ?>"  />
</p>

<p>
        <label for="father_name">Father Name <span class="required">*</span></label>
        <?php echo form_error('father_name'); ?>
        <br /><input id="father_name" class="form-control" type="text" name="father_name" maxlength="255" value="<?php echo set_value('father_name',$results[0]->father_name); ?>"  />
</p>

<p>
        <label for="emp_husband_name">Husband Name</label>
        <?php echo form_error('emp_husband_name'); ?>
        <br /><input id="emp_husband_name" class="form-control" type="text" name="emp_husband_name" maxlength="255" value="<?php echo set_value('emp_husband_name',$results[0]->emp_husband_name); ?>"  />
</p>

<p>
        <label for="emp_mother_name">Mother Name <span class="required">*</span></label>
        <?php echo form_error('emp_mother_name'); ?>
        <br /><input id="emp_mother_name" class="form-control" type="text" name="emp_mother_name" maxlength="255" value="<?php echo set_value('emp_mother_name',$results[0]->emp_mother_name); ?>"  />
</p>

<p>
        <label for="date_of_birth">Date of Birth <span class="required">*</span></label>
        <?php echo form_error('date_of_birth'); ?>
        <br /><input id="date_of_birth" class="form-control" type="text" name="date_of_birth" maxlength="255" value="<?php echo set_value('date_of_birth',$results[0]->date_of_birth); ?>"  />
</p>

<p>
        <label for="nationality">Nationality <span class="required">*</span></label>
        <?php echo form_error('nationality'); ?>
        <br /><input id="nationality" class="form-control" type="text" name="nationality" maxlength="255" value="<?php echo set_value('nationality',$results[0]->nationality); ?>"  />
</p>

<p>
        <label for="blood_group">Blood group</label>
        <?php echo form_error('blood_group'); ?>
        <br /><input id="blood_group" class="form-control" type="text" name="blood_group" maxlength="255" value="<?php echo set_value('blood_group',$results[0]->blood_group); ?>"  />
</p>

<p>
        <label for="marital_status">Marital Status</label>
        <?php echo form_error('marital_status'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = array(
                                                  ''  => 'Please Select',
                                                  'maried'    => 'Maried',
                                                  'unmaried'    => 'Unmaried'
                                                ); 
        
        ?>

        <br /><?php echo form_dropdown('marital_status', $options, set_value('marital_status',$results[0]->marital_status),'class="form-control"')?>
</p>                                             
                        
<p>
        <label for="qualification">Qualification <span class="required">*</span></label>
        <?php echo form_error('qualification'); ?>
        <br /><input id="qualification" class="form-control" type="text" name="qualification" maxlength="255" value="<?php echo set_value('qualification',$results[0]->qualification); ?>"  />
</p>

<p>
        <label for="designation">Designation <span class="required">*</span></label>
        <?php echo form_error('designation'); ?>
        <br /><input id="designation" class="form-control" type="text" name="designation" maxlength="255" value="<?php echo set_value('designation',$results[0]->designation); ?>"  />
</p>

<p>
        <label for="job_status">Job Status <span class="required">*</span></label>
        <?php echo form_error('job_status');
        
        ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = array(
                                                  ''  => 'Please Select',
                                                  'active'    => 'Active',
                                                  'inactive'    => 'Inactive'
                                                ); ?>

        <br /><?php echo form_dropdown('job_status', $options, set_value('job_status',$results[0]->job_status),'class="form-control"')?>
</p>                                             
                        
<p>
        <label for="salary">Salary <span class="required">*</span></label>
        <?php echo form_error('salary'); ?>
        <br /><input id="salary" class="form-control" type="text" name="salary" maxlength="21" value="<?php echo set_value('salary',$results[0]->salary); ?>"  />
</p>

<p>
        <label for="contact_number">Contact Number <span class="required">*</span></label>
        <?php echo form_error('contact_number'); ?>
        <br /><input id="contact_number" class="form-control" type="text" name="contact_number" maxlength="255" value="<?php echo set_value('contact_number',$results[0]->contact_number); ?>"  />
</p>

<p>
        <label for="emp_email">Email</label>
        <?php echo form_error('emp_email'); ?>
        <br /><input id="emp_email" class="form-control" type="text" name="emp_email"  value="<?php echo set_value('emp_email',$results[0]->emp_email); ?>"  />
</p>

<p>
        <label for="joining_date">Joining Date <span class="required">*</span></label>
        <?php echo form_error('joining_date'); ?>
        <br /><input id="joining_date" class="form-control" type="text" name="joining_date" maxlength="255" value="<?php echo set_value('joining_date',$results[0]->joining_date); ?>"  />
</p>

<p>
        <label for="present_address">Present Address <span class="required">*</span></label>
	<?php echo form_error('present_address'); ?>
	<br />
							
	<?php echo form_textarea( array( 'name' => 'present_address','class' => 'form-control', 'rows' => '5', 'cols' => '80', 'value' => set_value('present_address',$results[0]->present_address) ) )?>
</p>
<p>
        <label for="permanent_address">Permanent  Address <span class="required">*</span></label>
	<?php echo form_error('permanent_address'); ?>
	<br />
							
	<?php echo form_textarea( array( 'name' => 'permanent_address','class' => 'form-control', 'rows' => '5', 'cols' => '80', 'value' => set_value('permanent_address',$results[0]->permanent_address) ) )?>
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