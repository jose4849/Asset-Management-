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
						<li><i class="fa fa-laptop"></i>All Users</li>						  	
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
                                 <th></i>Full Name</th>
                                 <th>Rule</th>
                                 <th>Email / Username</th>
                                 <th>Designation</th>
                                 <th>Mobile</th>
                                 <th>Action</th>
                              </tr>
							    <?php
			$session_data = $this->session->userdata('logged_in');		?>
							  <?php foreach($results as $result ){ ?>
                              <tr>
                                 <td><?php echo $result->user_full_name; ?></td>
                                 <td><?php $user_level=$result->user_level;
								 if($user_level==0){ echo "No Access"; }
								 if($user_level==1){ echo "Administration"; }
								 if($user_level==2){ echo "Executive"; }
								 if($user_level==3){ echo "Manager"; }
								 if($user_level==4){ echo "Accounts"; }
								 ?></td>
                                 <td><?php echo $result->user_email; ?></td>
                                 <td><?php echo $result->designation; ?></td>
                                 <td><?php echo $result->user_phone; ?></td>
                                 <td>
                                  <div class="btn-group">
								  <?php if(isset($session_data['user_edit'])){ ?>
                                      <a class="btn btn-primary" href="<?php echo base_url(); ?>users/edituser/<?php echo $result->id; ?>"><i class="icon_plus_alt2"></i></a>
                                      <a class="btn btn-success" href="#">
                                          <?php $status=$result->user_status;
                                          if($status==1){
                                          ?>
                                          <i onclick="userstatus('<?php echo $result->id; ?>',0)" class="icon_check_alt2"></i>
                                          <?php } else{ ?>
                                          <i onclick="userstatus('<?php echo $result->id; ?>',1)" class="icon_minus_alt2"></i>
                                          <?php } ?>
                                      </a>
									  <?php } if(isset($session_data['user_del'])){ ?>
                                      <a class="btn btn-danger" onclick="deleteuser('<?php echo $result->id; ?>')" href="#"><i class="icon_close_alt2"></i></a>
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
    function deleteuser(id){ 
        var con = confirm("Are you confirm to Delete ?"); 
        if(con==1){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>users/userdelete",
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
    function userstatus(id,status){
        if(status==1){
            var con = confirm("User status will be Active"); 
            if(con==1){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>users/userstatus",
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
                            url: "<?php echo base_url(); ?>users/userstatus",
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
