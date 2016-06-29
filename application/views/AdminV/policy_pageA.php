      <?php
        foreach($policy as $p)
        {
          $policyTitle = $p->policy_title;
          $policyContent = $p->policy_content;
          $policyFooter = $p->policy_footer;
          $policyTime = $p->policy_timeupdated;
          $policyHeader = $p->policy_header;
        }
       ?>


        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2><?php echo $policyHeader ?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-md-12 col-lg-12 col-sm-12">
                      <!-- blockquote -->
                      <blockquote>
                        <h2><?php echo $policyTitle; ?></h2>
                        <hr>
                        <p><?php echo $policyContent; ?> </p>
                        <hr>
                        <font size="2">
                          <?php echo $policyFooter; ?>
                        </font>
                      </blockquote>
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
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>production/js/custom.js"></script>
  </body>
</html>