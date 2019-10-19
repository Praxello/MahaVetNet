$('#farmerup').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: url + 'import_farmers.php',
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

$('#animalup').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: url + 'import_animals.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            alert(response.Message);
            if (response.ResponseCode == '200') {
                $('#animaup')[0].reset();
            }
        }
    });
});