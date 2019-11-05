<div class="modal fade" id="editfarmerModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
<form id="editfarmer" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Add Farmer</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                    <div class="form-group">
                            <input type="hidden" id="eownerid"/>
                            <input type="text" class="form-control" placeholder="Name" id="edit_fname" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Mobile No." id="edit_fmobile" required>
                        </div>
                        <div class="form-group">
                            <label>Gender: </label>
                            <label class="radio-inline"><input type="radio" name="edit_optradio"  value="Male" id="male">Male</label>
                            <label class="radio-inline"><input type="radio" name="edit_optradio" value="Female" id="female">Female</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Address" id="edit_faddress" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fcategory">Select Category</label>
                            <select id="edit_fcategory" class="form-control" style="height: 2.43em!important;">
											<option value=" "></option>
										   <option value="BPL">BPL</option>
										   <option value="OPEN">OPEN</option>
										   <option value="SC">SC</option>
										   <option value="ST">ST</option>
									   </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Aadhar No.(Optional)" id="edit_fadhar">
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