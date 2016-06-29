<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quitclaim report</h1>
                        <?php echo $this->session->flashdata('success'); ?>


                             <div class="panel panel-danger">
                                 <div class="panel-heading">Quitclaim Report</div>
                             <!-- /.panel-heading -->
                                <div class="panel-body">



                          <?php echo form_open('Admin/do_generate_quitclaim_report');?>


                           <button type="submit" class="btn btn-default">Generate</button>
                           <br>

                           <?php
                           if(!empty($reports))
                           {
                             $count = 1;
                             foreach($reports as $d)
                             {
                               echo $count. '.' .'Generated on '.$d->report_qc_timestamp.'        ';
                               ?><a href="<?php echo base_url();?>admin/download_generated_report/<?php echo $d->report_qc_filename?>">Download</a>
                           <?php
                           $count++;

                           echo '<br>';
                             }
                           }
                           else if(empty($reports))
                           {
                             //
                           }
                            ?>


                           </form>


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

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

<!-- Dropzone -->
<script src="<?php echo base_url();?>js/dropzone.js"></script>






</body>

</html>
