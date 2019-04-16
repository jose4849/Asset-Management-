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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Bank</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><i class="fa fa-laptop"></i>All Bank</li>						  	
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
                                 <th>Bank Name</th>
                                 <th>Branch Name</th>
                                 <th>Account Number</th>
                                 <th>Current Balance</th>                                
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
							  
							  <?php foreach($results as $result ){ ?>
                              <tr>
                                 <td><?php echo $result->bank_name; ?></td>
                                 <td><?php echo $result->branch_name; ?></td>
                                 <td><?php echo $result->account_number; ?></td>
                                 <td><?php echo $result->balance; ?></td>
                                
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="<?php echo base_url(); ?>bank/edit_bank/<?php echo $result->bank_id; ?>"><i class="icon_plus_alt2"></i></a>
                                      
                                      <a class="btn btn-danger" onclick="delete_bank('<?php echo $result->bank_id; ?>')" href="#"><i class="icon_close_alt2"></i></a>
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
    function delete_bank(id){ 
        var con = confirm("Are you confirm to Delete ?"); 
        if(con==1){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>bank/bank_delete",
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
