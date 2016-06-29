<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Document</h4>
      </div>
      <div class="modal-body">

        <?php echo form_open_multipart('Admin/do_update_document');?>

                                <input type="hidden" name="documentid">
                                  <div class="form-group">
                                  <label for="docuname">Document Name</label>
                                  <input type="text" class="form-control" id="docuname" name="docuname" placeholder="Document name" required>
                                  </div>
                                  <label for="docucateg">Document Category</label>
                                  <br>
                                  <label class="radio-inline">
                                  <input type="radio" name="docucateg" id="inlineRadio1" value="Forms" checked> Forms
                                  </label>
                                  <label class="radio-inline">
                                  <input type="radio" name="docucateg" id="inlineRadio2" value="Templates"> Templates
                                  </label>

                                  <div class="form-group">
                                    <label for="sendto">Company</label>
                                    <select class="js-example-placeholder-single form-control" style="width:100%;" name="company">
                                    <option></option>
                                    <?php
                                      foreach($uniquecompanies as $c)
                                      {
                                        echo '<option value="'.$c.'">'.$c.'</option>';
                                      }

                                    ?>
                                    </select>

                                </div>


                                  <div class="form-group">
                                  <label for="docufile">File input</label>
                                  <input type="file" name="userfile" size="20" />
                                  <p class="help-block">Doc or Docx files only.</p>
                                  <?php echo $error;?>
                                   </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a style="margin-top: -5px;" class="btn btn-danger btn-ok">Submit</a>
      </div>
      </form>
    </div>
  </div>
</div>
