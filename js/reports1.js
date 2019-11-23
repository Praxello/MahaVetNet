const data = {
    branchid: $('#branchid').val()
}
var branchId_taluka = null;
var branchId_dispencery = null;
var dispeneryId = null;
$('#year').select2({
    allowClear: true,
    placeholder: "Select Year"
});
$('#month').select2({
    allowClear: true,
    placeholder: "Select Month"
});
$('#zone').select2({
    allowClear: true,
    placeholder: "Select Zone"
});
$('#district').select2({
    allowClear: true,
    placeholder: "Select District"
});
$('#taluka').select2({
    allowClear: true,
    placeholder: "Select Taluka"
});
$('#dispencery').select2({
    allowClear: true,
    placeholder: "Select Dispencery"
});
$('#operation').select2({
    allowClear: true,
    placeholder: "Select Report To be Generated"
});
var regionMap = [];
var districtMap = new Map();
var TalukaMap = new Map();
var dispenceryMap = new Map();
loadMaps();
getyear();

function getyear() {

    var year = '';
    $.ajax({
        type: "POST",
        url: url + "fetchyearfrommedication.php",
        async: false,
        dataType: 'json',
        success: function(response) {

            var count;
            if (response['Data'] != null) {
                count = response['Data'].length;

            }
            for (var i = 0; i < count; i++) {
                year += "<option value='" + response['Data'][i].year + "'>" + response['Data'][i].year + "</option>";
            }
            $("#year").html(year);
        }
    });
}

function loadMaps() {
    $.ajax({
        url: url + 'download_report_data.php',
        type: 'POST',
        async: false,
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Responsecode == 200) {
                if (response.Regions != null) {
                    regionMap = [...response.Regions];
                    //console.log(regionMap);
                }
                if (response.Blocks != null) {
                    var count = response.Blocks.length;
                    for (var i = 0; i < count; i++) {
                        var key = Object.keys(response.Blocks[i]);
                        key = key.toString();
                        districtMap.set(key, response.Blocks[i]);
                    }
                    // console.log(districtMap);
                }
                if (response.Taluka != null) {
                    // console.log(response.Taluka);
                    var count = response.Taluka.length;
                    for (var i = 0; i < count; i++) {
                        var key = Object.keys(response.Taluka[i]);
                        key = key.toString();
                        TalukaMap.set(key, response.Taluka[i]);
                    }
                    //console.log(TalukaMap);
                }
                if (response.Dispencery != null) {
                    //console.log(response.Dispencery);
                    var count = response.Dispencery.length;
                    // console.log(TalukaMap);
                    // console.log(count);
                    var last1 = null;
                    var bknstr = null; //Block name string
                    var brnnstr = null; //Branch name string

                    key = key.toString();
                    var concatkey = null;
                    let i = 0;
                    let sum = 0;
                    for (let value of TalukaMap) {
                        let name1 = value[0];

                        let name2 = value[1];
                        let talcount = name2[name1].length;
                        for (let j = 0; j < talcount; j++) {
                            bknstr = name2[name1][j].blockName;
                            brnnstr = name2[name1][j].branchName;
                            concatkey = bknstr + brnnstr;
                            dispenceryMap.set(concatkey, response.Dispencery[i]);
                            i++;
                        }


                    }

                    // console.log(dispenceryMap);
                }
            }
        },
        complete: function(response) {
            $("#wait").css("display", "none");
        }
    });
}
const loadZones = level => {
    var count = regionMap.length;
    var zonesData = '';
    for (var i = 0; i < count; i++) {
        zonesData += "<option value=''>Select Region</option>";
        zonesData += "<option>" + regionMap[i] + "</option>";
    }
    $('#zone').html(zonesData);

}
const loadDistricts = (param, level) => {
    console.log("distmap" + param);
    var zonesData = '';
    if (districtMap.has(param)) {
        var districts = districtMap.get(param);
        var count = districts[param].length;
        for (var i = 0; i < count; i++) {
            zonesData += "<option value=''>Select District</option>";
            zonesData += "<option>" + districts[param][i] + "</option>";
        }
        $('#district').html(zonesData);
    }
}

const loadTaluka = (param, level) => {
    var zonesData = '';
    if (TalukaMap.has(param)) {
        var talukas = TalukaMap.get(param);
        console.log(talukas);
        var count = talukas[param].length;
        for (var i = 0; i < count; i++) {
            zonesData += "<option value=''>Select Taluka</option>";
            zonesData += "<option value=" + talukas[param][i].blockName + talukas[param][i].branchName + ">" + talukas[param][i].branchName + "</option>";
        }
        $('#taluka').html(zonesData);
    }
}
const loadDispencery = (param, level) => {
    var zonesData = '';
    console.log(param);
    console.log(dispenceryMap);

    if (dispenceryMap.has(param)) {
        var dispencery = dispenceryMap.get(param);
        // console.log(dispencery);
        var key = Object.keys(dispencery);
        var count = dispencery[key].length;

        for (var i = 0; i < count; i++) {
            zonesData += "<option value=''>Select Dispencery</option>";
            zonesData += "<option value=" + dispencery[key][i].branchId + ">" + dispencery[key][i].centre_type + "</option>";
        }
        $('#dispencery').html(zonesData);
    }
}
const fetchDispencery = branchid => {
    var zonesData = '';
    $.ajax({
        url: url + 'fetchDispencerybyid.php',
        type: 'POST',
        data: { branchid: branchid },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                // console.log(response.Data);
                var count = response.Data.length;
                for (var i = 0; i < count; i++) {
                    zonesData += "<option value=''>Select Dispencery</option>";
                    zonesData += "<option value=" + response.Data[i].branchId + ">" + response.Data[i].centre_type + "</option>";
                }
                $('#dispencery').html(zonesData);
            }
        }
    });
}
const singleDispencery = (param, branchId) => {
    var zonesData = '';
    // console.log(param);
    // console.log(branchId);
    zonesData += "<option value=''>Select Dispencery</option>";
    zonesData += "<option value=" + branchId + " selected>" + param + "</option>";
    $('#dispencery').html(zonesData);
}
const loadBranchLevel = branchid => {
    var level = 1;
    var centerid = $("#centerid").val();
    if (branchid >= 100001 && branchid < 200000) {
        level = 1;
        loadZones(level);
    } else if (branchid >= 200001 && branchid < 300000) {
        level = 2;
        branchId_taluka = branchid;
        $('.zone').hide();
        loadDistricts(centerid, level);
    } else if (branchid >= 300001 && branchid < 400000) { //ddc
        level = 3;
        branchId_dispencery = branchid;
        $('.zone').hide();
        $('.district').hide();
        loadTaluka(centerid, level);
    } else if (branchid >= 400001 && branchid < 500000) { //ddc
        level = 3;
        branchId_dispencery = branchid;
        $('.zone').hide();
        $('.district').hide();
        loadTaluka(centerid, level);
    } else if (branchid >= 500001 && branchid < 600000) { //daho
        level = 4;
        $('.zone').hide();
        $('.district').hide();
        $('.taluka').hide();
        // loadDispencery(centerid,level);
        fetchDispencery(branchid);
    } else {
        level = 4;
        $('.zone').hide();
        $('.district').hide();
        $('.taluka').hide();
        singleDispencery(centerid, branchid);

    }
    //loadZones(data.branchid, level);
}
loadBranchLevel(data.branchid);





// const getDispenceryBranch = param => {
//     $.ajax({
//         url: url + 'getbranchName.php',
//         type: 'POST',
//         data: { centretype: param },
//         async: true,
//         dataType: 'json',
//         beforeSend: function() {
//             $("#wait").css("display", "block");
//         },
//         success: function(response) {
//             if (response.Data != null) {
//                 dispeneryId = response.Data;
//             }
//         },
//         complete: function(response) {
//             $("#wait").css("display", "none");
//         }
//     });
// }
const getTreatment = param => {
    var ke = [];
    for (var k in param) {
        var j = Object.values(param[k]);
        if (j[0] != "") {
            ke.push(k);
        }
    }
    return ke;
}
const get_reports = () => {
    const reportData = {
        year: $('#year').val(),
        month: $('#month').val(),
        zone: $('#zone').val(),
        district: $('#district').val(),
        taluka: $('#taluka').val(),
        dispencery: $('#dispencery').val(),
        reportType: $('#operation').val(),
        branchId: $('#dispencery').val()
    };
    if (reportData.branchId != null && reportData.month != '' && reportData.year != '') {
        $.ajax({
            url: url + 'get_reports.php',
            type: 'POST',
            data: reportData,
            async: true,
            dataType: 'json',
            beforeSend: function() {
                $("#wait").css("display", "block");
            },
            success: function(response) {
                console.log(response);
                $('.farmer-table').dataTable().fnDestroy();
                $('.farmer-head').empty();
                $('.farmer-data').empty();
                if (response.Data != null) {
                    var count = response.Data.length;
                    var tableData = '',
                        tableHead = '';
                    if (reportData.reportType == 1 || reportData.reportType == 2 || reportData.reportType == 3 || reportData.reportType == 4) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th><th>Animal Name</th> <th>Species</th> <th>Breed</th><th>Scheme</th><th>Straw Number</th>";
                        tableHead += "<th>AIType</th> <th>Status of Reproductive Organ</th><th>Stage of Oestrus</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var aiType = null,
                                organStatus = null,
                                oestrusStage = null,
                                scheme = null,
                                strawNumber = null;
                            if (jsonObject.hasOwnProperty('ArtificialInsemination')) {
                                aiType = jsonObject['ArtificialInsemination'].AIType;
                                organStatus = jsonObject['ArtificialInsemination']['Status of reproductive organ'];
                                oestrusStage = jsonObject['ArtificialInsemination']['Stage of Oestrus'];
                                scheme = jsonObject['ArtificialInsemination'].Scheme;
                                strawNumber = jsonObject['ArtificialInsemination'].StrawNo;
                            }
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].Visit_Date + "</td>";
                            tableData += "<td>" + response.Data[i].FirstName + ' ' + response.Data[i].LastName + "</td>";
                            tableData += "<td>" + response.Data[i].ownerAddress + "</td>";
                            tableData += "<td>" + response.Data[i].Category + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].Species + "</td>";
                            tableData += "<td>" + response.Data[i].Breed + "</td>";
                            tableData += "<td>" + scheme + "</td>";
                            tableData += "<td>" + strawNumber + "</td>";
                            tableData += "<td>" + aiType + "</td>";
                            tableData += "<td>" + organStatus + "</td>";
                            tableData += "<td>" + oestrusStage + "</td></tr>";
                        }
                    } else if (reportData.reportType == 5) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th><th>Animal Name</th><th>Species</th> <th>Breed</th><th>Scheme</th><th>Straw Number</th>";
                        tableHead += "<th>Calf BDate</th> <th>CalfGender</th><th>AIDate</th><th>AIType</th><th>CalfDetails</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var aiType = null,
                                AIDate = null,
                                CalfBDate = null,
                                CalfDetails = null,
                                CalfGender = null,
                                scheme = null,
                                strawNumber = null;
                            if (jsonObject.hasOwnProperty('Delivery')) {
                                AIDate = jsonObject['Delivery'].AIDate;
                                aiType = jsonObject['Delivery']['AI-TYPE'];
                                CalfBDate = jsonObject['Delivery']['CalfBDate'];
                                CalfDetails = jsonObject['Delivery']['CalfDetails'];
                                CalfGender = jsonObject['Delivery']['CalfGender'];
                                scheme = jsonObject['Delivery'].Scheme;
                                strawNumber = jsonObject['Delivery'].StrawNo;
                            }
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].Visit_Date + "</td>";
                            tableData += "<td>" + response.Data[i].FirstName + ' ' + response.Data[i].LastName + "</td>";
                            tableData += "<td>" + response.Data[i].ownerAddress + "</td>";
                            tableData += "<td>" + response.Data[i].Category + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].Species + "</td>";
                            tableData += "<td>" + response.Data[i].Breed + "</td>";
                            tableData += "<td>" + scheme + "</td>";
                            tableData += "<td>" + strawNumber + "</td>";
                            tableData += "<td>" + CalfBDate + "</td>";
                            tableData += "<td>" + CalfGender + "</td>";
                            tableData += "<td>" + AIDate + "</td>";
                            tableData += "<td>" + aiType + "</td>";
                            tableData += "<td>" + CalfDetails + "</td></tr>";
                        }
                    } else if (reportData.reportType == 6) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Batch No.</th> <th>Cow</th> <th>Bull</th><th>Calf</th><th>Buffalo</th>";
                        tableHead += "<th>Redka</th> <th>Goat</th><th>Sheep</th><th>Poultry</th></tr>";
                        for (var i = 0; i < count; i++) {
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].Visit_Date + "</td>";
                            tableData += "<td>" + response.Data[i].FirstName + ' ' + response.Data[i].LastName + "</td>";
                            tableData += "<td>" + response.Data[i].ownerAddress + "</td>";
                            tableData += "<td>" + response.Data[i].batch + "</td>";
                            tableData += "<td>" + response.Data[i].cow + "</td>";
                            tableData += "<td>" + response.Data[i].bull + "</td>";
                            tableData += "<td>" + response.Data[i].calf + "</td>";
                            tableData += "<td>" + response.Data[i].buffalo + "</td>";
                            tableData += "<td>" + response.Data[i].redka + "</td>";
                            tableData += "<td>" + response.Data[i].goat + "</td>";
                            tableData += "<td>" + response.Data[i].sheep + "</td>";
                            tableData += "<td>" + response.Data[i].poultry + "</td></tr>";
                        }
                    } else if (reportData.reportType == 7) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th><th>Animal Name</th> <th>Species</th> <th>Breed</th><th>Probable Cause</th><th>Finding Reproductive Organ</th>";
                        tableHead += "<th>Treatment Suggested</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var pcause = null,
                                organ = null,
                                treat = null;
                            if (jsonObject.hasOwnProperty('Infertility')) {
                                pcause = jsonObject['Infertility']['Probable Cause'];
                                organ = jsonObject['Infertility']['Findings of Reproductive Organ'];
                                treat = jsonObject['Infertility']['Treatment Suggested'];
                            }
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].Visit_Date + "</td>";
                            tableData += "<td>" + response.Data[i].FirstName + ' ' + response.Data[i].LastName + "</td>";
                            tableData += "<td>" + response.Data[i].ownerAddress + "</td>";
                            tableData += "<td>" + response.Data[i].Category + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].Species + "</td>";
                            tableData += "<td>" + response.Data[i].Breed + "</td>";
                            tableData += "<td>" + pcause + "</td>";
                            tableData += "<td>" + organ + "</td>";
                            tableData += "<td>" + treat + "</td></tr>";
                        }
                    } else if (reportData.reportType == 8) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Cow</th> <th>Bull</th><th>Calf</th><th>Buffalo</th>";
                        tableHead += "<th>Redka</th> <th>Goat</th><th>Sheep</th><th>Poultry</th></tr>";
                        for (var i = 0; i < count; i++) {
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].Visit_Date + "</td>";
                            tableData += "<td>" + response.Data[i].FirstName + ' ' + response.Data[i].LastName + "</td>";
                            tableData += "<td>" + response.Data[i].ownerAddress + "</td>";
                            tableData += "<td>" + response.Data[i].cow + "</td>";
                            tableData += "<td>" + response.Data[i].bull + "</td>";
                            tableData += "<td>" + response.Data[i].calf + "</td>";
                            tableData += "<td>" + response.Data[i].buffalo + "</td>";
                            tableData += "<td>" + response.Data[i].redka + "</td>";
                            tableData += "<td>" + response.Data[i].goat + "</td>";
                            tableData += "<td>" + response.Data[i].sheep + "</td>";
                            tableData += "<td>" + response.Data[i].poultry + "</td></tr>";
                        }
                    } else if (reportData.reportType == 9) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th><th>Animal Name</th>";
                        tableHead += "<th>Fess</th> <th>Payment Type</th><th>Mobile</th><th>Cast</th></tr>";
                        for (var i = 0; i < count; i++) {
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].visitDate + "</td>";
                            tableData += "<td>" + response.Data[i].firstName + ' ' + response.Data[i].lastName + "</td>";
                            tableData += "<td>" + response.Data[i].address + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].feesAmount + "</td>";
                            tableData += "<td>" + response.Data[i].typeOfPayment + "</td>";
                            tableData += "<td>" + response.Data[i].mobile + "</td>";
                            tableData += "<td>" + response.Data[i].category + "</td></tr>";
                        }
                    } else if (reportData.reportType == 10) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th><th>Animal Name</th> <th>Species</th> <th>Breed</th><th>Procedure</th><th>NoOfAnimals</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var peocedure = null,
                                noofanimals = null;

                            if (jsonObject.hasOwnProperty('Castration')) {
                                peocedure = jsonObject['Castration']['Procedure'];
                                noofanimals = jsonObject['Castration']['NoOfAnimals'];
                            }
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].Visit_Date + "</td>";
                            tableData += "<td>" + response.Data[i].FirstName + ' ' + response.Data[i].LastName + "</td>";
                            tableData += "<td>" + response.Data[i].ownerAddress + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].Category + "</td>";
                            tableData += "<td>" + response.Data[i].Species + "</td>";
                            tableData += "<td>" + response.Data[i].Breed + "</td>";
                            tableData += "<td>" + peocedure + "</td>";
                            tableData += "<td>" + noofanimals + "</td></tr>";

                        }
                    } else if (reportData.reportType == 11) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th><th>Animal Name</th> <th>Species</th> <th>Breed</th><th>Surgery Name</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var surgery = null;
                            if (jsonObject.hasOwnProperty('Surgery')) {
                                surgery = jsonObject['Surgery']['Surgery Name'];
                            }
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].Visit_Date + "</td>";
                            tableData += "<td>" + response.Data[i].FirstName + ' ' + response.Data[i].LastName + "</td>";
                            tableData += "<td>" + response.Data[i].ownerAddress + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].Category + "</td>";
                            tableData += "<td>" + response.Data[i].Species + "</td>";
                            tableData += "<td>" + response.Data[i].Breed + "</td>";
                            tableData += "<td>" + surgery + "</td></tr>";
                        }
                    } else if (reportData.reportType == 12) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th><th>Animal Name</th> <th>Species</th> <th>Breed</th><th>Pregnant</th><th>PD Type</th>";
                        tableHead += "<th>Scheme</th> <th>StrawNo</th> <th>Expected Delivery Date</th><th>Results</th><th>AIDate</th><th>AI-Type</th><th>Pregancy Tenure</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var Pregnant = null,
                                aiType = null,
                                AIDate = null,
                                PregnancyTenure = null,
                                ExpectedDeliveryDate = null,
                                PDType = null,
                                scheme = null,
                                Results = null,
                                strawNumber = null;
                            if (jsonObject.hasOwnProperty('Pregnancy')) {
                                AIDate = jsonObject['Pregnancy'].AIDate;
                                aiType = jsonObject['Pregnancy']['AI-TYPE'];
                                PregnancyTenure = jsonObject['Pregnancy']['Pregnancy Tenure'];
                                ExpectedDeliveryDate = jsonObject['Pregnancy']['Expected Delivery Date'];
                                Pregnant = jsonObject['Pregnancy']['Pregnant'];
                                PDType = jsonObject['Pregnancy']['PD Type'];
                                scheme = jsonObject['Pregnancy'].Scheme;
                                strawNumber = jsonObject['Pregnancy'].StrawNo;
                                Results = jsonObject['Pregnancy'].Results
                            }
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].Visit_Date + "</td>";
                            tableData += "<td>" + response.Data[i].FirstName + ' ' + response.Data[i].LastName + "</td>";
                            tableData += "<td>" + response.Data[i].ownerAddress + "</td>";
                            tableData += "<td>" + response.Data[i].Category + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].Species + "</td>";
                            tableData += "<td>" + response.Data[i].Breed + "</td>";
                            tableData += "<td>" + Pregnant + "</td>";
                            tableData += "<td>" + PDType + "</td>";
                            tableData += "<td>" + scheme + "</td>";
                            tableData += "<td>" + strawNumber + "</td>";
                            tableData += "<td>" + ExpectedDeliveryDate + "</td>";
                            tableData += "<td>" + Results + "</td>";
                            tableData += "<td>" + AIDate + "</td>";
                            tableData += "<td>" + aiType + "</td>";
                            tableData += "<td>" + PregnancyTenure + "</td></tr>";
                        }
                    } else if (reportData.reportType == 13) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Admission Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th> <th>Animal Name</th><th>Species</th><th>Breed</th><th>DateOfBirth</th><th>Gender</th><th>Weight</th>";
                        tableHead += "<th>Symptoms</th><th>Diagnosis</th><th>Treatment</th><th>DischargeDate</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var treatments = getTreatment(jsonObject);
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].visitDate + "</td>";
                            tableData += "<td>" + response.Data[i].firstName + ' ' + response.Data[i].lastName + "</td>";
                            tableData += "<td>" + response.Data[i].address + "</td>";
                            tableData += "<td>" + response.Data[i].category + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].specie + "</td>";
                            tableData += "<td>" + response.Data[i].breed + "</td>";
                            tableData += "<td>" + response.Data[i].dateOfBirth + "</td>";
                            tableData += "<td>" + response.Data[i].gender + "</td>";
                            tableData += "<td>" + response.Data[i].weight + "</td>";
                            tableData += "<td>" + response.Data[i].symptoms + "</td>";
                            tableData += "<td>" + response.Data[i].diagnosis + "</td>";
                            tableData += "<td>" + treatments.toString() + "</td>";
                            tableData += "<td>" + response.Data[i].dischargeDate + "</td></tr>";
                        }
                    } else if (reportData.reportType == 14) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th> <th>Animal Name</th><th>Species</th><th>Breed</th><th>DateOfBirth</th><th>Gender</th><th>Weight</th>";
                        tableHead += "<th>Symptoms</th><th>Diagnosis</th><th>Treatment</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var treatments = getTreatment(jsonObject);
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].visitDate + "</td>";
                            tableData += "<td>" + response.Data[i].firstName + ' ' + response.Data[i].lastName + "</td>";
                            tableData += "<td>" + response.Data[i].address + "</td>";
                            tableData += "<td>" + response.Data[i].category + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].specie + "</td>";
                            tableData += "<td>" + response.Data[i].breed + "</td>";
                            tableData += "<td>" + response.Data[i].dateOfBirth + "</td>";
                            tableData += "<td>" + response.Data[i].gender + "</td>";
                            tableData += "<td>" + response.Data[i].weight + "</td>";
                            tableData += "<td>" + response.Data[i].symptoms + "</td>";
                            tableData += "<td>" + response.Data[i].diagnosis + "</td>";
                            tableData += "<td>" + treatments.toString() + "</td></tr>";

                        }
                    } else if (reportData.reportType == 15) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th> <th>Animal Name</th><th>Species</th><th>Breed</th><th>DateOfBirth</th><th>Gender</th><th>Weight</th>";
                        tableHead += "<th>Symptoms</th><th>Diagnosis</th><th>Treatment</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var disease = response.Data[i].symptoms;
                            var fever = disease.toLowerCase().includes("fever");
                            var diarrhea = disease.toLowerCase().includes("diarrhea");
                            var mouth = disease.toLowerCase().includes("mouth lesions");
                            if ((fever && diarrhea) || (fever && mouth) || (diarrhea && mouth)) {

                                var jsonObject = JSON.parse(response.Data[i].treatment);
                                var treatments = getTreatment(jsonObject);
                                tableData += "<tr><td>" + (i + 1) + "</td>";
                                tableData += "<td>" + response.Data[i].Year + "</td>";
                                tableData += "<td>" + response.Data[i].visitDate + "</td>";
                                tableData += "<td>" + response.Data[i].firstName + ' ' + response.Data[i].lastName + "</td>";
                                tableData += "<td>" + response.Data[i].address + "</td>";
                                tableData += "<td>" + response.Data[i].category + "</td>";
                                tableData += "<td>" + response.Data[i].animalName + "</td>";
                                tableData += "<td>" + response.Data[i].specie + "</td>";
                                tableData += "<td>" + response.Data[i].breed + "</td>";
                                tableData += "<td>" + response.Data[i].dateOfBirth + "</td>";
                                tableData += "<td>" + response.Data[i].gender + "</td>";
                                tableData += "<td>" + response.Data[i].weight + "</td>";
                                tableData += "<td>" + response.Data[i].symptoms + "</td>";
                                tableData += "<td>" + response.Data[i].diagnosis + "</td>";
                                tableData += "<td>" + treatments.toString() + "</td></tr>";
                            }
                        }
                    } else if (reportData.reportType == 16) {
                        tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                        tableHead += "<th>Category</th><th>Animal Name</th> <th>Species</th><th>Breed</th><th>DateOfBirth</th><th>Gender</th><th>Weight</th>";
                        tableHead += "<th>Symptoms</th><th>Diagnosis</th><th>Treatment</th></tr>";
                        for (var i = 0; i < count; i++) {
                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var treatments = getTreatment(jsonObject);
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].visitDate + "</td>";
                            tableData += "<td>" + response.Data[i].firstName + ' ' + response.Data[i].lastName + "</td>";
                            tableData += "<td>" + response.Data[i].address + "</td>";
                            tableData += "<td>" + response.Data[i].category + "</td>";
                            tableData += "<td>" + response.Data[i].animalName + "</td>";
                            tableData += "<td>" + response.Data[i].specie + "</td>";
                            tableData += "<td>" + response.Data[i].breed + "</td>";
                            tableData += "<td>" + response.Data[i].dateOfBirth + "</td>";
                            tableData += "<td>" + response.Data[i].gender + "</td>";
                            tableData += "<td>" + response.Data[i].weight + "</td>";
                            tableData += "<td>" + response.Data[i].symptoms + "</td>";
                            tableData += "<td>" + response.Data[i].diagnosis + "</td>";
                            tableData += "<td>" + treatments.toString() + "</td></tr>";

                        }
                    }
                }
                $('#farmer-head').html(tableHead);
                $('.farmer-data').html(tableData);
                $('.farmer-table').dataTable({
                    searching: true,
                    retrieve: true,
                    bPaginate: $('tbody tr').length > 10,
                    order: [],
                    columnDefs: [{ orderable: false, targets: [0, 1, 2, 3, 4, 5, 6, 7, 8] }],
                    dom: 'Bfrtip',
                    buttons: ['copy', 'excel', 'csv', 'pdf', 'colvis'],
                    destroy: true
                });

            },
            complete: function(response) {
                $("#wait").css("display", "none");
            }
        });
    } else {
        alert('Please Select All the fields');
    }
}

function get_mrp() {
    var branchId = $('#dispencery').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var email = $('#emailid').val();
    if (branchId != null && month != '' && year != '' && email != '') {
        const parameters = {
            branchId: branchId,
            year: year,
            month: month,
            email: email
        };
        window.location.href = url + 'download_excel.php?branchId=' + parameters.branchId + '&&year=' + parameters.year + '&&month=' + parameters.month + '&&email=' + parameters.email;
    } else {
        alert('Please Select All the fields');
    }
}