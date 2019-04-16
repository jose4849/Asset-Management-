<!-- container section start -->

<!-- javascripts -->
<script src="<?php echo base_url(); ?>asset/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery-ui-1.10.4.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-ui-1.9.2.custom.min.js"></script>
<!-- bootstrap -->
<script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
<!-- nice scroll -->
<script src="<?php echo base_url(); ?>asset/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.nicescroll.js" type="text/javascript"></script>
<!-- charts scripts -->
<script src="<?php echo base_url(); ?>asset/assets/img/jquery-knob/<?php echo base_url(); ?>asset/js/jquery.knob.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/assets/img/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?php echo base_url(); ?>asset/js/owl.carousel.js" ></script>
<!-- jQuery full calendar -->
<<script src="<?php echo base_url(); ?>asset/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="<?php echo base_url(); ?>asset/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
<!--script for this page only-->
<script src="<?php echo base_url(); ?>asset/js/calendar-custom.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.rateit.min.js"></script>
<!-- custom select -->
<script src="<?php echo base_url(); ?>asset/js/jquery.customSelect.min.js" ></script>
<script src="<?php echo base_url(); ?>asset/assets/img/chart-master/Chart.js"></script>

<!--custome script for all page-->
<script src="<?php echo base_url(); ?>asset/js/scripts.js"></script>
<!-- custom script for this page-->
<script src="<?php echo base_url(); ?>asset/js/sparkline-chart.js"></script>
<script src="<?php echo base_url(); ?>asset/js/easy-pie-chart.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url(); ?>asset/js/xcharts.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.autosize.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.placeholder.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/gdp-data.js"></script>	
<script src="<?php echo base_url(); ?>asset/js/morris.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/sparklines.js"></script>	
<script src="<?php echo base_url(); ?>asset/js/charts.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/bootstrap-datepicker.js"></script>


<!-- <script type="text/javascript" src="<?php echo base_url(); ?>asset/date/bootstrap/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript">

    $('.form_date').datetimepicker({
        language: 'fr',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });

</script>   -->
<script type="text/javascript">
    $('.bs_datepicker.bsd_format1').datepicker({
        format: 'yyyy-mm-dd',
        orientation: "bottom"
    });

    $('.bs_datepicker.bsd_format2').datepicker({
        format: 'dd-mm-yyyy',
        orientation: "bottom"
    });
</script>

<script>

    //knob
    $(function() {
        $(".knob").knob({
            'draw': function() {
                $(this.i).val(this.cv + '%')
            }
        })
    });

    //carousel
    $(document).ready(function() {
        $("#owl-slider").owlCarousel({
            navigation: true,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true

        });
    });

    //custom select box

    $(function() {
        $('select.styled').customSelect();
    });

    /* ---------- Map ---------- */
    $(function() {
        $('#map').vectorMap({
            map: 'world_mill_en',
            series: {
                regions: [{
                        values: gdpData,
                        scale: ['#000', '#000'],
                        normalizeFunction: 'polynomial'
                    }]
            },
            backgroundColor: '#eef3f7',
            onLabelShow: function(e, el, code) {
                el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
            }
        });
    });



</script>

</body>
</html>
