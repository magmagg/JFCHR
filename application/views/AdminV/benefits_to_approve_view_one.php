<?php
				 foreach($details as $d)
				 {
					 $benefitsubmissionid = $d->benefit_submission_id;
					 $senderid = $d->benefit_sender_id;
					 $docuname = $d->benefit_filename;
					 $isapproved = $d->benefit_isapproved;
					 $wantedvalue = $d->benefit_value;
				 }

				 foreach($enrolment as $e)
				 {
					 $value = $e->benefit_value;
					 $name = $e->benefit_title;
				 }

?>
<!-- Page Content -->
				<div id="page-wrapper">
						<div class="container-fluid">
								<div class="row">
										<div class="col-lg-12">
												<h1 class="page-header">Benefit enrolment</h1>
												<?php echo $this->session->flashdata('success'); ?>
												<div class="panel panel-success">
                        <div class="panel-heading">
                            Success Panel
                        </div>
                        <div class="panel-body">
													<?php
													echo form_open('admin/process_benefits');
													?>

														<a href="<?php echo base_url();?>admin/download_benefit/<?php echo $docuname?>">Download <?php echo $username?>'s submission</a>
														<input type="hidden" name="benefitsubmissionid" value="<?php echo $benefitsubmissionid?>">
														<input type="hidden" name="value" value="<?php echo $value?>">
														<input type="hidden" name="senderid" value="<?php echo $senderid?>">
														<input type="hidden" name="title" value="<?php echo $name?>">
														<input type="hidden" name="wantedvalue" value="<?php echo $wantedvalue?>">
														<br>
														<br>
														<?php
														if($isapproved == 1)
														{
															?>
															<div class="alert alert-success text-center">You have approved this already</div>
															<input id="btn_dcs" name="btn_dcs" type="submit" class="btn btn-success" value="Approve" disabled/>
															<input id="btn_dcs" name="btn_dcs" type="submit" class="btn btn-danger" value="Reject" disabled/>
															<?php
														}
														else
														{
															?>
															<input id="btn_dcs" name="btn_dcs" type="submit" class="btn btn-success" value="Approve"/>
															<input id="btn_dcs" name="btn_dcs" type="submit" class="btn btn-danger" value="Reject"/>
															<?php
														}
														?>



																															</form>
                          </div>





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
