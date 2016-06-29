<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Updating document</h4>
      </div>
      <div class="modal-body">

        <?php echo form_open(base_url().'admin/do_swap_hierarchy_quitclaim');?>
                                <input type="hidden" name="employeeid">
                                <input type="hidden" name="approverid">
                                  <div class="form-group">
                                  <label for="docuname">Current approver:</label>
                                  <input type="text" class="form-control" id="capprovername" name="capprovername" disabled>
                                  </div>

                                  <div class="form-group">
                                    <label for="sendto">Swap with:</label>
                                    <select class="js-example-placeholder-single form-control" style="width:100%;" name="approver" required>
                                    <option></option>
                                    <?php
                                      foreach($quitclaimtitles as $q)
                                      {
                                        echo '<option value="'.$q->quitclaim_approvers_id.'">'.$q->quitclaim_approvers_position.'</option>';
                                      }

                                    ?>
                                    </select>

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
