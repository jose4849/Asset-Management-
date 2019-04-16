<?php echo $header; ?>
<section id="container" class="">     
    <?php echo $topbar; ?>
    <?php echo $sidebar; ?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-user-md"></i>Tenant Dashboard</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
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
                                <h4><?php echo $basic[0]->tenant_name; ?></h4>               
                                <div class="follow-ava">
                                    <img src="<?php echo base_url(); ?>asset/img/profile-widget-avatar.jpg" alt="">
                                </div>
                                <h6>Tenant</h6>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p><?php echo $basic[0]->address; ?></p>
                                <p><i class="fa fa-phone"><?php echo $basic[0]->tenant_phone; ?></i></p>
                                <p><i class="fa fa-twitter"><?php echo $basic[0]->tenant_mobile; ?></i></p>
                                <h6>
<!--                                    <span><i class="icon_clock_alt"></i>11:05 AM</span>
                                    <span><i class="icon_calendar"></i>25.10.13</span>
                                    <span><i class="icon_pin_alt"></i>NY</span>-->
                                </h6>
                            </div>
                            <div class="col-lg-2 col-sm-6 follow-info weather-category">
                                <ul>
                                    <li class="active">

                                        <i class="fa fa-home fa-2x"> </i><br>
                                        <div class="count"><?php echo count($booking); ?></div>
                                        <div class="title">Shop</div>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-lg-2 col-sm-6 follow-info weather-category">
                                <ul>
                                    <li class="active">

                                        <i class="fa fa-bell fa-2x"> </i><br>

                                        <div class="count"><?php echo $dueamount; ?></div>
                                        <div class="title">Due</div>
                                    </li>

                                </ul>
                            </div>
                            <div class="col-lg-2 col-sm-6 follow-info weather-category">
                                <ul>
                                    <li class="active">

                                        <i class="fa fa-tachometer fa-2x"> </i><br>

                                        <div class="count"><?php echo $asamount; ?></div>
                                        <div class="title">Total Paid</div>
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

                                        Billing History
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#shop-list">

                                        Shop List
                                    </a>
                                </li>
                                <li class="">
                                    <a data-toggle="tab" href="#edit-profile">

                                        Bill Pay
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
                                                    <th>Bill ID</th>
                                                    <th>Shop Info</th>
                                                    <th>Year/Month</th>
                                                    <th>Amount</th>
                                                    <th>Generate Date</th>
                                                    <th>Status</th>

                                                </tr>
                                                <?php foreach ($billing_history as $bill) { ?>
                                                    <tr>
                                                        <td><?php echo $bill->bill_id; ?></td>
                                                        <td><?php echo $bill->complex_name."(".$bill->shop.")"; ?></td>
                                                        <td><?php echo $bill->year; ?>/<?php echo getMonthNumber($bill->month); ?></td>

                                                        <td><?php echo $bill->amount; ?></td>
                                                        <td><?php echo $bill->date; ?></td>
                                                        <td><?php
                                                            $bill_status = $bill->bill_status;
                                                            if ($bill_status == 1) {
                                                                echo 'Paid';
																 
                                                            } else {
                                                                echo '<a style="color:red;">Unpaid</a>';
																?>
																<a href="#" onclick="removebill('<?php echo $bill->bill_id; ?>')" class="btn btn-danger"><i class="icon_close_alt2"></i></a>
																<?php
                                                            }
                                                            ?></td>


                                                    </tr>
                                                <?php } ?>


                                            </tbody>
                                        </table>                                       

















                                    </div>
                                </div>



                                <!--- shop list ------->
                                <div id="shop-list" class="tab-pane">
                                    <div class="shop-list">   



                                        <!-------------------advance and refaund------------------------------------>
                                        <form role="form" class="form-horizontal">                                                  
                                            <div class="form-group">

                                                <div class="col-lg-6">
                                                    <span style="padding-left: 39px; line-height: 35px ! important;"><strong style="">Operations</strong><br></span>

                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <div class="col-lg-12">
                                                    <ul>
                                                        <li style="float:left;padding-right:20px;">
                                                            <span>Booking ID<br>
                                                                <input type="text" id="booking_id_op" value="" class="form-control" >

                                                            </span>
                                                        </li>
                                                        <li style="float:left;padding-right:20px;"><span>Amount:<br><input type="text" class="form-control" value="0" id="amount_op"></span></li>
                                                        <li style="float:left;padding-right:20px;"><span>Payment Date:<br><input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>"  id="paydate_op" ></span></li>
                                                        <li style="float:left;padding-right:20px;">Payment Type:<br><span>
                                                                <select class="form-control" id="paytype_op">
                                                                    <option value="cash">Cash</option>

                                                                </select>

                                                            </span>
                                                        </li>
                                                        <li>
                                                            Payment Type:<br><span>
															    <?php $session_data = $this->session->userdata('logged_in');?>
																<?php if(isset($session_data['advance'])){ ?>
                                                                <a  onclick="advance()" class="btn btn-primary">Add Advance</a>
																<?php } if(isset($session_data['refund'])){ ?>
                                                                <a onclick="refaund()" class="btn btn-primary" >Refund</a>
																<?php } if(isset($session_data['unbooked'])){ ?>
                                                                <a onclick="unbooked()" class="btn btn-primary">Unbooked</a>
																<?php } ?>
                                                            </span>
                                                        </li>

                                                    </ul>

                                                </div>
                                            </div>   
                                        </form>
                                        <br>
                                        <script>
										function removebill(bill_id){
											$.ajax({
												type: "POST",
												url: "<?php echo base_url(); ?>rent/removebill",
                                                data: {bill_id: bill_id}
                                                }).done(function(msg) { location.reload();});
										}
										
										
                                                                function advance() {
                                                                    var booking_id = $('#booking_id_op').val();
                                                                    var amount_op = $('#amount_op').val();
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "<?php echo base_url(); ?>shop/add_advance",
                                                                        data: {booking_id: booking_id, amount_op: amount_op,tenant_id:'<?php echo $basic[0]->tenant_id; ?>'}
                                                                    })
                                                                            .done(function(msg) {
                                                                        //alert(msg);
                                                                        window.location.href = "<?php echo base_url(); ?>reports/invoice/" + msg + "";

                                                                    });
                                                                }
                                                                

                                                                function refaund() {
                                                                    var booking_id = $('#booking_id_op').val();
                                                                    var amount_op = $('#amount_op').val();
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "<?php echo base_url(); ?>shop/refaund",
                                                                        data: {booking_id: booking_id, amount_op: amount_op,tenant_id:'<?php echo $basic[0]->tenant_id; ?>'}
                                                                    })
                                                                            .done(function(msg) {
                                                                        //alert(msg);
                                                                        window.location.href = "<?php echo base_url(); ?>reports/invoice/" + msg + "";

                                                                    });
                                                                }
                                                                function unbooked() {
                                                                    var booking_id = $('#booking_id_op').val();
                                                                    var amount_op = $('#amount_op').val();
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "<?php echo base_url(); ?>shop/unbooked",
                                                                        data: {booking_id: booking_id, amount_op: amount_op,tenant_id:'<?php echo $basic[0]->tenant_id; ?>'}
                                                                    })
                                                                            .done(function(msg) {
                                                                        alert(msg);
                                                                        //window.location.href = "<?php echo base_url(); ?>reports/invoice/" + msg + "";

                                                                    });
                                                                }
                                                                
                                                                
                                                                
                                        </script>
                                        <!-------------------advance and refaund------------------------------------>



                                        <table class="table table-striped table-advance table-hover">
                                            <tbody>


                                                <tr>
                                                    <th>Booking ID</th>
                                                    <th>Company Name</th>
                                                    <th>Complex Name</th>
                                                    <th>Shop</th>
                                                    <th>Floor</th>
                                                    <th>Description</th>
													<th>Rent/month</th>
                                                    <th>Advance</th>
                                                    <th>Booking Status</th>

                                                </tr>
                                                <?php foreach ($booking as $shop) { ?>
                                                    <tr>
                                                        <td><?php echo $shop->booking_id; ?></td>
                                                        <td><?php echo $shop->company_names; ?></td>
                                                        <td><?php echo $shop->complex_name; ?></td>
                                                        <td><?php echo $shop->shop; ?></td>
                                                        <td><?php echo $shop->floor; ?></td>
                                                        <td>No</td>
														<td Title="Click to edit." style="cursor:pointer;" onclick="editrent('<?php echo $shop->totalrent; ?>','<?php echo $shop->booking_id; ?>')">
                                                            <?php echo $shop->totalrent; ?>
													
                                                        </td>														
                                                        <td>
                                                            <?php echo $shop->security_money; ?>

                                                        </td>
                                                        <td>
                                                            <a href="#"><button>Booked</button></a>
															<a target="_blank" href="<?php echo base_url(); ?>shop/rentdetails/<?php echo $shop->shop_id; ?>/<?php echo $shop->booking_id; ?>"><button>Bill Details</button></a>
                                                        </td>

                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>

<script>
function editrent(amount,id){
var newamount = prompt("Please enter new rent amount", amount);
if(amount!=newamount){
 $.ajax({
   type: "POST",
   url: "<?php echo base_url(); ?>shop/bookingupdate",
   data: {booking_id:id,totalrent:newamount}
   })
   .done(function(msg) {
   alert(msg);
   location.reload();
   });
}
}
</script>














                                    </div>
                                </div>                               


                                <!--- shop list end ------->






                                <!-- profile -->
                                <div id="profile" class="tab-pane">
                                    <section class="panel">
                                        <div class="bio-graph-heading">
                                            Customer Profile Details
                                        </div>
                                        <div class="panel-body bio-graph-info">
                                            <h1>Bio Graph</h1>
                                            <div class="row">
                                                <div class="bio-row">
                                                    <p><span>Tenant Name</span>: <?php echo $basic[0]->tenant_name; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Father/Hasband</span>: <?php echo $basic[0]->father_hasband; ?></p>
                                                </div>                                              
                                                <div class="bio-row">
                                                    <p><span>Proprietor</span>: <?php echo $basic[0]->proprietor_name; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Mother Name</span>: <?php echo $basic[0]->mother_name; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Address</span>: <?php echo $basic[0]->address; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>web </span>:<?php echo $basic[0]->tenant_web; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Mobile </span>: <?php echo $basic[0]->tenant_mobile; ?></p>
                                                </div>
                                                <div class="bio-row">
                                                    <p><span>Phone </span>:  <?php echo $basic[0]->tenant_phone; ?></p>
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
													<div class="col-lg-12" style="padding-left: 56px;">
													<input type="checkbox" onclick="resets()" name="utility" value="0" id="utility" />Include Utility ( if checked only one item can choice from list. ) 
													</div>
                                                    <div class="col-lg-6">
                                                        <span style="padding-left: 39px; line-height: 35px ! important;"><strong style="">Item List:</strong><br></span>
                                                        <ul>
                                                            <?php foreach ($billing_unpaid as $bill) { ?>

                                                                <li style="float:left;padding-right:20px;"><span><input name="chkboxName" onchange="showSelectedValues()" id="<?php echo $bill->bill_id; ?>" value="<?php echo $bill->amount; ?>" type="checkbox" data-com="<?php echo $bill->company_id; ?>" data-comx="<?php echo $bill->complex_id; ?>"  data-shopid="<?php echo $bill->shop; ?>" data-mon="<?php echo $bill->month; ?>" data-year="<?php echo $bill->year; ?>" /> 
																</span><?php echo $bill->shop; ?>-(<?php echo $bill->complex_name; ?>)-<?php echo $bill->year; ?>/<?php echo getMonthNumber($bill->month); ?></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-lg-12">
                                                        <ul>
                                                            <li style="float:left;padding-right:20px;"><span>Tenant Name:<br>
                                                                    <input class="form-control"  type="text" value="<?php echo $basic[0]->tenant_name; ?>" />
                                                                    <input class="form-control" type="hidden" value="<?php echo $basic[0]->tenant_id; ?>" />
                                                                </span></li>
                                                            <li style="float:left;padding-right:20px;"><span>Amount:<br><input id="amount" value="0" class="form-control" type="text" value="Amount" /></li>
                                                            <li style="float:left;padding-right:20px;"><span>Payment Date:<br><input id="paydate" class="form-control datepick" type="text" value="<?php echo date('d-m-Y') ?>" /></span></li>
                                                            <li style="float:left;padding-right:20px;">Payment Type:<br><span>
                                                                    <select id="paytype" class="form-control">
                                                                        <option value="cash" >Cash</option>
                                                                        <option value="cheque">Cheque</option>
                                                                    </select>

                                                            </li>
                                                            <li style="float:left;padding-right:20px;">If cheque(Date):<br><span><input class="form-control" id="chequedate" type="text" value="<?php echo date('d-m-Y') ?>" /></span></li>

                                                        </ul>
													
                                                    </div>
													
                                                    <div class="col-lg-12">
													    
                                                        <ul>
                                                            <li style="float:left;padding-right:20px;"><span>Electrical Bill:<br>
                                                                    <input class="form-control"  type="text" id="electrical" value="0" />
                                                                    
                                                                </span></li>
                                                            <li style="float:left;padding-right:20px;"><span>Water:<br>
															<input id="water" value="0" class="form-control" type="text" value="0" /></li>
                                                            <li style="float:left;padding-right:20px;"><span>GAS:<br>
															<input id="gas" value="0" class="form-control" type="text" value="0" />
															</span></li>
                                                            <li style="float:left;padding-right:20px;"><span>Service Charge:<br>
															<input id="service" value="0" class="form-control" type="text" value="0" />       
															<br></span>
                                                            </li>
                                                            <li style="float:left;padding-right:20px;"><br><span></span></li>

                                                        </ul>
													
                                                    </div>													
													
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-lg-10" style="margin-left:39px">
                                                        <button class="btn btn-primary" onclick="generate_invoice()" type="button">Generate Invoice</button>
                                                        <button class="btn btn-danger" type="button">Cancel</button>
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
																function resets(){
																 $('input:checkbox[name=chkboxName]').attr('checked',false);
																}
																
																
                                                                $(document).ready(function() {
																	/* multiple choice start*/

													
																	$("input:checkbox").on('click', function() {
																	  // in the handler, 'this' refers to the box clicked on
																	if ($('#utility').is(":checked"))
																	{
																	  // it is checked 
																		var $box = $(this);
																	  if ($box.is(":checked")) {
																		// the name of the box is retrieved using the .attr() method
																		// as it is assumed and expected to be immutable
																		var group = "input:checkbox[name=chkboxName]";
																		// the checked state of the group/box on the other hand will change
																		// and the current value is retrieved using .prop() method
																		$(group).prop("checked", false);
																		$box.prop("checked", true);
																	  } else {
																		$box.prop("checked", false);
																	  }
																	  // it is checked
																	}
																	});
																	
																	/* multiple choice start*/
																
																
																
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

                                                                function showSelectedValues()
                                                                {
                                                                    var rents = 0;
                                                                    rents = $("input[name=chkboxName]:checked").map(
                                                                            function() {
                                                                                return this.value;
                                                                            }).get().join(",");
                                                                    var partsOfStr = rents.split(',');
                                                                    var total = 0;
                                                                    for (var i = 0; i < partsOfStr.length; i++) {
                                                                        total += partsOfStr[i] << 0;
                                                                    }
                                                                    $('#amount').val(total);


                                                                    $("input[name=chkboxName]:checked").map(
                                                                            function() {
                                                                                return this.id;
                                                                            }).get().join(",");







                                                                }
                                                                function generate_invoice() {
																
																if ($('#utility').is(":checked"))
																	{
																	/* for single item start */
																	var com =$("input[name=chkboxName]:checked").data('com');
																	var comx =$("input[name=chkboxName]:checked").data('comx');
																	var shop =$("input[name=chkboxName]:checked").data('shopid');
																	var month =$("input[name=chkboxName]:checked").data('mon');
																	var year =$("input[name=chkboxName]:checked").data('year');

																
																	/* for multiple item start */
                                                                    var tanent_id = "<?php echo $basic[0]->tenant_id; ?>";
                                                                    var items = $("input[name=chkboxName]:checked").map(function() {
                                                                        return this.id;
                                                                    }).get().join(",");
                                                                    var amount = $('#amount').val();
                                                                    var pay_date = $('#paydate').val();
                                                                    var paytype = $('#paytype').val();
                                                                    var electrical = $('#electrical').val();
                                                                    var water = $('#water').val();
                                                                    var gas = $('#gas').val();
                                                                    var service = $('#service').val();
                                                                    var paytype = $('#paytype').val();
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "<?php echo base_url(); ?>tenant/invoice",
                                                                        data: {tenant_id: tanent_id,
																		items: items,
																		amount: amount,
																		pay_date: pay_date,
																		type: paytype,
																		utility:1,
																		com:com,
																		comx:comx,
																		shop:shop,
																		month:month,
																		year:year,
																		service:service,
																		electrical:electrical,
																		water:water,
																		gas:gas,
																		token:'<?php echo $token=$basic[0]->tenant_id.time(); ?>'
																																				}
                                                                    })
                                                                    .done(function(msg) {
																	console.log(msg);
																	    
																		if(msg=='found'){ alert("Invoice is already insert");}else{
																			window.location.href = "<?php echo base_url(); ?>reports/invoice/" + msg + "";
																		}
                                                                        //

                                                                    });
																	
																    
																
																	/* for single item end */
																	}
																else{
																
																
																	/* for multiple item start */
                                                                    var tanent_id = "<?php echo $basic[0]->tenant_id; ?>";
                                                                    var items = $("input[name=chkboxName]:checked").map(function() {
                                                                        return this.id;
                                                                    }).get().join(",");
                                                                    var amount = $('#amount').val();
                                                                    var pay_date = $('#paydate').val();
                                                                    var paytype = $('#paytype').val();
                                                                    var electrical = $('#electrical').val();
                                                                    var water = $('#water').val();
                                                                    var gas = $('#gas').val();
                                                                    var service = $('#service').val();
                                                                    var paytype = $('#paytype').val();
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "<?php echo base_url(); ?>tenant/invoice",
                                                                        data: {tenant_id: tanent_id,
																		items: items,
																		amount: amount,
																		pay_date: pay_date,
																		type: paytype,
																		utility:0,
																		service:service,
																		electrical:electrical,
																		water:water,
																		gas:gas,
																		token:'<?php echo $token; ?>'
																																				}
                                                                    })
                                                                    .done(function(msg) {
																	console.log(msg);
                                                                        if(msg=='found'){ alert("Invoice is already insert");}else{
																			window.location.href = "<?php echo base_url(); ?>reports/invoice/" + msg + "";
																		}
																		

                                                                    });
																	/* for multiple item end */
																	}
																	
																	
																	
																	
                                                                }
</script>
<?php

function getMonthNumber($monthStr) {
$m = trim($monthStr);
switch ($m) {
    case "01":
        $m = "Jan";
        break;
    case "02":
        $m = "Feb";
        break;
    case "03":
        $m = "Mar";
        break;
    case "04":
        $m = "Apr";
        break;
    case "05":
        $m = "May";
        break;
    case "06":
        $m = "Jun";
        break;
    case "07":
        $m = "Jul";
        break;
    case "08":
        $m = "Aug";
        break;
    case "09":
        $m = "Sep";
        break;
    case "10":
        $m = "Oct";
        break;
    case "11":
        $m = "Nov";
        break;
    case "12":
        $m = "Dec";
        break;
    default:
        break;
}
return $m;
}

?>






<?php echo $footer; ?>