<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Updating hotline</h4>
      </div>
      <div class="modal-body">
        
        <?php echo form_open('Admin/do_update_value');?>

                                <input type="hidden" name="values_id">
                                <input type="hidden" name="value_owner_id">
                                  <div class="form-group">
                                  <label for="docuname">Value name</label>
                                  <input type="text" class="form-control" id="value_name" name="value_name" placeholder="Document name" disabled>
                                  </div>
                                 <div class="form-group">
                                  <label for="docuname">Value</label>
                                  <input type="text" class="form-control" id="values_value" name="values_value" placeholder="Value" required>
                                  </div>

                                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>