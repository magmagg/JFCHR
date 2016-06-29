<?php
foreach($users as $u)
{
  $usertitles[] = $u->user_positiontitle;
}
?>
    <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Creating new quitclaim workflow.</h1>

                            <?php echo $this->session->flashdata('dcs_sent'); ?>
                               <div class="panel panel-danger">
                                 <div class="panel-heading">Submit</div>
                               <!-- /.panel-heading -->
                                <div class="panel-body">

                                  <?php echo form_open('admin/do_create_new_workflow');?>


                                  <div class="form-group">
                                    <label for="sendto">Department</label>
                                    <select class="js-example-placeholder-single-first" id="departments" style="width:100%;" name="department" onChange="clearData();getData(this);">
                                    <option value=""></option>
                                  </select>

                                  <div class="form-group">
                                    <label for="sendto">Send to</label>
                                    <select class="js-example-placeholder-single-first" id="titles" style="width:100%;" name="approvers[]">
                                    <option value=""></option>
                                    </select>
                                </div>

                                <div id="dynamicInput" class="dynamicdiv"></div>
                                <button type="button" class="btn btn-success btn-circle" value="Add" onclick="addInput('dynamicInput'); myFunction();" ><i class="fa fa-plus"></i></button> <strong>Add more Approvers</strong>





                                   <br><br>
                                   <button type="submit" class="btn btn-default">Submit</button>

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
    var newtitles = [];
var max_input = 50;
var starting_input = 1;
</script>

<script>
function minus_approvers()
{
  starting_input -=1
}
</script>

<script>
$(document).ready(function() {
  var wrapper = $(".dynamicdiv");
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })

});
</script>




<!-- PUT DEPARTMENTS IN FIRST SELECT -->
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

<!--ALWAYS CLEAR TITLES-->
<!-- GET DATA OF SELECT THEN PUT OPTIONS IN SECOND SELECT -->
<script>
function clearData()
{
    document.getElementById('titles').options.length = 0;
}
function getData(dropdown)
{
    newtitles = [];
    var select = document.getElementById("titles");
    var value = dropdown.options[dropdown.selectedIndex].value;
    for(i = 0; i<department_titles.length; i = i+1)
    {
      if(value == department_titles[i].user_sbu)
      {
        newtitles.push(department_titles[i].user_positiontitle);
      }
      else
      {

      }
    }


    for (var i = 0; i<newtitles.length; i++)
    {
        var opt = document.createElement('option');
        opt.value = newtitles[i];
        opt.innerHTML = newtitles[i];
        select.appendChild(opt);
    }

    console.log(newtitles);
}
</script>

<script>
$(".js-example-placeholder-single-first").select2({
  placeholder: "Select title",
  allowClear: true
});
</script>

<script>

function addInput(divName)
{
    if(starting_input < max_input)
    {
    var newDiv = document.createElement('div');
    var selectHTML = "";
    selectHTML="<div class='form-group'>";
    selectHTML+="<label for 'sendto'>Followed by:</label>";
    selectHTML+="<select class='js-example-placeholder-single form-control' id='titles' style='width:100%;'' name='approvers[]'>";
    selectHTML +="<option class='add'></option>";
    for(i = 0; i < newtitles.length; i = i + 1) {
        selectHTML += "<option value='" + newtitles[i] + "'>" + newtitles[i] + "</option>";
    }
    selectHTML += "</select></div>";
    selectHTML+="<a href='#' class='remove_field' onclick='minus_approvers()'>Remove</a>";
    newDiv.innerHTML = selectHTML;
    document.getElementById(divName).appendChild(newDiv);
    starting_input+=1;
    }
    else
    {
      alert("Maximum of 5 only!");
    }
}
</script>

<script type="text/javascript">
    function myFunction()
    {
$(".js-example-placeholder-single").select2({
  placeholder: "Select person",
  allowClear: true
});
}
</script>

<?php
/*
function validateForm()
{
  var x = document.forms["myForm"]["approvers[]"].value;
    if (x == null || x == "") {
        alert("Please Complete approvers");
        return false;
    }

}
*/
?>





</body>

</html>
