    <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Creating new benefit.</h1>

                            <?php echo $this->session->flashdata('dcs_sent'); ?>
                               <div class="panel panel-danger">
                                 <div class="panel-heading">New benefit</div>
                               <!-- /.panel-heading -->
                                <div class="panel-body">

                                  <?php echo form_open('Admin/do_create_new_benefit');?>


                                  <div class="form-group">
                                  <label for="docuname">Benefit Title</label>
                                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                                  </div>

                                  <div class="form-group">
                                  <label for="comment">Description</label>
                                  <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description" required></textarea>
                                  </div>

                                  <label for="comment">Value</label>
                                  <div class="form-group input-group">
                                            <span class="input-group-addon">₱</span>
                                            <input type="text" name="value" class="form-control">
                                            <span class="input-group-addon">.00</span>
                                        </div>

                                        <div class="form-group">
                                    <label for="sendto">Send to</label>
                                    <select class="js-example-placeholder-single-first"  style="width:100%;" name="approver";>
                                    <option value="1">Admin</option>
                                    <?php foreach($users as $u)
                                    {
                                        echo '<option value="'.$u->user_employeeID.'">'.$u->user_lastname.'</option>';
                                        //LAGAY YUNG VALUE SA OPTION
                                    }
                                    ?>
                                    </select>
                                </div>



                            <div class="form-group">
                              <label for="sendto">Department</label>
                              <select class="js-example-placeholder-single-first" id="departments" style="width:100%;" name="department">
                              <option value="ALL">All departments</option>
                            </select>
                          </div>

                          <div class="form-group">
                          <label>Fields</label>
                          <?php
                          foreach($defined as $d)
                          {
                            echo '<div class="checkbox">';
                            echo '<label>';
                            echo '<input type="checkbox" name="defined[]" value='.'"'.$d->benfits_defined_name.'">'.$d->benfits_defined_name;
                            echo '</label>';
                            echo '</div>';
                          }
                          ?>

                        </div>

                        <div class="form-group">
                        <label>Additional fields</label>
                                  <div class="input_fields_wrap">
                                  <div><input type="text" class="form-control" placeholder="Field" style="width:30%;" name="mytext[]"></div>
                                  <br>
                                  </div>
                                  <button class="add_field_button btn btn-primary">Add More Fields</button>

                                   <br><br>
                                   <button type="submit" class="btn btn-default">Submit</button>

                                   </form>
                                 </div>

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
    var department_titles = <?php echo json_encode($alldepttitles); ?>;
    var departments = [];
    var uniquedepartments = [];


    for(i = 0; i<department_titles.length; i = i+1)
    {
      departments.push(department_titles[i].user_sbu);
    }

    $.each(departments, function(i, el){
        if($.inArray(el, uniquedepartments) === -1) uniquedepartments.push(el);
    });
    var select = document.getElementById('departments');

    for (var i = 0; i<uniquedepartments.length; i++)
    {
        var opt = document.createElement('option');
        opt.value = uniquedepartments[i];
        opt.innerHTML = uniquedepartments[i];
        select.appendChild(opt);
    }
    </script>

    <script>
    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" class="form-control" placeholder="Field" style="width:30%;" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

<script>
$(".js-example-placeholder-single-first").select2({
  placeholder: "Select approver",
  allowClear: true
});
</script>

</body>

</html>
