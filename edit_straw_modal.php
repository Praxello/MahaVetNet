<div class="modal fade" id="edit_strawmodal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <form id="editstraw" method="POST" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Update Straw Details</h4>
                </div>
                <div class="modal-body">

                <input type="hidden" id="strawId">
                    <div class="row">
                    <div class="form-group">
                            <input type="text" class="form-control" placeholder="Straw Number" id="estraw_number" required>
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