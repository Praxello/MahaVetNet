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
                     tblData += '<p><span>' + response.Data[i].mobile + '(' + response.Data[i].branchId + ')</span></p><a class="btn btn-primary btn-sm float-right" type="button" onclick="getanemail(\'' + response.Data[i].branchId + '\',\'' + response.Data[i].centre_type + '\',\'' + response.Data[i].mobile + '\')";>Not My VD</a> </div><div class="clearfix"></div> </a>';
                     tblData += '</li>';
                 }
                 tblData += '<hr></hr>';
                 $('.loadmobile').prepend(tblData);
             }

         }
     });
 }

 function getanemail(branchId, centre_type, mobile) {
     const data = {
         branchId: branchId,
         center: centre_type,
         mobile: mobile
     };
     $.ajax({
         url: url + 'sendEmail.php',
         type: 'POST',
         data: data,
         dataType: 'json',
         success: function(response) {
             alert(response.Message);
         }
     });
 }