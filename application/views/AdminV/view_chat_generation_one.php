     <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quitclaim</h1>
                        <?php echo $this->session->flashdata('success')?>


                                   <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat

                </div>
                <div class="panel-body">
                    <ul class="chat">

                    <?php
                     if(!empty($comments))
                      {


                              $counter = 0;
                         foreach($comments as $c)
                            {

                              foreach($users as $u)
                              {
                                if($c->qc_sender_id == $u->user_employeeID)
                                {
                                  $name = $u->user_lastname;
                                }
                              }

                              if ($counter % 2 == 0)
                              {
                                  echo '<li class="left clearfix">';
                                  echo '</span>';
                                  echo '<div class="chat-body clearfix">';
                                  echo '<div class="header">';
                                  echo '<strong class="primary-font">';
                                  echo $name;
                                  echo '</strong> <small class="pull-right text-muted">';
                                  echo '<span class="glyphicon glyphicon-time"></span>';
                                  echo $c->qc_timestamp;
                                  echo '</small>';
                                  echo '</div>';
                                  echo '<p>';
                                  echo $c->qc_comment;
                                  echo '</p>';
                                  echo '</div>';
                                  echo '</li>';
                                  $counter++;
                              }

                              else
                              {
                                  echo '<li class="right clearfix">';
                                  echo '</span>';
                                  echo '<div class="chat-body clearfix">';
                                  echo '<div class="header">';
                                  echo '<small class=" text-muted"><span class="glyphicon glyphicon-time"></span>';
                                  echo $c->qc_timestamp;
                                  echo '</small>';
                                  echo '<strong class="pull-right primary-font">';
                                  echo $name;
                                  echo '</strong>';
                                  echo '</div>';
                                  echo '<p>';
                                  echo $c->qc_comment;
                                  echo '</p>';
                                  echo '</div>';
                                  echo '</li>';
                                  $counter++;
                              }
                            }
                       }

                        else if(empty($comments))
                        {
                            echo $this->session->flashdata('noannounce');
                        }
                        ?>
                    </ul>
                </div>


                        </span>
                    </div>
                    <h5>Signature</h5>
                    <?php echo form_open('admin/do_generate_script');?>
                    <div id="signature"></div>
                    <a href="#" id="clearSignature" onclick="disableButton2()">Clear Signature</a>
                    <a href="#" id="acceptSignature" onclick="enableButton2()">Accept Signature</a>
                    <input type="hidden" id="signatureBytes" name="signature" value="" />
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <button type="submit" class="btn btn-primary" id="button2" disabled>Generate</button>

                  </form>

                  <div class="panel panel-info">
                              <div class="panel-heading">
                                Generated scripts
                             </div>
                     <div class="panel-body">





                          <div class="well well-lg">
                              <h4>Scripts</h4>

                      <?php
                      $count = 1;
                      foreach($scripts as $s)
                      {

                        echo $count.'.'.'Generated on:';
                        $count++;
                        echo $s->scripts_timestamp.'                |';
                        ?> '<a href="<?php echo base_url();?>admin/download_script/<?php echo $s->scripts_raw_name?>">Download</a>
                        <?php
                        echo '<br>';

                      }

                        ?>
                          </div>

                    </div>



                </div>
            </div>

                                   <!-- THIS IS THE QUITCLAIM -->



                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


    </div>
    <!-- /#wrapper -->


    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>/dist/js/sb-admin-2.js"></script>

    <script>
  		$(document).ready(function(){
    var $sigdiv = $("#signature").jSignature({ lineWidth: 1, width: 700, height: 200 });


    $('#clearSignature').click(function (){
      $sigdiv.jSignature("reset");
    })

    $('#acceptSignature').click(function(){
      var datapair =   $("#signature").jSignature("getData", "base30")
      $("#signatureBytes").val("data:" + datapair[0] + "," + datapair[1] )
    })
  })
  	</script>

    <script>
        function enableButton2()
        {
            document.getElementById("button2").disabled = false;
        }

        function disableButton2()
        {
            document.getElementById("button2").disabled = true;
        }
    </script>

</body>

</html>
