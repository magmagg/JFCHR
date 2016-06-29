        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>Import Users</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <?php echo form_open_multipart('Admin/import_users');?>
                      <div class="form-group">
                        <label for="docufile">File input</label>
                        <input type="file" name="userfile" size="20" />
                        <p class="help-block">CSV file only</p>
                        <?php echo $error;?>
                      </div>
                      <button type="submit" class="btn btn-default">Submit</button>
                      <?php echo $this->session->flashdata('csv'); ?>
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