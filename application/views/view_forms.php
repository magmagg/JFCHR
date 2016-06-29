
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Available Forms</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th style="width: 23%;">Date Uploaded</th>
                          <th style="width: 15%;">Type</th>
                          <th style="width: 10%;">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php

                        foreach($documents as $d)
                        {
                          if($d->document_active == 1)
                          {

                      ?>
                        <tr>
                          <td><?php echo $d->document_title; ?></td>
                          <td><?php echo $d->document_timestamp; ?></td>
                          <td><?php echo $d->document_category; ?></td>
                          <td><a href="<?php echo base_url();?>user/download_document/<?php echo $d->document_filename?>">Download</a></td>
                        </tr>

                      <?php
                          }
                        }
                      ?>

                      </tbody>
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
    <!-- FastClick -->
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>production/js/custom.js"></script>

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

    <!-- /gauge.js -->
  </body>

</html>
