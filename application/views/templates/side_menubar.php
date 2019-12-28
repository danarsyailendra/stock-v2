<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php if($user_permission): ?>
          <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
            <li class="treeview" id="mainUserNav">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if(in_array('createUser', $user_permission)): ?>
              <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
              <?php endif; ?>

              <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
              <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
            <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="mainGroupNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Groups</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Add Group</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Manage Groups</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>


          <?php if(in_array('createChannel', $user_permission) || in_array('updateChannel', $user_permission) || in_array('viewChannel', $user_permission) || in_array('deleteChannel', $user_permission)): ?>
            <li id="channelNav">
              <a href="<?php echo base_url('channel/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span>Channel</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createProduk', $user_permission) || in_array('updateProduk', $user_permission) || in_array('viewProduk', $user_permission) || in_array('deleteProduk', $user_permission)): ?>
            <li id="produkNav">
              <a href="<?php echo base_url('produk/') ?>">
                <i class="fa fa-files-o"></i> <span>Produk</span>
              </a>
            </li>
          <?php endif; ?>
          

          <?php if(in_array('createWorkorder', $user_permission) || in_array('updateWorkorder', $user_permission) || in_array('viewWorkorder', $user_permission) || in_array('deleteWorkorder', $user_permission)): ?>
            <li class="treeview" id="mainWorkorderNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Work Order</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createWorkorder', $user_permission)): ?>
                  <li id="addWorkorderNav"><a href="<?php echo base_url('workorder/create') ?>"><i class="fa fa-circle-o"></i> Add WO</a></li>
                <?php endif; ?>
                <?php if(in_array('updateProduct', $user_permission) || in_array('viewWorkorder', $user_permission) || in_array('deleteWorkorder', $user_permission)): ?>
                <li id="manageWorkorderNav"><a href="<?php echo base_url('workorder') ?>"><i class="fa fa-circle-o"></i> Manage WO</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createLembur', $user_permission) || in_array('updateLembur', $user_permission) || in_array('viewLembur', $user_permission) || in_array('deleteLembur', $user_permission)): ?>
            <li class="treeview" id="mainWorkorderNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span>Overtime</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createLembur', $user_permission)): ?>
                  <li id="addLemburNav"><a href="<?php echo base_url('lembur/create') ?>"><i class="fa fa-circle-o"></i> Add Overtime</a></li>
                <?php endif; ?>
                <?php if(in_array('updateLembur', $user_permission) || in_array('viewLembur', $user_permission) || in_array('deleteLembur', $user_permission)): ?>
                <li id="manageLemburNav"><a href="<?php echo base_url('lembur') ?>"><i class="fa fa-circle-o"></i> Manage Overtime</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>


          <?php if(in_array('viewReports', $user_permission)): ?>
            <li id="reportNav">
              <a href="<?php echo base_url('reports/') ?>">
                <i class="glyphicon glyphicon-stats"></i> <span>Reports</span>
              </a>
            </li>
          <?php endif; ?>


         

        

        <!-- <li class="header">Settings</li> -->

        <?php if(in_array('viewProfile', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span>Profile</span></a></li>
        <?php endif; ?>
        <?php if(in_array('updateSetting', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Setting</span></a></li>
        <?php endif; ?>

        <?php endif; ?>
        <!-- user permission info -->
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>