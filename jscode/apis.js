 const url = 'https://praxello.com/ahimsa/apis/';
 // const url = 'apis/';
 getMobileNumber();

 function getMobileNumber() {
     var contact = sessionStorage.getItem('mobile');
     $.ajax({
         url: url + 'getmobilenumber.php',
         type: 'POST',
         data: { 'contact': contact },
         dataType: 'json',
         success: function(response) {
             if (response.Data != null) {
                 var str = '',
                     tblData = '';
                 var count = response.Data.length;
                 tblData += '<li><div class="notification_header">';
                 tblData += '<h3>Your Mobile Number is mapped in ' + count + ' VDs</h3></div></li>';
                 for (var i = 0; i < count; i++) {
                     // sessionStorage.setItem(i, JSON.stringify(response.Data[i]));
                     tblData += '<li><a href="#"><div class="notification_desc"><p>' + response.Data[i].centre_type + '</p>';
                     tblData += '<p><span>' + response.Data[i].mobile + '(' + response.Data[i].branchId + ')</span></p></div><div class="clearfix"></div> </a>';
                     tblData += '</li>';
                 }
                 tblData += '<hr></hr>';
                 $('.loadmobile').prepend(tblData);
             }

         }
     });
 }

 // function loadHeaderData() {
 //     var count = sessionStorage.length;
 //     var str = '',
 //         tblData = '';
 //     if (count > 0) {
 //         tblData += '<li><div class="notification_header">';
 //         tblData += '<h3>You have ' + count + ' new messages</h3></div></li>';
 //         for (var i = 0; i < count; i++) {
 //             str = JSON.parse(sessionStorage.getItem(i));
 //             tblData += '<li><a href="#"><div class="notification_desc"><p>' + str.centre_type + '</p>';
 //             tblData += '<p><span>' + str.mobile + '</span></p></div><div class="clearfix"></div> </a>';
 //             tblData += '</li>';
 //         }
 //         tblData += '<hr></hr>';
 //         console.log(tblData);
 //         $('.loadmobile').prepend(tblData);
 //     }
 // }