		<!-- Page Content -->
		        <div id="page-wrapper">
		            <div class="container-fluid">
		                <div class="row">
		                        <h1 class="page-header">Archived forms</h1>

                
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">Archived forms</div>
                               <!-- /.panel-heading -->
                                <div class="panel-body">
                                

                                <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Document Title</th>
                                            <th style="text-align: center;">Date Uploaded</th>
                                            <th style="text-align: center;">View</th>
                                            <th style="text-align: center;">Download</th>
                                        </tr>
                                    </thead>
                                    <tbod>
                                        <?php
                                        
                                            foreach($documents as $d)
                                            {
                                                if($d->document_isarchived == 1 && $d->document_active == 1)
                                                {
                                                echo '<tr>';
                                                echo '<td>'.$d->document_title.'</td>';
                                                echo '<td style="text-align: center;">'.$d->document_timestamp.'</td>' . '</td>';
                                                echo '<td style="text-align: center;">'.'View'.'</td>';
                                                echo '<td style="text-align: center;">';
                                                
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
