$('#fupForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: url + 'import_strwas.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            alert(response.Message);
            if (response.ResponseCode == '200') {
                $('#fupForm')[0].reset();
                loadstraw(url, straw, data.branchid);
            }
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
});