<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Hotline</h4>
      </div>
      <div class="modal-body">
        
        <?php echo form_open('Admin/do_upate_hotline');?>

                                <input type="hidden" name="hotlineid">
                                  <div class="form-group">
                                  <label for="docuname">Hotline Name:</label>
                                  <input type="text" class="form-control" id="hotlinename" name="hotlinename" placeholder="Document name" required>
                                  </div>
                                 <div class="form-group">
                                  <label for="docuname">Hotline Number:</label>
                                  <input type="text" class="form-control" id="hotline" name="hotline" placeholder="Document name" required>
                                  </div>

                                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button style="margin-top: -5px;" type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>