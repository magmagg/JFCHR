<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Policies</h1>

                <div class="panel panel-default">
                <div class="panel-heading">
                        Policies
                </div>
                <!-- /.panel-heading -->

                <div class="panel-body">
                <?php echo $this->session->flashdata('posted'); ?>

                         <?php echo $this->session->flashdata('update'); ?>
                                <?php
                                if(!empty($policies))
                                {
                                    echo '<div class="dataTable_wrapper">';
                                      echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                      echo '<thead>';
                                      echo '<tr>';
                                      echo '<th>'."Policy Header".'</th>';
                                      echo '<th>'."Policy Content".'</th>';
                                      echo '<th>'."Date Posted".'</th>';
                                      echo '<th>'."Last updated".'</th>';
                                      echo '<th>'."View Policy".'</th>';
                                      echo '</tr>';
                                      echo '</thead>';
                                      echo '<tbody>';
                                    foreach($policies as $p)
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$p->policy_header.'</td>';
                                        echo '<td class="cutoff">'.$p->policy_content.'</td>';
                                        echo '<td>'.$p->policy_dateposted.'</td>';
                                        echo '<td>'.$p->policy_timeupdated.'</td>';
                                         echo '<td>'?><a href="<?php echo base_url();?>user/view_policy/<?php echo $p->policy_id?>">View</a><?php '</td>'; ?>
                                      <?php
                                    }
                                }
                                else
                                {
                                    echo '<div class="alert alert-danger text-center">No Policies available.</div>';
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

$("td.cutoff").text(function(index, currentText)
{
return currentText.substr(0, 175) + '...';
});
</script>

<script type="text/javascript">
$('#confirm-delete').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

</body>

</html>
