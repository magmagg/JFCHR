          <div id="page-wrapper" class="bg">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="color: white;">Manage Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            Add User
                        </div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-6" style="margin-left: 30%;">
                              <?php echo form_open(base_url()."Admin/add_users"); ?>
                              <?php echo $this->session->flashdata('msg'); ?>
                          
                              <div class="form-group" style="margin-top: 2%;">
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                                <span class="text-danger"> <?php echo form_error('fname'); ?> </span>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
                                <span class="text-danger"> <?php echo form_error('lname'); ?> </span>
                              </div>
                              <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                                <span class="text-danger"> <?php echo form_error('email'); ?> </span>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                <span class="text-danger"> <?php echo form_error('username'); ?> </span>
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <span class="text-danger"> <?php echo form_error('password'); ?> </span>
                              </div>
                              <div class="form-group">
                                <input type="password" class="form-control" id="Cpassword" name="Cpassword" placeholder="Confirm Password">
                                <span class="text-danger"> <?php echo form_error('Cpassword'); ?> </span>
                              </div>
                              <center> <button type="submit" class="btn btn-default">Submit</button> </center>
                                </form>
                                <?php echo form_close(); ?>
                            </div>
                                <!-- /.col-lg-6 (nested) -->
                                <!-- /.col-lg-6 (nested) -->
                          </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
