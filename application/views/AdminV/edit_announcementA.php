        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>Announcements</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php
                      echo $this->session->flashdata('update');
                      echo $this->session->flashdata('deletedannounce');

                      if(!empty($announcements))
                      {
                    ?>

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Time Posted</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
                          foreach($announcements as $a)
                          {
                        ?>
                          <tr>
                            <td><?php echo $a->a_title; ?></td>
                            <td><?php echo $a->a_content; ?></td>
                            <td><?php echo $a->a_timeposted; ?></td>
                            <td><a href="<?php echo base_url();?>admin/edit_announcement/<?php echo $a->a_id?>">Edit</a></td>
                            <td><a href="#" data-href="<?php echo base_url();?>Admin/delete_announcement/<?php echo $a->a_id?>" data-toggle="modal" data-target="#confirm-delete">Delete</a></td>
                          </tr>
                        </tbody>
                      <?php
                          }
                        }
                        else
                        {
                          ?>
                            <div class="alert alert-info">
                              <ul class="fa-ul">
                                <li>
                                  There are no announcements available.
                                </li>
                              </ul>
                            </div>
                          <?php
                        }
                      ?>
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
      $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    </script>

  </body>
</html>
