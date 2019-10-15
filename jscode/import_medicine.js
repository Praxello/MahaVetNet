$('#fupForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'import_medicines.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            alert(response.Message);
            if (response.ResponseCode == '200') {
                $('#fupForm')[0].reset();
            }
        }
    });
});