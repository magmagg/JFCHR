        <!-- Page Content -->
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                                <h1 class="page-header">Messages</h1>

                                 <?php echo $this->session->flashdata('message_sent'); ?>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                            Messages
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#home-pills" data-toggle="tab">Inbox</a>
                                </li>
                                <li><a href="#profile-pills" data-toggle="tab">Sent</a>
                                </li>
                                <li><a href="#messages-pills" data-toggle="tab">New message</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home-pills">
                                    <br>
                                        <?php
                                        if(!empty($messages))
                                        {
                                            echo '<div class="dataTable_wrapper">';
                                            echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                            echo '<thead>';
                                            echo '<tr>';
                                            echo '<th>'."From".'</th>';
                                            echo '<th>'."Content".'</th>';
                                            echo '<th>'."Sent".'</th>';
                                            echo '</tr>';
                                            echo '</thead>';
                                            echo '<tbody>';
                                            foreach($messages as $m)
                                            {
                                              foreach($users as $u)
                                              {
                                                if($m['people_receiver_id'] == $u->user_employeeID)
                                                {
                                                  $name = $u->user_firstname . ' ' . $u->user_lastname;
                                                }
                                              }
                                                echo '<tr>';
                                                echo '<td>'.$name.'</td>';
                                                echo '<td>'.$m['message'].'</td>';
                                                echo '<td>'.$m['message_timestamp'].'</td>';
                                               // echo '<td>'.anchor('item/view_item/'.$i->id,'View').'</td>';
                                                //echo '<td>'.anchor('item/view_edit_item/'.$i->id,'Edit').'</td>';
                                               // echo '<td>'.anchor('item/view_delete_item/'.$i->id,'Delete').'</td>';
                                            }
                                            echo '</tbody>';
                                            echo '</table>';
                                            echo '</div>';
                                        }
                                        else if(empty($messages))
                                        {
                                            echo '<div class="alert alert-danger text-center">No messages.</div>';
                                        }

                                        ?>
                                </div>



                                <div class="tab-pane fade" id="profile-pills">
                                    <br>
                                        <?php
                                        if(!empty($sentmessages))
                                        {
                                            echo '<div class="dataTable_wrapper">';
                                            echo '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
                                            echo '<thead>';
                                            echo '<tr>';
                                            echo '<th>'."Message".'</th>';
                                            echo '<th>'."Time sent".'</th>';
                                            echo '<th>'."Receiver name".'</th>';
                                            echo '<th>'."Action".'</th>';
                                            echo '</tr>';
                                            echo '</thead>';
                                            echo '<tbody>';
                                            foreach($sentmessages as $m)
                                            {
                                              foreach($users as $u)
                                              {
                                                if($m['people_receiver_id'] == $u->user_employeeID)
                                                {
                                                  $name = $u->user_firstname . ' ' . $u->user_lastname;
                                                }
                                              }
                                                echo '<tr>';
                                                echo '<td>'.$m['message'].'</td>';
                                                echo '<td>'.$m['message_timestamp'].'</td>';
                                                echo '<td>'.$name.'</td>';
                                                echo '<td>'.'Delete'.'</td>';
                                               // echo '<td>'.anchor('item/view_item/'.$i->id,'View').'</td>';
                                                //echo '<td>'.anchor('item/view_edit_item/'.$i->id,'Edit').'</td>';
                                               // echo '<td>'.anchor('item/view_delete_item/'.$i->id,'Delete').'</td>';
                                            }
                                            echo '</tbody>';
                                            echo '</table>';
                                            echo '</div>';
                                        }
                                        else if(empty($sentmessages))
                                        {
                                            echo '<div class="alert alert-danger text-center">No sent messages.</div>';
                                        }

                                        ?>
                                </div>



                                <div class="tab-pane fade" id="messages-pills">
                                    <div class="panel-body">
                                        <?php echo form_open(base_url()."user/send_message"); ?>
                                         <?php echo $this->session->flashdata('announce_success'); ?>
                                  <div class="form-group">
                                    <label for="sendto">Send to</label>
                                    <select class="js-example-basic-multiple form-control" multiple="multiple" style="width:100%;" name="receivers[]">
                                    <?php foreach($users as $u)
                                    {
                                        echo '<option value="'.$u->user_employeeID.'">'.$u->user_firstname." ".$user_middlename." ".$u->user_lastname.'</option>';
                                        //LAGAY YUNG VALUE SA OPTION
                                    }
                                    ?>
                                    </select>
                                </div>


                                  <div class="form-group">
                                    <label for="content">Message</label>
                                    <textarea class="form-control" rows="5" id="message" name="message" placeholder="Message"></textarea>
                                  </div>


                                  <center> <button type="submit" class="btn btn-default">Send</button> </center>
                                </form>
                                <?php echo form_close(); ?>
                                    </div>
                                <!-- .panel-body -->

                                </div>

                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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

    <script src="<?php echo base_url();?>js/select2.min.js"></script>

    <script type="text/javascript">
  $(".js-example-basic-multiple").select2(
    {
         placeholder: "Send to",
        allowClear: true
    });
</script>






</body>

</html>
