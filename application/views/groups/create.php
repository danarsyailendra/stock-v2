

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Groups</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">groups</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
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
              <h3 class="box-title">Add Group</h3>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Users</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Channel</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createChannel" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateChannel" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewChannel" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteChannel" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Produk</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProduk" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProduk" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProduk" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProduk" class="minimal"></td>
                      </tr>
                      <!-- <tr>
                        <td>Stores</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteStore" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Attributes</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteAttribute" class="minimal"></td>
                      </tr> -->
                      <tr>
                        <td>Work Orders</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWorkorder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWorkorder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWorkorder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWorkorder" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Overtimes</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createLembur" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateLembur" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewLembur" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteLembur" class="minimal"></td>
                      </tr>
                      <!-- <tr>
                        <td>Orders</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteOrder" class="minimal"></td>
                      </tr>
                      <tr>
                        <td>Reports</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewReports" class="minimal"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr> -->
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile" class="minimal"></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('groups/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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
    $("#mainGroupNav").addClass('active');
    $("#addGroupNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>

