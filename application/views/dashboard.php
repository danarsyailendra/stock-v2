<form id="form_wo" target="_blank" action="<?= base_url('dashboard/woChartPDF/') ?>"  method="post">
    <input type="hidden" id="imagewo" name="imagewo">
</form>
<form id="form_ot" target="_blank" action="<?= base_url('dashboard/otChartPDF/') ?>"  method="post">
    <input type="hidden" id="imageot" name="imageot">
</form>
<form id="form_mix" target="_blank" action="<?= base_url('dashboard/mixChartPDF/') ?>"  method="post">
    <input type="hidden" id="imagemix" name="imagemix">
</form>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <?php if ($is_admin == true): ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-danger" id="wo_box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Workorder</h3>

                            <div class="box-tools pull-right" id="wo_tool">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                <a target="_blank" id="print_wo" class="btn btn-box-tool"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="workorderChart" style="height:250px"></canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-6">
                    <div class="box box-danger" id="ot_box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Overtime</h3>

                            <div class="box-tools pull-right"id="ot_tool">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                <button type="button" id="print_ot" class="btn btn-box-tool"><i class="fa fa-print"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="overtimeChart" style="height:250px"></canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-danger" id="mix_box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Approved WO and Overtime</h3>

                            <div class="box-tools pull-right"id="mix_tool">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                <button type="button" id="print_mix" class="btn btn-box-tool"><i class="fa fa-print"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="overtimeMix" style="height:250px"></canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        <?php endif; ?>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--Workorder-->
<script type="text/javascript">
    $(document).ready(function () {
        $("#dashboardMainMenu").addClass('active');
    });

    $('#print_wo').on('click', function () {
        $('#form_wo').submit();
    });
    function donewo() {
        var image = document.getElementById("workorderChart").toDataURL();
        $('#imagewo').attr('value', image);
    }
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#workorderChart').get(0).getContext('2d');
    var pieChart = new Chart(pieChartCanvas);
    var pie_wo = <?= $pie_wo ?>;
    var PieData = [];
    $.each(pie_wo, function (index, val) {
        var PieSlice = {
            value: val['value'],
            label: val['label'],
            color: val['color'],
            highlight: val['highlight']
        };
        PieData.push(PieSlice);
    });
    //console.log(PieData);
    var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
        bezierCurve: false,
        onAnimationComplete: donewo
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
    //console.log(pieChartCanvas.toDataURL());

</script>
<!--Overtime-->
<script type="text/javascript">
    $('#print_ot').on('click', function () {
        $('#form_ot').submit();
    });
    function doneot() {
        var image = document.getElementById("overtimeChart").toDataURL();
        $('#imageot').attr('value', image);
    }
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvasOt = $('#overtimeChart').get(0).getContext('2d');
    var pieChartOt = new Chart(pieChartCanvasOt);
    var pie_lembur = <?= $pie_lembur ?>;
    var PieData = [];
    $.each(pie_lembur, function (index, val) {
        var PieSlice = {
            value: val['value'],
            label: val['label'],
            color: val['color'],
            highlight: val['highlight']
        };
        PieData.push(PieSlice);
    });
    //console.log(PieData);
    var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
        bezierCurve: false,
        onAnimationComplete: doneot
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChartOt.Doughnut(PieData, pieOptions)
</script>
<!--Mix-->
<script type="text/javascript">
    $('#print_mix').on('click', function () {
        $('#form_mix').submit();
    });
    function donemix() {
        var image = document.getElementById("overtimeMix").toDataURL();
        $('#imagemix').attr('value', image);
    }
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvasMix = $('#overtimeMix').get(0).getContext('2d');
    var pieChartMix = new Chart(pieChartCanvasMix);
    var pie_mix = <?= $pie_mix ?>;
    var PieData = [];
    $.each(pie_mix, function (index, val) {
        var PieSlice = {
            value: val['value'],
            label: val['label'],
            color: val['color'],
            highlight: val['highlight']
        };
        PieData.push(PieSlice);
    });
    //console.log(PieData);
    var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
        bezierCurve: false,
        onAnimationComplete: donemix
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChartMix.Doughnut(PieData, pieOptions)
</script>
