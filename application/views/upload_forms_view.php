		<!-- Page Content -->
		        <div id="page-wrapper">
		            <div class="container-fluid">
		                <div class="row">
		                        <h1 class="page-header">Uploading of Forms</h1>


                        			 <div class="panel panel-yellow">
	                       				 <div class="panel-heading">Upload forms</div>
                       				 <!-- /.panel-heading -->
                        				<div class="panel-body">
                                


                                  <?php echo form_open_multipart('Admin/do_upload');?>


                                  <div class="form-group">
                                  <label for="docuname">Document Name</label>
                                  <input type="text" class="form-control" id="docuname" name="docuname" placeholder="Document name" required>
                                  </div>

                                  <label for="docucateg">Document Category</label>
                                  <br>
                                  <label class="radio-inline">
                                  <input type="radio" name="docucateg" id="inlineRadio1" value="forms" checked> Forms
                                  </label>
                                  <label class="radio-inline">
                                  <input type="radio" name="docucateg" id="inlineRadio2" value="templates"> Templates
                                  </label>

                                  <div class="form-group">
                                  <label for="docufile">File Input:</label>
                                  <input type="file" name="userfile" size="20" />
                                  <p class="help-block">Doc or Docx files only.</p>
                                  <?php echo $error;?>
                                   </div>
                                   <button type="submit" class="btn btn-warning">Submit</button>

                                   </form>

                       				
                        			</div>
                        		<!-- .panel-body -->
                    			</div>
                    			<!-- /.panel -->
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
