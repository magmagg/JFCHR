        <?php
            foreach($userdata as $usr)
            {
                $fname = $usr->user_firstname;
                $lname = $usr->user_lastname;
                $userid = $usr->user_employeeID;
                $password = $usr->user_password;
                $email = $usr->user_email;
                $username = $usr->user_username;
                $sbu = $usr->user_sbu;
                $positiontitle = $usr->user_positiontitle;
                $rank = $usr->user_rank;
                $location = $usr->user_company;
                $field = $usr->user_isfield;
            }
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>Edit User</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <center>
                      <h3><?php echo $fname." ".$lname?></h3>
                    </center>

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo base_url(); ?>Admin/edit_user_one">

                      <input type="hidden" name="userid" value="<?php echo $userid; ?>" />

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="email" value="<?php echo $email; ?>" type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Username: <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="username" value="<?php echo $username?>" type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="password" value="<?php echo $password?>" id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="sendto">SBU</label>
                        <select class="js-example-placeholder-single-first" id="titles" style="width:100%;" name="SBU">
                        <option value="<?php echo $sbu?>"><?php echo $sbu; ?></option>
                        <?php
                        foreach($sbus as $s)
                        {
                          echo '<option value="'.$s->sbu.'">'.$s->sbu.'</option>';
                        }
                        ?>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="sendto">Position title:</label>
                      <select class="js-example-placeholder-single-first" id="titles" style="width:100%;" name="ptitle">
                      <option value="<?php echo $positiontitle?>"><?php echo $positiontitle; ?></option>
                      <?php
                      foreach($positions as $s)
                      {
                        echo '<option value="'.$s->position.'">'.$s->position.'</option>';
                      }
                      ?>
                      </select>
                  </div>


                  <div class="form-group">
                    <label for="sendto">Rank:</label>
                    <select class="js-example-placeholder-single-first" id="titles" style="width:100%;" name="rank">
                    <option value="<?php echo $rank?>"><?php echo $rank; ?></option>
                    <?php
                    foreach($ranks as $s)
                    {
                      echo '<option value="'.$s->rank.'">'.$s->rank.'</option>';
                    }
                    ?>
                    </select>
                </div>

                <?php
                if($field == 'Field')
                {
                  $newfield = 'Non Field';
                }
                else
                {
                  $newfield = 'Field';
                }
                ?>

                <div class="form-group">
                  <label for="sendto">Field or Non Field:</label>
                  <select class="js-example-placeholder-single-first" id="titles" style="width:100%;" name="field">
                  <option value="<?php echo $field?>"><?php echo $field; ?></option>
                  <option value="<?php echo $newfield?>"><?php echo $newfield; ?></option>
                  </select>
              </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

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
  </body>
</html>
