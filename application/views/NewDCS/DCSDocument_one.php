<?php
foreach($dcs as $d)
{
  $dcs_title = $d->dcs_title;
  $dcs_sendercomment = $d->dcs_sendercomment;
  $dcs_sendername = $d->dcs_sender;
  $dcs_filename = $d->dcs_docufilename;
  $dcs_controlnumber = $d->dcs_control_number;
  $dcs_id = $d->dcs_id_fk;
}
?>
  	<!-- Page Content -->
		        <div id="page-wrapper" class="bg">
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-lg-12">

		                        <h1 class="page-header">Viewing <?php echo $dcs_title; ?></h1>
                                    <div class="panel panel-yellow">
                                      <div class="panel-heading">
                                       <?php echo $dcs_title; ?>
                                        <a href="#" data-href="<?php echo base_url();?>DCS/resubmit_document/<?php echo $dcs_id?>" data-toggle="modal" data-target="#confirm-resubmit"><button type="button" class="btn btn-sm btn-default pull-right">Update Document</button></a>
                                      </div>
                                      <div class="panel-body">
                                        <div class="well">
                                          <h4>Comment:</h4>
                                            <?php echo $dcs_sendercomment; ?>
                                          </div>

                                        <div class="well">
                                          <h4>Control Number:</h4>
                                            <?php echo $dcs_controlnumber; ?>
                                        </div>
                                        <div>
                                          File:&nbsp;<a href="<?php echo base_url();?>user/download_dcs_document/<?php echo $dcs_filename?>"><?php echo $dcs_filename; ?></a>
                                        </div>
                                      </div>
                                      <div class="panel-footer">
                                        Submitted by: <font class="font"><?php echo $dcs_sendername; ?></font>
                                      </div>
                                    </div>




                                    
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

     <script src="<?php echo base_url();?>js/select2.min.js"></script>

<script>
$('#confirm-resubmit').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>


    <script type="text/javascript">
$(".js-example-placeholder-single").select2({
  placeholder: "Select person",
  allowClear: true
});
</script>


</body>

</html>
