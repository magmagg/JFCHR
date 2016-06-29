		<!-- Page Content -->
		        <div id="page-wrapper" class="bg">
		            <div class="container-fluid">
		                <div class="row">
		                        <h1 class="page-header">Documents To Approve</h1>

                        			 <div class="panel panel-yellow">
	                       				 <div class="panel-heading">Approval Requests</div>

                       				 <!-- /.panel-heading -->
                        				<div class="panel-body">
                                        <?php echo $this->session->flashdata('accepted'); ?>
                                        <?php
                                                echo '<div class="dataTable_wrapper">';
                                                echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                                echo '<thead>';
                                                echo '<tr>';
                                                echo '<th>'."Title".'</th>';
                                                echo '<th>'."Sender".'</th>';
                                                echo '<th>'."Time".'</th>';
                                                echo '<th>'."Pending".'</th>';
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '</tbody>';
                                            foreach($dcs as $d)
                                            {
                                                $session_data = $this->session->userdata('logged_in');
                                                $employeeID = $session_data['employeeID'];
                                                $approvingnumbers = 0;
                                                $dcs_id = $d->dcs_id;
                                                $data['dcs'] = $this->Model_user->get_dcs_progress($dcs_id);
                                                foreach($data['dcs'] as $d)
                                                {
                                                    if($d->dcs_isapproved == 0)
                                                    {
                                                        $approvingnumbers +=1;
                                                    }   
                                                }
                                                

                                              foreach($data['dcs'] as $d)
                                              {
                                               $approver = $d->dcs_approver_id;
                                               $approversleft = $approvingnumbers - $d->dcs_reversehierarchy;                                              
                                             
                                             
                                                
                                               if($d->dcs_isapproved == 2)
                                               {
                                                $isapprover = 'Stopped';
                                                break;
                                               }
                                               else if($approver == $employeeID && $d->dcs_isapproved == 1)
                                               {
                                                $isapprover = 'You already approved this';
                                                break;
                                               }
                                               else if ($approver == $employeeID && $approvingnumbers == $d->dcs_reversehierarchy)
                                               {
                                                 $current_approver = 1;
                                                 $isapprover = 'You are the approver';
                                                 break;
                                               }
                                               else if ($approver != $employeeID)
                                               {                                                  
                                                 continue;
                                               }
                                               else
                                               {
                                                $beforeyouhierarchy = $d->dcs_hierarchy - 1;
                                                 foreach($data['dcs'] as $d)
                                                 {
                                                  if($beforeyouhierarchy == $d->dcs_hierarchy)
                                                  {
                                                    $name =  $d->user_lastname;
                                                  }
                                                 }                                    
                                                $isapprover = $name . ' Needs to approve before you';
                                               }

                                           }
                                                
                                                echo '<tr>';
                                                echo '<td>';?><a href="<?php echo base_url();?>user/view_one_dcs_approval_page/<?php echo $d->dcs_id?>"> <?php echo $d->dcs_title;?></a><?php '</td>';
                                                echo '<td>'.$d->dcs_sender.'</td>';
                                                echo '<td class="align">'.$d->dcs_timestamp.'</td>';
                                                echo '<td>'.$isapprover.'</td>';

                                                echo '</tr>';
                                               // echo '<td>'.anchor('item/view_item/'.$i->id,'View').'</td>';
                                                //echo '<td>'.anchor('item/view_edit_item/'.$i->id,'Edit').'</td>';
                                               // echo '<td>'.anchor('item/view_delete_item/'.$i->id,'Delete').'</td>';
                                            }
                                        ?>
                                        </tbody>
                                </table>
                            </div>
                        			</div>
                        		<!-- .panel-body -->
                    			</div>
                    			<!-- /.panel -->

                    			<!--next content HERE!!!!!!!!!!!!!!!!!!!!! -->
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
