<?php
foreach($dcs as $d)
{
  $title = $d->custom_dcs_title;
  $id = $d->custom_dcs_id;
}

$session_data = $this->session->userdata('logged_in');
$mysbu = $session_data['SBU'];
?>
    <!-- Page Content -->
            <div id="page-wrapper" class="bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Submitting <?php echo $title; ?></h1>

                               <div class="panel panel-yellow">
                                 <div class="panel-heading">Submitting <?php echo $title; ?> 
                                 
                                 </div>
                               <!-- /.panel-heading -->
                                <div class="panel-body">
                                
                                  <?php echo form_open_multipart('DCS/do_submit_dcs');?>
                                  <input type="hidden" name="dcstitle" value="<?php echo $title?>">

                                  <input type="hidden" name="dcsid" value="<?php echo $id?>">


                                  <div class="form-group">
                                  <label for="comment">Comment:&nbsp;</label>(optional)
                                  <textarea class="form-control" rows="5" id="dcscomment" name="dcscomment" placeholder="Comment" style="max-width: 940px;"></textarea>
                                  </div>

                                  <div class="form-group">
                                    <label for="sendto">Send To:</label>
                                    <select class="js-example-placeholder-single-first"  style="width:100%;" name="sbu";>
                                    
                                    <?php 
                                    foreach($sbus as $s)
                                      {
                                          if($s->user_sbu == $mysbu)
                                          {                                          
                                            echo '<option value="'.$s->user_sbu.'">'.$s->user_sbu.'</option>';
                                          }
                                      }
                                      
                                    foreach($sbus as $s)
                                    {
                                        if($s->user_sbu == $mysbu)
                                        {                                          
                                          continue;
                                        }
                                        else
                                        {
                                           echo '<option value="'.$s->user_sbu.'">'.$s->user_sbu.'</option>';
                                        }
                                    }
                                    ?>
                                    </select>
                                </div>

                                  <div class="form-group">
                                  <label for="docufile">File Input:</label>
                                  <input type="file" name="userfile" size="20" />
                                  <p class="help-block">Doc or Docx files only.</p>
                                  <?php echo $this->session->flashdata('error');?>
                                  

                                  
                                   </div>
                                   <button type="submit" class="btn btn-warning">Submit</button>

                                   </form>
                              
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
    <script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

    <!-- Dropzone -->
    <script src="<?php echo base_url();?>js/dropzone.js"></script>

    <script src="<?php echo base_url();?>js/select2.min.js"></script>

    <script src="<?php echo base_url();?>js/bootstrap-select.js"></script>



<script>
$(".js-example-placeholder-single-first").select2({
  placeholder: "Select title",
  allowClear: true
});
</script> 

</body>

</html>
