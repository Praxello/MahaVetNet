<div class="modal fade" id="farmerModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <form id="addnewfarmer" method="POST" >
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

                            <input type="text" class="form-control" placeholder="Name" id="fname" required>

                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Mobile No." id="fmobile" required onkeypress="javascript:return isNumberKey(event)" pattern="^\d{10}$">

                        </div>
                        <div class="form-group">
                            <label>Gender: </label>
                            <label class="radio-inline"><input type="radio" name="optradio" checked
                                    value="Male">Male</label>
                            <label class="radio-inline"><input type="radio" name="optradio"
                                    value="Female">Female</label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Address" id="faddress"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fcategory">Select Category</label>
                            <select id="fcategory" class="form-control" style="height: 2.43em!important;">
                                <option value=" "></option>
                                <option value="BPL">BPL</option>
                                <option value="OPEN">OPEN</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Aadhar No.(Optional)" id="fadhar">
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