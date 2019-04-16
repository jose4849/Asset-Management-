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
                    <h3 class="page-header"><i class="fa fa-laptop"></i>Rent collection</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="fa fa-laptop"></i>Rent collection</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row col-lg-6">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->
<p>
<label for="complex_name">Company <span class="required"></span></label>
<?php echo form_dropdown('company', $company, '', 'class="form-control company"'); ?>
</p>
<p>
<label for="complex_name">Complex <span class="required"></span></label>
<?php $complex['none']='Select Company First'; echo form_dropdown('complex', $complex, set_value('complex'), 'class="form-control complex"') ?>
</p>
<p>
<label for="complex_name">Shop No <span class="required"></span></label>
<input id="shop_no" class="form-control" type="text" name="shop_no" maxlength="255" value=""  />
</p>
<p>
<label for="complex_name">Tenant Name<span class="required"></span></label>
<select  class="tenant form-control">
<option>Select Tenant</option>
</select>
</p> 
<p>
<a target="_blank" class="link" href="#"><button class="form-control">Submit</button></a>
</p>	
            </div>

        </section>
    </section>
    <!--main content end-->
</section>

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
msg="<option>Select Complex</option>"+msg;
                $(".complex").html(msg);

            });

        });

        /* for complex with company start */

       /* for complex with company start */

        $(".complex").change(function() {

            var company_id = $(".company").val();
            var complex_id = $(".complex").val();

            $.ajax({

                type: "POST",

                url: "<?php echo base_url(); ?>shop/tenants",

                data: {company_id: company_id,complex_id:complex_id}

            })

                    .done(function(msg) {
					
					// alert(msg);
					
//msg="<option>Select Tenant</option>"+msg;
msg=""+msg;
                $(".tenant").html(msg);

            });

        });

        /* for complex with company start */


		/* for complex with company start */

        $("#shop_no").blur(function() {

            var company_id = $(".company").val();
            var complex_id = $(".complex").val();
            var shop_no = $("#shop_no").val();

            $.ajax({

                type: "POST",

                url: "<?php echo base_url(); ?>shop/tenant",

                data: {company_id: company_id,complex_id:complex_id,shop_no:shop_no}

            })

                    .done(function(msg) {
//msg="<option>Select Tenant</option>"+msg;
msg=""+msg;
                $(".tenant").html(msg);
				var tenant = $(".tenant").val();
				
				$(".link").attr("href", "<?php echo base_url(); ?>tenant/dashboard/"+tenant+"")
            });

        });

		
		
        /* for complex with company start */
		 $(".tenant").change(function() {
			var tenant = $(".tenant").val();
			$(".link").attr("href", "<?php echo base_url(); ?>tenant/dashboard/"+tenant+"")
		 });
		
    });
</script>	


<?php echo $footer; ?>