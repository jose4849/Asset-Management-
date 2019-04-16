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
                        $id=$this->uri->segment(3);
			$attributes = array('class' => '', 'id' => '');
			echo form_open("users/update/$id", $attributes); 
                        ?>

			<p>
					<label for="user_full_name">Full Name <span class="required">*</span></label>
					<?php echo form_error('user_full_name'); ?>
					<br /><input id="user_full_name"  class="form-control" type="text" name="user_full_name" maxlength="255" value="<?php echo $results[0]->user_full_name; ?>"  />
			</p>

			<p>
					<label for="user_email">Email <span class="required">*</span></label>
					<?php echo form_error('user_email'); ?>
					<br /><input id="user_email" type="text" class="form-control" name="user_email" maxlength="255" value="<?php echo $results[0]->user_email; ?>"  />
			</p>

			<p>
					<label for="designation">Designation <span class="required">*</span></label>
					<?php echo form_error('designation'); ?>
					<br /><input id="designation" type="text" class="form-control" name="designation" maxlength="255" value="<?php echo $results[0]->designation; ?>"  />
			</p>

			<p>
					<label for="user_address">Address <span class="required">*</span></label>
				<?php echo form_error('user_address'); ?>
				<br />
										
				<?php echo form_textarea( array( 'name' => 'user_address', 'rows' => '5', 'cols' => '80','class' => 'form-control', 'value' => $results[0]->user_address ) )?>
			</p>
			<p>
					<label for="user_phone">Phone <span class="required">*</span></label>
					<?php echo form_error('user_phone'); ?>
					<br /><input id="user_phone" type="text" class="form-control" name="user_phone" maxlength="255" value="<?php echo $results[0]->user_phone; ?>"  />
			</p>
			<p>
                  <label for="password"><span class="required">Access level</span></label>
                  <?php 
                  $level= $results[0]->user_level;
                  echo form_dropdown("user_level", $user_level , $level, 'class=form-control'); 
                  ?>
            </p>
			<p>
					<label for="password">Password <span class="required">*</span></label>
					<?php echo form_error('password'); ?>
					<br /><input id="password" type="password" class="form-control" name="password" maxlength="255" value="<?php echo $results[0]->password; ?>"  />
			</p>
			<p>
					<?php echo form_submit( 'submit', 'Update',"class='btn btn-danger'"); ?>
			</p>

			<?php echo form_close(); ?>
			<!--------------------------------------------------------Content will be End From Here ----------------------------------->	
			</div><!--/.row-->
			<div class="row col-lg-6">
			
<!-----------------access level ---------------------------------------------------------------->

<style>
tr:nth-child(even) {
    background-color: #D0D8E1;
}
</style>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
$( document ).ready(function() {

/* your code will be bellow */
 $('#checkAllmod').click(function () {      
     $('.allmod').prop('checked', this.checked);    
 });
 
 $('#checkAllmodadd').click(function () {      
     $('.alladd').prop('checked', this.checked);    
 });

 $('#checkAllmodedit').click(function () {      
     $('.alledit').prop('checked', this.checked);    
 });

 $('#checkAllmodedel').click(function () {      
     $('.alldel').prop('checked', this.checked);    
 });
 
 $('#checkAllmodeup').click(function () {      
     $('.allup').prop('checked', this.checked);    
 });

 
/* your code will be above*/ 
});

</script>
<form action="#" method="post" >
<table border="1" style="margin-top: 26px; margin-left: 15px;" bordercolor="#000000"  width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td>Module</td>
		<td>Access</td>
		<td>Add New</td>
		<td>Edit</td>		
		<td>Delete</td>
	</tr>
	<tr>
		<td>All</td>
		<td><input id="checkAllmod" <?php  if(isset($all)){ if($all=='on'){ echo 'checked'; }} ?> type="checkbox"  name="all" /></td>
		<td><input id="checkAllmodadd" <?php  if(isset($all_add)){ if($all_add=='on'){ echo 'checked'; }} ?> type="checkbox" name="all_add" /></td>
		<td><input id="checkAllmodedit" <?php  if(isset($all_edit)){ if($all_edit=='on'){ echo 'checked'; }} ?> type="checkbox" name="all_edit" /></td>		
		<td><input id="checkAllmodedel" <?php  if(isset($all_del)){ if($all_del=='on'){ echo 'checked'; }} ?> type="checkbox" name="all_del" /></td>
	</tr>
	<tr>
		<td>Company</td>
		<td><input type="checkbox" <?php  if(isset($com)){ if($com=='on'){ echo 'checked'; }} ?> class="allmod" name="com" /></td>
		<td><input type="checkbox" <?php  if(isset($com_add)){ if($com_add=='on'){ echo 'checked'; }} ?> class="alladd" name="com_add" /></td>
		<td><input type="checkbox" <?php  if(isset($com_edit)){ if($com_edit=='on'){ echo 'checked'; }} ?> class="alledit" name="com_edit" /></td>		
		<td><input type="checkbox" <?php  if(isset($com_del)){ if($com_del=='on'){ echo 'checked'; }} ?> class="alldel" name="com_del" /></td>
	</tr>
	<tr>
		<td>Complex</td>
		<td><input type="checkbox" <?php  if(isset($comp)){ if($comp=='on'){ echo 'checked'; }} ?> class="allmod" name="comp" /></td>
		<td><input type="checkbox" <?php  if(isset($comp_add)){ if($comp_add=='on'){ echo 'checked'; }} ?> class="alladd" name="comp_add" /></td>
		<td><input type="checkbox" <?php  if(isset($comp_edit)){ if($comp_edit=='on'){ echo 'checked'; }} ?> class="alledit" name="comp_edit" /></td>
		
		<td><input type="checkbox" <?php  if(isset($comp_del)){ if($comp_del=='on'){ echo 'checked'; }} ?> class="alldel" name="comp_del" /></td>
	</tr>
	<tr>
		<td>Tenant</td>
		<td><input type="checkbox" <?php  if(isset($tenant)){ if($tenant=='on'){ echo 'checked'; }} ?> class="allmod" name="tenant" /></td>
		<td><input type="checkbox" <?php  if(isset($tenant_add)){ if($tenant_add=='on'){ echo 'checked'; }} ?> class="alladd" name="tenant_add" /></td>
		<td><input type="checkbox" <?php  if(isset($tenant_edit)){ if($tenant_edit=='on'){ echo 'checked'; }} ?> class="alledit" name="tenant_edit" /></td>
		
		<td><input type="checkbox" <?php  if(isset($tenant_del)){ if($tenant_del=='on'){ echo 'checked'; }} ?> class="alldel" name="tenant_del" /></td>
	</tr>
	
	<tr>
		<td>Bank</td>
		<td><input type="checkbox" <?php  if(isset($bank)){ if($bank=='on'){ echo 'checked'; }} ?> class="allmod" name="bank" /></td>
		<td><input type="checkbox" <?php  if(isset($bank_add)){ if($bank_add=='on'){ echo 'checked'; }} ?> class="alladd" name="bank_add" /></td>
		<td><input type="checkbox" <?php  if(isset($bank_edit)){ if($bank_edit=='on'){ echo 'checked'; }} ?> class="alledit" name="bank_edit" /></td>
		
		<td><input type="checkbox" <?php  if(isset($bank_del)){ if($bank_del=='on'){ echo 'checked'; }} ?> class="alldel" name="bank_del" /></td>
	</tr>	
	<tr>
		<td>Bank Transaction</td>
		<td colspan="4"><input type="checkbox" <?php  if(isset($banktansc)){ if($banktansc=='on'){ echo 'checked'; }} ?> class="allmod" name="banktansc" /></td>
		</tr>	
	
	<tr>
		<td>Add Advance</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($advance)){ if($advance=='on'){ echo 'checked'; }} ?> class="allmod" name="advance" /></td>
		
	</tr>
	<tr>
		<td>Refund</td>
		<td colspan="4"><input type="checkbox" <?php  if(isset($refund)){ if($refund=='on'){ echo 'checked'; }} ?> class="allmod" name="refund" /></td>
		
	</tr>	
	<tr>
		<td>Unbooked</td>
		<td colspan="4"><input type="checkbox" <?php  if(isset($unbooked)){ if($unbooked=='on'){ echo 'checked'; }} ?> class="allmod" name="unbooked" /></td>
		
	</tr>	
	<tr>
		<td>Shop</td>
		<td><input type="checkbox" <?php  if(isset($shop)){ if($shop=='on'){ echo 'checked'; }} ?> class="allmod" name="shop" /></td>
		<td><input type="checkbox" <?php  if(isset($shop_add)){ if($shop_add=='on'){ echo 'checked'; }} ?> class="alladd" name="shop_add" /></td>
		<td><input type="checkbox" <?php  if(isset($shop_edit)){ if($shop_edit=='on'){ echo 'checked'; }} ?> class="alledit" name="shop_edit" /></td>
		
		<td><input type="checkbox" <?php  if(isset($shop_del)){ if($shop_del=='on'){ echo 'checked'; }} ?> class="alldel" name="shop_del" /></td>
	</tr>	


	<tr>
		<td>Shop Booking</td>
		<td><input type="checkbox" <?php  if(isset($b_shop)){ if($b_shop=='on'){ echo 'checked'; }} ?> class="allmod" name="b_shop" /></td>
		<td><input type="checkbox" <?php  if(isset($b_shop_add)){ if($b_shop_add=='on'){ echo 'checked'; }} ?> class="alladd" name="b_shop_add" /></td>
		<td><input type="checkbox" <?php  if(isset($b_shop_edit)){ if($b_shop_edit=='on'){ echo 'checked'; }} ?> class="alledit" name="b_shop_edit" /></td>
		
		<td><input type="checkbox" <?php  if(isset($b_shop_del)){ if($b_shop_del=='on'){ echo 'checked'; }} ?> class="alldel" name="b_shop_del" /></td>
	</tr>
	
	<tr>
		<td>Rent Generate</td>
		<td colspan="4"><input type="checkbox" <?php  if(isset($rent)){ if($rent=='on'){ echo 'checked'; }} ?> class="allmod" name="rent" /></td>
		</tr>

	
	<tr>
		<td>Employee</td>
		<td><input type="checkbox" <?php  if(isset($emp)){ if($emp=='on'){ echo 'checked'; }} ?>  class="allmod" name="emp" /></td>
		<td><input type="checkbox" <?php  if(isset($emp_add)){ if($emp_add=='on'){ echo 'checked'; }} ?> class="alladd" name="emp_add" /></td>
		<td><input type="checkbox" <?php  if(isset($emp_edit)){ if($emp_edit=='on'){ echo 'checked'; }} ?> class="alledit" name="emp_edit" /></td>
		
		<td><input type="checkbox" <?php  if(isset($emp_del)){ if($emp_del=='on'){ echo 'checked'; }} ?> class="alldel" name="emp_del" /></td>
	</tr>	
	
	<tr>
		<td>Employee Transaction</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($emptansc)){ if($emptansc=='on'){ echo 'checked'; }} ?> class="allmod" name="emptansc" /></td>
		</tr>
		<tr>
		<td>Expense</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($exp_add_mod)){ if($exp_add_mod=='on'){ echo 'checked'; }} ?> class="allmod" name="exp_add_mod" /></td>
		</tr>
	
	<tr>
		<td>Expense Category</td>
		<td><input type="checkbox" <?php  if(isset($exp)){ if($exp=='on'){ echo 'checked'; }} ?> class="allmod" name="exp" /></td>
		<td><input type="checkbox" <?php  if(isset($exp_add)){ if($exp_add=='on'){ echo 'checked'; }} ?> class="alladd" name="exp_add" /></td>
		<td><input type="checkbox" <?php  if(isset($exp_edit)){ if($exp_edit=='on'){ echo 'checked'; }} ?> class="alledit" name="exp_edit" /></td>
		
		<td><input type="checkbox" <?php  if(isset($exp_del)){ if($exp_del=='on'){ echo 'checked'; }} ?> class="alldel" name="exp_del" /></td>
	</tr>	
	

	
	<tr>
		<td>User</td>
		<td><input type="checkbox" <?php  if(isset($user)){ if($user=='on'){ echo 'checked'; }} ?> class="allmod" name="user" /></td>
		<td><input type="checkbox" <?php  if(isset($user_add)){ if($user_add=='on'){ echo 'checked'; }} ?> class="alladd" name="user_add" /></td>
		<td><input type="checkbox" <?php  if(isset($user_edit)){ if($user_edit=='on'){ echo 'checked'; }} ?> class="alledit" name="user_edit" /></td>
		
		<td><input type="checkbox" <?php  if(isset($user_del)){ if($user_del=='on'){ echo 'checked'; }} ?> class="alldel" name="user_del" /></td>
	</tr>	

	<tr>
		<td>Report</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($report)){ if($report=='on'){ echo 'checked'; }} ?> class="allmod" name="report" /></td>
		
	</tr>		

	<tr>
		<td colspan="5">Reports Types</td>
	</tr>
	
	<tr>
		<td>Company</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($rep_com)){ if($rep_com=='on'){ echo 'checked'; }} ?> class="allmod" name="rep_com" /></td>
		
	</tr>	
	
		
	<tr>
		<td>Complex</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($rep_complex)){ if($rep_complex=='on'){ echo 'checked'; }} ?> class="allmod" name="rep_complex" /></td>
		
	</tr>	
	
		
	<tr>
		<td>Rent Collection</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($rep_rent)){ if($rep_rent=='on'){ echo 'checked'; }} ?> class="allmod" name="rep_rent" /></td>
		
	</tr>	
	
		
	<tr>
		<td>Tenant</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($rep_tenant)){ if($rep_tenant=='on'){ echo 'checked'; }} ?> class="allmod" name="rep_tenant" /></td>
		
	</tr>	
	
		
	<tr>
		<td>Bank</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($rep_bank)){ if($rep_bank=='on'){ echo 'checked'; }} ?> class="allmod" name="rep_bank" /></td>
		
	</tr>
	<tr>
		<td>Expense</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($rep_exp)){ if($rep_exp=='on'){ echo 'checked'; }} ?> class="allmod" name="rep_exp" /></td>
		
	</tr>	
	
		
	<tr>
		<td>Day to Day In/Out</td>
		<td colspan="4" ><input type="checkbox" <?php  if(isset($rep_daytoday)){ if($rep_daytoday=='on'){ echo 'checked'; }} ?>  class="allmod" name="rep_daytoday" /></td>
		
	</tr>	
	
		
	<tr>
		<td>Final</td>
		<td colspan="4" >
		
		<input type="checkbox" <?php  if(isset($rep_final)){ if($rep_final=='on'){ echo 'checked'; }} ?> class="allmod" name="rep_final" /></td>
		
	</tr>	
	<tr>
	<td colspan="5" align="center"><input style="margin-top:10px; margin-bottom:10px;" name="access" type="submit" class="btn btn-danger" value="Update Access" name="submit"></td>
	</tr>
</form>
</table>

			
<!-----------------access level ---------------------------------------------------------------->			
			
			</div>
          <!-- project team & activity end -->

          </section>
      </section>
      <!--main content end-->
  </section>
<?php echo $footer; ?>