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
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Data != null) {
                var branchId = response.Data.branchId;
                var userId = response.Data.userId;
                var username = response.Data.fullName;
                var email = response.Data.email;
                sessionStorage.setItem('mobile', response.Data.mobile);
                console.log(sessionStorage.getItem('mobile'));
                window.location.href = 'createSession.php?branchId=' + branchId + '&userId=' + userId + '&username=' + username + '&email=' + email + '&center=' + response.Data.center + '&designation=' + response.Data.designation;
            } else {
                alert('Enter Correct Username and password');
            }
        },
        complete: function(response) {
            $("#wait").css("display", "none");
        }
    });
});