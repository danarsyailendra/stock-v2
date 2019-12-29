<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage
            <small>Work Order</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Work Order</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">

                <div id="messages"></div>

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
                        <h3 class="box-title">Edit Work Order</h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="<?php echo base_url('workorder/update/' . $workorder_data['id']) ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <?php echo validation_errors(); ?>



                            <div class="form-group">
                                <label for="nomor_wo">Nomor WO</label>
                                <input type="text" class="form-control" id="nomor_wo" name="nomor_wo" placeholder="Enter Nomor WO" value="<?php echo $workorder_data['nomor_wo']; ?>"  autocomplete="off"/>
                            </div>

                            <div class="form-group">
                                <label for="wo_name">Nama WO</label>
                                <input type="text" class="form-control" id="wo_name" name="wo_name" placeholder="Enter WO Name" value="<?php echo $workorder_data['wo_name']; ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="channel">Nama Channel</label>
                                <?php $channel_data = json_decode($workorder_data['channel_name']); ?>
                                <select class="form-control select_group" id="channel" name="channel[]" multiple="multiple">

                                    <?php foreach ($channel as $k => $v): ?>
                                        <?php
                                        if ($channel_data != 'null') {
                                            if (in_array($v['id'], $channel_data)) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $v['id'] ?>" <?php echo $selected ?>><?php echo $v['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="produk">Nama Produk</label>
                                <?php $produk_data = json_decode($workorder_data['produk_name']); ?>
                                <select class="form-control select_group" id="produk" name="produk[]" multiple="multiple">
                                    <?php foreach ($produk as $k => $v): ?>
                                        <?php
                                        if ($produk_data != 'null') {
                                            if (in_array($v['id'], $produk_data)) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                        }
                                        ?>
                                        <option value="<?php echo $v['id'] ?>" <?php echo $selected ?>><?php echo $v['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="marketing_name">Nama Marketing</label>
                                <input type="text" class="form-control" id="marketing_name" name="marketing_name" placeholder="Enter Marketing Name" value="<?php echo $workorder_data['marketing_name']; ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="bobot">Bobot</label>
                                <input type="text" class="form-control" id="bobot" name="bobot" placeholder="Enter Bobot" value="<?php echo $workorder_data['bobot']; ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="input_date">Tanggal Input</label>
                                <input type="text" class="form-control datepicker" id="input_date" name="input_date" placeholder="Enter Input Date" value="<?php echo $workorder_data['input_date']; ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="deadline">Deadline</label>
                                <input type="text" class="form-control datepicker" id="deadline" name="deadline" placeholder="Enter Deadline" value="<?php echo $workorder_data['deadline']; ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <label for="backend">Backend</label>
                                <input type="number" class="form-control" id="backend" name="backend" placeholder="Enter Backend" autocomplete="off" value="<?php echo $workorder_data['backend_days']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="frontend">Frontend</label>
                                <input type="number" class="form-control" id="frontend" name="frontend" placeholder="Enter Frontend" autocomplete="off" value="<?php echo $workorder_data['frontend_days']; ?>"/>
                            </div>
                            <div class="form-group">
                                <label for="qa">QA</label>
                                <input type="number" class="form-control" id="qa" name="qa" placeholder="Enter QA" autocomplete="off" value="<?php echo $workorder_data['qa_days']; ?>"/>
                            </div>


                            <div class="form-group">
                                <label for="catatan">catatan</label>
                                <textarea type="text" class="form-control" id="catatan" name="catatan" placeholder="Enter 
                                          catatan" autocomplete="off">
                                              <?php echo $workorder_data['catatan']; ?>
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label>Lampiran : </label>
                                <?php if ($workorder_data['lampiran']): ?>
                                    <img src="<?php echo base_url() . $workorder_data['lampiran'] ?>" width="150" height="150" class="img-circle">
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="workorder_image">Lampiran</label>
                                <div class="kv-avatar">
                                    <div class="file-loading">
                                        <input id="workorder_image" name="workorder_image" type="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="<?php echo base_url('workorder/') ?>" class="btn btn-warning">Back</a>
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- col-md-12 -->
        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">

    $(document).ready(function () {
        $(".select_group").select2();
        $("#description").wysihtml5();
        $(".datepicker").datepicker({
            autoclose: true
        });

        $("#mainWorkorderNav").addClass('active');
        $("#manageWorkorderNav").addClass('active');

        var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' +
                'onclick="alert(\'Call your custom code here.\')">' +
                '<i class="glyphicon glyphicon-tag"></i>' +
                '</button>';
        $("#workorder_image").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
            layoutTemplates: {main2: '{preview} ' + btnCust + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif"]
        });
        $('#done').on('click', function (e) {
            $.ajax({
                url: '<?php echo base_url('workorder/done') ?>',
                type: "POST",
                dataType: 'json',
                data: {
                    workorder_id: '<?php echo $workorder_data['id'] ?>'
                },
                success: function (response) {
                    console.log('oke');
                },
                error: function (xhr, status, error) {
                    window.location = "<?php echo base_url('workorder') ?>";
                }
            });

        });
    });
</script>