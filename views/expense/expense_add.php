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
                        <li><i class="fa fa-laptop"></i>Add New Expense</li>						  	
                    </ol>
                </div>
            </div>

            <div class="row col-lg-6">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->

                <?php
                // Change the css classes to suit your needs    

                $attributes = array('class' => '', 'id' => '');
                echo form_open('expense_category', $attributes);
                ?>
                <p>
                    <label for="cat_description">Type <span class="required">*</span></label>

                    <select id="extype" onchange="extype()" class="form-control" >
                        <option value="0">Normal Type</option>
                        <option value="1">Monthly type</option>                      
                    </select>
                </p>
                <p>
                    <label for="exp_category_name">Expense Name <span class="required">*</span></label>
                    <?php echo form_error('exp_category_name'); ?>
                    <br /><input id="expense_name" type="text" class="form-control" name="exp_category_name" maxlength="255" value="<?php echo set_value('exp_category_name'); ?>"  />
                </p>
                <p>
                    <label for="exp_category_name">Expense category <span class="required">*</span></label>
                    <?php echo form_error('exp_category_name'); ?>
                    <br /><?php echo form_dropdown('expoptions', $expoptions, '', 'class="form-control expense_category"'); ?>
                </p>				<p>				<table class="col-lg-12">				<tr>                        <td colspan="2" class="text-center">Company</td>                        <td colspan="2" class="text-center">Complex</td>                    </tr>                    <tr>                        <td colspan="2"><?php echo form_dropdown('company', $company, '', 'class="form-control company"'); ?></td>                        <td colspan="2"><?php echo form_dropdown('complex', $complex, set_value('complex'), 'class="form-control complex"') ?></td>                    </tr>				</table>								</p>


                <p class="monthtype" >
                <table id="monthtypeitem" class="col-lg-12" style="display:none">
                    
                    <tr>
                        <td colspan="2" class="text-center">From</td>
                        <td colspan="2" class="text-center" >To</td>
                    </tr>
                    <tr>
                        <td >
                            <select id="fromyear" class="form-control">
                                <option value='2015' >2015</option>
                                <option value="2016" >2016</option>
                                <option value="2017" >2017</option>
                                <option value="2018" >2018</option>
                                <option value="2019" >2019</option>


                            </select>
                        </td><td>
                            <select id="frommonth" class="form-control">
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
                        </td>
                        <td >
                            <select id="toyear" class="form-control">
                                <option value='2015' >2015</option>
                                <option value="2016" >2016</option>
                                <option value="2017" >2017</option>
                                <option value="2018" >2018</option>
                                <option value="2019" >2019</option>

                            </select>
                        </td><td>
                            <select id="tomonth" class="form-control">
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
                        </td>


                    </tr>


                </table>



                </p>

                <p>
                    <label for="amount">Amount <span class="required">*</span></label>
                    <?php echo form_error('amount'); ?>
                    <br /><input id="amount" type="text" class="form-control" name="cat_description" maxlength="255" value="0"  />
                </p>
               <p>
                    <label for="dateofexpense">Date of Expense <span class="required">*</span></label>
                    <?php //echo form_error('dateofexpense'); ?>
                    <br /><input id="dateofexpense" type="text" class="form-control bs_datepicker bsd_format1" name="dateofexpense" maxlength="255" value="<?php echo date('Y-m-d') ?>"  />
                </p>
                <p>
                    <label for="expense_note">Note <span class="required">*</span></label>
                    <?php echo form_error('expense_note'); ?>
                    <br /><input id="expense_note" type="text" class="form-control" name="cat_description" maxlength="255" value="Please Note here"  />
                </p>




                <p>
                    <?php //echo form_submit('button', 'button', "class='btn submit btn-danger'"); ?>

                    <input type="button" onclick="save()" class="btn submit btn-danger" value="Submit" name="button">
                </p>

                <?php echo form_close(); ?>

                <!--------------------------------------------------------Content will be End From Here ----------------------------------->	
            </div><!--/.row--			
            <!-- project team & activity end -->

        </section>
    </section>
    <!--main content end-->
</section>
<script>
                        $(document).ready(function() {
                            /* for complex with company start */
                            $("#extype").change(function() {
                                var extype = $('#extype').val();

                                if (extype == 1) {
                                    $('#monthtypeitem').css('display', 'table');
                                }
                                else {
                                    $('#monthtypeitem').css('display', 'none');
                                }

                            });

                        });
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
        /* for complex with company start */
       
        /* for complex with company start */
    });
    function save(){
    

            var extype = $('#extype').val();
            var expense_category = $('.expense_category').val();
            var expense_name = $('#expense_name').val();
            var company = $('.company').val();
            var complex = $('.complex').val();
            var fromyear = $('#fromyear').val();
            var frommonth = $('#frommonth').val();
            var toyear = $('#toyear').val();
            var tomonth = $('#tomonth').val();
            var amount = $('#amount').val();
            var dateofexpense = $('#dateofexpense').val();
            var expense_note = $('#expense_note').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>expense/save",
                data: {
                    extype: extype,
                    expense_name: expense_name,
                    expense_category: expense_category,
                    company: company,
                    complex: complex,
                    fromyear:fromyear,
                    frommonth:frommonth,
                    toyear:toyear,
                    tomonth:tomonth,
                    amount:amount,
                    dateofexpense:dateofexpense,
                    expense_note:expense_note
                }
            })
                    .done(function(msg) {
                alert(msg);
                location.reload();
            });
       
    
    }
    
</script>
<?php echo $footer; ?>