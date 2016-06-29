		<!-- Page Content -->
		        <div id="page-wrapper" class="bg">
		            <div class="container-fluid">
		                <div class="row">
		                        <h1 class="page-header">Submitted Documents</h1>

                        			 <div class="panel panel-yellow">
	                       				 <div class="panel-heading">Files in Progress</div>
                       				 <!-- /.panel-heading -->
                        				<div class="panel-body">
                     

                                        <?php
                                        if(!empty($details))
                                        {
                                            echo '<div class="dataTable_wrapper">';
                                                echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                                echo '<thead>';
                                                echo '<tr>';
                                                echo '<th style="text-align: center">'."Title".'</th>';
                                                echo '<th style="text-align: center">'."Date Submitted".'</th>';
                                                echo '<th style="text-align: center">'."Progress".'</th>';
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '</tbody>';
                                            foreach($details as $d)
                                            {
                                                $dcs_id = $d->dcs_id;
                                                $data['dcs'] = $this->Model_user->get_dcs_progress($dcs_id);
                                                $approvingnumbers = 0;
                                                $approvers = 0;
                                                foreach($data['dcs'] as $d)
                                                {
                                                    
                                                    $hierarchy = $d->dcs_hierarchy;
                                                    $highestvalue = $hierarchy;
                                                    if($hierarchy < 0)
                                                    {
                                                        $highestvalue = $hierarchy;
                                                    }

                                                    if($d->dcs_isapproved == 1)
                                                    {
                                                        $approvers +=1;
                                                    }
                                                }
                                                $difference = $approvers / $highestvalue;
                                                $finalprogress = $difference * 100;
                                                echo '<tr>';
                                                echo '<td>';?><a href="<?php echo base_url();?>user/view_one_dcs/<?php echo $d->dcs_id?>"> <?php echo $d->dcs_title;?></a><?php '</td>';
                                                echo '<td style="text-align: center">'.$d->dcs_timestamp.'</td>';
                                                echo '<td>'.'<div class="progress">'
                                                           .'<div class="progress-bar ';
                                                           if($finalprogress == 100)
                                                           {
                                                            echo 'progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow='. $finalprogress .' aria-valuemin="0" aria-valuemax="100"';
                                                           }
                                                           if($finalprogress == 50)
                                                           {
                                                            echo 'progress-bar-striped progress-bar-warning active" role="progressbar" aria-valuenow='. $finalprogress .' aria-valuemin="0" aria-valuemax="100"';
                                                           }
                                                           else if ($finalprogress > 50)
                                                           {
                                                            echo 'progress-bar-striped  progress-bar-warning active" role="progressbar" aria-valuenow='. $finalprogress .' aria-valuemin="0" aria-valuemax="100"';
                                                           }
                                                           else if ($finalprogress < 50)
                                                           {
                                                            echo 'progress-bar-striped progress-bar-danger active" role="progressbar" aria-valuenow='. $finalprogress .' aria-valuemin="0" aria-valuemax="100"';
                                                           }
                                                           
                                                           
                                                           if($finalprogress == 0)
                                                           {
                                                            echo 'style="min-width:2em;">';
                                                           }
                                                           else
                                                           {
                                                            echo 'style="width:' . $finalprogress . '%">';
                                                           }
                                                           echo floor($finalprogress) . '%'
                                                           .'</div>'
                                                           .'</div>'
                                                           .'</td>';
                                                echo '</tr>';
                                               // echo '<td>'.anchor('item/view_item/'.$i->id,'View').'</td>';
                                                //echo '<td>'.anchor('item/view_edit_item/'.$i->id,'Edit').'</td>';
                                               // echo '<td>'.anchor('item/view_delete_item/'.$i->id,'Delete').'</td>';
                                            }
                                        }
                                        else if(empty($details))
                                        {
                                            echo $this->session->flashdata('nodcs');
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
