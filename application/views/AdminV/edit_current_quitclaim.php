        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>Undergoing Quitclaim </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <?php
                      if(!empty($users))
                      {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="dataTables-example">
                          <thead>
                            <tr class="headings">
                              <th class="column-title">Name </th>
                              <th class="column-title">Action </th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php
                              foreach($users as $u)
                              {
                            ?>
                            <tr class="even pointer">
                              <td class=" "><?php echo $u->user_firstname.' '.$u->user_lastname; ?></td>
                              <td class=" "><a href="<?php echo base_url();?>admin/edit_quitclaim/<?php echo $u->user_employeeID?>">Edit</a></td>
                            </tr>
                            <?php
                            }
                          }
                        else if(empty($users))
                        {
                          echo $this->session->flashdata('noquitclaim');
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
