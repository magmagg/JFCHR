        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>Hotlines</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <?php
                    if(!empty($hotlines))
                    {
                  ?>

                      <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="dataTables-example">
                          <thead>
                            <tr class="headings">
                              <th class="column-title">Name </th>
                              <th class="column-title">Number </th>
                              <th class="column-title">Update </th>
                              <th class="column-title">Delete </th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php
                              foreach($hotlines as $h)
                              {
                            ?>
                            <tr class="even pointer">
                              <td class=" "><?php echo $h->hotline_name; ?></td>
                              <td class=" "><?php echo $h->hotline_number; ?></td>
                              <td class=" "><a href="#myModal" data-toggle="modal" data-updatingid="<?php echo $h->hotline_id ?>" data-updatingname="<?php echo $h->hotline_name?>" data-updatinghotline="<?php echo $h->hotline_number?>">Update</a></td>
                              <td class=" "><a href="#" data-href="<?php echo base_url();?>Admin/do_delete_hotline/<?php echo $h->hotline_id?>" data-toggle="modal" data-target="#confirm-delete">Delete</a></td>
                              <?php
                              }
                    }
                    else if(empty($hotlines))
                    {
                      echo $this->session->flashdata('nodcs');
                    }
                              ?>

                              </td>
                            </tr>
                          </tbody>
                        </table>
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

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
  <script>

  $('#myModal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var updatingid = $(e.relatedTarget).data('updatingid');
    var updatingname = $(e.relatedTarget).data('updatingname');
    var updatinghotline = $(e.relatedTarget).data('updatinghotline');
    //populate the textbox
    $(e.currentTarget).find('input[name="hotlineid"]').val(updatingid);
    $(e.currentTarget).find('input[name="hotlinename"]').val(updatingname);
    $(e.currentTarget).find('input[name="hotline"]').val(updatinghotline);
});
    </script>

    <script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
  </script>
  </body>
</html>
