<?php
foreach($dcs as $d)
{
  $dcs_title = $d->dcs_title;
  $dcs_sendercomment = $d->dcs_sendercomment; 
  $dcs_sendername = $d->dcs_sender; 
  $dcs_filename = $d->dcs_docufilename; 
  $dcs_id = $d->dcs_id; 
}


?>
  	<!-- Page Content -->
		        <div id="page-wrapper" class="bg">
		            <div class="container-fluid">
		                <div class="row">
		                        <h1 class="page-header">Viewing Submitted Document</h1>
                                
                              <div class="panel panel-yellow">
                                <div class="panel-heading">
                                 <?php echo $dcs_title; ?>
                                </div>
                                <div class="panel-body">

                                  <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                      Sender Comment and File
                                    </div>
                                    <div class="panel-body">
                                      <?php echo $dcs_sendercomment; ?>
                                        <br>
                                        File: <a href="<?php echo base_url();?>user/download_dcs_document/<?php echo $dcs_filename?>"><?php echo $dcs_filename; ?></a>
                                          
                                    </div>
                                  </div>


                                          <div class="well well-lg">

                                            <table class="table table-bordered table-hover" style="width: 60%; margin-left: 20%;">
                                              <tr>
                                                <td colspan="2">
                                                  <h4 class="align">APPROVING BODY</h4>
                                                </td>
                                              </tr>
                                              <?php
                                              //GET NUMBER OF APPROVERS
                                              $approversnumber = 0;
                                              foreach($dcs as $d) 
                                              {
                                                if($d->dcs_isapproved == 0)
                                                {
                                                  $approversnumber +=1;
                                                }                                                                                              
                                              }
                                              $approversnumbe;
                                              //NAKUHA NA YUNG ILANG APPROVERS


                                              $session_data = $this->session->userdata('logged_in');
                                              $employeeID = $session_data['employeeID'];
                                              foreach($dcs as $d)
                                              {
                                                $approver = $d->dcs_approver_id;
                                                $rev_dcs_hierarchy = $d->dcs_reversehierarchy;

                                                if ($approver == $employeeID && $approversnumber == $rev_dcs_hierarchy)
                                                {
                                                  $current_approver = 1;
                                                  break;
                                                }
                                                if($approver == $employeeID && $d->dcs_isapproved == 1)
                                                {
                                                  $comment = '<div class="alert alert-success text-center">You have approved this already</div>';
                                                  $current_approver = 0;
                                                  break;
                                                }
                                                if($approver == $employeeID && $d->dcs_isapproved == 2)
                                                {
                                                  $comment = '<div class="alert alert-danger text-center">You have rejected this document</div>';
                                                  $current_approver = 0;
                                                  break;
                                                }
                                                if($approver != $employeeID && $d->dcs_isapproved == 2)
                                                {
                                                  $comment = '<div class="alert alert-danger text-center">'. $d->user_lastname . ' rejected this document</div>';
                                                  $current_approver = 0;
                                                  break;
                                                }

                                                $comment ='<div class="alert alert-danger text-center">You are not the approver yet!</div>';
                                                $current_approver = 0;
                                               
                                              }
                                              ?>


                                           <?php
                                              foreach($dcs as $d)
                                              {
                                                echo '<tr><td class="align">'.$d->dcs_hierarchy . "</td><td>" . $d->user_lastname . '</td></tr>';
                                            
                                              }
                                              ?>

                                            </table>
                                            <br>

                                              Sender Comment: <?php echo $dcs_sendercomment ?>
                                          </div>

                                         <br>
                                          <?php
                                          if($current_approver == 1)
                                          {
                                            echo form_open(base_url().'user/process_dcs_document/'.$dcs_id);
                                            ?>
                                            <input type="hidden" name="usedid" value=<?php echo $dcs_id ?>>
                                            <div class="form-group">
                                            <label for="comment">Comment:</label>
                                            <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                            </div> 
                                            <center>                                           
                                            <input id="btn_dcs" name="btn_dcs" type="submit" class="btn btn-success" value="Approve" onclick="unset_required()"/>
                                            <input id="btn_dcs" name="btn_dcs" type="submit" class="btn btn-danger" value="Reject" onclick="set_required()" />
                                            </center> 
                                            </form>
                                            <?php
                                            }
                                          else
                                          {
                                            ?>
                                            <?php echo $comment; ?>
                                              <div class="form-group">
                                              <label for="comment">Comment:</label>
                                              <textarea class="form-control" rows="5" disabled></textarea>
                                              </div> 
                                              <center> 
                                              <button type="button" class="btn btn-success disabled">Approve</button></a></button>
                                              <button type="button" class="btn btn-danger disabled">Reject</button></a></button>
                                              </center><?php
                                          }
                                          ?>
                                
                                          
                                          

                                         

                                    </div>
                                 <div class="panel-footer">
                                 Submitted by: <font class="font"><?php echo $dcs_sendername; ?></font>
                                </div>
                                  </div>
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

    <script>
    function set_required()
    {
       $("textarea").attr("required",true);
       $('textarea').attr("title","Needed when rejected");
    }
    </script>


    <script>
    function unset_required()
    {
       $("textarea").removeAttr("required");       
       $('textarea').removeAttr("title");
    }    
    </script>
</body>

</html>
