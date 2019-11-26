<div class="modal fade" id="animalModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
<form id="addnewanimal" method="POST">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Add Animal</h4>
                </div>
                <div class="modal-body">

                <div class="row">
                <div class="form-group">
                            <input type="text" class="form-control" placeholder="Animal Name-Tag" id="animalname" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Species" required="" id="species">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Breed" required="" id="breed">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Weight" required="" id="weight"  onkeypress="javascript:return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Gender: </label>
                            <label class="radio-inline"><input type="radio" name="animal_optradio" checked value="Male">Male</label>
                            <label class="radio-inline"><input type="radio" name="animal_optradio" value="Female">Female</label>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number" placeholder="Age" class="form-control" id="age" onkeypress="javascript:return isNumberKey(event)">
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" style="height: 2.43em!important;" id="year">
                                    <option>Year</option>
                                        <option>Days</option>
                                        <option>Month</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" placeholder="Weight" required="" id="birthdate">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Remark" id="remarks"></textarea>
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
