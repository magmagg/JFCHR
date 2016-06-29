<?php
  $current_approver = 0;
  foreach($quitclaim as $q)
  {
    $sender_name = $q->quitclaim_sender;
    $quitclaim_id = $q->quitclaim_id;
    $timeposted = $q->quitclaim_timestamp;
    $quitclaimid = $q->quitclaim_id;
    $file = $q->quitclaim_document_path.$q->quitclaim_document_filename;
    $filename = $q->quitclaim_document_filename;
    $quitclaimdocumentid = $q->quitclaim_document_id;
    $senderid = $q->quitclaim_senderid;

    $approverid = $q->quitclaim_approvers_emp_id;
    $isapprover = $q->quitclaim_reversehierarchy;
    $isapproved = $q->quitclaim_isapproved;
    if($employeeid == $approverid && $isapprover == 1 && $isapproved == 0)
    {
      $current_approver = 1;
     $quitclaim_approvers_table_id = $q->quitclaim_approvers_table_id;
    }
  }
?>
<style>
canvas.jSignature { height: 500px; }
</style>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>View Quitclaim of <?php echo $sender_name; ?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <h2 align="center">Approving Body</h2>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Hierarchy</th>
                          <th>Approver's Name</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($quitclaim as $q)
                        {
                      ?>
                        <tr>
                          <td><?php echo $q->quitclaim_hierarchy; ?></td>
                          <td><?php echo $q->user_lastname; ?></td>
                        </tr>
                      <?php
                        }
                      ?>
                      </tbody>
                    </table>

                    <?php
                      if($current_approver == 1)
                      {
                    ?>

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" action="<?php echo base_url(); ?>user/process_quitclaim/<?php echo $quitclaim_id;?>">

                      Signature:
                      <input type="file" name="fileToUpload" id="fileToUpload" required>

                          <input type="hidden" name="file" value="<?php echo $file?>">

                          <input type="hidden" name="filename" value="<?php echo $filename?>">

                          <input type="hidden" name="senderid" value="<?php echo $senderid?>">

                          <input type="hidden" name="quitclaimdocumentid" value="<?php echo $quitclaimdocumentid?>">

                          <input type="hidden"  name="quitclaimidfk" value="<?php echo $quitclaimid?>">

                          <input type="hidden" name="quitclaimidtable" value="<?php echo $quitclaim_approvers_table_id?>">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="btn_dcs" value="Approve">Submit</button>
                        </div>
                      </div>

                    </form>

                  <?php
                    }
                    else
                    {
                  ?>

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo base_url(); ?>user/process_quitclaim/<?php echo $quitclaim_id;?>">

                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="btn_dcs" value="Approve" disabled>Approve</button>
                        </div>
                      </div>

                    </form>

                  <?php
                    }
                  ?>

                  </div>
                </div>

                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>Chatbox</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown">
                          <a href="<?php echo base_url();?>user/generate_scripts/<?php echo $quitclaim_id;?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-code"></i> Generate Script</a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="panel-body">
                                      <ul class="chat">
                                        <div id="chat-wrap">
                                            <div id="chat-area"></div>

                                        </div>
                                      </ul>
                                  </div>
                                  <!-- /.panel-body -->
                                  <div class="panel-footer">
                                      <div class="input-group">
                                        <form id="send-message-area" action="">
                                            <textarea id="sendie" maxlength='100' class="form-control input-sm" placeholder="Type your message here..." ></textarea>
                                        </form>
                                      </div>

                                  </div>

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

  </body>
</html>
