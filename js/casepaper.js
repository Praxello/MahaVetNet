const data = {
    branchid: $('#branchid').val()
};

function loadcasepaper() {
    $('.farmer-table').dataTable().fnDestroy();
    $('.farmer-data').empty();
    var from = $('#from').val();
    var upto = $('#upto').val();
    const details = {
        from: from,
        upto: upto,
        branchId: data.branchid
    };
    if (from != '' && upto != '') {
        $.ajax({
            url: url + 'getcasepapers.php',
            type: 'POST',
            data: details,
            dataType: 'json',
            beforeSend: function() {
                $("#wait").css("display", "block");
            },
            success: function(response) {
                if (response.Data != null) {
                    var tableData = '';
                    var count = response.Data.length;
                    for (var i = 0; i < count; i++) {
                        tableData += "<tr><td>" + response.Data[i].animalName + "</td>";
                        tableData += "<td>" + response.Data[i].specie + "</td>";
                        tableData += "<td>" + response.Data[i].breed + "</td>";
                        tableData += "<td>" + response.Data[i].firstName + ' ' + response.Data[i].lastName + "</td>";
                        tableData += "<td>" + response.Data[i].mobile + "</td>";
                        tableData += "<td>" + response.Data[i].address + "</td>";
                        tableData += "<td>" + response.Data[i].symptoms + "</td>";
                        tableData += "<td>" + response.Data[i].visitDate + "</td></tr>";
                    }
                }
                $('.farmer-data').html(tableData);
                $('.farmer-table').dataTable({
                    searching: true,
                    retrieve: true,
                    bPaginate: $('tbody tr').length > 10,
                    order: [],
                    columnDefs: [{ orderable: false, targets: [0, 1, 2, 3, 4, 5, 6] }],
                    dom: 'Bfrtip',
                    buttons: ['copy', 'excel', 'csv', 'pdf', 'colvis'],
                    destroy: true
                });
            },
            complete: function() {
                $("#wait").css("display", "none");
            }

        });
    }
}