<!-- Page Content -->
				<div id="page-wrapper">
						<div class="container-fluid">
								<div class="row">
										<div class="col-lg-12">
												<h1 class="page-header">Benefit enrolment</h1>
												<?php echo $this->session->flashdata('process'); ?>

												 <?php
																		if(!empty($enrolment))
																		{
																				$count = 1;
																				echo '<div class="dataTable_wrapper">';
																						echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
																						echo '<thead>';
																						echo '<tr class="success">';
																						echo '<th>'."#".'</th>';
																						echo '<th>'."Title".'</th>';
																						echo '<th>'."Sender".'</th>';
																						echo '<th>'."Approved?".'</th>';
																						echo '<th>'."View".'</th>';
																						echo '</tr>';
																						echo '</thead>';
																						echo '</tbody>';
																				foreach($enrolment as $d)
																				{

																					foreach($users as $u)
																					{
																						if($d->benefit_sender_id == $u->user_employeeID)
																						{
																							$name = $u->user_firstname . ' ' . $u->user_lastname;
																						}
																					}
																						echo '<tr>';
																						echo '<td>'.$count.'</td>';
																						echo '<td>'.$d->benefit_title.'</td>';
																						echo '<td>'.$name.'</td>';
																						if($d->benefit_isapproved == 1)
																						{
																							echo '<td>'.'Yes'.'</td>';
																						}
																						else
																						{
																							echo '<td>'.'No'.'</td>';
																						}
																						echo '<td>'?><a href="<?php echo base_url();?>user/view_one_benefit_to_approve/<?php echo $d->benefit_submission_id?>">View</a><?php '</td>';
																						echo '</tr>';
																						$count +=1;
																				}
																		}
																		else if(empty($dcs))
																		{
																				echo '<div class="alert alert-danger text-center">No benefit enrolment available.</div>';
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
