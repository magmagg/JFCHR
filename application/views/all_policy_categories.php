<!-- Page Content -->
        <div id="page-wrapper" class="bg">
            <div class="container-fluid">
                <div class="row">
                        <h1 class="page-header">Hotlines</h1>


                           <div class="panel panel-yellow">
                             <div class="panel-heading">Hotlines</div>
                           <!-- /.panel-heading -->
                            <div class="panel-body">


                            <?php
                            if(!empty($categories))
                            {
                              $count = 1;
                                echo '<div class="dataTable_wrapper">';
                                    echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>'."#".'</th>';
                                    echo '<th>'."Category".'</th>';
                                    echo '<th>'."Content".'</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '</tbody>';
                                foreach($categories as $c)
                                {
                                    echo '<tr>';
                                    echo '<td style="text-align: center;">'.$count.'</td>';
                                    echo '<td style="text-align: center;">'.$c->policy_category.'</td>';
                                    echo '<td style="text-align: center;">'?><a href="<?php echo base_url();?>user/view_all_policy_sub_categories/<?php echo $c->policy_category_id?>">View</a><?php '</td>';
                                    echo '</tr>';
                                    $count++;

                                }
                            }
                            else if(empty($categories))
                            {
                               ?>
                            <div class="x_content bs-example-popovers">

                              <div class="alert alert-info alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                There are no accountabilities to approve.
                              </div>
                            </div>
                          <?php
                            }
                            ?>
                                </tbody>
                            </table>




                          </div>
                        <!-- .panel-body -->
                      </div>
                      <!-- /.panel -->

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

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
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
