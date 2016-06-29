        <?php
          foreach($quitclaim as $q)
          {
            $quitclaim_description = $q->quitclaim_description;
          }
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>Edit Quitclaim Workflow</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <?php echo $this->session->flashdata('csv'); ?>

                    <h2>Description:</h2>
                    <?php
                      echo $quitclaim_description;
                      echo "<br><br><br>";
                      echo $this->session->flashdata('swapped');

                      $count = 1;
                    ?>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Approver</th>
                          <th colspan="3">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          foreach($quitclaimtitles as $q)
                          {
                            foreach($usernames as $u)
                            {
                              if($q->quitclaim_approvers_position == $u->user_employeeID)
                              {
                                $name = $u->user_employeeID.' - '.$u->user_firstname.' '.$u->user_lastname;
                              }
                            }
                        ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $name; ?></td>
                          <td><a href="#myModal" data-toggle="modal"  data-employeeid="<?php echo $q->quitclaim_approvers_eid ?>" data-updatingid="<?php echo $q->quitclaim_approvers_id ?>" data-updatingname="<?php echo $q->quitclaim_approvers_position?>">Update</a></td>
                          <td><a href="#" data-href="<?php echo base_url();?>admin/delete_hierarchy_quitclaim/<?php echo $q->quitclaim_approvers_id?>/<?php echo $q->quitclaim_approvers_eid?>" data-toggle="modal" data-target="#confirm-delete">Delete</a></td>
                          <td><a href="#myModal1" data-toggle="modal"  data-employeeid="<?php echo $q->quitclaim_approvers_eid ?>" data-updatingid="<?php echo $q->quitclaim_approvers_id ?>" data-updatingname="<?php echo $q->quitclaim_approvers_position?>">Swap</a></td>
                        </tr>
                        <?php
                          $count ++;
                        }
                        ?>
                      </tbody>
                    </table>

                    <a href="#myModal2" data-toggle="modal"><button type="button" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></button></a> Add more Approvers

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

    <script>
         $('#myModal2').on('show.bs.modal', function(e) {

         //get data-id attribute of the clicked element
         var employeeID = <?php echo $employeeid ?>;
         //populate the textbox
         $(e.currentTarget).find('input[name="employeeID"]').val(employeeID);
     });
         </script>


    <script type="text/javascript">
$(".js-example-placeholder-single").select2({
  placeholder: "Select position",
  allowClear: true
});
</script>

<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

  <script>
    $('#myModal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var updatingid = $(e.relatedTarget).data('updatingid');
    var updatingidcs = $(e.relatedTarget).data('updatingidcs');
    var updatingname = $(e.relatedTarget).data('updatingname');
    var employeeid = $(e.relatedTarget).data('employeeid');
    //populate the textbox
    $(e.currentTarget).find('input[name="approverid"]').val(updatingid);
    $(e.currentTarget).find('input[name="capprovername"]').val(updatingname);
    $(e.currentTarget).find('input[name="dcsid"]').val(updatingidcs);
    $(e.currentTarget).find('input[name="employeeid"]').val(employeeid);
});
    </script>

    <script>
    $('#confirm-update').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
    </script>

    <script>
    $('#confirm-swap').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
    </script>

    <script>
    $('#myModal1').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var updatingid = $(e.relatedTarget).data('updatingid');
    var employeeid = $(e.relatedTarget).data('employeeid');
    var updatingidcs = $(e.relatedTarget).data('updatingidcs');
    var updatingname = $(e.relatedTarget).data('updatingname');
    //populate the textbox
    $(e.currentTarget).find('input[name="approverid"]').val(updatingid);
    $(e.currentTarget).find('input[name="employeeid"]').val(employeeid);
    $(e.currentTarget).find('input[name="capprovername"]').val(updatingname);
    $(e.currentTarget).find('input[name="dcsid"]').val(updatingidcs);
});
    </script>
  </body>
</html>
