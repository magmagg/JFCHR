<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm Quitclaim Activation</h4>
      </div>
      <div class="modal-body">

        <?php echo form_open(base_url().'user/check_quitclaim_password');?>

        <div class="well" align="center">
          Are you sure you want to activate your quitclaim?</br>
          Please fill out the fields to continue:
        </div>
          <div class="form-group">
            <label for="docuname">Password:</label>
            <input type="password" class="form-control" id="pword" name="pword">
          </div>
          <div class="form-group">
            <label for="docuname">New Email Address:</label>
            <input type="email" class="form-control" id="email" name="email">
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
