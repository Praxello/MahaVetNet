const loadstraw = (url, straw, branchid) => {
    $.ajax({
        url: url + 'getall_branchstraw.php',
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
                    const straws = response.Data[i];
                    straw.set(straws.strawId, straws);
                }
                straw_list(straw);
            }
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
}

function straw_list(straw) {
    $('.straw-table').dataTable().fnDestroy();
    $('.straw-data').empty();
    var responseData = '';
    var i = 1;
    for (let k of straw.keys()) {
        let straws = straw.get(k);
        var consumed = "<td>No</td>";
        if (straws.isConsumed == '1') {
            consumed = "<td>Yes</td>";
        }
        responseData += "<tr>";
        responseData += "<td>" + (i) + "</td>";
        responseData += "<td>" + straws.straw_number + "</td>";
        responseData += consumed;
        responseData += "<td><div class='btn-group' role='group' aria-label='Basic example'>";
        responseData += '<button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onClick="editstraw(' + k + ')"><i class="fa fa-edit"></i>';
        responseData += '</button><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onClick="removeStraw(' + k + ')"><i class="fa fa-trash"></i></button>';
        responseData += "</div></td></tr>";
        i++;
    }
    $('.straw-data').html(responseData);
    $('.straw-table').dataTable({
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

const editstraw = param => {
    param = param.toString();
    if (straw.has(param)) {
        const straws = straw.get(param);
        console.log(straws);
        $('#estraw_number').val(straws.straw_number);
        $('#strawId').val(param);
        $('#estraw_consumed').val(straws.isConsumed).trigger('change');
        $('#edit_strawmodal').modal();
    }
}

$('#addnewstraw').on('submit', function(e) {
    e.preventDefault();
    var strawData = {
        straw_number: $('#straw_number').val(),
        branchid: data.branchid
    };
    $.ajax({
        url: url + 'addstraw.php',
        type: 'POST',
        data: strawData,
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Responsecode == 200) {
                if (response.Data != null) {
                    straw.set(response.Data.strawId, response.Data);
                }
                $('#addnewstraw')[0].reset();
                $('#strawmodal').modal('toggle');
            }
            straw_list(straw);
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
});

$('#editstraw').on('submit', function(e) {
    e.preventDefault();
    var strawData = {
        strawId: $('#strawId').val(),
        straw_number: $('#estraw_number').val(),
        isConsumed: $('#estraw_consumed').val(),
        branchid: data.branchid
    };
    $.ajax({
        url: url + 'update_straw.php',
        type: 'POST',
        data: strawData,
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Responsecode == 200) {
                straw.set(strawData.strawId, strawData);
                $('#editstraw')[0].reset();
                $('#edit_strawmodal').modal('toggle');
            }
            straw_list(straw);
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
});

const removeStraw = param => {
    var r = confirm("Are you Sure to delete this Straw number!");
    if (r == true) {
        $.ajax({
            url: url + 'remove_straw.php',
            type: 'POST',
            data: { strawId: param },
            dataType: 'json',
            beforeSend: function() {
                $("#wait").css("display", "block");
            },
            success: function(response) {
                param = param.toString();
                if (response.Responsecode == 200) {
                    straw.delete(param);
                }
                straw_list(straw);
            },
            complete: function(data) {
                $("#wait").css("display", "none");
            }
        });
    }
}
loadstraw(url, straw, data.branchid);