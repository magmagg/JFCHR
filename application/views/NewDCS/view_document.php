    <!-- Page Content -->
            <div id="page-wrapper" class="bg">
                <div class="container-fluid">
                    <div class="row">
                            <h1 class="page-header">Available</h1>
                               <div class="panel panel-yellow">
                                 <div class="panel-heading">Available forms</div>
                               <!-- /.panel-heading -->
                                <div class="panel-body">
                                

                                        <?php

                                                 echo '<div class="dataTable_wrapper">';
                                                  echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                                  echo '<thead>';
                                                  echo '<tr>';
                                                  echo '<th>'."Document Title".'</th>';
                                                  echo '<th>'."Date uploaded".'</th>';
                                                  echo '<th>'."Document type".'</th>';
                                                  echo '<th>'."View".'</th>';
                                                  echo '<th>'."Download".'</th>';
                                                  echo '</tr>';
                                                  echo '</thead>';
                                                  echo '<tbody>';
                                                foreach($documents as $d)
                                                {
                                                    if($d->document_active == 1)
                                                    {
                                                    echo '<tr>';
                                                    echo '<td>'.$d->document_title.'</td>';
                                                    echo '<td>'.$d->document_timestamp.'</td>';
                                                    echo '<td>'.$d->document_category.'</td>';
                                                    echo '<td>'.'View'.'</td>';
                                                    echo '<td>';
                                                    
                                                        ?><a href="<?php echo base_url();?>user/download_document/<?php echo $d->document_filename?>">Download</a><?php '</td>';
                                                    }
                                                    

                                                   echo '</tr>';

                                                   // echo '<td>'.anchor('item/view_item/'.$i->id,'View').'</td>';
                                                    //echo '<td>'.anchor('item/view_edit_item/'.$i->id,'Edit').'</td>';
                                                   // echo '<td>'.anchor('item/view_delete_item/'.$i->id,'Delete').'</td>';

                                                }
                                            

                                            
                                        ?>
                                    </tbody>
                                </table>
                              </div>
                            <!-- .panel-body -->
                          </div>
                          <!-- /.panel -->

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

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




</body>

</html>
