
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

                <?php echo $this->session->flashdata('success');

                  if($noishrflag == 1)
                  {
                ?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Quitclaim Process</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="x_content bs-example-popovers">
                      <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Warning!</strong> You have no IS and HR yet, please complete this form to start the quitclaim.
                      </div>
                    </div>

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo base_url(); ?>Quitclaim/submit_ishr">
                      <div class="form-group">

            <input type="hidden" name="quitclaimid" value="<?php echo $quitclaimid?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Immediate Superior:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control" tabindex="-1" name="is" required>
                            <option></option>
                            <?php
                              foreach($users as $u)
                              {
                            ?>
                                <option value="<?php echo $u->user_employeeID; ?>"><?php echo $u->user_firstname.' '.$u->user_lastname.' '.$u->user_positiontitle; ?></option>

                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">HR Manager:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control" tabindex="-1" name="hr" required>
                            <option></option>
                            <?php
                              foreach($users as $u)
                              {
                            ?>
                                <option value="<?php echo $u->user_employeeID; ?>"><?php echo $u->user_firstname.' '.$u->user_lastname.' '.$u->user_positiontitle; ?></option>

                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <center> <button type="submit" class="btn btn-default">Submit</button> </center>
                    </form>

                    <?php
                      }
                      else
                      {

                      }
                    ?>
                  </div>
                </div>

                <?php echo $this->session->flashdata('quitclaim'); ?>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Approving Body</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Approver</th>
                          <th>Status</th>
                          <th>Position</th>
                          <th>Date Approved</th>
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

                          <?php
                            if($q->quitclaim_isapproved == 0)
                            {
                              ?>
                              <td style="color: black;"><i class="fa fa-minus">&nbsp;PENDING</i></td>
                              <?php
                            }
                            else if($q->quitclaim_isapproved == 2)
                            {
                              ?>
                              <td style="color: green;"><i class="fa fa-check ">&nbsp;REJECTED</i></td>
                              <?php
                            }
                            else
                            {
                              ?>
                            <td style="color: green;"><i class="fa fa-check ">&nbsp;APPROVED</i></td>
                              <?php
                            }
                          ?>
                          <td><?php echo $q->user_positiontitle; ?></td>
                          <td><?php echo $q->quitclaim_timeapproved; ?></td>
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
                          ?><a href="<?php echo base_url();?>Quitclaim/download_final_quitclaim_docu/<?php echo $employeeID?>">Download final document</a>
                          <?php
                        }
                      }
                      else if(empty($document))
                      {
                        //
                      }
                    ?>

                  </div>

                    &nbsp;Date of Activation:&nbsp; <font class="font"><?php echo $timeposted; ?></font>

                </div>

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Chatbox</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="dropdown">
                        <a href="<?php echo base_url();?>Quitclaim/generate_scripts/<?php echo $quitclaimid;?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-file-code-o"></i> Generate Scripts </a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                    <!-- /.panel-heading -->
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


                <div class="x_panel">
                  <div class="x_title">
                    <h2>Scripts</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <?php
                      if(!empty($scripts))
                      {
                        $count = 1;
                        foreach($scripts as $d)
                        {
                          echo $count. '.' .'Generated on '.$d->scripts_timestamp.'        ';
                    ?><a href="<?php echo base_url();?>Quitclaim/download_generated_report/<?php echo $d->scripts_raw_name?>">Download</a>
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

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>


        <script src="<?php echo base_url();?>js/select2.min.js"></script>

    <script>
      $(".js-example-placeholder-single").select2({
        placeholder: "Select IS",
        allowClear: true
      });
      </script>

      <script>
      $(".js-example-placeholder-single-first").select2({
        placeholder: "Select HR",
        allowClear: true
      });
    </script>
  </body>

</html>
