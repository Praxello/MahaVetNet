var animalList = new Map(); // This variable globally declare
var medicineData = new Map(); // Medicine Data Map
getallmedicinelist();
function getallmedicinelist(){
  var branchid = $("#brid").val();
  var selectmedicine ='';
  $.ajax({
      type: "POST",
      url: url+"allmedicines.php",
      data :{
        branchid:branchid
      },
      async : false,
      dataType :'json',
      success: function(response) {
        var count;
         if(response['Data']!=null){
            count= response['Data'].length;
         }
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
var vaccinationList = new Map();
$('#medicinename').select2({
  allowClear: true,
  placeholder: "Select Medicine Name"
});
$('#dmedicinename').select2({
  allowClear: true,
  placeholder: "Select Medicine Name"
});
$('#dmedicinetype').select2({
  allowClear: true,
  placeholder: "Select Medicine Type"
});
getanimaltabledata();
function settabledata(styleData){
  // console.log(styleData);
  var html ='';
  $('#styletbl').dataTable().fnDestroy();
  $("#styletbldata").empty();
  for(let k of styleData.keys())
  {
        var AllData= styleData.get(k);
        html +='<tr>';
        // let isConfirmed = confirmationStatus.get(AllData.isActive);
        // html +="<td>"+AllData.animalId+"</td>";
        // html +="<td>"+AllData.animalName+"</td>";
        // html +="<td>"+AllData.specie+"/"+AllData.breed+"</td>";
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
  columnDefs: [ { orderable: false, targets: [0,1,2,3] } ],
  dom: 'Bfrtip',
  buttons: [],
  destroy: true
  });

}

function getanimaltabledata(){
  var docterid = $("#drid").val();
  var branchid = $("#brid").val();
  // $('#styletbl').dataTable().fnDestroy();
  // $("#styletbldata").empty();
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
            animalList.set(response.Data[i].ownerId,response.Data[i]);
            }
            settabledata(animalList);
         }
     });
}
// This function is created For Edit Button
function buttonvacination(id){
   // console.log(id);
   //console.log(vaccinationList.get(id.toString()));
   var AllData= animalList.get(id.toString());
    // console.log(AllData.animalId);
    $("#oid").val(id);
    $("#aid").val(AllData.animalId);
    $("#firsttable").hide();
    $("#thirdtable").hide();
    $("#secondtable").show();
    getlistvaccineentry();
}
function buttondeworming(id){
  // console.log(id);
   //console.log(vaccinationList.get(id.toString()));
   var AllData= animalList.get(id.toString());
   $("#doid").val(id);
   $("#daid").val(AllData.animalId);
   $("#firsttable").hide();
   $("#secondtable").hide();
   $("#thirdtable").show();
   getlistdeworming();
   // console.log(AllData.animalId);
   // window.location.href="deworming.php?oid="+id+"&aniid="+AllData.animalId;
}
function backmain1(){
  // getanimaltabledata();
  $("#firsttable").show();
  $("#secondtable").hide();
  $("#thirdtable").hide();
}
function backmain(){
  // getanimaltabledata();
  $("#firsttable").show();
  $("#secondtable").hide();
  $("#thirdtable").hide();
}

function setvaccinationtabledata(styleData){
  var html ='';
  $('#vaccinationtbl').dataTable().fnDestroy();
  $("#vaccinationtbldata").empty();
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
        html +="<td>"+AllData.batch+"</td>";
        html +="<td>"+AllData.vaccineExpiryDate+"</td>";
        html +="<td>"+AllData.totalAnimals+"</td>";
        html +="<td>"+AllData.fees+"</td>";
        // html +="<td>"+isConfirmed+"</td>";
        html +='<td style=""><div class="btn-group" role="group" aria-label="Basic Example"><button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editStyle('+k+')"><i class="fa fa-edit"></i></button><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="removeMeasurements('+k+')"><i class="fa fa-remove"></i></button></div></td>';
        html +="</tr>";
  }
  $("#vaccinationtbldata").html(html);
  $('#vaccinationtbl').DataTable({
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
  // $('#styletbl').dataTable().fnDestroy();
  // $("#styletbldata").empty();
     $.ajax({
         type: "POST",
         url: url+"listvaccineentry.php",
         data :{
           // branchid:"2"
           branchid:branchid
         },
         async : false,
         dataType :'json',
         success: function(response) {
           var count;
            if(response['Data']!=null){
               count= response['Data'].length;
            }
            for(var i=0;i<count;i++)
            {
            vaccinationList.set(response.Data[i].treatmentId,response.Data[i]);
            }
            setvaccinationtabledata(vaccinationList);
         }
     });
}
// This function is created For Add Button New Style
function addStyle(){
  $("#vaccinationmsg").html("");
  $("#vaccinationtable").hide();
  $("#vaccinationtableform").show();
  $("#savevaccinationbtn").show();
  $("#updatevaccinationbtn").hide();
  $("#medicinename").val('').trigger('change');
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
  $("#totanimal").html(0);
}

// This function is created For Edit Button
function editStyle(id){
$("#vaccinationmsg").html("");
 console.log(vaccinationList.get(id.toString()));
var AllData= vaccinationList.get(id.toString());
$("#treatmentid").val(AllData.treatmentId);
// $("#styletitle").val(AllData.itemTitle);
// $("#stylestatus").val(AllData.isActive).trigger('change');
var medicinearr = AllData.medicineIds.split(",");
// $("#customerstyletable").hide();
// $("#customerstyletableform").show();
// $("#savebtncustomerstyle").hide();
// $("#updatebtncustomerstyle").show();
$("#vaccinationtable").hide();
$("#vaccinationtableform").show();
$("#savevaccinationbtn").hide();
$("#updatevaccinationbtn").show();
$("#medicinename").val(medicinearr).trigger('change');
$("#visitdate").val(AllData.visitDate);
$("#batchnumber").val(AllData.batch);
$("#expirydate").val(AllData.vaccineExpiryDate);
$("#wastageqty").val(AllData.wastageQuantity);
$("#nogoat").val(AllData.goat);
$("#nocow").val(AllData.cow);
$("#nobull").val(AllData.bull);
$("#nocalf").val(AllData.calf);
$("#nobuffalo").val(AllData.buffalo);
$("#noredka").val(AllData.redka);
$("#nosheep").val(AllData.sheep);
$("#nopoultry").val(AllData.poultry);
$("#nofees").val(AllData.fees);
$("#totanimal").html(AllData.totalAnimals);
}



// This function is created For Refresh Action / Backbutton
$('#reloadbtn1').on('click',function(event){
  event.preventDefault();
    $("#vaccinationmsg").html("");
  $("#vaccinationtable").show();
  $("#vaccinationtableform").hide();
  $("#savevaccinationbtn").show();
  $("#updatevaccinationbtn").hide();
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
$('#savevaccinationbtn').on('click',function(event){
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
    nogoat="0";
  }
  if(nocow==""){
    nocow="0";
  }
  if(nobull==""){
    nobull="0";
  }
  if(nocalf==""){
    nocalf="0";
  }
  if(nobuffalo==""){
    nobuffalo="0";
  }
  if(noredka==""){
    noredka="0";
  }
  if(nosheep==""){
    nosheep="0";
  }
  if(nopoultry==""){
    nopoultry="0";
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
              batchnumber :batchnumber,
              vaccineexpirydate:expirydate,
              ownerid :ownerid,
              animalid :animalid,
              totalanimals :totanimal,
              wastagequantity :wastageqty,
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
             batch: batchnumber,
             branchId: branchid,
             buffalo: nobuffalo,
             bull: nobull,
             calf:nocalf,
             cow: nocow,
             animalid :animalid,
             doctorId:docterid,
             fees: nofees,
             goat: nogoat,

             medicineIds: medicinename.toString(),
             ownerId: ownerid,
             poultry:nopoultry,
             redka: noredka,
             sheep: nosheep,
             totalAnimals: totanimal,
             vaccineExpiryDate: expirydate,
             visitDate:visitdate,
             wastageQuantity:wastageqty
           };
      var verrmsg ='';
    $.ajax({

        url:url+'vaccineentry.php',
        type:'POST',
        data:obj,
        dataType:'json',
        beforeSend: function() {
              $(".preloader").show();
        },
        success:function(response){
          if(response.Responsecode===200){
            // console.log(response.Message);
            verrmsg +='<div class="alert alert-success alert-dismissible">';
            verrmsg +='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            verrmsg +='<strong>Success!</strong>  '+response.Message+'';
            verrmsg +='</div>';
            $("#vaccinationmsg").html(verrmsg);
            // $("#vaccinationtable").show();
            // $("#vaccinationtableform").hide();
            obj1.treatmentId = response.RowId.toString();
            vaccinationList.set(response.RowId.toString(),obj1);
            setvaccinationtabledata(vaccinationList);
          }
          else {
            verrmsg +='<div class="alert alert-warning alert-dismissible">';
            verrmsg +='  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            verrmsg +='  <strong>Warning!</strong> '+response.Message+'';
            verrmsg +='</div>';
            $("#vaccinationmsg").html(verrmsg);
              // swal(response.Message);
          }
        },
        complete:function(response){
          // console.log("after");
          $(".preloader").hide();
        }
    });

});

// This function is created For Update Style Data
$('#updatevaccinationbtn').on('click',function(event){
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
  // console.log(totanimal);
  var docterid = $("#drid").val();
  var branchid = $("#brid").val();
  var ownerid = $("#oid").val();
  var animalid = $("#aid").val();
  var obj={
              treatmentid:treatmentid,
              medicineids:medicinename,
              visitdate :visitdate,
              batchnumber :batchnumber,
              vaccineexpirydate:expirydate,
              ownerid :ownerid,
              animalid :animalid,
              totalanimals :totanimal,
              wastagequantity :wastageqty,
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
            treatmentId:treatmentid,
             batch: batchnumber,
             branchId: branchid,
             buffalo: nobuffalo,
             bull: nobull,
             calf:nocalf,
             cow: nocow,
             doctorId: docterid,
             fees: nofees,
             goat: nogoat,
             animalid :animalid,
             // isDeleted: "0",
             medicineIds: medicinename.toString(),
             ownerId: ownerid,
             poultry:nopoultry,
             redka: noredka,
             sheep: nosheep,
             totalAnimals: totanimal,
             vaccineExpiryDate: expirydate,
             visitDate:visitdate,
             wastageQuantity:wastageqty
           };
  var verrmsg ='';
  $.ajax({
      url:url+'editvaccineentry.php',
      type:'POST',
      data:obj,
      dataType:'json',
      beforeSend: function() {
            $(".preloader").show();
            // console.log("before");
      },
      success:function(response){
        if(response.Responsecode===200){
          verrmsg +='<div class="alert alert-success alert-dismissible">';
          verrmsg +='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
          verrmsg +='<strong>Success!</strong>  '+response.Message+'';
          verrmsg +='</div>';
          $("#vaccinationmsg").html(verrmsg);
          $("#vaccinationtable").show();
          $("#vaccinationtableform").hide();
          // styleData.delete(styleid.toString());
          vaccinationList.set(treatmentid.toString(),obj1);
           setvaccinationtabledata(vaccinationList);
        }
        else {
          verrmsg +='<div class="alert alert-warning alert-dismissible">';
          verrmsg +='  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
          verrmsg +='  <strong>Warning!</strong> '+response.Message+'';
          verrmsg +='</div>';
          $("#vaccinationmsg").html(verrmsg);
        }

      },
      complete:function(response){
        $(".preloader").hide();
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
    var verrmsg ='';
  $.ajax({
      url:url+'deletevaccineentry.php',
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
          //swal(response.Message);
          verrmsg +='<div class="alert alert-success alert-dismissible">';
          verrmsg +='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
          verrmsg +='<strong>Success!</strong>  '+response.Message+'';
          verrmsg +='</div>';
          $("#vaccinationmsg").html(verrmsg);
          $("#vaccinationtable").show();
          $("#vaccinationtableform").hide();
          vaccinationList.delete(id.toString());
          setvaccinationtabledata(vaccinationList);
        }
        else {
          //  swal(response.Message);
          verrmsg +='<div class="alert alert-warning alert-dismissible">';
          verrmsg +='  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
          verrmsg +='  <strong>Warning!</strong> '+response.Message+'';
          verrmsg +='</div>';
          $("#vaccinationmsg").html(verrmsg);
        }

      },
      complete:function(response){

        // console.log("after");
        $(".preloader").hide();
      }
  });
}
var dwormingList = new Map();
//
function setdewormingtabledata(styleData){
  // console.log(styleData);
  var html ='';
  $('#dewormingtbl').dataTable().fnDestroy();
  $("#dewormingtbldata").empty();
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
        html +='<td style=""><div class="btn-group" role="group" aria-label="Basic Example"><button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="deditStyle('+k+')"><i class="fa fa-edit"></i></button><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="dremoveMeasurements('+k+')"><i class="fa fa-remove"></i></button></div></td>';
        html +="</tr>";
  }
  $("#dewormingtbldata").html(html);
  $('#dewormingtbl').DataTable({
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
  // $('#styletbl').dataTable().fnDestroy();
  // $("#styletbldata").empty();
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
            dwormingList.set(response.Data[i].treatmentId,response.Data[i]);
            }
            setdewormingtabledata(dwormingList);
         }
     });
}
// This function is created For Add Button New Style
function daddStyle(){
  $("#dewormingmsg").html("");
  $("#dewormingtable").hide();
  $("#dewormingtableform").show();
  $("#dsavebtncustomerstyle").show();
  $("#dupdatebtncustomerstyle").hide();
  $("#dmedicinename").val('').trigger('change');
  $("#dvisitdate").val('');
  $("#dmedicinetype").val('').trigger('change');
  $("#dnogoat").val('');
  $("#dnocow").val('');
  $("#dnobull").val('');
  $("#dnocalf").val('');
  $("#dnobuffalo").val('');
  $("#dnoredka").val('');
  $("#dnosheep").val('');
  $("#dnopoultry").val('');
  $("#dnofees").val('');
}

function deditStyle(id){
  $("#dewormingmsg").html("");
   // console.log(dwormingList.get(id.toString()));
var AllData= dwormingList.get(id.toString());
$("#dtreatmentid").val(AllData.treatmentId);
// $("#styletitle").val(AllData.itemTitle);
// $("#stylestatus").val(AllData.isActive).trigger('change');
var medicinearr = AllData.medicineIds.split(",");
$("#dewormingtable").hide();
$("#dewormingtableform").show();
$("#dsavebtncustomerstyle").hide();
$("#dupdatebtncustomerstyle").show();
$("#dmedicinename").val(medicinearr).trigger('change');
$("#dvisitdate").val(AllData.visitDate);
$("#dmedicinetype").val(AllData.type).trigger('change');
$("#dnogoat").val(AllData.goat);
$("#dnocow").val(AllData.cow);
$("#dnobull").val(AllData.bull);
$("#dnocalf").val(AllData.calf);
$("#dnobuffalo").val(AllData.buffalo);
$("#dnoredka").val(AllData.redka);
$("#dnosheep").val(AllData.sheep);
$("#dnopoultry").val(AllData.poultry);
$("#dnofees").val(AllData.fees);
$("#dtotanimal").html(AllData.totalanimals);
}

function damount(){
  var nogoat =$("#dnogoat").val();
  var nocow =$("#dnocow").val();
  var nobull =$("#dnobull").val();
  var nocalf =$("#dnocalf").val();
  var nobuffalo =$("#dnobuffalo").val();
  var noredka =$("#dnoredka").val();
  var nosheep =$("#dnosheep").val();
  var nopoultry =$("#dnopoultry").val();
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
  $("#dnofees").val(total);
  $("#dtotanimal").html(total);
}


// This function is created For Refresh Action / Backbutton
$('#dreloadbtn').on('click',function(event){
  event.preventDefault();
  $("#dewormingtable").show();
  $("#dewormingtableform").hide();
  $("#dsavebtncustomerstyle").show();
  $("#dupdatebtncustomerstyle").hide();
});

// This function is created For Save Style Data
$('#dsavebtncustomerstyle').on('click',function(event){
   event.preventDefault();
  var medicinename = $("#dmedicinename").val();
  var visitdate = $("#dvisitdate").val();
  var medicinetype = $("#dmedicinetype").val();
  var nogoat =$("#dnogoat").val();
  var nocow =$("#dnocow").val();
  var nobull =$("#dnobull").val();
  var nocalf =$("#dnocalf").val();
  var nobuffalo =$("#dnobuffalo").val();
  var noredka =$("#dnoredka").val();
  var nosheep =$("#dnosheep").val();
  var nopoultry =$("#dnopoultry").val();
  var nofees =$("#dnofees").val();
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
  var totanimal = $("#dtotanimal").html();
  var docterid = $("#drid").val();
  var branchid = $("#brid").val();
  var ownerid = $("#doid").val();
  var animalid = $("#daid").val();
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
             var verrmsg ='';
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
            // swal(response.Message);
            verrmsg +='<div class="alert alert-success alert-dismissible">';
            verrmsg +='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            verrmsg +='<strong>Success!</strong>  '+response.Message+'';
            verrmsg +='</div>';
            $("#dewormingmsg").html(verrmsg);
            $("#dewormingtable").show();
            $("#dewormingtableform").hide();
            obj1.treatmentId = response.RowId.toString();
            dwormingList.set(response.RowId.toString(),obj1);
            setdewormingtabledata(dwormingList);
          }
          else {
            verrmsg +='<div class="alert alert-warning alert-dismissible">';
            verrmsg +='  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            verrmsg +='  <strong>Warning!</strong> '+response.Message+'';
            verrmsg +='</div>';
            $("#dewormingmsg").html(verrmsg);

              // swal(response.Message);
          }
        },
        complete:function(response){

          // console.log("after");
          $(".preloader").hide();
        }
    });

});

// This function is created For Update Style Data
$('#dupdatebtncustomerstyle').on('click',function(event){
  // console.log("ok");
  event.preventDefault();
  var treatmentid=$("#dtreatmentid").val();
  var medicinename = $("#dmedicinename").val();
  var medicinetype = $("#dmedicinetype").val();
  var visitdate = $("#dvisitdate").val();
  var batchnumber =$("#dbatchnumber").val();
  var expirydate =$("#dexpirydate").val();
  var wastageqty =$("#dwastageqty").val();
  var nogoat =$("#dnogoat").val();
  var nocow =$("#dnocow").val();
  var nobull =$("#dnobull").val();
  var nocalf =$("#dnocalf").val();
  var nobuffalo =$("#dnobuffalo").val();
  var noredka =$("#dnoredka").val();
  var nosheep =$("#dnosheep").val();
  var nopoultry =$("#dnopoultry").val();
  var nofees =$("#dnofees").val();
  var verrmsg ='';
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
  var totanimal = $("#dtotanimal").html();
  var docterid = $("#drid").val();
  var branchid = $("#brid").val();
  var ownerid = $("#doid").val();
  var animalid = $("#daid").val();
          var obj={
              treatmentid:treatmentid,
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
             treatmentId:treatmentid,
             branchId: branchid,
             buffalo: nobuffalo,
             bull: nobull,
             calf:nocalf,
             cow: nocow,
             doctorId: docterid,
             fees: nofees,
             goat: nogoat,
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
              url:url+'editdewormingentry.php',
              type:'POST',
              data:obj,
              dataType:'json',
              success:function(response){
                  if(response.Responsecode===200){
                    // swal(response.Message);
                    $("#dewormingtable").show();
                    $("#dewormingtableform").hide();
                    verrmsg +='<div class="alert alert-success alert-dismissible">';
                    verrmsg +='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    verrmsg +='<strong>Success!</strong>  '+response.Message+'';
                    verrmsg +='</div>';
                    $("#dewormingmsg").html(verrmsg);
                    dwormingList.set(treatmentid.toString(),obj1);
                    setdewormingtabledata(dwormingList);
                  }
                  else{
                    verrmsg +='<div class="alert alert-warning alert-dismissible">';
                    verrmsg +='  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    verrmsg +='  <strong>Warning!</strong> '+response.Message+'';
                    verrmsg +='</div>';
                    $("#dewormingmsg").html(verrmsg);
                    // swal(response.Message);
                  }
                }
              });
});

// This function is created For Remove Button
function dremoveMeasurements(id){
  var AllData= dwormingList.get(id.toString());
  var visitdate =AllData.visitDate;
  var animalid = $("#aid").val();
  var docterid = $("#drid").val();
  var branchid = $("#brid").val();
  var verrmsg ='';
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
          verrmsg +='<div class="alert alert-success alert-dismissible">';
          verrmsg +='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
          verrmsg +='<strong>Success!</strong>  '+response.Message+'';
          verrmsg +='</div>';
          $("#dewormingmsg").html(verrmsg);
          $("#dewormingtable").show();
          $("#dewormingtableform").hide();
          dwormingList.delete(id.toString());
          setdewormingtabledata(dwormingList);
        }
        else {
          verrmsg +='<div class="alert alert-warning alert-dismissible">';
          verrmsg +='  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
          verrmsg +='  <strong>Warning!</strong> '+response.Message+'';
          verrmsg +='</div>';
          $("#dewormingmsg").html(verrmsg);
        }

      },
      complete:function(response){

        // console.log("after");
        $(".preloader").hide();
      }
  });
}
