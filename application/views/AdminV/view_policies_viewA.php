        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>Edit Policy Category</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <?php
                      echo $this->session->flashdata('posted');
                      echo $this->session->flashdata('update');

                      if(!empty($policies))
                      {
                    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Policy Title </th>
                                <th class="column-title">Policy Content </th>
                                <th class="column-title">Date Posted </th>
                                <th class="column-title">Last Updated </th>
                                <th class="column-title">View Policy </th>
                                <th class="column-title">Edit Policy </th>
                                <th class="column-title">Delete </th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php
                                foreach($policies as $p)
                                {
                              ?>
                              <tr class="even pointer">
                                <td class=" "><?php echo $p->policy_title; ?></td>
                                <td class=" "><?php echo $p->policy_content; ?></td>
                                <td class=" "><?php echo $p->policy_dateposted; ?></td>
                                <td class=" "><?php echo $p->policy_timeupdated; ?></td>
                                <td class=" "><a href="<?php echo base_url();?>admin/view_one_policy/<?php echo $p->policy_id?>">View</a></td>
                                <td class=" "><a href="<?php echo base_url();?>admin/edit_policy/<?php echo $p->policy_id?>/<?php echo $policycategid?>">Edit</a></td>
                                <td class=" "><a href="#" data-href="<?php echo base_url();?>Admin/delete_policy/<?php echo $p->policy_id?>" data-toggle="modal" data-target="#confirm-delete">Delete</a></td>
                              </tr>
                                <?php
                                }
                      }
                      else
                      {
                        echo '<div class="alert alert-danger text-center">There are no policies available.</div>';
                      }

                                ?>

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

    $("td.cutoff").text(function(index, currentText)
    {
    return currentText.substr(0, 175) + '...';
    });
    </script>

<script type="text/javascript">
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>
  </body>
</html>
