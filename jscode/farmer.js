const animal_owner = (url, farmers, data) => {
    $.ajax({
        url: url + 'allowners.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                for (var i = 0; i < count; i++) {
                    const AnimalOwner = response.Data[i].AnimalOwner;
                    farmers.set(AnimalOwner.ownerId, response.Data[i]);
                }
                farmer_list(farmers);
            }
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
}

function farmer_list(farmers) {
    $('.farmer-table').dataTable().fnDestroy();
    $('.farmer-data').empty();
    var responseData = '';
    for (let k of farmers.keys()) {
        let farmerData = farmers.get(k);
        const AnimalOwner = farmerData.AnimalOwner;
        responseData += "<tr>";
        responseData += "<td>" + AnimalOwner.firstName + ' ' + AnimalOwner.lastName + "</td>";
        responseData += "<td>" + AnimalOwner.mobile + "</td>";
        responseData += "<td>" + AnimalOwner.sex + "</td>";
        responseData += "<td><address>" + AnimalOwner.address + "</address></td>";
        responseData += "<td><div class='btn-group' role='group' aria-label='Basic example'>";
        responseData += '<button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onClick="editowner(' + k + ')"><i class="fa fa-edit"></i>';
        responseData += '</button><button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Animals" onClick="loadAnimals(' + k + ')"><img src="img/cow.png">';
        responseData += "</button></div></td></tr>";
    }
    $('.farmer-data').html(responseData);
    $('.farmer-table').dataTable({
        searching: true,
        retrieve: true,
        bPaginate: $('tbody tr').length > 10,
        order: [],
        columnDefs: [{ orderable: false, targets: [0, 1, 2, 3, 4] }],
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf'],
        destroy: true
    });
}

const editowner = param => {
    param = param.toString();
    if (farmers.has(param)) {
        const animalOwner = farmers.get(param);
        const owner = animalOwner.AnimalOwner;
        $('#edit_fname').val(owner.firstName + ' ' + owner.lastName);
        $('#eownerid').val(owner.ownerId);
        $('#edit_fmobile').val(owner.mobile);
        $('#edit_faddress').val(owner.address);
        $('#edit_fcategory').val(owner.category).trigger('change');
        $('#edit_fadhar').val(owner.adharId);
        if (owner.sex == 'Male') {
            $("#male").prop('checked', true);
        } else if (owner.sex == 'Female') {
            $("#female").prop('checked', true);
        }
        $('#editfarmerModal').modal();
    }

}

$('#addnewfarmer').on('submit', function(e) {
    e.preventDefault();
    var category = $('#fcategory').val();
    var adharid = $('#fadhar').val();
    if (category == '') {
        category = '';
    }
    if (adharid == '') {
        adharid = '';
    }
    var firstName = getFirstName($('#fname').val());
    var lastName = getLastName($('#fname').val());
    var farmerData = {
        gender: $("input[name='optradio']:checked").val(),
        userid: data.doctorid,
        firstname: firstName,
        lastname: lastName,
        profession: '',
        mobile: $('#fmobile').val(),
        city: '',
        state: '',
        address: $('#faddress').val(),
        landmark: '',
        branchid: data.branchid,
        category: category,
        adharid: adharid
    };
    $.ajax({
        url: url + 'addanimalowner.php',
        type: 'POST',
        data: farmerData,
        dataType: 'json',
        beforeSend: function() {
            console.log('in');
            $("#wait").css("display", "block");
        },
        success: function(response) {
            const Animals = null;
            var mainObj = {};
            if (response.Responsecode == 200) {
                if (response.Data != null) {
                    var count = response.Data.length;
                    var lastEntry = response.Data[count - 1];
                    mainObj.AnimalOwner = lastEntry;
                    mainObj.Animals = Animals;
                    farmers.set(lastEntry.ownerId, mainObj);
                }
                $('#addnewfarmer')[0].reset();
                $('#farmerModal').modal('toggle');
                loadAnimals(lastEntry.ownerId);
            }
            farmer_list(farmers);
        },
        complete: function(data) {
            // Hide image container
            console.log('out');
            $("#wait").css("display", "none");
        }
    });
});


$('#editfarmer').on('submit', function(e) {
    e.preventDefault();
    var category = $('#edit_fcategory').val();
    var adharid = $('#edit_fadhar').val();
    if (category == '') {
        category = '';
    }
    if (adharid == '') {
        adharid = '';
    }
    var firstName = getFirstName($('#edit_fname').val());
    var lastName = getLastName($('#edit_fname').val());
    var farmerData = {
        ownerid: $('#eownerid').val(),
        gender: $("input[name='edit_optradio']:checked").val(),
        userid: data.doctorid,
        firstname: firstName,
        lastname: lastName,
        profession: '',
        mobile: $('#edit_fmobile').val(),
        city: '',
        state: '',
        address: $('#edit_faddress').val(),
        landmark: '',
        branchid: data.branchid,
        category: category,
        adharid: adharid
    };
    var farmerData_set = {
        ownerId: $('#eownerid').val(),
        sex: $("input[name='edit_optradio']:checked").val(),
        userid: data.doctorid,
        firstName: firstName,
        lastName: lastName,
        profession: '',
        mobile: $('#edit_fmobile').val(),
        city: '',
        state: '',
        address: $('#edit_faddress').val(),
        landmark: '',
        branchid: data.branchid.toString(),
        category: category,
        adharid: adharid
    };
    $.ajax({
        url: url + 'updateanimalowner.php',
        type: 'POST',
        data: farmerData,
        dataType: 'json',
        success: function(response) {
            var ownerDetails = farmers.get(farmerData.ownerid.toString());
            var Animals = ownerDetails.Animals;
            var mainObj = {};
            if (response.Responsecode == 200) {
                if (response.Data != null) {
                    mainObj.AnimalOwner = farmerData_set;
                    mainObj.Animals = Animals;
                    farmers.set(farmerData.ownerid.toString(), mainObj);
                }
                $('#editfarmer')[0].reset();
                $('#editfarmerModal').modal('toggle');
            }
            farmer_list(farmers);
        }
    });
});
animal_owner(url, farmers, data);

function isNumberKey(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}