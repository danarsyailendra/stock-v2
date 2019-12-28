

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Overtime</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Overtime</li>
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
            <h3 class="box-title">Add Overtime</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>


                <div class="form-group">
                  <label for="tgl_mulai">Tanggal Mulai Lembur</label>
                  <input type="text" class="form-control datepicker" id="tgl_mulai" name="tgl_mulai" placeholder="Enter Start Overtime Date" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="tgl_akhir">Tanggal Akhir Lembur</label>
                  <input type="text" class="form-control datepicker" id="tgl_akhir" name="tgl_akhir" placeholder="Enter End Overtime Date" autocomplete="off" />
                </div>

               <div class="form-group">
                  <label for="wo_name_overtime">Nama WO</label>
                  <select class="form-control select_group" id="wo_name_overtime" name="wo_name_overtime[]" multiple="multiple">
                    <?php foreach ($wo as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['wo_name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="ket_overtime">Keterangan</label>
                  <textarea type="text" class="form-control" id="ket_overtime" name="ket_overtime" placeholder="Enter description" autocomplete="off">
                  </textarea>
                </div>

                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('lembur/') ?>" class="btn btn-warning">Back</a>
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

    $("#mainLemburNav").addClass('active');
    $("#addLemburNav").addClass('active');

    $('.datepicker').datepicker({
       autoclose:true 
    });
  });
</script>