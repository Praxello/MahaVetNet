var animalList = new Map(); // This variable globally declare
var medicineData = new Map(); // Medicine Data Map
getallmedicinelist();

function getallmedicinelist() {
    var branchid = $("#brid").val();
    var selectmedicine = '';
    $.ajax({
        type: "POST",
        url: url + "allmedicines.php",
        data: {
            branchid: branchid
        },
        async: false,
        dataType: 'json',
        success: function(response) {
            var count;
            if (response['Data'] != null) {
                count = response['Data'].length;
            }
            selectmedicine = "<option value=''>Select Medication</option>";
            for (var i = 0; i < count; i++) {
                selectmedicine += "<option value='" + response['Data'][i].medicineId + "'>" + response['Data'][i].tradeName + "</option>";
                medicineData.set(response.Data[i].medicineId, response.Data[i]);
            }
            $("#medicinename").html(selectmedicine);
            $("#dmedicinename").html(selectmedicine);
            $("#selectmedication").html(selectmedicine);
        }
    });
}
var strawData = new Map(); // StrawData Map DataTable
getstrawDatalist();

function getstrawDatalist() {
    var branchid = $("#brid").val();
    var selectmedicine = '';
    $.ajax({
        type: "POST",
        url: url + "getall_branchstraw.php",
        data: {
            branchid: branchid
        },
        async: false,
        dataType: 'json',
        success: function(response) {
            var count;
            if (response['Data'] != null) {
                count = response['Data'].length;
            }
            selectmedicine = "<option value=''>Select Straw Number</option>";
            for (var i = 0; i < count; i++) {
                selectmedicine += "<option value='" + response['Data'][i].strawId + "'>" + response['Data'][i].straw_number + "</option>";
                strawData.set(response.Data[i].strawId, response.Data[i]);
            }
            $("#aiselstrawno").html(selectmedicine);
        }
    });
}
$('#selectmedication').select2({
    allowClear: true,
    placeholder: "Select Medicine Type"
});
getanimaltabledata();

function settabledata(styleData) {

    var html = '';
    $('#styletbl').dataTable().fnDestroy();
    $("#styletbldata").empty();
    for (let k of styleData.keys()) {
        var AllData = styleData.get(k);
        html += '<tr>';
        html += "<td style='white-space: normal;'>" + AllData.animalName + "</td>";
        html += "<td style='white-space: normal;'>" + AllData.specie + "</td>";
        html += "<td style='white-space: normal;'>" + AllData.breed + "</td>";
        html += "<td style='white-space: normal;'>" + AllData.gender + "</td>";
        html += "<td style='white-space: normal;'>" + AllData.firstName + " " + AllData.lastName + "</td>";
        html += "<td style='white-space: normal;'><code>" + AllData.address + "</code></td>";
        html += "<td style='white-space: normal;'>" + AllData.mobile + "</td>";
        html += '<td style="white-space: normal;">';
        html += '      <button class="btn btn-primary" onclick="buttoncasepaper(' + k + ')">IPD Case Paper</button>';
        html += '</td>';
        html += "</tr>";
    }
    $("#styletbldata").html(html);
    $('#styletbl').DataTable({
        searching: true,
        retrieve: true,
        bPaginate: $('tbody tr').length > 10,
        order: [],
        columnDefs: [{ orderable: false, targets: [0, 1, 2, 3, 4, 5, 6, 7] }],
        dom: 'Bfrtip',
        buttons: [],
        destroy: true
    });

}

function getanimaltabledata() {
    var docterid = $("#drid").val();
    var branchid = $("#brid").val();
    $.ajax({
        type: "POST",
        url: url + "allpatients.php",
        data: {
            branchid: branchid
        },
        async: false,
        dataType: 'json',
        success: function(response) {
            var count;
            if (response['Data'] != null) {
                count = response['Data'].length;
            }
            for (var i = 0; i < count; i++) {
                animalList.set(response.Data[i].animalId, response.Data[i]);
            }
            settabledata(animalList);
        },
        complete: function(data) {
            // Hide image container
            // console.log('out');
            $("#wait").css("display", "none");
        }
    });
}




$('#opdvisittype').select2({
    allowClear: true,
    placeholder: "Select Visit Type"
});
$('#selectsymptoms').select2({
    allowClear: true,
    placeholder: "Select Symtoms Here"
});
$('#noprocedurecas').select2({
    allowClear: true,
    placeholder: "Select Castastration Here"
});

$('#aistai').select2({
    allowClear: true,
    placeholder: "Select Type of AI"
});
$('#aisooes').select2({
    allowClear: true,
    placeholder: "Stage of Oestrus"
});
$('#aissch').select2({
    allowClear: true,
    placeholder: "Select Scheme"
});
$('#aiselstrawno').select2({
    allowClear: true,
    placeholder: "Select Straw Number"
});
$('#opsust').select2({
    allowClear: true,
    placeholder: "Select Surgery Type"
});
$('#delcage').select2({
    allowClear: true,
    placeholder: "Select Calf Gender"
});
$('#delstai').select2({
    allowClear: true,
    placeholder: "Select Type of AI"
});
$('#delssch').select2({
    allowClear: true,
    placeholder: "Select Scheme"
});
$('#pdtype').select2({
    allowClear: true,
    placeholder: "Select Type"
});
$('#pdprety').select2({
    allowClear: true,
    placeholder: "Select Pregnant Status"
});
$('#pdstai').select2({
    allowClear: true,
    placeholder: "Select Type of AI"
});
$('#pdssch').select2({
    allowClear: true,
    placeholder: "Select Scheme"
});
$('#inotype').select2({
    allowClear: true,
    placeholder: "Select Type"
});
$('#selprecond').select2({
    allowClear: true,
    placeholder: "Select Present condition"
});
$('#opdcasepaperdate').select2({
    allowClear: true,
    placeholder: "Select Case Paper Date"
});
var alllistData = new Map(); // All List Data;
var paymentData = [];
var aiTypeData = [];
var inoculationTypeData = [];
var surgeryTypes = [];
var symptoms = [];
var casepaperlistData = new Map();
// var datearray =[];
var largedate = "";

function getallcasepaperlist(animalid) {
    var datearray = [];
    var selectlistpaper = '';
    $.ajax({
        type: "POST",
        url: url + "allcasepapersipd.php",
        data: {
            animalid: animalid
        },
        async: false,
        dataType: 'json',
        beforeSend: function() {
            // console.log('in');
            $("#wait").css("display", "block");
        },
        success: function(response) {
            var count;
            if (response['Data'] != null) {
                count = response['Data'].length;
            }
            selectlistpaper = "<option value=''>Select Date</option>";
            for (var i = 0; i < count; i++) {
                casepaperlistData.set(response.Data[i].FeesData.visitDate, response.Data[i]);
                selectlistpaper += "<option value='" + response.Data[i].FeesData.visitDate + "'>" + response.Data[i].FeesData.visitDate + "</option>";
            }
            for (let k of casepaperlistData.keys()) {
                var AllData = casepaperlistData.get(k);
                // console.log(AllData);
                var newobj = JSON.parse(AllData.MedicationData.treatment);
                if (newobj.hasOwnProperty('ArtificialInsemination')) {
                    datearray.push(AllData.MedicationData.visitDate);
                }
            }
            largedate = max_date(datearray);
            $("#opdcasepaperdate").html(selectlistpaper);

        },
        complete: function(response) {
            var today = $("#currentdate").val();
            // var today = new Date();
            // console.log("Date1"+today);
            attachcasepaperdata(today);
        }
    });
}

function max_date(all_dates) {
    var max_dt = all_dates[0],
        max_dtObj = new Date(all_dates[0]);
    all_dates.forEach(function(dt, index) {
        if (new Date(dt) > max_dtObj) {
            max_dt = dt;
            max_dtObj = new Date(dt);
        }
    });
    return max_dt;
}

function selectcasepaper() {
    var opddate = $("#opdcasepaperdate").val();
    $("#opdselectdate").val(opddate);
    $("#opdvisittype").val("HQ").trigger('change');
    $("#selectsymptoms").val("").trigger('change');
    $("#textdiagnosis").val("");
    $("#inotype").val("").trigger('change');
    // $("#nonvdate").val(opddate);
    $("#nofserch").val("1");
    $("#selprecond").val("").trigger('change');


    // $("#nocastrated").val("");
    $("#noprocedurecas").val("").trigger('change');
    $("#head1").html("");
    $("#shidden1").val(0);

    $("#aistai").val("").trigger('change');
    $("#aisooes").val("").trigger('change');
    $("#aisoror").val("");
    $("#aissch").val("").trigger('change');
    $("#aisno").val("");
    $("#head2").html("");
    $("#shidden2").val(0);

    $("#opsust").val("").trigger('change');
    $("#head3").html("");
    $("#shidden3").val(0);

    $("#delcadet").val("");
    $("#delcage").val("").trigger('change');
    $("#delcbirtdate").val("");
    $("#delcaidate").val("");
    $("#delstai").val("").trigger('change');
    $("#delssch").val("").trigger('change');
    $("#delstrawno").val("");
    $("#head4").html('');
    $("#shidden4").val(0);
    $("#inforo").val("");
    $("#ints").val("");
    $("#inpcoi").val("");
    $("#head5").html('');
    $("#shidden5").val(0);
    $("#pdsaidate").val("");
    $("#pdtextreport").val("");
    $("#pdtype").val("").trigger('change');
    $("#pdprety").val("").trigger('change');
    $("#pdstai").val("").trigger('change');
    $("#pdssch").val("").trigger('change');
    $("#pdstrawno").val("");
    $("#head6").html('');
    $("#shidden6").val(0);
    $("#pprocdetail").val("");
    $("#pdsystem").val("");
    $("#head7").html('');
    $("#shidden7").val(0);
    $("#treatment").val("");
    $("#head8").html('');
    $("#shidden8").val(0);
    // var d = new Date(opddate);
    $("#medicinetab").empty();
    // console.log('in');
    $("#wait").css("display", "block");
    attachcasepaperdata(opddate);
}

function buttoncasepaper(id) {
    casepaperlistData = new Map();
    // console.log(id);
    // console.log(animalList.get(id.toString()));
    var AllData = animalList.get(id.toString());
    $("#opdoid").val(id);
    $("#opdaid").val(AllData.animalId);
    $("#firsttable").hide();
    $("#medicinetab").empty();
    $("#fourthtable").show();
    $("#opdowner").html(AllData.firstName);
    $("#opdanimalname").html(AllData.animalName);
    $("#setnavanimal").attr("src", "http://praxello.com/ahimsa/animalphotos/" + AllData.animalId + ".jpg");
    $("#opdanimalage").html("<font color='red'>" + AllData.specie + "</font>/<font color='green'>" + AllData.breed + "</font>/<font color='blue'>" + AllData.gender + "</font>");
    // $("#opdanimalweight").html(AllData.weight);
    // $("#opdanimalgender").html(AllData.gender);
    var date = $("#currentdate").val();
    $("#opdselectdate").val(date);
    $("#opdvisittype").val("HQ").trigger('change');
    $("#selectsymptoms").val("").trigger('change');
    $("#textdiagnosis").val("");
    $("#inotype").val("").trigger('change');
    $("#nonvdate").val(date);
    $("#nofserch").val("1");
    $("#selprecond").val("").trigger('change');


    // $("#nocastrated").val("");
    $("#noprocedurecas").val("").trigger('change');
    $("#head1").html("");
    $("#shidden1").val(0);

    $("#aistai").val("").trigger('change');
    $("#aisooes").val("").trigger('change');
    $("#aisoror").val("");
    $("#aissch").val("").trigger('change');
    $("#aisno").val("");
    $("#head2").html("");
    $("#shidden2").val(0);

    $("#opsust").val("").trigger('change');
    $("#head3").html("");
    $("#shidden3").val(0);

    $("#delcadet").val("");
    $("#delcage").val("").trigger('change');
    $("#delcbirtdate").val("");
    $("#delcaidate").val("");
    $("#delstai").val("").trigger('change');
    $("#delssch").val("").trigger('change');
    $("#delstrawno").val("");
    $("#head4").html('');
    $("#shidden4").val(0);
    $("#inforo").val("");
    $("#ints").val("");
    $("#inpcoi").val("");
    $("#head5").html('');
    $("#shidden5").val(0);
    $("#pdsaidate").val("");
    $("#pdtextreport").val("");
    $("#pdtype").val("").trigger('change');
    $("#pdprety").val("").trigger('change');
    $("#pdstai").val("").trigger('change');
    $("#pdssch").val("").trigger('change');
    $("#pdstrawno").val("");
    $("#head6").html('');
    $("#shidden6").val(0);
    $("#pprocdetail").val("");
    $("#pdsystem").val("");
    $("#head7").html('');
    $("#shidden7").val(0);
    $("#treatment").val("");
    $("#head8").html('');
    $("#shidden8").val(0);
    getallcasepaperlist(AllData.animalId);
}

function backmain() {
    $("#firsttable").show();
    $("#fourthtable").hide();
}

function attachcasepaperdata(today) {
    var date = today;

    // var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    if (casepaperlistData.has(date)) {
        var AllData = casepaperlistData.get(date);
        // console.log(casepaperlistData.get(date));
        $("#setnavanimal").attr("src", "http://praxello.com/ahimsa/animalphotos/" + AllData.FeesData.animalId + ".jpg");
        $("#setimage").attr("src", "http://praxello.com/ahimsa/ipdcasephotos/" + AllData.MedicationData.medicationId + ".jpg");

        $("#nofserch").val(AllData.FeesData.feesAmount);
        $("#opdselectdate").val(AllData.FeesData.visitDate);
        $("#opdvisittype").val(AllData.MedicationData.visitType).trigger('change');
        $("#textsymptoms").val(AllData.MedicationData.symptoms);
        // var simptomarr = AllData.MedicationData.symptoms.split(",");
        // $("#selectsymptoms").val(simptomarr).trigger('change');

        $("#textdiagnosis").val(AllData.MedicationData.diagnosis);
        $("#inotype").val(AllData.MedicationData.typeOfInoculation).trigger('change');
        var samplearr = AllData.MedicationData.samples.split(",");
        // $("#nonvdate").val(AllData.MedicationData.nextVisitDate);
        $("#selprecond").val(AllData.MedicationData.presentCondition).trigger('change');
        if (AllData.MedicineData) {
            var countmedicaldata = AllData.MedicineData.length;
            for (var i = 0; i < countmedicaldata; i++) {
                $("#selectmedication").val(AllData.MedicineData[i].medicineId).trigger('change');
                if (AllData.MedicineData[i].instruction != "null")
                    $("#instruction" + AllData.MedicineData[i].medicineId).val(AllData.MedicineData[i].instruction);
                if (AllData.MedicineData[i].days != "null")
                    $("#days" + AllData.MedicineData[i].medicineId).val(AllData.MedicineData[i].days);
            }
        }
        var newobj = JSON.parse(AllData.MedicationData.treatment);

        if (newobj.hasOwnProperty('Castration') && (newobj['Castration'].NoOfAnimals != "")) {
            // $("#nocastrated").val(newobj['Castration'].NoOfAnimals);
            $("#noprocedurecas").val(newobj['Castration'].Procedure).trigger('change');
            $("#head1").html('<span class="badge badge-success">Data Added</span>');
            $("#shidden1").val(1);
        }

        if (newobj.hasOwnProperty('ArtificialInsemination') && (newobj['ArtificialInsemination'].AIType != "")) {
            $("#aistai").val(newobj['ArtificialInsemination'].AIType).trigger('change');
            $("#aisooes").val(newobj['ArtificialInsemination']['Stage of Oestrus']).trigger('change');
            $("#aisoror").val(newobj['ArtificialInsemination']['Status of reproductive organ']);
            $("#aissch").val(newobj['ArtificialInsemination'].Scheme).trigger('change');
            $("#aisno").val(newobj['ArtificialInsemination'].StrawNo);
            $("#head2").html('<span class="badge badge-success">Data Added</span>');
            $("#shidden2").val(1);
        }
        if (newobj.hasOwnProperty('Surgery') && (newobj['Surgery']['Surgery Name'] != "")) {
            $("#opsust").val(newobj['Surgery']['Surgery Name']).trigger('change');
            $("#head3").html('<span class="badge badge-success">Data Added</span>');
            $("#shidden3").val(1);
        }
        if (newobj.hasOwnProperty('Delivery') && (newobj['Delivery']['CalfDetails'] != "")) {
            $("#delcadet").val(newobj['Delivery']['CalfDetails']);
            $("#delcage").val(newobj['Delivery'].CalfGender).trigger('change');
            $("#delcbirtdate").val(newobj['Delivery']['CalfBDate']);
            $("#delcaidate").val(newobj['Delivery']['AIDate']);
            $("#delstai").val(newobj['Delivery']['AI-TYPE']).trigger('change');
            $("#delssch").val(newobj['Delivery'].Scheme).trigger('change');
            $("#delstrawno").val(newobj['Delivery'].StrawNo);
            $("#head4").html('<span class="badge badge-success">Data Added</span>');
            $("#shidden4").val(1);
        }
        if (newobj.hasOwnProperty('Infertility') && (newobj['Infertility']['Findings of Reproductive Organ'] != "")) {
            $("#inforo").val(newobj['Infertility']['Findings of Reproductive Organ']);
            $("#ints").val(newobj['Infertility']['Treatment Suggested']);
            $("#inpcoi").val(newobj['Infertility']['Probable Cause']);
            $("#head5").html('<span class="badge badge-success">Data Added</span>');
            $("#shidden5").val(1);
        }
        if (newobj.hasOwnProperty('Pregnancy') && (newobj['Pregnancy']['AIDate'] != "")) {
            $("#pdsaidate").val(newobj['Pregnancy']['AIDate']);
            $("#pdtextreport").val(newobj['Pregnancy']['Results']);
            $("#pdtype").val(newobj['Pregnancy']['PD Type']).trigger('change');
            $("#pdprety").val(newobj['Pregnancy'].Pregnant).trigger('change');
            $("#approxmon").val(newobj['Pregnancy']['Pregnancy Tenure']);
            $("#pdexpdeldate").val(newobj['Pregnancy']['Expected Delivery Date']);
            $("#pdstai").val(newobj['Pregnancy']['AI-TYPE']).trigger('change');
            $("#pdssch").val(newobj['Pregnancy'].Scheme).trigger('change');
            $("#pdstrawno").val(newobj['Pregnancy'].StrawNo);
            $("#head6").html('<span class="badge badge-success">Data Added</span>');
            $("#shidden6").val(1);
        }
        if (newobj.hasOwnProperty('Treatment') && (newobj['Treatment']['Treatment'] != "")) {
            $("#pprocdetail").val(newobj['Treatment']['Treatment']);
            $("#pdsystem").val(newobj['Treatment']['System']);
            $("#head7").html('<span class="badge badge-success">Data Added</span>');
            $("#shidden7").val(1);
        }
        if (newobj.hasOwnProperty('Other') && (newobj['Other']['Treatment'] != "")) {
            $("#treatment").val(newobj['Other']['Treatment']);
            $("#head8").html('<span class="badge badge-success">Data Added</span>');
            $("#shidden8").val(1);
        }
    }
    var pdsaidate = $("#pdsaidate").val();
    if (pdsaidate == "") {
        if (casepaperlistData.has(largedate)) {
            var dateData = casepaperlistData.get(largedate);
            var newobj = JSON.parse(dateData.MedicationData.treatment);
            if (newobj.hasOwnProperty('ArtificialInsemination')) {
                // $("#aistai").val(newobj['ArtificialInsemination'].AIType).trigger('change');
                // $("#aisooes").val(newobj['ArtificialInsemination']['Stage of Oestrus']).trigger('change');
                // $("#aisoror").val(newobj['ArtificialInsemination']['Status of reproductive organ']);
                // $("#aissch").val(newobj['ArtificialInsemination'].Scheme).trigger('change');
                // $("#aisno").val(newobj['ArtificialInsemination'].StrawNo);
                // $("#head2").html('<span class="badge badge-success">Data Added</span>');
                // $("#shidden2").val(1);


                // }
                // else{
                $("#pdstai").val(newobj['ArtificialInsemination'].AIType).trigger('change');
                $("#pdssch").val(newobj['ArtificialInsemination'].Scheme).trigger('change');
                $("#pdstrawno").val(newobj['ArtificialInsemination'].StrawNo);
                $("#delcaidate").val(largedate);
                $("#pdsaidate").val(largedate);

                $("#delstai").val(newobj['ArtificialInsemination'].AIType).trigger('change');
                $("#delssch").val(newobj['ArtificialInsemination'].Scheme).trigger('change');
                $("#delstrawno").val(newobj['ArtificialInsemination'].StrawNo);
            }
        }
    }
    // console.log('end');
    $("#wait").css("display", "none");
}
getalllistData();

function getalllistData() {
    var samlist = '',
        selectpmd = '',
        selectaitype = '',
        selectsymptoms = '',
        selectsurgerytype = '',
        selectinocutype = '';
    $.ajax({
        type: "POST",
        url: url + "alllistvalues.php",
        async: false,
        dataType: 'json',
        success: function(response) {
            var count;
            if (response['Data'] != null) {
                count = response['Data'].length;
            }
            let pmd = response['Data']['PaymentModes'].split(";");
            let cpmd = pmd.length;
            selectpmd = "<option value=''>Select Payment Mode</option>";
            for (var i = 0; i < cpmd; i++) {
                selectpmd += "<option value='" + pmd[i] + "'>" + pmd[i] + "</option>";
            }
            $("#selpaymethod").html(selectpmd);
            let aitype = response['Data']['aiType'].split(";");
            let caitype = aitype.length;
            selectaitype = "<option value=''>Select AI Type</option>";
            for (var i = 0; i < caitype; i++) {
                selectaitype += "<option value='" + aitype[i] + "'>" + aitype[i] + "</option>";
            }
            $("#aissch").html(selectaitype);
            $("#delssch").html(selectaitype);
            $("#pdssch").html(selectaitype);
            let inocutype = response['Data']['inoculationType'].split(";");
            let cinocutype = inocutype.length;
            selectinocutype = "<option value=''>Select Inoculation</option>";
            for (var i = 0; i < cinocutype; i++) {
                selectinocutype += "<option value='" + inocutype[i] + "'>" + inocutype[i] + "</option>";
            }
            $("#inotype").html(selectinocutype);

            let surgerytype = response['Data']['surgeryTypes'].split(";");
            let csurgerytype = surgerytype.length;
            selectsurgerytype = "<option value=''>Select Symtoms</option>";
            for (var i = 0; i < csurgerytype; i++) {
                selectsurgerytype += "<option value='" + surgerytype[i] + "'>" + surgerytype[i] + "</option>";
            }
            $("#opsust").html(selectsurgerytype);
            let symptoms = response['Data']['symptoms'].split(";");
            let csymptoms = symptoms.length;
            // selectsymptoms="<option value=''>Select Symtoms</option>";
            for (var i = 0; i < csymptoms; i++) {
                selectsymptoms += "<option value='" + symptoms[i] + "'>" + symptoms[i] + "</option>";
            }
            $("#selectsymptoms").html(selectsymptoms);

            let samplist = response['Data']['samplelist'].split(";");
            let csamplist = samplist.length;
            samlist = "<option value=''>Select sample list</option>";
            for (var i = 0; i < csamplist; i++) {
                samlist += "<option value='" + samplist[i] + "'>" + samplist[i] + "</option>";
            }
            $("#selnoofsc").html(samlist);
        }
    });
}
// opdcasepaperdate
function symtomsdrop() {
    var selectsymptoms = $("#selectsymptoms").val();
    $("#textsymptoms").val(selectsymptoms.toString());
}

function selectmedication() {
    var selectmedication = $("#selectmedication").val();
    if (selectmedication == '') {} else {
        createmedicationtable(selectmedication);
        $("#selectmedication").val('').trigger('change');
    }
}
var sm = 0;
// $("#medicinetab").empty();
function createmedicationtable(smval) {
    sm++;
    var medicinehtml = '';
    if (medicineData.has(smval)) {
        let mn = medicineData.get(smval);
        medicinehtml += '<tr id="ct' + smval + '">';
        medicinehtml += '<td style="width:60%;">' + mn.tradeName + '</td>';
        medicinehtml += '<td style="width:20%;"><input  type="text" id="instruction' + smval + '" style="width:100%;"/></td>';
        medicinehtml += '<td style="width:10%;"><input  type="text" id="days' + smval + '" style="width:100%;" onkeypress="javascript:return isNumberKey(event)"/></td>';
        medicinehtml += '<td style="width:10%;display:none"><input type="hidden" value=' + smval + '></input></td>';
        medicinehtml += '<td style="width:10%;"><button class="btn btn-danger" onclick="removetrash(' + smval + ')">X</button></td>';
        medicinehtml += '</tr>';

    }
    $("#medicinetab").append(medicinehtml);

}

function removetrash(smid) {
    $("#ct" + smid).remove();
}

$("#one1").on('submit', function(event) {
    event.preventDefault();
    $("#head1").html('<span class="badge badge-success">Data Added</span>');
    $("#shidden1").val(1);
    $('#collapseOne').collapse('toggle');
});
$("#one1").on('reset', function(event) {
    event.preventDefault();
    // $("#nocastrated").val("");
    $("#noprocedurecas").val("").trigger('change');
    $("#head1").html('');
    $("#shidden1").val(0);
    $('#collapseOne').collapse('toggle');
});
$("#two1").on('submit', function(event) {
    event.preventDefault();
    $("#head2").html('<span class="badge badge-success">Data Added</span>');
    $("#shidden2").val(1);
    $('#collapseTwo').collapse('toggle');

});
$("#two1").on('reset', function(event) {
    event.preventDefault();
    $("#aistai").val("").trigger('change');
    $("#aisooes").val("").trigger('change');
    $("#aisoror").val("");
    $("#aissch").val("").trigger('change');
    $("#aisno").val("");
    $("#head2").html('');
    $("#shidden2").val(0);
    $('#collapseTwo').collapse('toggle');
});
$("#three1").on('submit', function(event) {
    event.preventDefault();
    $("#head3").html('<span class="badge badge-success">Data Added</span>');
    $("#shidden3").val(1);
    $('#collapseThree').collapse('toggle');

});
$("#three1").on('reset', function(event) {
    event.preventDefault();
    $("#opsust").val("").trigger('change');
    $("#head3").html("");
    $("#shidden3").val(0);
    $('#collapseThree').collapse('toggle');
});

$("#four1").on('submit', function(event) {
    event.preventDefault();
    $("#head4").html('<span class="badge badge-success">Data Added</span>');
    $("#shidden4").val(1);
    $('#collapseFour').collapse('toggle');
});
$("#four1").on('reset', function(event) {
    event.preventDefault();
    $("#delcadet").val("");
    $("#delcage").val("").trigger('change');
    $("#delcbirtdate").val("");
    $("#delcaidate").val("");
    $("#delstai").val("").trigger('change');
    $("#delssch").val("").trigger('change');
    $("#delstrawno").val("");
    $("#head4").html('');
    $("#shidden4").val(0);
    $('#collapseFour').collapse('toggle');
});


$("#five1").on('submit', function(event) {
    event.preventDefault();
    $("#head5").html('<span class="badge badge-success">Data Added</span>');
    $("#shidden5").val(1);
    $('#collapseFive').collapse('toggle');
});
$("#five1").on('reset', function(event) {
    event.preventDefault();
    $("#inforo").val("");
    $("#ints").val("");
    $("#inpcoi").val("");
    $("#head5").html('');
    $("#shidden5").val(0);
    $('#collapseFive').collapse('toggle');
});
$("#six1").on('submit', function(event) {
    event.preventDefault();
    $("#head6").html('<span class="badge badge-success">Data Added</span>');
    $("#shidden6").val(1);
    $('#collapseSix').collapse('toggle');
});
$("#six1").on('reset', function(event) {
    event.preventDefault();
    $("#pdsaidate").val("");
    $("#pdtextreport").val("");
    $("#pdstrawno").val("");
    $("#head6").html('');
    $("#shidden6").val(0);
    $('#collapseSix').collapse('toggle');
});

$("#seven1").on('submit', function(event) {
    event.preventDefault();
    $("#head7").html('<span class="badge badge-success">Data Added</span>');
    $("#shidden7").val(1);
    $('#collapseSeven').collapse('toggle');
});
$("#seven1").on('reset', function(event) {
    event.preventDefault();
    $("#pprocdetail").val("");
    $("#pdsystem").val("");
    $("#head7").html('');
    $("#shidden7").val(0);
    $('#collapseSeven').collapse('toggle');
});
$("#eight1").on('submit', function(event) {
    event.preventDefault();
    $("#head8").html('<span class="badge badge-success">Data Added</span>');
    $("#shidden8").val(1);
    $('#collapseeight').collapse('toggle');
});
$("#eight1").on('reset', function(event) {
    event.preventDefault();
    $("#head8").html('');
    $("#shidden8").val(0);
    $('#collapseeight').collapse('toggle');
});
$("#nine1").on('submit', function(event) {
    event.preventDefault();
    $("#head8").html('<span class="badge badge-success">Data Added</span>');
    $("#shidden8").val(1);
    $('#collapseeight').collapse('toggle');

});
$("#nine1").on('reset', function(event) {
    event.preventDefault();
    $("#inotype").val("").trigger('change');
    $("#nonvdate").val("");
    $("#nofserch").val("");
    $("#selprecond").val("").trigger('change');
});
$("#opdform").on('submit', function(event) {
    event.preventDefault();


});
$("#opdform").on('reset', function(event) {
    event.preventDefault();
    $("#opdselectdate").val("");
    $("#opdvisittype").val("").trigger('change');
    $("#textsymptoms").val("");
    $("#selectsymptoms").val("").trigger('change');
    $("#textdiagnosis").val("");
});

function savepage() {
    var ownerid = $("#opdoid").val();
    var branchid = $("#brid").val();
    var animalid = $("#opdaid").val();
    var docternewid = $("#drid").val();

    var visitdate = $("#opdselectdate").val();
    // var nextvisitdate = $("#nonvdate").val();
    var visittype = $("#opdvisittype").val();
    var totalsamples = 0;
    var inoculation = $("#inotype").val();
    var diagnosis = $("#textdiagnosis").val();
    var symptoms = $("#textsymptoms").val();
    var medicineData = storeTblValues();
    var fees = $("#nofserch").val();
    var feestype = "CASH";
    var presentcondition = $("#selprecond").val();
    var samplenames = ["", ""];
    samplenames = samplenames.toString();
    var shidden1 = $("#shidden1").val();
    var shidden2 = $("#shidden2").val();
    var shidden3 = $("#shidden3").val();
    var shidden4 = $("#shidden4").val();
    var shidden5 = $("#shidden5").val();
    var shidden6 = $("#shidden6").val();
    var shidden7 = $("#shidden7").val();
    var shidden8 = $("#shidden8").val();
    var mainarr = new Object();
    var castrat = new Object();
    if (shidden1 == "1") {
        // var nocastrated = $("#nocastrated").val();
        var nocastrated = 1;
        var noprocedurecas = $("#noprocedurecas").val();
        castrat['NoOfAnimals'] = nocastrated;
        castrat['Procedure'] = noprocedurecas;
        mainarr['Castration'] = castrat;
    } else {
        var nocastrated = 1;
        castrat['NoOfAnimals'] = nocastrated;
        castrat['Procedure'] = "";
        mainarr['Castration'] = castrat;
    }
    var aiarr = new Object();
    var selaisno;
    if ($("#aiselstrawno").val() != '') {
        selaisno = $("#aiselstrawno").val();
    } else {
        selaisno = 0;
    }
    if (shidden2 == "1") {
        var aistai = $("#aistai").val();
        var aisooes = $("#aisooes").val();
        var aisoror = $("#aisoror").val();
        var aissch = $("#aissch").val();
        var aisno = $("#aisno").val();
        aiarr['AIType'] = aistai;
        aiarr['Status of reproductive organ'] = aisoror;
        aiarr['Stage of Oestrus'] = aisooes;
        aiarr['Scheme'] = aissch;
        aiarr['StrawNo'] = aisno;
        mainarr['ArtificialInsemination'] = aiarr;
    } else {
        aiarr['AIType'] = "";
        aiarr['Status of reproductive organ'] = "";
        aiarr['Stage of Oestrus'] = "";
        aiarr['Scheme'] = "";
        aiarr['StrawNo'] = "";
        mainarr['ArtificialInsemination'] = aiarr;
    }
    var opsarr = new Object();
    if (shidden3 == "1") {
        var opsust = $("#opsust").val();
        opsarr['Surgery Name'] = opsust;
        mainarr['Surgery'] = opsarr;
    } else {
        opsarr['Surgery Name'] = "";
        mainarr['Surgery'] = opsarr;
    }
    var delarr = new Object();
    if (shidden4 == "1") {
        var delcadet = $("#delcadet").val();
        var delcage = $("#delcage").val();
        var delcbirtdate = $("#delcbirtdate").val();
        var delcaidate = $("#delcaidate").val();
        var delstai = $("#delstai").val();
        var delssch = $("#delssch").val();
        var delstrawno = $("#delstrawno").val();
        delarr['AIDate'] = delcaidate;
        delarr['AI-TYPE'] = delstai;
        delarr['CalfBDate'] = delcbirtdate;
        delarr['CalfDetails'] = delcadet;
        delarr['CalfGender'] = delcage;
        delarr['Scheme'] = delssch;
        delarr['StrawNo'] = delstrawno;
        mainarr['Delivery'] = delarr;
    } else {
        delarr['AIDate'] = "";
        delarr['AI-TYPE'] = "";
        delarr['CalfBDate'] = "";
        delarr['CalfDetails'] = "";
        delarr['CalfGender'] = "";
        delarr['Scheme'] = "";
        delarr['StrawNo'] = "";
        mainarr['Delivery'] = delarr;
    }
    var infarr = new Object();
    if (shidden5 == "1") {
        var inforo = $("#inforo").val();
        var ints = $("#ints").val();
        var inpcoi = $("#inpcoi").val();
        infarr['Probable Cause'] = inpcoi;
        infarr['Findings of Reproductive Organ'] = inforo;
        infarr['Treatment Suggested'] = ints;
        mainarr['Infertility'] = infarr;
    } else {
        infarr['Probable Cause'] = "";
        infarr['Findings of Reproductive Organ'] = "";
        infarr['Treatment Suggested'] = "";
        mainarr['Infertility'] = infarr;
    }
    var pdarr = new Object();
    if (shidden6 == "1") {
        var pdsaidate = $("#pdsaidate").val();
        var pdtextreport = $("#pdtextreport").val();
        var pdtype = $("#pdtype").val();
        var pdstai = $("#pdstai").val();
        var pdssch = $("#pdssch").val();
        var pdstrawno = $("#pdstrawno").val();
        var pdprety = $("#pdprety").val();
        if (pdprety == "Is Pregnant") {
            var approxmon = $("#approxmon").val();
            var pdexpdeldate = $("#pdexpdeldate").val();
            pdarr['Pregnancy Tenure'] = approxmon;
            pdarr['Expected Delivery Date'] = pdexpdeldate;
        }
        pdarr['AIDate'] = pdsaidate;
        pdarr['AI-TYPE'] = pdstai;
        pdarr['Pregnant'] = pdprety;
        pdarr['PD Type'] = pdtype;
        pdarr['Scheme'] = pdssch;
        pdarr['StrawNo'] = pdstrawno;
        pdarr['Results'] = pdtextreport;
        mainarr['Pregnancy'] = pdarr;
    } else {
        pdarr['Pregnancy Tenure'] = "";
        pdarr['Expected Delivery Date'] = "";
        pdarr['AIDate'] = "";
        pdarr['AI-TYPE'] = "";
        pdarr['Pregnant'] = "";
        pdarr['PD Type'] = "";
        pdarr['Scheme'] = "";
        pdarr['StrawNo'] = "";
        pdarr['Results'] = "";
        mainarr['Pregnancy'] = pdarr;
    }
    var proarr = new Object();
    if (shidden7 == "1") {
        var pprocdetail = $("#pprocdetail").val();
        var pdsystem = $("#pdsystem").val();
        proarr['Treatment'] = pprocdetail;
        proarr['System'] = pdsystem;
        mainarr['Treatment'] = proarr;
    } else {
        proarr['Treatment'] = "";
        proarr['System'] = "";
        mainarr['Treatment'] = proarr;
    }
    var trearr = new Object();
    if (shidden8 == "1") {
        var treatment = $("#treatment").val();
        trearr['Treatment'] = treatment;
        mainarr['Other'] = trearr;
    } else {
        trearr['Treatment'] = "";
        mainarr['Other'] = trearr;
    }

    if (visitdate == "" || visittype == "" ||
        fees == "" || feestype == "" || presentcondition == "") {
        alert("Please Fill all required Fields");
    } else {
        var treatment = JSON.stringify(mainarr);
        $.ajax({
            type: "POST",
            url: url + "createcasepaperipd.php",
            data: {
                strawnumber: selaisno,
                treatment: treatment,
                doctorid: docternewid,
                animalid: animalid,
                visitdate: visitdate,
                nextvisitdate: visitdate,
                visittype: visittype,
                totalsamples: totalsamples,
                inoculation: inoculation,
                diagnosis: diagnosis,
                symptoms: symptoms,
                medicineids: medicineData['medicineids'],
                dosages: medicineData['dosages'],
                instructions: medicineData['instructions'],
                days: medicineData['days'],
                fees: fees,
                feestype: feestype,
                presentcondition: presentcondition,
                samplenames: samplenames,
                latitude: '0',
                longitude: '0',

            },
            async: false,
            dataType: 'json',
            beforeSend: function() {
                // console.log('in');
                $("#wait").css("display", "block");
            },
            success: function(response) {
                if (response['Responsecode'] == 200) {
                    // console.log(response['NewCasePaperId']);
                    imgup(response['NewCasePaperId']);
                    // alert(response['Message']);
                }
            },
            complete: function(data) {

                alert("Data Saved");
                // console.log('out');
                $("#wait").css("display", "none");
            }
        });
    }
}

function imgup(imgid) {
    var fd = new FormData();
    var files = $('#animalimgname')[0].files[0];
    fd.append('file', files);
    fd.append('imgname', imgid);
    fd.append('foldername', "ipdcasephotos");
    $.ajax({

        url: "http://praxello.com/ahimsa/uploadimage1.php",
        type: "POST",
        contentType: false,
        cache: false,
        processData: false,
        data: fd,
        dataType: 'json',
        async: false,
        success: function(response) {}
    });
}

function chpregancyval() {
    var pdprety = $("#pdprety").val();
    if (pdprety == "Is Pregnant") {
        $("#ispshow").show();
    } else {
        $("#ispshow").hide();
    }
}

function storeTblValues() {
    var TableData = new Array();
    var medarr = [];
    var insarr = [];
    var dayarr = [];
    var dosagesarr = [];
    $('#medicinetab tr').each(function(row, tr) {
        var instruction = $(tr).find('td:eq(1) input').val();
        if (instruction == '') {
            instruction = '-';
        }
        insarr.push(instruction);
        var days = $(tr).find('td:eq(2) input').val();

        if (days == '') {
            days = ' ';
        } else {
            days = parseInt(days);
        }
        dayarr.push(days);
        var medid = $(tr).find('td:eq(3) input').val();
        if (medid == '') {
            medid = ' ';
        }
        medarr.push(medid);
        var dosval = '';
        dosagesarr.push(dosval);
    });
    TableData['days'] = dayarr.toString();
    TableData['instructions'] = insarr.toString();
    TableData['medicineids'] = medarr.toString();
    TableData['dosages'] = dosagesarr.toString();
    // TableData.shift(); // first row will be empty - so remove
    return TableData;
}


var loadFile = function(event) {
    var output = document.getElementById('setimage');
    // console.log(output);
    output.src = URL.createObjectURL(event.target.files[0]);
    // $("#eveimg").show();
};

function imgon(value) {
    var modal = document.getElementById("myModal");
    var img = value;
    var modalImg = document.getElementById("img01");
    var captionText = "Image";
    modal.style.display = "block";
    modalImg.src = value;
    captionText.innerHTML = this.alt;

    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }
}

function loadstraw(param) {
    param = $("#aiselstrawno option:selected").text();
    $('#aisno').val(param);
}