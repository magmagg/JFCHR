        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>Plain Page</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action"  id="dataTables-example">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Title </th>
                            <th class="column-title">Category </th>
                            <th class="column-title">Date Uploaded </th>
                            <th class="column-title">Version </th>
                            <th class="column-title">Former Title </th>
                            <th class="column-title">Former Version </th>
                            <th class="column-title">Status </th>
                            <th class="column-title">Action </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                            foreach($documents as $d)
                            {
                              if($d->document_isarchived==1)
                              {
                          ?>
                          <tr class="even pointer">
                            <td class=" "><?php echo $d->document_title; ?></td>
                            <td class=" "><?php echo $d->document_category; ?></td>
                            <td class=" "><?php echo $d->document_timestamp; ?></td>
                            <td class=" "><?php echo $d->document_version; ?></td>
                            <td class=" "><?php echo $d->document_oldtitle; ?></td>
                            <td class=" "><?php echo $d->document_oldversion; ?></td>
                            <td class=" ">
                            <?php
                              if($d->document_active == 1)
                                {
                                  echo 'Activated';
                                }
                                else
                                {
                                  echo 'Deactivated';
                                }
                            ?>
                            </td>
                            <?php
                              echo '<td>'.'<div class="dropdown">'
                                                           .'<button style="width:100%;" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'
                                                           ."    "
                                                           .'<span class="caret"></span>'
                                                           .'</button>'
                                                           .'<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';

                                                            if($d->document_active == 1)
                                                            {
                                                                ?><li><a href="#" data-href="<?php echo base_url();?>Admin/deactivate_document/<?php echo $d->document_id?>" data-toggle="modal" data-target="#confirm-deactivate">Deactivate</a></li><?php
                                                            }
                                                            else
                                                            {
                                                                ?><li><a href="#" data-href="<?php echo base_url();?>Admin/activate_document/<?php echo $d->document_id?>" data-toggle="modal" data-target="#confirm-activate">Activate</a></li><?php
                                                            }
                                                           ?> <li><a href="#" data-href="<?php echo base_url();?>Admin/delete_document/<?php echo $d->document_id?>" data-toggle="modal" data-target="#confirm-delete">Delete</a></li><?php
                                                          ?> <li><a href="<?php echo base_url();?>admin/download_document/<?php echo $d->document_filename?>">Download</a></li><?php
                                                           echo '</ul>';
                                                           echo '</div>';
                                                           echo '</td>';
                                }

                                                if($d->document_isarchived==0)
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


        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
  </body>
</html>
