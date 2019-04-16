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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Complex</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><i class="fa fa-laptop"></i>All Complex</li>						  	
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
                                 <th> Company ID</th>
                                 <th>Complex Name</th>
                                 <th>Address</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Action</th>
                              </tr>
							   <?php
			$session_data = $this->session->userdata('logged_in');		?>
			      <?php foreach($results as $result ){ ?>
                              <tr>
                                 <td><?php echo $result->company_names; ?></td>
                                 <td><?php echo $result->complex_name; ?></td>
                                 <td><?php echo $result->complex_address; ?></td>
                                 <td><?php echo $result->complex_phone; ?></td>
                                 <td><?php echo $result->complex_email; ?></td>
                                 <td>
                                  <div class="btn-group">
								  <?php if(isset($session_data['comp_edit'])){ ?>
                                      <a class="btn btn-primary" href="<?php echo base_url(); ?>complex/editcomplex/<?php echo $result->complex_id; ?>"><i class="icon_plus_alt2"></i></a>
                                      <?php } if(isset($session_data['comp_del'])){ ?>
                                      <a class="btn btn-danger" onclick="deletecomplex('<?php echo $result->complex_id; ?>')" href="#"><i class="icon_close_alt2"></i></a>
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
    function deletecomplex(id){ 
        var con = confirm("Are you confirm to Delete ?"); 
        if(con==1){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>complex/complexdelete",
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
