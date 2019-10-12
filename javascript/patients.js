var vaccinationList = new Map(); // This variable globally declare save all Style Data in Array
let confirmationStatus = new Map();
var medicineData = new Map(); // Medicine Data Map

$('#medicinename').select2({
  allowClear: true,
  placeholder: "Select Medicine Name"
});
getlistvaccineentry();

function settabledata(styleData){
  console.log(styleData);
  var html ='';
  $('#styletbl').dataTable().fnDestroy();
  $("#styletbldata").empty();
  for(let k of styleData.keys())
  {
        var AllData= styleData.get(k);
        html +='<tr>';
        // let isConfirmed = confirmationStatus.get(AllData.isActive);
        html +="<td>"+AllData.animalId+"</td>";
        html +="<td>"+AllData.animalName+"</td>";
        html +="<td>"+AllData.specie+"/"+AllData.breed+"</td>";
        html +="<td>"+AllData.firstName+" "+AllData.lastName+"</td>";
        html +="<td>"+AllData.address+"</td>";
        html +="<td>"+AllData.mobile+"</td>";
        // html +="<td>"+isConfirmed+"</td>";
        html +='<td>';
        html +='<div class="btn-group">';
        html +='    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">';
        html +='  Action </button>';
        html +='    <ul class="dropdown-menu" >';
        html +='      <li><button class="btn btn-primary" onclick="buttonvacination('+k+')">Vaccination</button></li>';
        html +='      <li><button class="btn btn-secondary" onclick="buttondeworming('+k+')">Deworming</button></li>';
        html +='    </ul>';
        html +='  </div>';
        // html +='<td style=""><div class="btn-group" role="group" aria-label="Basic Example"><button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editStyle('+k+')"><i class="fa fa-edit"></i></button><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="removeMeasurements('+k+')"><i class="fa fa-remove"></i></button></div></td>';
        html +="</tr>";
  }
  $("#styletbldata").html(html);
  $('#styletbl').DataTable({
  searching: true,
  retrieve: true,
  bPaginate: $('tbody tr').length>10,
  order: [],
  columnDefs: [ { orderable: false, targets: [0,1,2,3,4,5,6] } ],
  dom: 'Bfrtip',
  buttons: [],
  destroy: true
  });

}

function getlistvaccineentry(){
  var docterid = $("#drid").val();
  var branchid = $("#brid").val();
  $('#styletbl').dataTable().fnDestroy();
  $("#styletbldata").empty();
     $.ajax({
         type: "POST",
         url: url+"allpatients.php",
         data :{
           branchid:branchid
         },
         async : false,
         dataType :'json',
         success: function(response) {
            // console.log(response);
           var count;
            if(response['Data']!=null){
               count= response['Data'].length;
            }
            for(var i=0;i<count;i++)
            {
            vaccinationList.set(response.Data[i].ownerId,response.Data[i]);
            }
            settabledata(vaccinationList);
         }
     });
}

// This function is created For Add Button New Style
// function addStyle(){
//   $("#customerstyletable").hide();
//   $("#customerstyletableform").show();
//   $("#savebtncustomerstyle").show();
//   $("#updatebtncustomerstyle").hide();
//   $("#medicinename").val('').trigger('change');
//   $("#visitdate").val('');
//   $("#batchnumber").val('');
//   $("#expirydate").val('');
//   $("#wastageqty").val('');
//   $("#nogoat").val('');
//   $("#nocow").val('');
//   $("#nobull").val('');
//   $("#nocalf").val('');
//   $("#nobuffalo").val('');
//   $("#noredka").val('');
//   $("#nosheep").val('');
//   $("#nopoultry").val('');
//   $("#nofees").val('');
//   $("#totanimal").html(0);
// }

// This function is created For Edit Button
function buttonvacination(id){
  // console.log(id);
   //console.log(vaccinationList.get(id.toString()));
   var AllData= vaccinationList.get(id.toString());
   // console.log(AllData.animalId);
   window.location.href="vaccination.php?oid="+id+"&aniid="+AllData.animalId;
   // $.ajax({
   //     type: "POST",
   //     url: "vaccination.php",
   //     data :{
   //       ownerid:id,   // For the owner id
   //       animalid:AllData.animalId // For the animal id
   //     },
   //     async : false,
   //     dataType :'json',
   //     success: function(response) {
   //        console.log(response);
   //        window.location.href="vaccination.php";
   //     }
   // });

}
function buttondeworming(id){
  // console.log(id);
   //console.log(vaccinationList.get(id.toString()));
   var AllData= vaccinationList.get(id.toString());
   // console.log(AllData.animalId);
   window.location.href="deworming.php?oid="+id+"&aniid="+AllData.animalId;
}


// This function is created For Refresh Action / Backbutton
// $('#reloadbtn').on('click',function(event){
//   event.preventDefault();
//   $("#customerstyletable").show();
//   $("#customerstyletableform").hide();
//   $("#savebtncustomerstyle").show();
//   $("#updatebtncustomerstyle").hide();
// });
// function vacciamount(){
//   var nogoat =$("#nogoat").val();
//   var nocow =$("#nocow").val();
//   var nobull =$("#nobull").val();
//   var nocalf =$("#nocalf").val();
//   var nobuffalo =$("#nobuffalo").val();
//   var noredka =$("#noredka").val();
//   var nosheep =$("#nosheep").val();
//   var nopoultry =$("#nopoultry").val();
//   if(nogoat==""){
//     nogoat=0;
//   }
//   if(nocow==""){
//     nocow=0;
//   }
//   if(nobull==""){
//     nobull=0;
//   }
//   if(nocalf==""){
//     nocalf=0;
//   }
//   if(nobuffalo==""){
//     nobuffalo=0;
//   }
//   if(noredka==""){
//     noredka=0;
//   }
//   if(nosheep==""){
//     nosheep=0;
//   }
//   if(nopoultry==""){
//     nopoultry=0;
//   }
//   var total = parseInt(nogoat)+parseInt(nocow)+parseInt(nobull)+parseInt(nocalf)+parseInt(nobuffalo)+
//   parseInt(noredka)+parseInt(nosheep)+parseInt(nopoultry);
//   // console.log("Total"+total);
//   $("#nofees").val(total);
//   $("#totanimal").html(total);
// }
// This function is created For Save Style Data
// $('#savebtncustomerstyle').on('click',function(event){
//    event.preventDefault();
//   var medicinename = $("#medicinename").val();
//   var visitdate = $("#visitdate").val();
//   var batchnumber =$("#batchnumber").val();
//   var expirydate =$("#expirydate").val();
//   var wastageqty =$("#wastageqty").val();
//   var nogoat =$("#nogoat").val();
//   var nocow =$("#nocow").val();
//   var nobull =$("#nobull").val();
//   var nocalf =$("#nocalf").val();
//   var nobuffalo =$("#nobuffalo").val();
//   var noredka =$("#noredka").val();
//   var nosheep =$("#nosheep").val();
//   var nopoultry =$("#nopoultry").val();
//   var nofees =$("#nofees").val();
//   if(nogoat==""){
//     nogoat="0";
//   }
//   if(nocow==""){
//     nocow="0";
//   }
//   if(nobull==""){
//     nobull="0";
//   }
//   if(nocalf==""){
//     nocalf="0";
//   }
//   if(nobuffalo==""){
//     nobuffalo="0";
//   }
//   if(noredka==""){
//     noredka="0";
//   }
//   if(nosheep==""){
//     nosheep="0";
//   }
//   if(nopoultry==""){
//     nopoultry="0";
//   }
//   var totanimal = $("#totanimal").html();

//   var obj={
//               medicineids:medicinename,
//               visitdate :visitdate,
//               batchnumber :batchnumber,
//               vaccineexpirydate:expirydate,
//               ownerid :'2',
//               animalid :'2',
//               totalanimals :totanimal,
//               wastagequantity :wastageqty,
//               fees :nofees,
//               doctorid :'2',
//               branchid :'2',
//               goat :nogoat,
//               cow :nocow,
//               bull :nobull,
//               calf :nocalf,
//               buffalo :nobuffalo,
//               redka :noredka,
//               sheep :nosheep,
//               poultry :nopoultry
//            };
//            var obj1 ={
//              batch: batchnumber,
//              branchId: "2",
//              buffalo: nobuffalo,
//              bull: nobull,
//              calf:nocalf,
//              cow: nocow,
//              doctorId: "759",
//              fees: nofees,
//              goat: nogoat,
//              isDeleted: "0",
//              medicineIds: medicinename.toString(),
//              ownerId: "10",
//              poultry:nopoultry,
//              redka: noredka,
//              sheep: nosheep,
//              totalAnimals: totanimal,
//              vaccineExpiryDate: expirydate,
//              visitDate:visitdate,
//              wastageQuantity:wastageqty
//            };
//     $.ajax({
//
//         url:url+'vaccineentry.php',
//         type:'POST',
//         data:obj,
//         dataType:'json',
//         beforeSend: function() {
//               $(".preloader").show();
//         },
//         success:function(response){
//           if(response.Responsecode===200){
//             swal(response.Message);
//             $("#customerstyletable").show();
//             $("#customerstyletableform").hide();
//             obj.treatmentid = response.RowId.toString();
//             vaccinationList.set(response.RowId.toString(),obj1);
//             settabledata(vaccinationList);
//           }
//           else {
//               swal(response.Message);
//           }
//         },
//         complete:function(response){
//           $(".preloader").hide();
//         }
//     });
// });

// This function is created For Update Style Data
// $('#updatebtncustomerstyle').on('click',function(event){
//   event.preventDefault();
//   var treatmentid=$("#treatmentid").val();
//   var medicinename = $("#medicinename").val();
//   var visitdate = $("#visitdate").val();
//   var batchnumber =$("#batchnumber").val();
//   var expirydate =$("#expirydate").val();
//   var wastageqty =$("#wastageqty").val();
//   var nogoat =$("#nogoat").val();
//   var nocow =$("#nocow").val();
//   var nobull =$("#nobull").val();
//   var nocalf =$("#nocalf").val();
//   var nobuffalo =$("#nobuffalo").val();
//   var noredka =$("#noredka").val();
//   var nosheep =$("#nosheep").val();
//   var nopoultry =$("#nopoultry").val();
//   var nofees =$("#nofees").val();
//   if(nogoat==""){
//     nogoat=0;
//   }
//   if(nocow==""){
//     nocow=0;
//   }
//   if(nobull==""){
//     nobull=0;
//   }
//   if(nocalf==""){
//     nocalf=0;
//   }
//   if(nobuffalo==""){
//     nobuffalo=0;
//   }
//   if(noredka==""){
//     noredka=0;
//   }
//   if(nosheep==""){
//     nosheep=0;
//   }
//   if(nopoultry==""){
//     nopoultry=0;
//   }
//   var totanimal = $("#totanimal").html();
//   console.log(totanimal);
//   var obj={
//               treatmentid:treatmentid,
//               medicineids:medicinename,
//               visitdate :visitdate,
//               batchnumber :batchnumber,
//               vaccineexpirydate:expirydate,
//               ownerid :'2',
//               animalid :'2',
//               totalanimals :totanimal,
//               wastagequantity :wastageqty,
//               fees :nofees,
//               doctorid :'2',
//               branchid :'2',
//               goat :nogoat,
//               cow :nocow,
//               bull :nobull,
//               calf :nocalf,
//               buffalo :nobuffalo,
//               redka :noredka,
//               sheep :nosheep,
//               poultry :nopoultry
//            };
//     var obj1 ={
//             treatmentid:treatmentid,
//              batch: batchnumber,
//              branchId: "2",
//              buffalo: nobuffalo,
//              bull: nobull,
//              calf:nocalf,
//              cow: nocow,
//              doctorId: "759",
//              fees: nofees,
//              goat: nogoat,
//              isDeleted: "0",
//              medicineIds: medicinename.toString(),
//              ownerId: "10",
//              poultry:nopoultry,
//              redka: noredka,
//              sheep: nosheep,
//              totalAnimals: totanimal,
//              vaccineExpiryDate: expirydate,
//              visitDate:visitdate,
//              wastageQuantity:wastageqty
//            };
//   $.ajax({
//       url:url+'editvaccineentry.php',
//       type:'POST',
//       data:obj,
//       dataType:'json',
//       beforeSend: function() {
//             $(".preloader").show();
//       },
//       success:function(response){
//         if(response.Responsecode===200){
//           swal(response.Message);
//           $("#customerstyletable").show();
//           $("#customerstyletableform").hide();
//           vaccinationList.set(treatmentid.toString(),obj1);
//           settabledata(vaccinationList);
//         }
//         else {
//             swal(response.Message);
//         }
//
//       },
//       complete:function(response){
//         $(".preloader").hide();
//       }
//   });
// });

// This function is created For Remove Button
// function removeMeasurements(id){
//   $.ajax({
//       url:url+'deletevaccineentry.php',
//       type:'POST',
//       data:{
//         treatmentid : id ,
//         branchid : 1
//       },
//       dataType:'json',
//       beforeSend: function() {
//             $(".preloader").show();
//             // console.log("before");
//       },
//       success:function(response){
//         if(response.Responsecode===200){
//           alert(response.Message);
//           $("#customerstyletable").show();
//           $("#customerstyletableform").hide();
//           vaccinationList.delete(id.toString());
//           settabledata(vaccinationList);
//         }
//         else {
//             alert(response.Message);
//         }
//
//       },
//       complete:function(response){
//         $(".preloader").hide();
//       }
//   });
// }
