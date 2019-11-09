beforeSend: function() {
    console.log('in');
    $("#wait").css("display", "block");
},

,
complete: function(data) {
    // Hide image container
     console.log('out');
    $("#wait").css("display", "none");
}
<div id="wait"></div>
<link href="css/loader.css" rel="stylesheet">
