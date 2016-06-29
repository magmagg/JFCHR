    <!-- Page Content -->
            <div id="page-wrapper" class="bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Approved Documents</h1>
                            <div class="panel panel-yellow">
                                <div class="panel-heading">Approved Files</div>
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
                                                echo '<th style="text-align: center; width: 8%;">'."No. ".'</th>';
                                                echo '<th style="text-align: center; width: 50%;">'."Title".'</th>';
                                                echo '<th style="text-align: center;">'."Date Posted".'</th>';
                                                echo '<th style="text-align: center; width: 10%;">'."Action".'</th>';
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '</tbody>';
                                            foreach($dcs as $d)
                                            {
                                                echo '<tr>';
                                                echo '<td style="text-align: center;">'.$count.'</td>';                                                
                                                echo '<td>'.$d->dcs_document_title.'</td>';                                                                                 
                                                echo '<td style="text-align: center;">'.$d->dcs_document_timestamp.'</td>';
                                                echo '<td style="text-align: center;">'?><a href="<?php echo base_url();?>DCS/view_one_document/<?php echo $d->dcs_id_fk?>">View</a><?php '</td>';
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
