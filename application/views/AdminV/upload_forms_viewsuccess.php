		<!-- Page Content -->
		        <div id="page-wrapper">
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-lg-12">
		                        <h1 class="page-header">Uploading of forms.</h1>


                        			 <div class="panel panel-danger">
	                       				 <div class="panel-heading">Upload forms</div>
                       				 <!-- /.panel-heading -->
                        				<div class="panel-body">

                         				<ul>
                                  <?php foreach ($upload_data as $item => $value):?>
                                  <li><?php echo $item;?>: <?php echo $value;?></li>
                                  <?php endforeach; ?>
                                  </ul>

                                  <p><?php echo anchor('Admin/view_forms_upload', 'Upload Another File!'); ?></p>
                        			</div>
                        		<!-- .panel-body -->
                    			</div>
                    			<!-- /.panel -->

                    			<h3>Your file was successfully uploaded!</h3>




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




</body>

</html>
