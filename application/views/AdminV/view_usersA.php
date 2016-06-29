        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <?php
                    echo $this->session->flashdata('update_one_user');
                    echo $this->session->flashdata('msg');
                  ?>
                  <div class="x_title">
                    <h2>View Users</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Email Address</th>
                                            <th>Username</th>
                                            <th>SBU</th>
                                            <th>Position</th>
                                            <th>Rank</th>
                                            <th colspan="2">Action</th>
                                            <th>QuitClaim</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 0.90em;">
                                        <?php
                                            foreach($users as $u)
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$u->user_employeeID.'</td>';
                                                echo '<td>'.$u->user_firstname." ".$u->user_middlename." ".$u->user_lastname.'</td>';
                                                echo '<td>'.$u->user_email.'</td>';
                                                echo '<td>'.$u->user_username.'</td>';
                                                echo '<td>'.$u->user_sbu.'</td>';
                                                echo '<td>'.$u->user_positiontitle.'</td>';
                                                echo '<td>'.$u->user_rank.'</td>';
                                                echo '<td>'?><a href="<?php echo base_url();?>admin/edit_user/<?php echo $u->user_employeeID?>">Edit</a><?php '</td>';
                                                echo '<td>';
                                                if($u->user_active == 1)
                                                {

                                                    ?><a href="#" data-href="<?php echo base_url();?>Admin/deactivate_user/<?php echo $u->user_employeeID?>" data-toggle="modal" data-target="#confirm-deactivate">Deactivate</a><?php echo '</td>';
                                                }
                                                else
                                                {
                                                    ?><a href="#" data-href="<?php echo base_url();?>Admin/activate_user/<?php echo $u->user_employeeID?>" data-toggle="modal" data-target="#confirm-activate">Activate</a><?php echo '</td>';
                                                }

                                                if($u->user_isquitclaim == 0)
                                                {
                                                echo '<td>'?>  <a href="#" data-href="<?php echo base_url();?>admin/activate_quitclaim/<?php echo $u->user_employeeID?>/<?php echo $u->user_lastname?>/<?php echo $u->user_sbu?>" data-toggle="modal" data-target="#confirm-quit">Quitclaim</a><?php '</td>';
                                                }
                                                else
                                                {
                                                  echo '<td>'?>  <a href="#" data-href="<?php echo base_url();?>admin/deactivate_quitclaim/<?php echo $u->user_employeeID?>/<?php echo $u->user_lastname?>/<?php echo $u->user_sbu?>" data-toggle="modal" data-target="#confirm-quit">Deactivate</a><?php '</td>';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered by <a href="#">Jollibee Foods Corporation</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

        <!-- jQuery -->
    <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>production/js/custom.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

    <script type="text/javascript">
$('#confirm-deactivate').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

<script type="text/javascript">
$('#confirm-activate').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

<script type="text/javascript">
$('#confirm-quit').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});


</script>
  </body>
</html>
