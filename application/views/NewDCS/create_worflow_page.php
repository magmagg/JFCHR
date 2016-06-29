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
                            <h1 class="page-header">Create New Workflow</h1>

                            <?php echo $this->session->flashdata('dcs_sent'); ?>
                               <div class="panel panel-yellow">
                                 <div class="panel-heading"">Submit</div>
                               <!-- /.panel-heading -->
                                <div class="panel-body">
                                
                                  <?php echo form_open('Dcs_admin/do_create_new_workflow');?>


                                  <div class="form-group">
                                  <label for="docuname">Proposal title</label>
                                  <input type="text" class="form-control" id="dcstitle" name="dcstitle" placeholder="Proposal" required>
                                  </div>

                                  <div class="form-group">
                                  <label for="comment">Description</label>
                                  <textarea class="form-control" rows="5" id="dcscomment" name="dcscomment" placeholder="Comment" required></textarea>
                                  </div>

                                  
                                  
                                  <div class="form-group">
                                    <label for="sendto">Send to</label>
                                    <select class="js-example-placeholder-single-first"  style="width:100%;" name="approvers[]";>
                                    <option value=""></option>
                                    <?php foreach($users as $u)
                                    {
                                        echo '<option value="'.$u->user_positiontitle.'">'.$u->user_positiontitle.'</option>';
                                        //LAGAY YUNG VALUE SA OPTION
                                    }
                                    ?>
                                    </select>
                                </div>

                                <div id="dynamicInput" class="dynamicdiv"></div>
                                <button type="button" class="btn btn-success btn-circle" value="Add" onclick="addInput('dynamicInput'); myFunction(); add_value_to_select();" ><i class="fa fa-plus"></i></button> <strong>Add more Approvers</strong>

  
                               

                                  
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
var max_input = 5;
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

<script>
$(".js-example-placeholder-single-first").select2({
  placeholder: "Select title",
  allowClear: true
});
</script>

<script>
var titles = <?php echo json_encode($usertitles) ?>;


function addInput(divName) 
{
    if(starting_input < max_input)
    {
    var newDiv = document.createElement('div');
    var selectHTML = "";
    selectHTML="<div class='form-group'>";
    selectHTML+="<label for 'sendto'>Followed by:</label>";
    selectHTML+="<select class='js-example-placeholder-single form-control' style='width:100%;'' name='approvers[]'>";
    selectHTML +="<option class='add'></option>";
    for(i = 0; i < titles.length; i = i + 1) {
        selectHTML += "<option value='" + titles[i] + "'>" + titles[i] + "</option>";
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
