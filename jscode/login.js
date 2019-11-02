$('#signin').on('submit', function(event) {
    event.preventDefault();
    var loginData = {
        usrname: $('#usrname').val(),
        passwrd: $('#passwrd').val()
    };
    $.ajax({
        url: url + 'authenticate.php',
        type: 'POST',
        data: loginData,
        dataType: 'json',
        beforeSend: function() {
            console.log('in');
            // Show image container
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Data != null) {
                var branchId = response.Data.branchId;
                var userId = response.Data.userId;
                var username = response.Data.fullName;
                window.location.href = 'createSession.php?branchId=' + branchId + '&userId=' + userId + '&username=' + username;
            } else {
                alert('Enter Correct Username and password');
            }
        },
        complete: function(data) {
            // Hide image container
            console.log('out');
            $("#wait").css("display", "none");
        }
    });
});