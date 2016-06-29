<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Updating document</h4>
      </div>
      <div class="modal-body">

        <?php echo form_open(base_url().'admin/do_update_hierarchy_quitclaim_one_user');?>

                                <input type="hidden" name="updatingdcsid">
                                <input type="hidden" name="updatingid1">
                                <input type="hidden" name="senderid">

                                  <div class="form-group">
                                  <label for="docuname">Current approver:</label>
                                  <input type="text" class="form-control" id="updatingid" name="updatingid" disabled>
                                  </div>

                                  <div class="form-group">
                                    <label for="sendto">New Approver</label>
                                    <select class="js-example-placeholder-single form-control" style="width:100%;" name="approver">
                                    <option></option>
                                    <?php
                                      foreach($users as $u)
                                      {
                                         echo '<option value="'.$u->user_employeeID.'">'.$u->user_firstname. ' '. $u->user_lastname.' - '.$u->user_positiontitle.'</option>';
                                       }

                                    ?>
                                    </select>

                                </div>

                                <?php
                                /*
                                foreach($users as $u)
                                {
                                  $flag = false;
                                  $userid = $u->user_employeeID;
                                  foreach($dcs as $d)
                                  {
                                    if($userid == $d->dcs_approver_id)
                                    {}
                                    else
                                    {
                                       echo '<option value="'.$u->user_employeeID.'">'.$u->user_firstname." ".$u->user_middlename." ".$u->user_lastname.'</option>';
                                    }
                                  }
                                }
                                */

                                    ?>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button style="margin-top: -5px;" type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
