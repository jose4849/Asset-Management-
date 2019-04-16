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
						<li><i class="fa fa-laptop"></i>All Company</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row">
			<!--------------------------------------------------------Content will be start From Here ----------------------------------->


             
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> Company Name</th>
                                 <th><i class="icon_calendar"></i> Date</th>
                                 <th><i class="icon_mail_alt"></i> Email</th>
                                 <th><i class="icon_pin_alt"></i> Owner Name</th>
                                 <th><i class="icon_mobile"></i> Mobile</th>
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
							  <?php
			$session_data = $this->session->userdata('logged_in');		?>
							  <?php foreach($results as $result ){ ?>
                              <tr>
                                 <td><?php echo $result->company_names; ?></td>
                                 <td><?php echo $result->created_date; ?></td>
                                 <td><?php echo $result->email; ?></td>
                                 <td><?php echo $result->owner_name; ?></td>
                                 <td><?php echo $result->phone; ?></td>
                                 <td>
                                  <div class="btn-group">
								  <?php if(isset($session_data['com_edit'])){ ?>
                                      <a class="btn btn-primary" href="<?php echo base_url(); ?>company/edituser/<?php echo $result->id; ?>"><i class="icon_plus_alt2"></i></a>
                                    <?php } if(isset($session_data['com_del'])){ ?>  
                                      <a class="btn btn-danger" onclick="deletecompany('<?php echo $result->id; ?>')" href="#"><i class="icon_close_alt2"></i></a>
                                  <?php } ?>
								  </div>
                                  </td>
                              </tr>
                                                          <?php } ?>                     
                           </tbody>
                        </table>
                          <?php echo $link; ?>
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
    function deletecompany(id){ 
        var con = confirm("Are you confirm to Delete ?"); 
        if(con==1){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>company/companydelete",
                        data: {id:id}
                    })
                    .done(function( msg ) {
                       //alert(msg); 
                       location.reload();
                    });
        }
        else{
            alert("Thank You.");
        }
    }
    function userstatus(id,status){
        if(status==1){
            var con = confirm("User status will be Active"); 
            if(con==1){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>company/companydelete",
                            data: {id:id,status:status}
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
        else{
            var con = confirm("User status will be Deactive"); 
            if(con==1){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>company/companydelete",
                            data: {id:id,status:status}
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
    }
</script>
<?php echo $footer; ?>
