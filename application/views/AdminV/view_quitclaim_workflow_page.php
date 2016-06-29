<?php
foreach($quitclaim as $q)
{
  $quitclaim_description = $q->quitclaim_description;
}
?>
  	<!-- Page Content -->
		        <div id="page-wrapper">
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-lg-12">

		                        <h1 class="page-header">Quitclaim workflow</h1>
                                        <div class="panel panel-info">
                                              <div class="panel-heading">
                                             </div>
                                     <div class="panel-body">
                                     <div class="well">
                                     <h4>Description:</h4>
                                          <?php echo $quitclaim_description; ?>
                                      </div>

                                         <?php echo $this->session->flashdata('swapped'); ?>


                                          <div class="well well-lg">
                                              <h4>Approving body</h4>

                                      <?php
                                                $count = 1;
                                                echo '<div class="dataTable_wrapper">';
                                                echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                                echo '<thead>';
                                                echo '<tr>';
                                                echo '<th>'."#".'</th>';
                                                echo '<th>'."Approver".'</th>';
                                                echo '<th>'."Update".'</th>';
                                                echo '<th>'."Delete".'</th>';
                                                echo '<th>'."Swap".'</th>';
                                                echo '</tr>';
                                                echo '</thead>';
                                                echo '</tbody>';
                                            foreach($quitclaimtitles as $q)
                                            {

                                                echo '<tr>';
                                                echo '<td>'.$count.'</td>';
                                                echo '<td>'.$q->quitclaim_approvers_position;
                                                echo '<td>';?> <a href="#myModal" data-toggle="modal"  data-updatingid="<?php echo $q->quitclaim_approvers_id ?>" data-updatingname="<?php echo $q->quitclaim_approvers_position?>">Update</a><?php echo '</td>';
                                                echo '<td>';?> <a href="#" data-href="<?php echo base_url();?>admin/delete_hierarchy_quitclaim/<?php echo $q->quitclaim_approvers_id?>" data-toggle="modal" data-target="#confirm-delete">Delete</a><?php echo '</td>';
                                                echo '<td>';?> <a href="#myModal1" data-toggle="modal"  data-updatingid="<?php echo $q->quitclaim_approvers_id ?>" data-updatingname="<?php echo $q->quitclaim_approvers_position?>">Swap</a><?php echo '</td>';

                                                echo '</tr>';
                                               // echo '<td>'.anchor('item/view_item/'.$i->id,'View').'</td>';
                                                //echo '<td>'.anchor('item/view_edit_item/'.$i->id,'Edit').'</td>';
                                               // echo '<td>'.anchor('item/view_delete_item/'.$i->id,'Delete').'</td>';
                                                $count ++;
                                            }

                                            echo '</table>';
                                            echo '</div>';

                                        ?>

                                        <a href="#myModal2" data-toggle="modal"><button type="button" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></button></a> Add more Approvers

                                          </div>

                                    </div>
                                 <div class="panel-footer">
                                 Update
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


    <script type="text/javascript">
$(".js-example-placeholder-single").select2({
  placeholder: "Select position",
  allowClear: true
});
</script>

<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

  <script>
    $('#myModal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var updatingid = $(e.relatedTarget).data('updatingid');
    var updatingidcs = $(e.relatedTarget).data('updatingidcs');
    var updatingname = $(e.relatedTarget).data('updatingname');
    //populate the textbox
    $(e.currentTarget).find('input[name="approverid"]').val(updatingid);
    $(e.currentTarget).find('input[name="capprovername"]').val(updatingname);
    $(e.currentTarget).find('input[name="dcsid"]').val(updatingidcs);
});
    </script>

    <script>
    $('#confirm-update').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
    </script>

    <script>
    $('#confirm-swap').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
    </script>

    <script>
    $('#myModal1').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var updatingid = $(e.relatedTarget).data('updatingid');
    var updatingidcs = $(e.relatedTarget).data('updatingidcs');
    var updatingname = $(e.relatedTarget).data('updatingname');
    //populate the textbox
    $(e.currentTarget).find('input[name="approverid"]').val(updatingid);
    $(e.currentTarget).find('input[name="capprovername"]').val(updatingname);
    $(e.currentTarget).find('input[name="dcsid"]').val(updatingidcs);
});
    </script>

</body>

</html>
