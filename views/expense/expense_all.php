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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Expense</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><i class="fa fa-laptop"></i>All Expense</li>						  	
					</ol>
				</div>
			</div>
            

            <div class="row">
			<!--------------------------------------------------------Content will be start From Here ----------------------------------->


             
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              
                          </header>
                          <table border="0" >
                            <tr>
                                <td colspan="6"></td>
                            </tr>
                            <tr>
                            <form >
                                                      
                                <td>
                                    <input type='text' value='01-01-<?php echo date("Y"); ?>' name='from' class='form-control bs_datepicker bsd_format2' />
                                </td>
                                <td>
                                    <input type='text' value='31-12-<?php echo date("Y"); ?>' name='to' class='form-control bs_datepicker bsd_format2' />
                                </td>
                                 <td><input style="width:100px" type="submit"  class="form-control btn btn-danger"  value="Search"  /></td>
                            </form>

                            </tr>
                            
                            
                         
                            
                            
                        </table> 
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th>ID</th>                             
                                 <th> Expense Name</th>                             
                                 <th> Company Name</th>                             
                                 <th> Expense Note</th>
                                 <th> Expense By</th>
								 <th>Amount</th>
								 <th>Date</th>
                               
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
							   <?php
			$session_data = $this->session->userdata('logged_in');		?>
							  <?php foreach($results as $result ){ ?>
                              <tr>
                                 <td><?php echo $result->expense_id; ?></td>
                                 <td><?php echo $result->expense_name; ?></td>
                                 <td><?php echo (isset($company[$result->company])) ? $company[$result->company] : 'Not Set' ;  ?></td>
                                 <td><?php echo $result->expense_note; ?></td>
                                 <td><?php echo $result->expense_by_name; ?></td>
                                 <td><?php echo $result->amount; ?></td>
                                 <td><?php echo $result->dateofexpense; ?></td>
                               
                                 <td>
                                  <div class="btn-group">
								  <?php  if(isset($session_data['exp_add'])){ ?>
                                      <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>expense/edit_expense_category/<?php echo $result->cat_id; ?>"><i class="icon_plus_alt2"></i></a>-->
                                      <?php } if(isset($session_data['exp_del'])){ ?>
                                      <a class="btn btn-danger" onclick="delete_expense_category('<?php echo $result->expense_id; ?>')" href="#"><i class="icon_close_alt2"></i></a>
									  <?php }  ?>
								  </div>
                                  </td>
                              </tr>
                                                          <?php } ?>                     
                           </tbody>
                        </table>
                          <?php if (isset($link) && ! empty($link)) {echo $link;} ?>
                      </section>
                  </div>
                        
           

			
			<!--------------------------------------------------------Content will be End From Here ----------------------------------->	
			</div><!--/.row-->
		
			
          <!-- project team & activity end -->

          </section>
      </section>
      <!--main content end-->
  </section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function delete_expense_category(id){ 
        var con = confirm("Are you confirm to Delete ?"); 
        if(con==1){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>expense/expense_delete",
                        data: {id:id}
                    })
                    .done(function( msg ) {
                       alert(msg);                         
                    });
        }
        else{
            alert("Thank You.");
        }
    }
    
</script>
<?php echo $footer; ?>
