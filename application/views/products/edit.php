

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
            <h3 class="box-title">Edit Work Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                

                <div class="form-group">
                  <label for="nomor_wo">Nomor WO</label>
                  <input type="text" class="form-control" id="nomor_wo" name="nomor_wo" placeholder="Enter Nomor WO" value="<?php echo $product_data['nomor_wo']; ?>"  autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="wo_name">Nama WO</label>
                  <input type="text" class="form-control" id="wo_name" name="wo_name" placeholder="Enter WO Name" value="<?php echo $product_data['wo_name']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="channel_name">Nama Channel</label>
                  <?php $brand_data = json_decode($product_data['brand_id']); ?>
                  <select class="form-control select_group" id="channel_name" name="channel_name[]" multiple="multiple">
                    <?php foreach ($brands as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $brand_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="produk_name">Nama Produk</label>
                  <?php $category_data = json_decode($product_data['category_id']); ?>
                  <select class="form-control select_group" id="produk_name" name="produk_name[]" multiple="multiple">
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="marketing_name">Nama Marketing</label>
                  <input type="text" class="form-control" id="marketing_name" name="marketing_name" placeholder="Enter Marketing Name" value="<?php echo $product_data['marketing_name']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="bobot">Bobot</label>
                  <input type="text" class="form-control" id="bobot" name="bobot" placeholder="Enter Bobot" value="<?php echo $product_data['bobot']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="input_date">Tanggal Input</label>
                  <input type="text" class="form-control" id="input_date" name="input_date" placeholder="Enter Input Date" value="<?php echo $product_data['input_date']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="deadline">Deadline</label>
                  <input type="text" class="form-control" id="deadline" name="deadline" placeholder="Enter Deadline" value="<?php echo $product_data['deadline']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="catatan">catatan</label>
                  <textarea type="text" class="form-control" id="catatan" name="catatan" placeholder="Enter 
                  catatan" autocomplete="off">
                    <?php echo $product_data['catatan']; ?>
                  </textarea>
                </div>

                <div class="form-group">
                  <label>Lampiran : </label>
                  <img src="<?php echo base_url() . $product_data['image'] ?>" width="150" height="150" class="img-circle">
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
                <a href="<?php echo base_url('users/') ?>" class="btn btn-warning">Back</a>
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
    $("#manageProductNav").addClass('active');
    
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