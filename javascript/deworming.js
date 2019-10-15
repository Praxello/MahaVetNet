var vaccinationList = new Map(); // This variable globally declare save all Style Data in Array
let confirmationStatus = new Map();
var medicineData = new Map(); // Medicine Data Map
getallmedicinelist();

$('#medicinename').select2({
  allowClear: true,
  placeholder: "Select Medicine Name"
});
$('#medicinetype').select2({
  allowClear: true,
  placeholder: "Select Type"
});
getlistdeworming();
function getallmedicinelist(){
  var branchid = $("#brid").val();
  var selectmedicine ='';
  $.ajax({
      type: "POST",
      url: url+"allmedicines.php",
      data :{
        // branchid:"2"
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
          // selectmedicine ='<option value="">Select Medicine Name</option>';
         for(var i=0;i<count;i++)
         {
           selectmedicine +="<option value='"+response['Data'][i].medicineId+"'>"+response['Data'][i].tradeName+"</option>";
         medicineData.set(response.Data[i].medicineId,response.Data[i]);
         }
         $("#medicinename").html(selectmedicine);
         $("#dmedicinename").html(selectmedicine);
      }
  });
}
function settabledata(styleData){
  // console.log(styleData);
  var html ='';
  $('#styletbl').dataTable().fnDestroy();
  $("#styletbldata").empty();
  for(let k of styleData.keys())
  {
        var AllData= styleData.get(k);
        var mid =AllData.medicineIds.split(",");
        var mcount =mid.length;
        var mname ='';
        for(var i=0;i<mcount;i++){

           if(medicineData.has(mid[i])){
             let mn= medicineData.get(mid[i]);
              mname+=mn.tradeName+"<br>";
           }
        }
        html +='<tr>';
        // let isConfirmed = confirmationStatus.get(AllData.isActive);
        html +="<td>"+mname+"</td>";
        html +="<td>"+AllData.visitDate+"</td>";
        // html +="<td>"+AllData.batch+"</td>";
        // html +="<td>"+AllData.vaccineExpiryDate+"</td>";
        html +="<td>"+AllData.totalanimals+"</td>";
        html +="<td>"+AllData.fees+"</td>";
        // html +="<td>"+isConfirmed+"</td>";
        html +='<td style=""><div class="btn-group" role="group" aria-label="Basic Example"><button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editStyle('+k+')"><i class="fa fa-edit"></i></button><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="removeMeasurements('+k+')"><i class="fa fa-remove"></i></button></div></td>';
        html +="</tr>";
  }
  $("#styletbldata").html(html);
  $('#styletbl').DataTable({
  searching: true,
  retrieve: true,
  bPaginate: $('tbody tr').length>10,
  order: [],
  columnDefs: [ { orderable: false, targets: [0,1,2,3,4] } ],
  dom: 'Bfrtip',
  buttons: [],
  destroy: true
  });

}

function getlistdeworming(){
  var branchid = $("#brid").val();
  $('#styletbl').dataTable().fnDestroy();
  $("#styletbldata").empty();
     $.ajax({
         type: "POST",
         url: url+"listdewormingentry.php",
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
            vaccinationList.set(response.Data[i].treatmentId,response.Data[i]);
            }
            settabledata(vaccinationList);
         }
     });
}

// This function is created For Add Button New Style
function addStyle(){
  $("#customerstyletable").hide();
  $("#customerstyletableform").show();
  $("#savebtncustomerstyle").show();
  $("#updatebtncustomerstyle").hide();
  $("#medicinename").val('').trigger('change');
  $("#visitdate").val('');
  $("#medicinetype").val('').trigger('change');
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

function editStyle(id){
   //console.log(vaccinationList.get(id.toString()));
var AllData= vaccinationList.get(id.toString());
$("#treatmentid").val(AllData.treatmentId);
// $("#styletitle").val(AllData.itemTitle);
// $("#stylestatus").val(AllData.isActive).trigger('change');
var medicinearr = AllData.medicineIds.split(",");
$("#customerstyletable").hide();
$("#customerstyletableform").show();
$("#savebtncustomerstyle").hide();
$("#updatebtncustomerstyle").show();
$("#medicinename").val(medicinearr).trigger('change');
$("#visitdate").val(AllData.visitDate);
$("#medicinetype").val(AllData.type).trigger('change');
$("#nogoat").val(AllData.goat);
$("#nocow").val(AllData.cow);
$("#nobull").val(AllData.bull);
$("#nocalf").val(AllData.calf);
$("#nobuffalo").val(AllData.buffalo);
$("#noredka").val(AllData.redka);
$("#nosheep").val(AllData.sheep);
$("#nopoultry").val(AllData.poultry);
$("#nofees").val(AllData.fees);
$("#totanimal").html(AllData.totalanimals);
}




// This function is created For Refresh Action / Backbutton
$('#reloadbtn').on('click',function(event){
  event.preventDefault();
  $("#customerstyletable").show();
  $("#customerstyletableform").hide();
  $("#savebtncustomerstyle").show();
  $("#updatebtncustomerstyle").hide();
});
function vacciamount(){
  var nogoat =$("#nogoat").val();
  var nocow =$("#nocow").val();
  var nobull =$("#nobull").val();
  var nocalf =$("#nocalf").val();
  var nobuffalo =$("#nobuffalo").val();
  var noredka =$("#noredka").val();
  var nosheep =$("#nosheep").val();
  var nopoultry =$("#nopoultry").val();
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
  var total = parseInt(nogoat)+parseInt(nocow)+parseInt(nobull)+parseInt(nocalf)+parseInt(nobuffalo)+
  parseInt(noredka)+parseInt(nosheep)+parseInt(nopoultry);
  // console.log("Total"+total);
  $("#nofees").val(total);
  $("#totanimal").html(total);
}
// This function is created For Save Style Data
$('#savebtncustomerstyle').on('click',function(event){
   event.preventDefault();
  var medicinename = $("#medicinename").val();
  var visitdate = $("#visitdate").val();
  var medicinetype = $("#medicinetype").val();
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
  var totanimal = $("#totanimal").html();
  // console.log(totanimal);
  // console.log("medicinename"+medicinename);
  // console.log("visitdate"+visitdate);
  // console.log("batchnumber"+batchnumber);
  // console.log("expirydate"+expirydate);
  // console.log("wastageqty"+wastageqty);
  // console.log("nogoat"+nogoat);
  // console.log("nocow"+nocow);
  // console.log("nobull"+nobull);
  // console.log("nocalf"+nocalf);
  // console.log("nobuffalo"+nobuffalo);
  // console.log("noredka"+noredka);
  // console.log("nosheep"+nosheep);
  // console.log("nopoultry"+nopoultry);
  // console.log("nofees"+nofees);
  var docterid = $("#drid").val();
  var branchid = $("#brid").val();
  var ownerid = $("#oid").val();
  var animalid = $("#aid").val();
  var obj={
              medicineids:medicinename,
              visitdate :visitdate,
              dewormingtype: medicinetype,
              ownerid :ownerid,
              animalid :animalid,
              totalanimals :totanimal,
              fees :nofees,
              doctorid :docterid,
              branchid :branchid,
              goat :nogoat,
              cow :nocow,
              bull :nobull,
              calf :nocalf,
              buffalo :nobuffalo,
              redka :noredka,
              sheep :nosheep,
              poultry :nopoultry
           };
           var obj1 ={
             branchId: branchid,
             buffalo: nobuffalo,
             bull: nobull,
             calf:nocalf,
             cow: nocow,
             doctorId: docterid,
             fees: nofees,
             goat: nogoat,
             // isDeleted: "0",
               animalid :animalid,
             medicineIds: medicinename.toString(),
             ownerId: ownerid,
             poultry:nopoultry,
             redka: noredka,
             sheep: nosheep,
             totalanimals: totanimal,
             visitDate:visitdate,
             type:medicinetype
           };
    $.ajax({
        url:url+'dewormingentry.php',
        type:'POST',
        data:obj,
        dataType:'json',
        beforeSend: function() {
              $(".preloader").show();
        },
        success:function(response){
          if(response.Responsecode===200){
            swal(response.Message);
            $("#customerstyletable").show();
            $("#customerstyletableform").hide();
            obj.treatmentId = response.RowId.toString();
            vaccinationList.set(response.RowId.toString(),obj1);
            settabledata(vaccinationList);
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
$('#updatebtncustomerstyle').on('click',function(event){
  console.log("ok");
  event.preventDefault();
  var treatmentid=$("#treatmentid").val();
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
  var totanimal = $("#totanimal").html();
  var docterid = $("#drid").val();
  var branchid = $("#brid").val();
  var ownerid = $("#oid").val();
  var animalid = $("#aid").val();
          var obj={
              treatmentId:treatmentid,
              medicineids:medicinename,
              visitdate :visitdate,
              dewormingtype: medicinetype,
              ownerid :ownerid,
              animalid :animalid,
              totalanimals :totanimal,
              fees :nofees,
              doctorid :docterid,
              branchid :branchid,
              goat :nogoat,
              cow :nocow,
              bull :nobull,
              calf :nocalf,
              buffalo :nobuffalo,
              redka :noredka,
              sheep :nosheep,
              poultry :nopoultry
           };
           // var obj1 ={
           //   treatmentId:treatmentid,
           //   branchId: branchid,
           //   buffalo: nobuffalo,
           //   bull: nobull,
           //   calf:nocalf,
           //   cow: nocow,
           //   doctorId: docterid,
           //   fees: nofees,
           //   goat: nogoat,
           //   animalid :animalid,
           //   medicineIds: medicinename.toString(),
           //   ownerId: ownerid,
           //   poultry:nopoultry,
           //   redka: noredka,
           //   sheep: nosheep,
           //   totalanimals: totanimal,
           //   visitDate:visitdate,
           //   type:medicinetype
           // };
           $.ajax({
              url:url+'editdewormingentry.php',
              type:'POST',
              data:obj,
              dataType:'json',
              success:function(response){
                  if(response.Responsecode===200){
                    swal(response.Message);
                    $("#customerstyletable").show();
                    $("#customerstyletableform").hide();
                    // styleData.delete(styleid.toString());
                    // vaccinationList.set(treatmentid.toString(),obj1);
                    // settabledata(vaccinationList);
                  }
                  else{
                    swal(response.Message);
                  }
                }
              });
});

// This function is created For Remove Button
function removeMeasurements(id){
  var AllData= vaccinationList.get(id.toString());
  var visitdate =AllData.visitDate;
  var animalid = $("#aid").val();
  var docterid = $("#drid").val();
  var branchid = $("#brid").val();
  $.ajax({
      url:url+'deletedewormingentry.php',
      type:'POST',
      data:{
        visitdate:visitdate,
        animalid : animalid,
        treatmentid : id ,
        branchid : branchid
      },
      dataType:'json',
      beforeSend: function() {
            $(".preloader").show();
            // console.log("before");
      },
      success:function(response){
        if(response.Responsecode===200){
          swal(response.Message);
          $("#customerstyletable").show();
          $("#customerstyletableform").hide();
          vaccinationList.delete(id.toString());
          settabledata(vaccinationList);
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
}
