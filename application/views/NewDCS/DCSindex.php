    <!-- Page Content -->
            <div id="page-wrapper" class="bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Submitting of Documents</h1>
                            <div class="panel panel-yellow">
                                 <div class="panel-heading">Available Documents</div>
                               <!-- /.panel-heading -->
                                <div class="panel-body">
                               
                                    <?php echo $this->session->flashdata('dcs_sent'); ?>

                                     <?php
                                                if(!empty($dcs))
                                                {
                                                    $count = 1;
                                                    echo '<div class="dataTable_wrapper">';
                                                        echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                                        echo '<thead>';
                                                        echo '<tr class="">';
                                                        echo '<th style="width: 8%; text-align: center;">'."No. ".'</th>';
                                                        echo '<th style="width: 25%; text-align: center;">'."Title".'</th>';
                                                        echo '<th style="text-align: center;">'."Description".'</th>';
                                                        echo '<th style="width: 15%; text-align: center;">'."Action".'</th>';
                                                        echo '</tr>';
                                                        echo '</thead>';
                                                        echo '</tbody>';
                                                    foreach($dcs as $d)
                                                    {
                                                        echo '<tr>';
                                                        echo '<td style="text-align: center;">'.$count.'</td>';                                                
                                                        echo '<td>'.$d->custom_dcs_title.'</td>';                                                                                 
                                                        echo '<td>'.$d->custom_dcs_description.'</td>';
                                                        echo '<td style="text-align: center;">'?><a href="<?php echo base_url();?>DCS/submit_one_dcs/<?php echo $d->custom_dcs_id?>">Submit</a><?php '</td>';
                                                        echo '</tr>';
                                                        $count +=1;
                                                    }
                                                }
                                                else if(empty($dcs))
                                                {
                                                    echo '<div class="alert alert-danger text-center" style="width: 50%; margin-left: 25%; margin-top: 2%;">No document submission available./div>';
                                                }
                                                ?>
                              </div>
                            <!-- .panel-body -->
                          </div>
                          <!-- /.panel -->

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
