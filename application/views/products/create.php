

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

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Add Work Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>


                <div class="form-group">
                  <label for="nomor_wo">Nomor WO</label>
                  <input type="text" class="form-control" id="nomor_wo" name="nomor_wo" placeholder="Enter Nomor WO" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="wo_name">Nama WO</label>
                  <input type="text" class="form-control" id="wo_name" name="wo_name" placeholder="Enter Nama WO" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="channel_name">Nama Channel</label>
                  <select class="form-control select_group" id="channel_name" name="channel_name[]" multiple="multiple">
                    <?php foreach ($brands as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="produk_name">Produk</label>
                  <select class="form-control select_group" id="produk_name" name="produk_name[]" multiple="multiple">
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="marketing_name">Nama Marketing</label>
                  <input type="text" class="form-control" id="marketing_name" name="marketing_name" placeholder="Enter Nama Marketing" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="bobot">Bobot</label>
                  <input type="text" class="form-control" id="bobot" name="bobot" placeholder="Enter Bobot" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="input_date">Tanggal Input</label>
                  <input type="text" class="form-control" id="input_date" name="input_date" placeholder="Enter Tanggal Input" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="deadline">Deadline</label>
                  <input type="text" class="form-control" id="deadline" name="deadline" placeholder="Enter Deadline" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="catatan">Catatan</label>
                  <textarea type="text" class="form-control" id="catatan" name="catatan" placeholder="Enter Catatan" autocomplete="off">
                  </textarea>
                </div>

                <div class="form-group">

                  <label for="product_image">Lampiran</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
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
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#addProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
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
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>