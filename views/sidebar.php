      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
			  
			  
			<?php
			$session_data = $this->session->userdata('logged_in');		?>
			
			
			
			
			  
			  
			  
<!-------------------------------------------------------1-------------------------------------------------------------->			

              <ul class="sidebar-menu">                
                  <li class="active">
                      <a class="" href="<?php echo base_url(); ?>">
                          <i class="icon_house_alt"></i>
                          <span>
						  Dashboard
						  </span>
                      </a>
                  </li>
				  <?php if(isset($session_data['com'])){ ?>
				  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Company</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
						  <?php if(isset($session_data['com_add'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>company">Add Company</a></li>
						  <?php } ?>
                          <li><a class="" href="<?php echo base_url(); ?>company/view/">All Company</a></li>
                      </ul>
                  </li>
				  <?php } ?>
				  <?php if(isset($session_data['comp'])){ ?>
				  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Complex</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
						  <?php if(isset($session_data['comp'])){ ?>	
                          <li><a class="" href="<?php echo base_url(); ?>complex">Add Complex</a></li>  
						  <?php } ?>
                          <li><a class="" href="<?php echo base_url(); ?>complex/allcomplex">All Complex</a></li>
                      </ul>
                  </li>	
				  <?php } ?>
				  <?php if(isset($session_data['shop'])){ ?>
				  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Shop</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
							 <?php if(isset($session_data['shop_add'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>shop">Add Shop</a></li> 
							 <?php } ?>
						  
                          <li><a class="" href="<?php echo base_url(); ?>shop/allshop">All Shop</a></li>
						  <?php if(isset($session_data['b_shop'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>shop/booking">Shop Booking</a></li>
						  <?php } ?>
                      </ul>
                  </li>
<?php } ?>
<?php if(isset($session_data['tenant'])){ ?>

				  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Tenant</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
					  <?php if(isset($session_data['tenant_add'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>tenant">Add Tenant</a></li>
							<?php } ?>
                          <li><a class="" href="<?php echo base_url(); ?>tenant/alltenant">All Tenant</a></li>
                      </ul>
                  </li> 
<?php } ?>
<?php if(isset($session_data['rent'])){ ?>				  
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Rent Allowance</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="<?php echo base_url(); ?>rent">Monthly Bill Generate</a></li>                        
                      </ul>
                  </li>
				  <?php } ?>
				  
<li>
                      <a href="<?php echo base_url(); ?>rent/collections" class="">
                          <i class="icon_document_alt"></i>
                          <span>Rent Collections</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      
                  </li>				  
				  
				  
				  
				  <?php if(isset($session_data['bank'])){ ?>
				  
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Bank</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
					  <?php if(isset($session_data['bank_add'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>bank">Add Bank</a></li>
						  <?php } ?>
                          <li><a class="" href="<?php echo base_url(); ?>bank/view">All Bank</a></li>
						  <?php if(isset($session_data['banktansc'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>bank/transection">Transection</a></li>
						  <?php } ?>
                      </ul>                                         
					  
                  </li>
				  <?php } ?>
				  <?php if(isset($session_data['emp'])){ ?>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Employee</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
							<?php if(isset($session_data['emp_add'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>employee">Add Employee</a></li>
						  <?php } ?>
                          <li><a class="" href="<?php echo base_url(); ?>employee/view">All Employee</a></li>
                      </ul>                                         
                  </li>
                       <?php } ?>
				  <?php if(isset($session_data['exp'])){ ?>					   
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Expense</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <?php if(isset($session_data['exp_add'])){ ?>	<li><a class="" href="<?php echo base_url(); ?>expense_category">Category Add</a></li><?php } ?> 
                          <li><a class="" href="<?php echo base_url(); ?>expense_category/view">Expense Category</a></li>
                         <?php if(isset($session_data['exp_add_mod'])){ ?> <li><a class="" href="<?php echo base_url(); ?>expense">Add Expense</a></li><?php } ?>
                         <?php if(isset($session_data['exp_add_mod'])){ ?> <li><a class="" href="<?php echo base_url(); ?>expense/view">Expense</a></li><?php } ?>
                          
                      </ul>
                  </li>
                  <?php } ?>
				  <?php if(isset($session_data['report'])){ ?>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Reports</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">                          
                          <?php if(isset($session_data['rep_com'])){ ?>
						  <li><a class="" href="<?php echo base_url(); ?>reports/company">Company</a></li>
						  <?php } if(isset($session_data['rep_complex'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>reports/complex">Complex</a></li>
						  <?php  }  if(isset($session_data['rep_rent'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>reports/rentcollection">Rent Collection</a></li>
                          <li><a class="" href="<?php echo base_url(); ?>reports/utilitiescollection">Utilities Collection</a></li>
						  <?php } if(isset($session_data['rep_tenant'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>reports/tenant"><span>Tenant</span></a></li>
                          <li><a class="" href="<?php echo base_url(); ?>reports/tenant_due"><span>Tenant Due</span></a></li>
						  <?php } if(isset($session_data['rep_bank'])){ ?>
						  <!--<li><a class="" href="<?php echo base_url(); ?>reports/employe"><span>Employee</span></a></li>-->
                          <li><a class="" href="<?php echo base_url(); ?>reports/bank"><span>Bank</span></a></li>
						  <?php } if(isset($session_data['rep_exp'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>reports/expense">Expense</a></li>
						  <?php } if(isset($session_data['rep_daytoday'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>reports/final_daytoday">Day to Day In/Out</a></li>
						  <?php } if(isset($session_data['rep_final'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>reports/final_report">Final</a></li>
						  <?php } ?>
                        
                      </ul>
                  </li>
				  <?php } if(isset($session_data['user'])){ ?>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Users</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
							 <?php  if(isset($session_data['user_add'])){ ?>
                          <li><a class="" href="<?php echo base_url(); ?>users">Add User</a></li>
						 <?php } ?>
                          <li><a class="" href="<?php echo base_url(); ?>users/alluser">All User</a></li>
                      </ul>
                  </li> 
<?php } ?>				  
              </ul>
        		  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
          </div>
      </aside>
      <!--sidebar end-->
      