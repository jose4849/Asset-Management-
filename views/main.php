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
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><i class="fa fa-laptop"></i>Dashboard</li>						  	
                    </ol>
                </div>
            </div>
            <div class="row">
                <!--------------------------------------------------------Content will be start From Here ----------------------------------->

             <h1 style="text-align: center; font-weight: bold; margin: 0px;">Lion Asset Management</h1>
                            <h3 style="text-align: center; font-weight: bold; margin: 0px;">Report at Glance- <?php echo date('M'); ?> <?php echo date('Y'); ?></h3><br><br>
                	

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                   <!-- <div class="info-box dark-bg">
                        <div class="count">Bank</div>
                        <div class="count"><?php if($balance>0){ echo $balance; } else{ echo '0'; } ?></div>						
                    </div>/.info-box-->			
                </div><!--/.col-->
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box blue-bg">
<!--                        <i class="fa fa-cloud-download"></i>-->
                        <div class="count">INCOME</div>
                        <div class="count"><?php if($income>0){ echo $income; }else{ echo '0';} ?></div>
<!--                        <div class="title">helllo</div>						-->
                    </div><!--/.info-box-->			
                </div><!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box brown-bg">
                           <div class="count">Expense</div>
                        <div class="count"><?php if($expense>0){ echo $expense; } else{ echo '0'; }  ?></div>
<!--                        <i class="fa fa-shopping-cart"></i>
                        <div class="count">7.538</div>
                        <div class="title"></div>						-->
                    </div><!--/.info-box-->			
                </div><!--/.col-->
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <!--<div class="info-box green-bg">
                        <div class="count">Cash</div>
                        <div class="count"><?php $ca=$cash_in_hand;
                        if($ca==0){ echo '0'; }else{ echo $ca; }
                        ?></div>						
                    </div>info-box-->			
                </div><!--/.col-->
                <!--------------------------------------------------------Content will be End From Here ----------------------------------->	
            </div><!--/.row-->


            <!-- project team & activity end -->

        </section>
    </section>
    <!--main content end-->
</section>
<?php echo $footer; ?>