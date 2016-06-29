  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Forms</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Policies
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                <h1>Policies</h1>
                                 <?php echo form_open(base_url()."Admin/make_new_policy"); ?>
                                 <div class="form-group">
                                    <label for="fname">Header(Name displayed in the page header)</label>
                                    <input type="text" class="form-control" id="header" name="header" placeholder="Header" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="sendto">Category</label>
                                    <select class="js-example-placeholder-single-first"  style="width:100%;" name="categ";>

                                    <?php
                                    foreach($categ as $c)
                                    {
                                      echo '<option value="'.$c->policy_category_id.'">'.$c->policy_category.'</option>';
                                    }

                                    ?>
                                    </select>
                                </div>




                                  <div class="form-group">
                                    <label for="fname">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder ="Title" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="lname">Content</label>
                                    <textarea id="elm1" rows="5"  name="content" class="editable" placeholder="Content"></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Footer</label>
                                    <input type="text" class="form-control" id="footer" name="footer" placeholder="Footer" required>
                                  </div>
                                  <center> <button type="submit" class="btn btn-default">Submit</button> </center>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <h1>Categories</h1>
                                         <?php echo form_open(base_url()."Admin/make_new_category"); ?>
                                 <div class="form-group">
                                    <label for="fname">Category</label>
                                    <input type="text" class="form-control" id="header" name="category" placeholder="Category" required>
                                  </div>
                                  <center> <button type="submit" class="btn btn-default">Submit</button> </center>
                                </form>
                         <!-- /.panel-body -->

                         <h1 style="color:red">Available categories:</h1>
                         <?php
                         $count = 1;
                         foreach($categ as $c)
                         {
                          echo $count. '.';
                          echo $c->policy_category;
                          $count++;
                          echo '<br>';
                         }
                         ?>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="<?php echo base_url();?>js/select2.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>/dist/js/sb-admin-2.js"></script>

    <script>
$(".js-example-placeholder-single-first").select2({
  placeholder: "Select title",
  allowClear: true
});
</script>
</body>

</html>
