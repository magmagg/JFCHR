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
                                


                                  <?php echo form_open_multipart('Admin/do_submit_dcs');?>


                                  <div class="form-group">
                                  <label for="docuname">Document name</label>
                                  <input type="text" class="form-control" id="docuname" name="docuname" placeholder="Document name" required>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="sendto">Send to</label>
                                    <select class="select js-example-basic-multiple form-control" multiple="multiple" style="width:100%;" name="receivers[]">
                                    <?php foreach($users as $u)
                                    {
                                        echo '<option value="'.$u->user_employeeID.'">'.$u->user_firstname." ".$user_middlename." ".$u->user_lastname.'</option>';
                                        //LAGAY YUNG VALUE SA OPTION
                                    }
                                    ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="sendto">Send to</label>
                                    <select class="select js-example-basic-multiple form-control" multiple="multiple" style="width:100%;" name="receivers[]">
                                    <?php foreach($users as $u)
                                    {
                                        echo '<option value="'.$u->user_employeeID.'">'.$u->user_firstname." ".$user_middlename." ".$u->user_lastname.'</option>';
                                        //LAGAY YUNG VALUE SA OPTION
                                    }
                                    ?>
                                    </select>
                                </div>

  
                               

                                  <div class="form-group">
                                  <label for="docufile">File input</label>
                                  <input type="file" name="userfile" size="20" />
                                  <p class="help-block">Doc or Docx files only.</p>
                                  <?php echo $error;?>
                                   </div>
                                   <button type="submit" class="btn btn-default">Submit</button>

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

    <script src="<?php echo base_url();?>js/select2.min.js"></script>


    <script type="text/javascript">
  $(".js-example-basic-multiple").select2(
    {
         placeholder: "Send to",
        allowClear: true,
        maximumSelectionLength: 1
    });
</script>

<script>
$('select').change(function() {
    var myOpt = [];
    $("select").each(function () {
        myOpt.push($(this).val());
    });
    $("select").each(function () {
        $(this).find("option").prop('hidden', false);
        var sel = $(this);
        $.each(myOpt, function(key, value) {
            if((value != "") && (value != sel.val())) {
                sel.find("option").filter('[value="' + value +'"]').prop('hidden', true);
            }
        });
    });
});
</script>

</body>

</html>
