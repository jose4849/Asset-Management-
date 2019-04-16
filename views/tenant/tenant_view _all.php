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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Tenant</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><i class="fa fa-laptop"></i>All Tenant</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row">
			<!--------------------------------------------------------Content will be start From Here ----------------------------------->


             
                  <div class="col-lg-12">
                      <section class="panel">
                              <form>
                              <input type="text" name="s" placeholder="Search by Tenant Name" class="form-control" style="width:450px; display: inline;">
                              <input type="submit" value="Search" class="form-control btn btn-danger" style="width:150px; display: inline;">
                              </form>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
								 <th><i class="icon_profile"></i>ID</th>
                                 <th><i class="icon_profile"></i>Tenant Name</th>
                                 <th><i class="icon_profile"></i>Father/Husband</th>
                                 <th><i class="icon_mail_alt"></i>Address</th>
                                 <th><i class="icon_mobile"></i> Phone/Mobile</th>
                                 <!--<th><i class="fa fa-money"></i>Account</th>-->
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
							  <?php $session_data = $this->session->userdata('logged_in');		?>
							  <?php foreach($results as $result ){ ?>
                              <tr>
								 <td><?php echo $result->tenant_id; ?></td>
                                 <td><?php echo $result->tenant_name; ?></td>
                                 <td><?php echo $result->father_hasband; ?></td>
                                 <td><?php echo $result->address; ?></td>
                                 <td><?php echo $result->tenant_phone; ?></td>
                                 <!--<td>0</td>-->
                                 <td>
                                  <div class="btn-group">
								  
									  
                                      <a class="btn btn-success"  href="<?php echo base_url(); ?>tenant/dashboard/<?php echo $result->tenant_id; ?>"><i class="fa fa-eye"></i></a>
                                      <?php if(isset($session_data['tenant_edit'])){ ?>
									  <a class="btn btn-primary" href="<?php echo base_url(); ?>tenant/edittenant/<?php echo $result->tenant_id; ?>"><i class="icon_plus_alt2"></i></a>
                                      <?php } if(isset($session_data['tenant_del'])){ ?>
                                      <a class="btn btn-danger" onclick="deletetenant('<?php echo $result->tenant_id; ?>')" href="#"><i class="icon_close_alt2"></i></a>
									  <?php } ?>
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
    function deletetenant(id){ 
        var con = confirm("Are you confirm to Delete ?"); 
        if(con==1){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>tenant/tenantdelete",
                        data: {id:id}
                    })
                    .done(function( msg ) {
                       alert(msg); 
                       location.reload();
                    });
        }
        else{
            alert("Thank You.");
        }
    }
    
</script>
<?php echo $footer; ?>
