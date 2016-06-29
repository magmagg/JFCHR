<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Updating document</h4>
      </div>
      <div class="modal-body">

        <?php echo form_open(base_url().'admin/add_new_benefit_field');?>

                                <input type="hidden" name="benefitpkfk">
                                <input type="hidden" name="benefitid">

                                <div class="form-group">
                                <label for="docuname">Field:</label>
                                <input type="text" class="form-control" id="Field" name="Field" required>

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
