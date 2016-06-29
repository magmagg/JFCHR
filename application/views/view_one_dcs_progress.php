<?php
foreach($dcs as $d)
{
  $dcs_title = $d->dcs_title;
  $dcs_sendercomment = $d->dcs_sendercomment;
  $dcs_sendername = $d->dcs_sender;
  $dcs_filename = $d->dcs_docufilename;
}
?>
  	<!-- Page Content -->
		        <div id="page-wrapper" class="bg">
		            <div class="container-fluid">
		                <div class="row">
		                        <h1 class="page-header">Submitted Documents</h1>
                                <?php echo $this->session->flashdata('deleteapprover');?> 

                                <?php echo $this->session->flashdata('dcs_sent');?> 
                                <?php echo $this->session->flashdata('swapped');?> 
                                        <div class="panel panel-yellow">
                                              <div class="panel-heading">
                                                 <?php echo $dcs_title; ?>
                                             </div>
                                     <div class="panel-body">
                                     <div class="well">
                                     <h4>Comment:</h4>
                                          <?php echo $dcs_sendercomment; ?>
                                      </div>

                                         


                                          <div class="well well-lg">
                                              <h4 style="text-align: center;">Approving Body</h4>
                                              
                                      <?php
                                                echo '<div class="dataTable_wrapper">';
                                                echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                                echo '<thead>';
                                                echo '<tr>';
                                                echo '<th style="text-align: center;">'."#".'</th>';
                                                echo '<th style="text-align: center;">'."Approver".'</th>';
                                                echo '<th style="text-align: center;">'."Approved?".'</th>';
                                                echo '<th style="text-align: center;">'."Position".'</th>';
                                                echo '<th style="text-align: center;">'."Date Approved".'</th>';
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '</tbody>';
                                            foreach($dcs as $d)
                                            {
                                               
                                                echo '<tr>';
                                                echo '<td style="text-align: center;">'.$d->dcs_hierarchy.'</td>';
                                                echo '<td>'.$d->user_lastname.'</td>';
                                                if($d->dcs_isapproved == 0)
                                                {
                                                  echo  '<td>'.'<i class="fa fa-times fa-fw"></i>'.'</td>';
                                                }
                                                else if($d->dcs_isapproved == 2)
                                                {
                                                  echo  '<td>'.'<i class="fa fa-times fa-fw">REJECTOR</i>'.'</td>';
                                                }
                                                else
                                                {
                                                  echo  '<td>'.'<i class="fa fa-check fa-fw"></i>'.'</td>';
                                                }
                                                
                                                echo '<td>'.$d->user_positiontitle.'</td>';
                                                echo '<td style="text-align: center;">'.$d->dcs_timeapproved.'</td>';
                                              echo '</tr>';
                                               // echo '<td>'.anchor('item/view_item/'.$i->id,'View').'</td>';
                                                //echo '<td>'.anchor('item/view_edit_item/'.$i->id,'Edit').'</td>';
                                               // echo '<td>'.anchor('item/view_delete_item/'.$i->id,'Delete').'</td>';
                                            }
                                            
                                            echo '</table>';
                                            echo 'Date Posted:&nbsp;' . $d->dcs_timestamp;
                                            echo '</div>';

                                        ?>
                                          </div>

                                          File:&nbsp;<a href="<?php echo base_url();?>user/download_dcs_document/<?php echo $dcs_filename?>"><?php echo $dcs_filename; ?></a>


                                    </div>
                                 <div class="panel-footer">
                                 Submitted by: <font class="font"><?php echo $dcs_sendername; ?></font>
                                </div>
                                  </div>
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


    <script type="text/javascript">
$(".js-example-placeholder-single").select2({
  placeholder: "Select person",
  allowClear: true
});
</script>


</body>

</html>
