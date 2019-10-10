var styleData = new Map(); // This variable globally declare save all Style Data in Array
let confirmationStatus = new Map();
var medicineData = new Map(); // Medicine Data Map
//getmeasurementitems();
// getallmedicine();
//abc();
$('#medicinename').select2({
  allowClear: true,
  placeholder: "Select Medicine Name"
});

function addtablemedicine(){
  var medicinename = $("#medicinename").val();
            $("#fileList tbody").empty();
            for (var n = 0; n < 4; n++) {
                $("#fileList tbody").append(
                    "<tr>" +
                    "<td style='display:none'>" +n+ "</td>" +
                    "<td>Medicine1"+n+"</td>"+
                    "<td> <button class='btn btn-danger btnDelete'><i class='fa fa-remove '></i></button></td>" +
                    "</tr>"
                );
            }
            $(".btnDelete").on("click", Delete);
            $('#fileList').show()
 }
  function Delete() {
            var rowNumber = $(this).closest('tr').index()+1;
            document.getElementById("fileList").deleteRow(rowNumber);
  }
// function getallmedicine(){
//   $('#styletbl').dataTable().fnDestroy();
//   $("#styletbldata").empty();
//      $.ajax({
//          type: "GET",
//          url: api_url+"allmedicines.php",
//          data:{
//            branchid:1
//          },
//
//          success: function(response) {
//            console.log(response);
//            var count;
//             if(response['Data']!=null){
//                count= response['Data'].length;
//             }
//             for(var i=0;i<count;i++)
//             {
//             medicineData.set(response.Data[i].medicineId,response.Data[i]);
//             }
//             console.log(medicineData);
//          }
//      });
// }
// function abc(){
//       console.log("ok");
//       $('#styletbl').DataTable({
//       searching: true,
//       retrieve: true,
//       bPaginate: $('tbody tr').length>10,
//       order: [],
//       columnDefs: [ { orderable: false, targets: ['copy', 'csv', 'excel', 'pdf'] } ],
//       dom: 'Bfrtip',
//       buttons: [],
//       destroy: true
//       });
// }
// function settabledata(styleData){
//   // console.log(styleData);
//   var html ='';
//   $('#styletbl').dataTable().fnDestroy();
//   $("#styletbldata").empty();
//   for(let k of styleData.keys())
//   {
//         var AllData= styleData.get(k);
//         html +='<tr>';
//         let isConfirmed = confirmationStatus.get(AllData.isActive);
//         html +="<td>"+AllData.itemTitle+"</td>";
//         // html +="<td>"+isConfirmed+"</td>";
//         html +='<td style=""><div class="btn-group" role="group" aria-label="Basic Example"><button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editStyle('+k+')"><i class="fa fa-edit"></i></button><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="removeMeasurements('+k+')"><i class="fa fa-remove"></i></button></div></td>';
//         html +="</tr>";
//   }
//   $("#styletbldata").html(html);
//   $('#styletbl').DataTable({
//   searching: true,
//   retrieve: true,
//   bPaginate: $('tbody tr').length>10,
//   order: [],
//   columnDefs: [ { orderable: false, targets: [0,1] } ],
//   dom: 'Bfrtip',
//   buttons: [],
//   destroy: true
//   });
//
// }
// This function is created for Get All Style Data.
// function getmeasurementitems(){
//   $('#styletbl').dataTable().fnDestroy();
//   $("#styletbldata").empty();
//      $.ajax({
//          type: "GET",
//          url: api_url+"getmeasurementitems.php",
//          async : false,
//          success: function(response) {
//            var count;
//             if(response['Data']!=null){
//                count= response['Data'].length;
//             }
//             for(var i=0;i<count;i++)
//             {
//             styleData.set(response.Data[i].measurementId,response.Data[i]);
//             }
//             settabledata(styleData);
//          }
//      });
// }

//This function is useful for upload the image files
// function imguplod(imgid){
//   // alert(imgid);
//    var triggerid=$('#customerstylepic'+imgid).trigger('click');
//    var fileupload = document.getElementById('customerstylepic'+imgid);
//    fileupload.onchange = function () {
//                 var customerstylepic = $('#customerstylepic'+imgid).val();
//                 var formdata = new FormData($("#custstyleform"+imgid));
//                 $.ajax({
//                      url:"src/addimg.php",
//                      type:"POST",
//                      contentType: false,
//                      cache: false,
//                      processData:false,
//                      data: {
//                        imgnameid:imgid,
//                        imgpic :customerstylepic
//                      },
//                      success:function(response){
//                        // alert(response);
//                        window.location.reload();
//
//
//                      }
//               });
//    };
// }

// This function is created For Add Button New Style
function addStyle(){
  $("#customerstyletable").hide();
  $("#customerstyletableform").show();
  $("#savebtncustomerstyle").show();
  $("#updatebtncustomerstyle").hide();
  // $("#medicinename").val('').trigger('change');
  $("#visitdate").val('');
  $("#batchnumber").val('');
  $("#expirydate").val('');
  $("#wastageqty").val('');
  $("#nogoat").val('');
  $("#nocow").val('');
  $("#nobull").val('');
  $("#nocalf").val('');
  $("#nobuffalo").val('');
  $("#noredka").val('');
  $("#nosheep").val('');
  $("#nopoultry").val('');
  $("#nofees").val('');
}

// This function is created For Edit Button
// function editStyle(id){
// var AllData= styleData.get(id.toString());
// $("#styleid").val(AllData.measurementId);
// $("#styletitle").val(AllData.itemTitle);
// // $("#stylestatus").val(AllData.isActive).trigger('change');
// $("#customerstyletable").hide();
// $("#customerstyletableform").show();
// $("#savebtncustomerstyle").hide();
// $("#updatebtncustomerstyle").show();
// }



// This function is created For Refresh Action / Backbutton
$('#reloadbtn').on('click',function(event){
  event.preventDefault();
  $("#customerstyletable").show();
  $("#customerstyletableform").hide();
  $("#savebtncustomerstyle").show();
  $("#updatebtncustomerstyle").hide();
});
function vacciamount(){

  var nogoat =parseInt($("#nogoat").val());
  var nocow =parseInt($("#nocow").val());
  var nobull =parseInt($("#nobull").val());
  if(nogoat==""){
    nogoat=0;
  }
  if(nocow==""){
    nocow=0;
  }
  if(nobull==""){
    nobull=0;
  }
  var total = nogoat+nocow+nobull;
  console.log("Total"+total);
  $("#totanimal").html(total);
}
// This function is created For Save Style Data
$('#savebtncustomerstyle').on('click',function(event){
   event.preventDefault();
  var medicinename = $("#medicinename").val();
  var visitdate = $("#visitdate").val();
  var batchnumber =$("#batchnumber").val();
  var expirydate =$("#expirydate").val();
  var wastageqty =$("#wastageqty").val();
  var nogoat =$("#nogoat").val();
  var nocow =$("#nocow").val();
  var nobull =$("#nobull").val();
  var nocalf =$("#nocalf").val();
  var nobuffalo =$("#nobuffalo").val();
  var noredka =$("#noredka").val();
  var nosheep =$("#nosheep").val();
  var nopoultry =$("#nopoultry").val();
  var nofees =$("#nofees").val();
  if(nogoat==""){
    nogoat=0;
  }
  if(nocow==""){
    nocow=0;
  }
  if(nobull==""){
    nobull=0;
  }
  if(nocalf==""){
    nocalf=0;
  }
  if(nobuffalo==""){
    nobuffalo=0;
  }
  if(noredka==""){
    noredka=0;
  }
  if(nosheep==""){
    nosheep=0;
  }
  if(nopoultry==""){
    nopoultry=0;
  }
  console.log("medicinename"+medicinename);
  console.log("visitdate"+visitdate);
  console.log("batchnumber"+batchnumber);
  console.log("expirydate"+expirydate);
  console.log("wastageqty"+wastageqty);
  console.log("nogoat"+nogoat);
  console.log("nocow"+nocow);
  console.log("nobull"+nobull);
  console.log("nocalf"+nocalf);
  console.log("nobuffalo"+nobuffalo);
  console.log("noredka"+noredka);
  console.log("nosheep"+nosheep);
  console.log("nopoultry"+nopoultry);
  console.log("nofees"+nofees);
   // $("#stylestatus").val();
  // if(styletitle==""||stylestatus==""){
  //     swal("Missing Parameter");
  // }
  // else{
  var obj={
              medicineids:medicinename,
              visitdate :visitdate,
              batchnumber :batchnumber,
              vaccineexpirydate:expirydate,
              ownerid :'2',
              animalid :'2',
              totalanimals :'2',
              wastagequantity :wastageqty,
              fees :nofees,
              doctorid :'2',
              branchid :'2',
              goat :nogoat,
              cow :nocow,
              bull :nobull,
              calf :nocalf,
              buffalo :nobuffalo,
              redka :noredka,
              sheep :nosheep,
              poultry :nopoultry
           };
    $.ajax({

        url:api_url+'vaccineentry.php',
        type:'POST',
        data:obj,
        dataType:'json',
        beforeSend: function() {
              $(".preloader").show();
        },
        success:function(response){
          if(response.Responsecode===200){
            swal(response.Message);
            // $("#customerstyletable").show();
            // $("#customerstyletableform").hide();
            // obj.measurementId = response.RowId.toString();
            // styleData.set(response.RowId.toString(),obj);
            // settabledata(styleData);
          }
          else {
              swal(response.Message);
          }

        },
        complete:function(response){

          // console.log("after");
          $(".preloader").hide();
        }
    });

});

// This function is created For Update Style Data
// $('#updatebtncustomerstyle').on('click',function(event){
//   event.preventDefault();
//   var styleid = $("#styleid").val();
//   var styletitle = $("#styletitle").val();
//   var stylestatus = 1;
//   // $("#stylestatus").val();
//
//   if(styletitle==""||stylestatus==""||styleid==""){
//       swal("Missing Parameter");
//   }
//   else{
//     var obj={
//       measurementId:styleid,
//       itemTitle:styletitle,
//       isActive:stylestatus
//     };
//   $.ajax({
//       url:api_url+'editmeasurementitem.php',
//       type:'POST',
//       data:obj,
//       dataType:'json',
//       beforeSend: function() {
//             $(".preloader").show();
//             // console.log("before");
//       },
//       success:function(response){
//         if(response.Responsecode===200){
//           swal(response.Message);
//           $("#customerstyletable").show();
//           $("#customerstyletableform").hide();
//           // styleData.delete(styleid.toString());
//           styleData.set(styleid.toString(),obj);
//           settabledata(styleData);
//         }
//         else {
//             swal(response.Message);
//         }
//
//       },
//       complete:function(response){
//
//         // console.log("after");
//         $(".preloader").hide();
//       }
//   });
// }
// });

// This function is created For Remove Button
// function removeMeasurements(id){
//   $.ajax({
//       url:api_url+'deletemeasurements.php',
//       type:'POST',
//       data:{
//         measurementId:id
//       },
//       dataType:'json',
//       beforeSend: function() {
//             $(".preloader").show();
//             // console.log("before");
//       },
//       success:function(response){
//         if(response.Responsecode===200){
//           swal(response.Message);
//           $("#customerstyletable").show();
//           $("#customerstyletableform").hide();
//           styleData.delete(id.toString());
//           settabledata(styleData);
//         }
//         else {
//             swal(response.Message);
//         }
//
//       },
//       complete:function(response){
//
//         // console.log("after");
//         $(".preloader").hide();
//       }
//   });
// }
