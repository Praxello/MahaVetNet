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
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            alert(response.Message);
            if (response.ResponseCode == '200') {
                $('#farmerup')[0].reset();
                animal_owner(url, farmers, data);
            }
        },
        complete: function() {
            $("#wait").css("display", "none");
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
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            alert(response.Message);
            if (response.ResponseCode == '200') {
                $('#animalup')[0].reset();
            }
        },
        complete: function() {
            $("#wait").css("display", "none");
        }
    });
});