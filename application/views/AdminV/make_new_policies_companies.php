        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>New Policy</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php
                        if(!empty($uniquecompanies))
                        {
                            $count = 1;
                    ?>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th colspan="2">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach($uniquecompanies as $c)
                            {
                        ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $c; ?></td>
                          <td><a href="<?php echo base_url();?>admin/view_one_company_policies/<?php echo $c?>">View policies</a></td>
                          <td><a href="<?php echo base_url();?>admin/make_one_policies_company/<?php echo $c?>">Create policies</a></th>
                        </tr>
                        <?php
                            $count++;
                            }
                        }
                        else if(empty($uniquecompanies))
                        {
                            echo $this->session->flashdata('nocompanies');
                        }
                        ?>
                      </tbody>
                    </table>
                  
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