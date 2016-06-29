        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>View Documents</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action"  id="dataTables-example">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Title </th>
                            <th class="column-title">Category </th>
                            <th class="column-title">Version </th>
                            <th class="column-title">Status </th>
                            <th class="column-title">Date Uploaded </th>
                            <th class="column-title">SBU </th>
                            <th class="column-title">Action </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                            foreach($documents as $d)
                            {
                              if($d->document_isarchived==0)
                              {
                          ?>
                          <tr class="even pointer">
                            <td class=" "><?php echo $d->document_title; ?></td>
                            <td class=" "><?php echo $d->document_category; ?></td>
                            <td class=" "><?php echo $d->document_version; ?></td>
                            <td class=" ">
                            <?php
                              if($d->document_active == 1)
                                {
                                  echo 'Yes';
                                }
                                else
                                {
                                  echo 'No';
                                }
                            ?>
                            </td>
                            <td class=" "><?php echo $d->document_timestamp; ?></td>
                            <td class=" "><?php echo $d->document_company; ?></td>
                            <?php
                              echo '<td>'.'<div class="dropdown">'
                                                           .'<button style="width:100%;" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'
                                                           ."Action "
                                                           .'<span class="caret"></span>'
                                                           .'</button>'
                                                           .'<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                                                            if($d->document_isarchived == 0)
                                                            {
                                                                ?><li><a href="#" data-href="<?php echo base_url();?>Admin/archive_document/<?php echo $d->document_id?>" data-toggle="modal" data-target="#confirm-archive">Archive</a></li><?php
                                                            }
                                                            if($d->document_active == 1)
                                                            {
                                                                ?><li><a href="#" data-href="<?php echo base_url();?>Admin/deactivate_document/<?php echo $d->document_id?>" data-toggle="modal" data-target="#confirm-deactivate">Deactivate</a></li><?php
                                                            }
                                                            else
                                                            {
                                                                ?><li><a href="#" data-href="<?php echo base_url();?>Admin/activate_document/<?php echo $d->document_id?>" data-toggle="modal" data-target="#confirm-activate">Activate</a></li><?php
                                                            }
                                                           ?> <li><a href="#" data-href="<?php echo base_url();?>Admin/delete_document/<?php echo $d->document_id?>" data-toggle="modal" data-target="#confirm-delete">Delete</a></li><?php
                                                           ?> <li><a href="#myModal" data-toggle="modal" data-updatingid="<?php echo $d->document_id ?>" data-updatingname="<?php echo $d->document_title?>">Update</a></li><?php
                                                           ?> <li><a href="<?php echo base_url();?>admin/download_document/<?php echo $d->document_filename?>">Download</a></li><?php
                                                           echo '</ul>';
                                                           echo '</div>';
                                                           echo '</td>';
                                }

                                                if($d->document_isarchived==1)
                                                {
                                                }


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


    <script type="text/javascript">
      $(".js-example-placeholder-single").select2({
        placeholder: "Select company",
        allowClear: true
      });
    </script>

    <script>
     $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
      });

     $(document).ready(function() {
        $('#dataTables-example1').DataTable({
                responsive: true
        });
      });

      //triggered when modal is about to be shown
      $('#myModal').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var updatingid = $(e.relatedTarget).data('updatingid');
        var updatingname = $(e.relatedTarget).data('updatingname');
        //populate the textbox
        $(e.currentTarget).find('input[name="documentid"]').val(updatingid);
        $(e.currentTarget).find('input[name="docuname"]').val(updatingname);
      });
    </script>

    <script type="text/javascript">
      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

      $('#confirm-deactivate').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

      $('#confirm-activate').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

      $('#confirm-archive').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    </script>
  </body>
</html>
