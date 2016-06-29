
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hotllines</h2>
                    <?php echo $this->session->flashdata('msg'); ?>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <?php
                    if(!empty($hotlines))
                    {
                  ?>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Number</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $count = 1;
                        foreach($hotlines as $h)
                        {
                        ?>
                          <tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo $h->hotline_name;?></td>
                            <td><?php echo $h->hotline_number;?></td>
                          </tr>
                        <?php
                          $count++;
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

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
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
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>production/js/custom.js"></script>


    <script type="text/javascript">
        $('#confirm-quit').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
  </body>

</html>
