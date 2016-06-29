        <?php
          foreach($quitclaim as $q)
          {
            $timeposted = $q->quitclaim_timestamp;

            $quitclaimid = $q->quitclaim_id;
          }
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>Edit Undergoing Quitclaim Workflow</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <?php echo $this->session->flashdata('swapped'); ?>
                    <?php echo $this->session->flashdata('success'); ?>
                    
                    <h2 style="text-align: center;">APPROVING BODY</h2>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Approver</th>
                          <th>Status</th>
                          <th>Position</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($quitclaim as $q)
                        {
                      ?>
                        <tr>
                          <th><?php echo $q->quitclaim_hierarchy; ?></th>
                          <td><?php echo $q->user_lastname; ?></td>
                          <?php

                                                if($q->quitclaim_isapproved == 0)
                                                {
                                                  echo  '<td style="color: black;">'.'<i class="fa fa-minus fa-fw">&nbsp;&nbsp;PENDING</i>'.'</td>';
                                                }
                                                else if($q->quitclaim_isapproved == 2)
                                                {
                                                  echo  '<td style="color: rgb(180,14,22);">'.'<i class="fa fa-warning fa-fw">&nbsp;REJECTED</i>'.'</td>';
                                                }
                                                else
                                                {
                                                  echo  '<td style="color: green;">'.'<i class="fa fa-check fa-fw">&nbsp;APPROVED</i>'.'</td>';
                                                }
                          ?>
                          <td><?php echo $q->user_positiontitle; ?></td>
                          <td><a href="#myModal" data-toggle="modal" data-senderid="<?php echo $q->quitclaim_senderid ?>" data-updatingid="<?php echo $q->quitclaim_approvers_emp_id ?>" data-updatingid1="<?php echo $q->quitclaim_approvers_emp_id ?>" data-updatingdcsid="<?php echo $q->quitclaim_id_fk?>">Update</a></td>
                        </tr>
                    <?php
                      }
                    ?>
                      </tbody>
                    </table>
                  
                    <?php
                                        if(!empty($document))
                                        {
                                          foreach($document as $d)
                                          {
                                            ?><a href="<?php echo base_url();?>Quitclaim/download_final_quitclaim_docu/<?php echo $d->quitclaim_document_filename?>">Download final document</a>
                                        <?php
                                          }
                                        }
                                        else if(empty($document))
                                        {
                                          //
                                        }
                                         ?>

                    </div>
                                 <div class="panel-footer">
                                  Date of Activation:&nbsp; <font class="font"><?php echo $timeposted; ?></font>
                                </div>
                                  </div>

                  </div>
                </div>

                <div class="x_panel" style="min-height:50px;">
                  <div class="x_title">
                    <h2>Scripts</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <br>
                  <?php echo form_open('Admin/do_generate_quitclaim_report/'.$employeeID);?>


                         <center><button type="submit" class="btn btn-default">Generate</button></center>
                         <br>


                         <?php
                         if(!empty($reports))
                         {
                           $count = 1;
                           foreach($reports as $d)
                           {
                             echo $count. '.' .'Generated on '.$d->report_qc_timestamp.'        ';
                             ?><a href="<?php echo base_url();?>admin/download_generated_report/<?php echo $d->report_qc_filename?>">Download</a>
                         <?php
                         $count++;

                         echo '<br>';
                           }
                         }
                         else if(empty($reports))
                         {
                           //
                         }
                          ?>


                         </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Powered by <a href="#">Jollibee Foods Corporation</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>production/js/custom.js"></script>


        <script type="text/javascript">
$(".js-example-placeholder-single").select2({
  placeholder: "Select position",
  allowClear: true
});
</script>
    <script>

    $('#myModal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var senderid = $(e.relatedTarget).data('senderid');
    var updatingid = $(e.relatedTarget).data('updatingid');
    var updatingid1 = $(e.relatedTarget).data('updatingid1');
    var updatingdcsid = $(e.relatedTarget).data('updatingdcsid');
    //populate the textbox
    $(e.currentTarget).find('input[name="senderid"]').val(senderid);
    $(e.currentTarget).find('input[name="updatingid"]').val(updatingid);
    $(e.currentTarget).find('input[name="updatingid1"]').val(updatingid1);
    $(e.currentTarget).find('input[name="updatingdcsid"]').val(updatingdcsid);
    });
    </script>
  </body>
</html>