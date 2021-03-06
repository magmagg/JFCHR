<div class="right_col" role="main">
    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="min-height:600px;">
          <div class="x_title">
            <h2>Manage SBUS</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


                        <?php echo $this->session->flashdata('workflow'); ?>


                            <div class="panel-body">
                         <?php
                                    if(!empty($sbu))
                                    {
                                        $count = 1;
                                        echo '<div class="dataTable_wrapper">';
                                            echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                            echo '<thead>';
                                            echo '<tr class="">';
                                            echo '<th style="text-align: center; width: 8%;">'."# ".'</th>';
                                            echo '<th style="text-align: center;">'."SBU".'</th>';
                                            echo '<th style="text-align: center; width: 15%;">'."Update".'</th>';
                                            echo '<th style="text-align: center; width: 15%;">'."Delete".'</th>';
                                            echo '</tr>';
                                            echo '</thead>';
                                            echo '</tbody>';
                                        foreach($sbu as $s)
                                        {
                                            echo '<tr>';
                                            echo '<td style="text-align: center;">'.$count.'</td>';
                                            echo '<td>'.$s->sbu.'</td>';
                                            echo '<td style="text-align: center;">';?> <a href="#myModal" data-toggle="modal" data-updatingid="<?php echo $s->sbu_id ?>" data-updatingname="<?php echo $s->sbu?>">Update</a><?php echo '</td>';
                                            echo '<td style="text-align: center;">';
                                            ?><a href="#" data-href="<?php echo base_url();?>Admin/delete_sbu/<?php echo $s->sbu_id?>" data-toggle="modal" data-target="#confirm-deactivate">Delete</a><?php echo '</td>';
                                            echo '</td>';
                                            echo '</tr>';
                                            $count +=1;
                                        }

                                        echo '</table>';
                                        echo '</div>';
                                        ?>   <a href="#myModal2" data-toggle="modal"><button type="button" class="btn btn-default btn-circle"><i class="fa fa-plus"></i></button></a><b> Add SBU</b>

<?php
                                    }
                                    else if(empty($sbu))
                                    {
                                        echo '<div class="alert alert-danger text-center">No SBU\'s available.</div>';
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

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>production/js/custom.js"></script>



     <!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
});
</script>

<script>
$('#myModal').on('show.bs.modal', function(e) {

//get data-id attribute of the clicked element
var updatingid = $(e.relatedTarget).data('updatingid');
var updatingname = $(e.relatedTarget).data('updatingname');
//populate the textbox
$(e.currentTarget).find('input[name="updatingid"]').val(updatingid);
$(e.currentTarget).find('input[name="updatingname"]').val(updatingname);
});
</script>

<script type="text/javascript">
$('#confirm-deactivate').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>








</body>

</html>
