

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reports
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reports</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="col-md-12 col-xs-12">
            <form class="form-inline" target="_blank" action="<?php echo base_url('reports/woPDF') ?>" method="POST">
                <div class="form-group">
                    <label for="date">Year</label>
                    <select class="form-control" name="year_wo" id="year_wo">
                        <!--<?php foreach ($report_years as $key => $value): ?>
                            <option value="<?php echo $value ?>" <?php
                            if ($value == $selected_year) {
                                echo "selected";
                            }
                            ?>><?php echo $value; ?></option>
                        <?php endforeach ?>-->
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020" selected="">2020</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Export to PDF</button>
            </form>
        </div>

        <br /> <br />



        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Workorder - Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="manageTableWO" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nomor WO</th>
                            <th>Nama WO</th>
                            <th>Nama Marketing</th>
                            <th>Bobot</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="col-md-12 col-xs-12">
            <form class="form-inline" target="_blank" action="<?php echo base_url('reports/otPDF') ?>" method="POST">
                <div class="form-group">
                    <label for="date">Year</label>
                    <select class="form-control" name="year_ot" id="year_ot">
                        <!--<?php foreach ($report_years as $key => $value): ?>
                                <option value="<?php echo $value ?>" <?php
                            if ($value == $selected_year) {
                                echo "selected";
                            }
                            ?>><?php echo $value; ?></option>
                        <?php endforeach ?>-->
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020" selected="">2020</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Export to PDF</button>
            </form>
        </div><br><br>
        <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Overtime - Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="manageTableOvertime" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal Mulai Lembur</th>
                            <th>Tanggal Akhir Lembur</th>
                            <th>Nama WO</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="col-md-12 col-xs-12">
            <form class="form-inline" target="_blank" action="<?php echo base_url('reports/karyawanPDF') ?>" method="POST">
                <button type="submit" class="btn btn-default">Export to PDF</button>
            </form>
        </div><br><br>
        <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Karyawan - Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="manageTableKaryawan" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="col-md-12 col-xs-12">
            <form class="form-inline" target="_blank" action="<?php echo base_url('reports/channelPDF') ?>" method="POST">
                <button type="submit" class="btn btn-default">Export to PDF</button>
            </form>
        </div><br><br>
        <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Channel - Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="manageTableChannel" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Channel</th>
                            <th>Nama PIC</th>
                            <th>No. HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="col-md-12 col-xs-12">
            <form class="form-inline" target="_blank" action="<?php echo base_url('reports/productPDF') ?>" method="POST">
                <button type="submit" class="btn btn-default">Export to PDF</button>
            </form>
        </div><br><br>
        <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Produk - Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="manageTableProduct" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="col-md-12 col-xs-12">
            <form class="form-inline" target="_blank" action="<?php echo base_url('reports/groupPDF') ?>" method="POST">
                <button type="submit" class="btn btn-default">Export to PDF</button>
            </form>
        </div><br><br>
        <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Group - Report</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="manageTableGroup" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Group Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

    $(document).ready(function () {
        $("#reportNav").addClass('active');
    });
    var manageTable;
    var base_url = "<?php echo base_url(); ?>";
    var report_data = <?php echo '[' . implode(',', $results) . ']'; ?>;
    var manageTableOvertime;


    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */
        var areaChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    label: 'Electronics',
                    fillColor: 'rgba(210, 214, 222, 1)',
                    strokeColor: 'rgba(210, 214, 222, 1)',
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: report_data
                }
            ]
        }

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChart = new Chart(barChartCanvas)
        var barChartData = areaChartData
        barChartData.datasets[0].fillColor = '#00a65a';
        barChartData.datasets[0].strokeColor = '#00a65a';
        barChartData.datasets[0].pointColor = '#00a65a';
        var barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        }

        barChartOptions.datasetFill = false
        barChart.Bar(barChartData, barChartOptions)
    });
    manageTable = $('#manageTableWO').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': base_url + 'reports/fetchWorkorderData',
            'data': function (data) {
                data.year = $('#year_wo').val();
                console.log(data);
            }
        },
        'order': []
    });
    $('#year_wo').change(function () {
        manageTable.draw();
    });
    manageTableOvertime = $('#manageTableOvertime').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': base_url + 'reports/fetchOvertimeData',
            'data': function (data) {
                data.year = $('#year_ot').val();
            }
        },
        'order': []
    });
    $('#year_ot').change(function () {
        manageTableOvertime.draw();
    });
    manageTableKaryawan = $('#manageTableKaryawan').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': base_url + 'reports/fetchKaryawanData',
            'data': function (data) {
            }
        },
        'order': []
    });
    manageTableChannel = $('#manageTableChannel').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': base_url + 'reports/fetchChannelData',
            'data': function (data) {
            }
        },
        'order': []
    });
    manageTableProduct = $('#manageTableProduct').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': base_url + 'reports/fetchProductData',
            'data': function (data) {
            }
        },
        'order': []
    });
    manageTableGroup = $('#manageTableGroup').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': base_url + 'reports/fetchGroupData',
            'data': function (data) {
            }
        },
        'order': []
    });
</script>
