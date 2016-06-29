<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add approver</h4>
      </div>
      <div class="modal-body">

        <?php echo form_open(base_url().'admin/edit_quitclaim_workflow_add_modal');?>

                                <input type="hidden" name="employeeID">

                                  <div class="form-group">
                                    <label for="sendto">Add:</label>
                                    <select class="js-example-placeholder-single form-control" style="width:100%;" name="approver" required>
                                    <option></option>
                                    <?php
                                      foreach($users as $u)
                                      {
                                        echo '<option value="'.$u->user_employeeID.'">'.$u->user_employeeID.' - '.$u->user_firstname.' '.$u->user_lastname.' - '.$u->user_positiontitle.'</option>';
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
