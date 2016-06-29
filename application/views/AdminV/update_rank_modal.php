<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Rank</h4>
      </div>
      <div class="modal-body">

        <?php echo form_open(base_url().'Admin/do_update_rank');?>

                                  <input type="hidden" name="updatingid">
                                  <div class="form-group">
                                  <label for="docuname">Current rank:</label>
                                  <input type="text" class="form-control" id="updatingname" name="updatingname" disabled>
                                  </div>

                                  <div class="form-group">
                                  <label for="docuname">New rank:</label>
                                  <input type="text" class="form-control" id="newpos" name="newpos">
                                  </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
