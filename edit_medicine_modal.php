<div class="modal fade" id="edit_medicinemodal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <form id="editmedicine" method="POST" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Edit Medicine Details</h4>
                </div>
                <div class="modal-body">

                <input type="hidden"  id="medicineid">
                    <div class="row">
                    <div class="form-group">
                            <input type="text" class="form-control" placeholder="Type" id="emedicinetype" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Unit" id="emedicineunit" required>
                        </div>
                        
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Trade of Medicine" id="emedicinetrade" required></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->