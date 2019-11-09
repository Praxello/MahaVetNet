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
                var email = response.Data.email;
                window.location.href = 'createSession.php?branchId=' + branchId + '&userId=' + userId + '&username=' + username + '&email=' + email + '&center=' + response.Data.center;
            } else {
                alert('Enter Correct Username and password');
            }
        },
        complete: function(response) {
            // Hide image container
            console.log('out');
            $("#wait").css("display", "none");
        }
    });
});