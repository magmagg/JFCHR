		<!-- Page Content -->
		        <div id="page-wrapper">
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-lg-12">
		                        <h1 class="page-header">Values</h1>

                        			 
                     

                                        <?php
                                        if(!empty($values))
                                        {
                                            echo '<div class="dataTable_wrapper">';
                                                echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                                echo '<thead>';
                                                echo '<tr>';                                                
                                                echo '<th>'."#".'</th>';
                                                echo '<th>'."Value".'</th>';
                                                echo '<th>'."Type".'</th>';
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '</tbody>';
                                                $count = 1;
                                            foreach($values as $v)
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$count.'</td>'; 
                                                echo '<td>'.$v->values_value.'</td>';                                                
                                                echo '<td>'.$v->value_type.'</td>';
                                                echo '</tr>';
                                                $count++;

                                            }
                                        }
                                        else if(empty($values))
                                        {
                                            echo $this->session->flashdata('novalues');
                                        }
                                        ?>
                                        </tbody>
                                </table>
                 

                    		

		                    </div>
		                    <!-- /.col-lg-12 -->
		                </div>
		                <!-- /.row -->
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

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

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
