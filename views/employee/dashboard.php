<?php echo $header; ?>
<section id="container" class="">     
    <?php echo $topbar; ?>
    <?php echo $sidebar; ?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-user-md"></i>Employee Dashboard</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="icon_documents_alt"></i>Pages</li>
                        <li><i class="fa fa-user-md"></i>Profile</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                                <h4><?php echo $basic[0]->employee_name; ?></h4>               
                                <div class="follow-ava">
                                    <img src="<?php echo base_url(); ?>asset/img/profile-widget-avatar.jpg" alt="">
                                </div>
                                <h6>Employee</h6>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p><?php echo $basic[0]->present_address; ?></p>
                                <p><i class="fa fa-phone"><?php echo $basic[0]->contact_number; ?></i></p>
                                <p><i class="fa fa-twitter"><?php echo $basic[0]->emp_email; ?></i></p>
                                <h6>
                                    
                                </h6>
                            </div>
                            <div class="col-lg-2 col-sm-6 follow-info weather-category">
                                <ul>
                                    <li class="active">

                                        <i class="fa fa-home fa-2x"> </i><br>
                                        <div class="count"><?php echo $debit_amount; ?></div>
                                        <div class="title">Total Debit</div>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-lg-2 col-sm-6 follow-info weather-category">
                                <ul>
                                    <li class="active">

                                        <i class="fa fa-bell fa-2x"> </i><br>

                                        <div class="count"><?php echo $credit_amount; ?></div>
                                        <div class="title">Total Credit</div>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-lg-2 col-sm-6 follow-info weather-category">
                                <ul>
                                    <li class="active">

                                        <i class="fa fa-tachometer fa-2x"> </i><br>

                                        <div class="count"><?php echo ($credit_amount-$debit_amount); ?></div>
                                        <div class="title">Balance</div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading tab-bg-info">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#recent-activity">
                                        
                                        Account History
                                    </a>
                                </li>
                                <!--
                                <li class="">
                                    <a data-toggle="tab" href="#shop-list">
                                        <i class="icon-envelope"></i>
                                        Shop List
                                    </a>
                                </li>
                                -->
                                <li class="">
                                    <a data-toggle="tab" href="#edit-profile">
                                        
                                        Payment( Debit/Credit)
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#profile">
                                        
                                        Profile Details
                                    </a>
                                </li>

                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">


                                <div id="recent-activity" class="tab-pane active">
                                    <div class="profile-activity">                                          

                                        <?php //print_r($billing_history); ?>


                                        <table class="table table-striped table-advance table-hover">
                                            <tbody>


                                                <tr>
                                                    <th width="150px" >Bill ID</th>
                                                    <th width="150px">Transection Type</th>
                                                    <th width="100px">Pay Type</th>
                                                    <th>Note</th>
                                                    <th width="150px" >Debit</th>
                                                    <th width="150px" >Credit</th>
                                                    <th width="150px">Date</th>

                                                </tr>
                                                <?php foreach ($billing_history as $bill) { ?>
                                                    <tr>
                                                        <td><?php echo $bill->emp_bill_id; ?></td>
                                                        <td><?php echo $bill->transection_type; ?></td>
                                                        <td><?php echo $bill->payment_type; ?></td>

                                                        <td><?php echo $bill->note; ?></td>
                                                        <td><?php echo $bill->debit; ?></td>
                                                        <td><?php echo $bill->credit; ?></td>
                                                        <td><?php echo $bill->	date; ?></td>
                                                       


                                                    </tr>
                                                <?php } ?>


                                            </tbody>
                                        </table>                                       

















                                    </div>
                                </div>



                               






                                <!-- profile -->
                                <div id="profile" class="tab-pane">
                                    <section class="panel">
                                        <div class="bio-graph-heading">
                                            Employee Profile Details
                                        </div>
                                        <div class="panel-body bio-graph-info">
                                            <h1>Bio Graph</h1>
                                            <div class="row">
                                                <div class="bio-row">
                                                    <p><span>Name</span>: <?php echo $basic[0]->employee_name; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Father</span>: <?php echo $basic[0]->father_name; ?></p>
                                                </div>                                              
                                                <div class="bio-row">
                                                    <p><span>Husband</span>: <?php echo $basic[0]->emp_husband_name; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Mother Name</span>: <?php echo $basic[0]->emp_mother_name; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Address</span>: <?php echo $basic[0]->present_address; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Blood Group </span>:<?php echo $basic[0]->blood_group; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Joining Date</span>: <?php echo $basic[0]->joining_date; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Qualification</span>:  <?php echo $basic[0]->qualification; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section>
                                        <div class="row">                                              
                                        </div>
                                    </section>
                                </div>



                                <!-- edit-profile -->
                                <div id="edit-profile" class="tab-pane">
                                    <section class="panel">                                          
                                        <div class="panel-body bio-graph-info">
                                            <?php ?>



                                            <h1>Payment</h1>
                                            <form class="form-horizontal" role="form">                                                  
                                              
                                                <div class="form-group">

                                                    <div class="col-lg-12">
                                                        <ul>
                                                            <li style="float:left;padding-right:20px;">Payment Type:<br><span>
                                                                    <select id="transection_type" class="form-control">
                                                                        <option value="credit" >Credit( Deposit )</option>
                                                                        <option value="debit">Debit ( Withdraw )</option>
                                                                    </select>
                                                                    
                                                            </li>
                                                            <li style="float:left;padding-right:20px;"><span>Note:<br>
                                                                    <input class="form-control" id="note" type="text" value="No note yet" />
                                                                    <input class="form-control" id="employee_id" type="hidden" value="<?php echo $basic[0]->employee_id; ?>" />
                                                                </span></li>
                                                            <li style="float:left;padding-right:20px;"><span>Amount:<br><input id="amount" class="form-control" type="text" value="0" /></li>
                                                            <li style="float:left;padding-right:20px;"><span>Payment Date:<br><input id="paydate" class="form-control datepick" type="text" value="<?php echo date('d-m-Y') ?>" /></span></li>
                                                            <li style="float:left;padding-right:20px;">Payment Type:<br><span>
                                                                    <select id="paytype" class="form-control">
                                                                        <option value="cash" >Cash</option>
                                                                        <option value="cheque">Cheque</option>
                                                                    </select>
                                                                    
                                                            </li>
                                                            

                                                        </ul>

                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-lg-10" style="margin-left:39px">
													<?php
			$session_data = $this->session->userdata('logged_in');		?>
			<?php if(isset($session_data['emptansc'])){ ?>
                                                        <button class="btn btn-primary" onclick="generate_invoice()" type="button">Transection</button>
                                                        <button class="btn btn-danger" type="button">Cancel</button>
                                                    <?php } ?>
													</div>
                                                </div>
                                            </form>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    <!--main content end-->
</section>
<script>

function generate_invoice(){
     
    var transection_type=$('#transection_type').val();
    var note=$('#note').val();
    var employee_id=$('#employee_id').val();
    var amount=$('#amount').val();
    var date=$('#paydate').val();
    var paytype=$('#paytype').val();
    
     $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>employee/invoice",
            data: {
                employee_id: employee_id,
                transection_type:transection_type,
                amount:amount,
                note:note,
                date:date,
                type:paytype}
            })
            .done(function(msg) {
            alert(msg);
            windows.reload();
      });
}                                                                    
</script>







<?php echo $footer; ?>