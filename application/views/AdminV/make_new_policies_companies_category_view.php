        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>Plain Page</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <?php
                        if(!empty($categories))
                        {
                            $count = 1;
                    ?>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Category</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                        <?php
                            foreach($categories as $c)
                            {
                        ?>
                                <tr>
                                  <td><?php echo $count; ?></td>
                                  <td><?php echo $c->policy_category; ?></td>
                                  <td><a href="<?php echo base_url();?>admin/make_new_policies_edit_category/<?php echo $c->policy_category_id?>">Edit</a></td>
                                </tr>
                        <?php
                            $count++;
                            }
                        }
                        else if(empty($categories))
                        {
                            echo $this->session->flashdata('nocompanies');
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
