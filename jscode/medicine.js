const loadMedicine = (url, medicines, branchid) => {
    $.ajax({
        url: url + 'getall_branchmedicine.php',
        type: 'POST',
        data: { branchid: branchid },
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                for (var i = 0; i < count; i++) {
                    const medicine = response.Data[i];
                    medicines.set(medicine.medicineId, medicine);
                }
                medicine_list(medicines);
            }
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
}

function medicine_list(medicines) {
    $('.medicine-table').dataTable().fnDestroy();
    $('.medicine-data').empty();
    var responseData = '';
    for (let k of medicines.keys()) {
        let medicine = medicines.get(k);
        responseData += "<tr>";
        responseData += "<td>" + medicine.type + "</td>";
        responseData += "<td>" + medicine.tradeName + "</td>";
        responseData += "<td>" + medicine.unit + "</td>";
        responseData += "<td><div class='btn-group' role='group' aria-label='Basic example'>";
        responseData += '<button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onClick="editmedicine(' + k + ')"><i class="fa fa-edit"></i>';
        responseData += '</button><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onClick="remove_medicine(' + k + ')"><i class="fa fa-trash"></i></button>';
        responseData += "</div></td></tr>";
    }
    $('.medicine-data').html(responseData);
    $('.medicine-table').dataTable({
        searching: true,
        retrieve: true,
        bPaginate: $('tbody tr').length > 10,
        order: [],
        columnDefs: [{ orderable: false, targets: [0, 1, 2, 3] }],
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf'],
        destroy: true
    });
}

const editmedicine = param => {
    param = param.toString();
    if (medicines.has(param)) {
        const medicine = medicines.get(param);
        $('#emedicinetype').val(medicine.type);
        $('#emedicineunit').val(medicine.unit);
        $('#emedicinetrade').val(medicine.tradeName);
        $('#medicineid').val(param);
        $('#edit_medicinemodal').modal();
    }
}

$('#addnewmedicine').on('submit', function(e) {
    e.preventDefault();
    var medicineData = {
        type: $('#medicinetype').val(),
        unit: $('#medicineunit').val(),
        tradename: $('#medicinetrade').val(),
        branchid: data.branchid
    };
    $.ajax({
        url: url + 'addmedicine.php',
        type: 'POST',
        data: medicineData,
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Responsecode == 200) {
                if (response.Data != null) {
                    medicines.set(response.Data.medicineId, response.Data);
                }
                $('#addnewmedicine')[0].reset();
                $('#medicinemodal').modal('toggle');
            }
            medicine_list(medicines);
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
});

$('#editmedicine').on('submit', function(e) {
    e.preventDefault();
    var medicineData = {
        type: $('#emedicinetype').val(),
        unit: $('#emedicineunit').val(),
        tradeName: $('#emedicinetrade').val(),
        medicineId: $('#medicineid').val()
    };
    $.ajax({
        url: url + 'update_medicine.php',
        type: 'POST',
        data: medicineData,
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Responsecode == 200) {
                medicines.set(medicineData.medicineId, medicineData);
                $('#editmedicine')[0].reset();
                $('#edit_medicinemodal').modal('toggle');
            }
            medicine_list(medicines);
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
});

const remove_medicine = param => {
    var r = confirm("Are you Sure to delete this medicine!");
    if (r == true) {
        $.ajax({
            url: url + 'remove_medicine.php',
            type: 'POST',
            data: { medicineId: param },
            dataType: 'json',
            beforeSend: function() {
                $("#wait").css("display", "block");
            },
            success: function(response) {
                param = param.toString();
                if (response.Responsecode == 200) {
                    medicines.delete(param);
                }
                medicine_list(medicines);
            },
            complete: function(data) {
                $("#wait").css("display", "none");
            }
        });
    }
}
loadMedicine(url, medicines, data.branchid);