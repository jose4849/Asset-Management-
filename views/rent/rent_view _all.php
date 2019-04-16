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
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Monthly Bill Generate</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="fa fa-laptop"></i>All Rent</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->



                <div class="col-lg-12">
                    <section class="panel">

                        <table class="table table-striped table-advance table-hover">
                            <tbody>
                            <form action="#" method="post"> 
                                <tr>

                                    <th>
                                        <?php echo form_dropdown('company', $company, set_value('company'), 'class="form-control company"') ?>

                                        <select style="margin-top:10px;" id="complex"  name="complex" class="form-control complex">
                                            <option value=''>Select Complex</option>
                                        </select>
                                        <input style="margin-top:12px;" type="text" id="shop_id" class="form-control" placeholder="Shop Number" name="shop_id" />

                                        <select style="margin-top:10px;" name="status" class="form-control">                                            
                                            <option value="1" >Booked</option>
                                        </select>
                                        <select style="margin-top:10px;" id="year" class="form-control">
                                            <option value='2015' >2015</option>
                                            <option value='2016' >2016</option>
                                            <option value='2017' >2017</option>
                                            <option value='2018' >2018</option>
                                            <option value='2019' >2019</option>
                                            <option value='2020' >2020</option>
                                        </select>

                                    </th>

                                    <th width="33%">
                                        <select required style="height: 222px;" id="month" class="form-control" multiple>
                                            <option value='01' >January</option>
                                            <option value="02" >February</option>
                                            <option value="03" >march</option>
                                            <option value="04" >April</option>
                                            <option value="05" >May</option>
                                            <option value="06" >June</option>
                                            <option value="07" >July</option>
                                            <option value="08" >August</option>
                                            <option value="09" >September</option>
                                            <option value="10" >October</option>
                                            <option value="11" >November</option>
                                            <option value="12" >December</option>

                                        </select>
                                <p>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p>
                                </th>
                                <th><input type="button" onclick="generate()" class="form-control" value="Generate Bill" /></th>

                                </tr>
                            </form>
                            <tbody>
                        </table>
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
                                    function generate() {
                                        var company = $('.company').val();
                                        var complex = $('#complex').val();
                                        var shop_id = $('#shop_id').val();
                                        var year = $('#year').val();
                                        var month = $('#month').val();
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo base_url(); ?>rent/monthlybill",
                                            data: {company: company, complex: complex, shop_id: shop_id, year: year, month: month}
                                        })
                                            .done(function(msg) {
                                            var url="<?php echo base_url(); ?>rent/group_invoice_print?id="+msg;
                                            window.open(url,'_blank');
                                            //window.reload();
                                        });

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
