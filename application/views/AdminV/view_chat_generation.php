<!-- Page Content -->
        <div id="page-wrapper" class="bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style="color: black;">Update values</h1>
                <div class="panel panel-yellow">
                <div class="panel-heading">
                        Users
                </div>
                <!-- /.panel-heading -->

                <div class="panel-body">
                        <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Username</th>
                                    <th>SBU</th>
                                    <th>Position</th>
                                    <th>Rank</th>
                                    <th>Location</th>
                                    <th>View chat</th>
                                </tr>
                            </thead>
                            <tbod>
                                <?php
                                    foreach($users as $u)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$u->user_employeeID.'</td>';
                                        echo '<td>'.$u->user_firstname." ".$u->user_middlename." ".$u->user_lastname.'</td>';
                                        echo '<td>'.$u->user_email.'</td>';
                                        echo '<td>'.$u->user_username.'</td>';
                                        echo '<td>'.$u->user_sbu.'</td>';
                                        echo '<td>'.$u->user_positiontitle.'</td>';
                                        echo '<td>'.$u->user_rank.'</td>';
                                        echo '<td>'.$u->user_location.'</td>';
                                        echo '<td>'?><a href="<?php echo base_url();?>admin/view_one_user_chatbox/<?php echo $u->quitclaim_id?>">View</a><?php '</td>'; ?>
                                        <?php

                                       // echo '<td>'.anchor('item/view_item/'.$i->id,'View').'</td>';
                                        //echo '<td>'.anchor('item/view_edit_item/'.$i->id,'Edit').'</td>';
                                       // echo '<td>'.anchor('item/view_delete_item/'.$i->id,'Delete').'</td>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    </div>

                    <!-- /.table-responsive -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>/dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
$('#dataTables-example').DataTable({
        responsive: true
});
});
</script>

<script type="text/javascript">
$('#confirm-deactivate').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

<script type="text/javascript">
$('#confirm-activate').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

</body>

</html>
