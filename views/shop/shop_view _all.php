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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Shop</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><i class="fa fa-laptop"></i>All Shop</li>						  	
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
                           <form action="#" method="post"> 
                              <tr>
                                 <th>
                                     <?php echo form_dropdown('company', $company, set_value('company'), 'class="form-control company"') ?>
                                 </th>
                                 <th>
                                     <select name="complex" class="form-control complex">
                                         <option value=''>Select Complex</option>
                                     </select>
                                 </th>
                                 <th>
                                     <input type="text" class="form-control" placeholder="Shop Number" name="shop" />
                                 </th>
                                 <th><select name="status" class="form-control">
                                         <option value='' >Select Status</option>
                                         <option value="1" >Booked</option>
                                         <option value="0" >Not Booked</option>
                                     </select></th>
                                 <th><input type="submit" class="form-control" value="Filter" /></th>
                                 <th></th>
                                 <th></th>
                              </tr>
                           </form>
                              <tr>
                                 <th>ID</th>
                                 <th>Company Name</th>
                                 <th>Complex Name</th>
                                 <th>Shop</th>
                                 <th>Floor</th>
                                 <th>Description</th>
                                 <th>Booking Status</th>
                                 <th>Action</th>
                              </tr>
							   <?php
			$session_data = $this->session->userdata('logged_in');		?>
			      <?php foreach($results as $result ){ ?>
                              <tr>
                                 <td><?php echo $result->shop_id; ?></td>
                                 <td><?php echo $result->company_names; ?></td>
                                 <td><?php echo $result->complex_name; ?></td>
                                 <td><?php echo $result->shop; ?></td>
                                 <td><?php echo $result->floor; ?></td>
                                 <td><?php echo $result->description; ?></td>
                                  <td>
                                  <?php $book=$result->bookstatus;
                                  $booking_id=$result->booking_id;
                                  if($book=='0'){ ?>
                                      <a href="<?php echo base_url(); ?>shop/booking">Not Booked</a>
                                  <?php
                                  }
                                  else{
                                  ?>
                                      <a href="<?php echo base_url(); ?>shop/booked/<?php echo $booking_id; ?>">Booked</a>
                                  <?php } ?>
                                  
                                  </td>
                                 <td>
                                  <div class="btn-group">
								   <?php if(isset($session_data['shop_edit'])){ ?>
                                      <a class="btn btn-primary" href="<?php echo base_url(); ?>shop/editshop/<?php echo $result->shop_id; ?>"><i class="icon_plus_alt2"></i></a>
                                       <?php } if(isset($session_data['shop_del'])){ ?>
                                      <a class="btn btn-danger" onclick="deleteshop('<?php echo $result->shop_id; ?>')" href="#"><i class="icon_close_alt2"></i></a>
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
    function deleteshop(id){ 
        var con = confirm("Are you confirm to Delete ?"); 
        if(con==1){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>shop/shopdelete",
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
<script>
    $(document).ready(function() {
        /* for complex with company start */
        $(".company").change(function() {
            var company_id = $(".company").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>shop/complex",
                data: {company_id: company_id}
            })
                    .done(function(msg) {
               $(".complex").html(msg);
            });
        });
        /* for complex with company start */
    });
</script>
<?php echo $footer; ?>
