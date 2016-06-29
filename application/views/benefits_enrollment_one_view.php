<?php
foreach ($enrolment as $e)
{
  $title = $e->benefit_title;
  $id = $e->benefit_id;
  $value = $e->benefit_value;
}
?>
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $title?></h1>

                        <?php
                                   if(!empty($enrolment))
                                   {
                                     echo '<div class="panel panel-yellow">';

                                     echo '<div class="panel-heading">';
                                     echo 'Enrolling in this benefit will give you:'.$title.' with a value of: '.$value;
                                     echo '</div>';

                                     echo '<div class="panel-body">';
                                     echo form_open('user/do_submit_one_benefit');
                                      echo '<div class="dataTable_wrapper">';
                                      echo '<table class="table table-striped table-bordered table-hover">';
                                       foreach($enrolment as $e)
                                       {
                                           echo '<tr>';
                                           echo '<td>'.$e->benefit_field.'</td>';
                                             $textfieldname = str_replace(' ', '', $e->benefit_field);
                                           echo '<td>'.'<input type="text" name="'.$textfieldname.'"'.' required>'.'</input>'.'</td>';
                                           echo '</tr>';
                                       }
                                       echo '<tr>';
                                       echo '<td>'.'Value'.'</td>';
                                       echo '<td>'.'<input type="text" name="value" required></input>'.'</td>';
                                       echo '</tr>';
                                       echo '<tr><td colspan="2"><center><input id="btn_dcs" name="submit" type="submit" class="btn btn-success" value="Submit"></center></td>';
                                       echo '<input type="hidden" name="benefitid" value="'.$id.'">';
                                       echo '</table>';
                                       echo '</div>';
                                       echo '</form>';

                                       echo '</div>';
                                       echo '<div class="panel-footer">';
                                       echo '</div>';
                                       echo '</div>';
                                   }
                                   else if(empty($enrolment))
                                   {
                                       echo '<div class="alert alert-danger text-center">No benefit enrolment available.</div>';
                                   }
                                   ?>

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

</body>

</html>
