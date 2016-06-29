        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height:600px;">
                  <div class="x_title">
                    <h2>Upload Benefits Summary</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">



                                                  <?php echo form_open_multipart('Admin/do_upload_benefits_summary');?>

                                                  <div class="form-group">
                                                    <label for="sendto">SBU</label>
                                                    <select class="selectpicker" data-live-search="true" id="departments" style="width:100%;" name="sbu" onChange="clearData();getData(this);" required>
                                                    <option value=""></option>
                                                  </select>

                                                  <div class="form-group">
                                                    <label for="sendto">Rank</label>
                                                    <select class="selectpicker-first" id="rank" style="width:100%;" name="rank" required>
                                                    <option value=""></option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                              <label>Field or Non-Field?</label>
                                                              <label class="radio-inline">
                                                                  <input type="radio" name="field" value="Field">Field
                                                              </label>
                                                              <label class="radio-inline">
                                                                  <input type="radio" name="field" value="Non Field">Non-Field
                                                              </label>
                                                          </div>

                                                  <div class="form-group">
                                                                <label>By date?</label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="datesensitive" id="dateyes" value="Yes">Yes
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="datesensitive" id="dateno" value="No">No
                                                                </label>
                                                            </div>


                                                            <div id="datebefore" class="datebefore"></div>
                                                            <div id="filebefore" class="filebefore"></div>
                                                            <div id="dateafter" class="dateafter"></div>
                                                            <div id="fileafter" class="fileafter"></div>






                                                   <button type="submit" class="btn btn-default">Submit</button>

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

    <!-- Latest compiled and minified JavaScript -->
<script src="<?php echo base_url();?>js/bootstrap-select.min.js"></script>



    <script src="<?php echo base_url(); ?>production/js/custom.js"></script>
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
    $('.selectpicker').selectpicker({
      style: 'btn-info',
      size: 4
    });
    </script>

    <script>
    $('.selectpicker-first').selectpicker({
      style: 'btn-info',
      size: 4
    });

</script>
    <script>
    $(document).ready(function() {
        $('input[type=radio][name=datesensitive]').change(function() {
            if (this.value == 'Yes')
            {
                document.getElementById("dateyes").disabled = true;
                document.getElementById("dateno").disabled = true;
                document.getElementById("dateyes").checked = true;

                var divBeforeDate = "datebefore";

                var newDivBD = document.createElement('div');

                var selectHTMLBD = "";


                selectHTMLBD="<div class='form-group'>";
                selectHTMLBD+="<label for 'datebefore'>Date before:</label>";
                selectHTMLBD+="<input type='date' name='datebefore' required/>";
                selectHTMLBD+=" </div>";

                            selectHTMLBD+="<div class='form-group'>";
                            selectHTMLBD+="<label for 'docufile'>Before date file:</label>";
                            selectHTMLBD+="<input type='file' name='userfile' size='20' onchange='ValidateSingleInput(this);' />";
                            selectHTMLBD+="<p class='help-block'>Doc or Docx files only.</p>";
                            selectHTMLBD+="<?php echo $error;?>";
                            selectHTMLBD+=" </div>";


                            selectHTMLBD+="<div class='form-group'>";
                            selectHTMLBD+="<label for 'docufile'>After date file:</label>";
                            selectHTMLBD+="<input type='file' name='afterfile' size='20' onchange='ValidateSingleInput(this);' />";
                            selectHTMLBD+="<p class='help-block'>Doc or Docx files only.</p>";
                            selectHTMLBD+="<?php echo $error;?>";
                            selectHTMLBD+=" </div>";
                            selectHTMLBD+="<input type='hidden' name='datesensitive' id='dateno' value='Yes'>";


                newDivBD.innerHTML = selectHTMLBD;
                document.getElementById(divBeforeDate).appendChild(newDivBD);


            }
            else if (this.value == 'No')
            {
                document.getElementById("dateyes").disabled = true;
                document.getElementById("dateno").disabled = true;
                document.getElementById("dateno").checked = true;
                var divBeforeDate = "datebefore";

                var newDivBD = document.createElement('div');

                var selectHTMLBD = "";

                            selectHTMLBD+="<div class='form-group'>";
                            selectHTMLBD+="<label for 'docufile'>File input:</label>";
                            selectHTMLBD+="<input type='file' name='userfile' size='20' onchange='ValidateSingleInput(this);' required/>";
                            selectHTMLBD+="<p class='help-block'>Doc or Docx files only.</p>";
                            selectHTMLBD+="<?php echo $error;?>";
                            selectHTMLBD+=" </div>";
                            selectHTMLBD+="<input type='hidden' name='datesensitive' id='dateno' value='No'>";



                newDivBD.innerHTML = selectHTMLBD;
                document.getElementById(divBeforeDate).appendChild(newDivBD);
            }
        });
    });
    </script>

    <script>
    var _validFileExtensions = [".doc", ".docx"];
    function ValidateSingleInput(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
             if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Sorry, doc and docx files only");
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }
    </script>


    <script>
    var sbus = <?php echo json_encode($sbus); ?>;

    var select = document.getElementById('departments');


    for (var i = 0; i<sbus.length; i++)
    {
        var opt = document.createElement('option');
        opt.value = sbus[i].user_sbu;
        opt.innerHTML = sbus[i].user_sbu;
        select.appendChild(opt);
    }
    </script>

    <script>
    var rankssbu = <?php echo json_encode($ranks); ?>;

    console.log(rankssbu);

    </script>

    <script>
    function clearData()
    {
        document.getElementById('rank').options.length = 0;
    }
    function getData(dropdown)
    {
        newranks = [];
        var select = document.getElementById("rank");
        var value = dropdown.options[dropdown.selectedIndex].value;


        for(i = 0; i<rankssbu.length; i = i+1)
        {
          if(value == rankssbu[i].user_sbu)
          {
            newranks.push(rankssbu[i].user_rank);
          }
          else
          {

          }
        }


        for (var i = 0; i<newranks.length; i++)
        {
            var opt = document.createElement('option');
            opt.value = newranks[i];
            opt.innerHTML = newranks[i];
            select.appendChild(opt);
        }

        console.log(newranks);
    }
    </script>


    </body>

    </html>
