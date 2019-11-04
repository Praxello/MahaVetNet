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

const loadZones = (param, level) => {
    $.ajax({
        url: url + 'dashboard_map.php',
        type: 'POST',
        data: { branchid: param },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                var zonesData = '';
                for (var i = 0; i < count; i++) {
                    zonesData += "<option></option>";
                    zonesData += "<option>" + response.Data[i].branch + "</option>";
                }
                if (level == 1)
                    $('#zone').html(zonesData);
                else if (level == 2)
                    $('#district').html(zonesData);
                else if (level == 3)
                    $('#taluka').html(zonesData);
                else if (level == 4)
                    $('#dispencery').html(zonesData);
            }
        }
    });
}
const loadBranchLevel = branchid => {
    var level = 1;
    if (branchid >= 100001 && branchid < 200000) {
        level = 1;
    } else if (branchid >= 200001 && branchid < 300000) {
        level = 2;
        branchId_taluka = branchid;
        $('.zone').hide();
    } else if (branchid >= 300001 && branchid < 400000) { //ddc
        level = 3;
        branchId_dispencery = branchid;
        $('.zone').hide();
        $('.district').hide();
    } else if (branchid >= 400001 && branchid < 600000) { //daho 
        level = 4;
        $('.zone').hide();
        $('.district').hide();
        $('.taluka').hide();
    } else {
        level = 4;
        $('.zone').hide();
        $('.district').hide();
        $('.taluka').hide();
    }
    loadZones(data.branchid, level);
}
loadBranchLevel(data.branchid);


const loadDistricts = (param, level) => {
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: { centretype: param, branchid: data.branchid },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                branchId_taluka = response.Data;
                loadZones(response.Data, level);
            }
        }
    });
}
const loadTaluka = (param, level) => {
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: { centretype: param, branchid: branchId_taluka },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                branchId_dispencery = response.Data;
                loadZones(response.Data, level);
            }
        }
    });
}
const loadDispencery = (param, level) => {
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: { centretype: param, branchid: branchId_dispencery },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                loadZones(response.Data, level);
            }
        }
    });
}
const getDispenceryBranch = param => {
    $.ajax({
        url: url + 'getbranchName.php',
        type: 'POST',
        data: { centretype: param },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                dispeneryId = response.Data;
            }
        }
    });
}
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
        branchId: dispeneryId
    };
    console.log(reportData);
    $.ajax({
        url: url + 'get_reports.php',
        type: 'POST',
        data: reportData,
        async: true,
        dataType: 'json',
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
                    tableHead += "<th>Category</th> <th>Species</th> <th>Breed</th><th>Scheme</th><th>Straw Number</th>";
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
                        tableData += "<td>" + response.Data[i].Species + "</td>";
                        tableData += "<td>" + response.Data[i].Breed + "</td>";
                        tableData += "<td>" + scheme + "</td>";
                        tableData += "<td><code>" + strawNumber + "</code></td>";
                        tableData += "<td>" + aiType + "</td>";
                        tableData += "<td>" + organStatus + "</td>";
                        tableData += "<td>" + oestrusStage + "</td></tr>";
                    }
                } else if (reportData.reportType == 5) {
                    tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                    tableHead += "<th>Category</th> <th>Species</th> <th>Breed</th><th>Scheme</th><th>Straw Number</th>";
                    tableHead += "<th>Calf BDate</th> <th>CalfGender</th><th>AIDate</th><th>AIType</th><th>CalfDetails</th></tr>";
                    for (var i = 0; i < count; i++) {
                        var jsonObject = JSON.parse(response.Data[i].treatment);
                        console.log(jsonObject);
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
                        tableData += "<td>" + response.Data[i].Species + "</td>";
                        tableData += "<td>" + response.Data[i].Breed + "</td>";
                        tableData += "<td>" + scheme + "</td>";
                        tableData += "<td><code>" + strawNumber + "</code></td>";
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
                    tableHead += "<th>Category</th> <th>Species</th> <th>Breed</th><th>Probable Cause</th><th>Finding Reproductive Organ</th>";
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
                    tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                    tableHead += "<th>Fess</th> <th>Payment Type</th><th>Mobile</th><th>Cast</th></tr>";
                    for (var i = 0; i < count; i++) {
                        tableData += "<tr><td>" + (i + 1) + "</td>";
                        tableData += "<td>" + response.Data[i].Year + "</td>";
                        tableData += "<td>" + response.Data[i].visitDate + "</td>";
                        tableData += "<td>" + response.Data[i].firstName + ' ' + response.Data[i].lastName + "</td>";
                        tableData += "<td>" + response.Data[i].address + "</td>";
                        tableData += "<td>" + response.Data[i].feesAmount + "</td>";
                        tableData += "<td>" + response.Data[i].typeOfPayment + "</td>";
                        tableData += "<td>" + response.Data[i].mobile + "</td>";
                        tableData += "<td>" + response.Data[i].category + "</td></tr>";
                    }
                } else if (reportData.reportType == 10) {
                    tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                    tableHead += "<th>Category</th> <th>Species</th> <th>Breed</th><th>Procedure</th><th>NoOfAnimals</th></tr>";
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
                        tableData += "<td>" + response.Data[i].Category + "</td>";
                        tableData += "<td>" + response.Data[i].Species + "</td>";
                        tableData += "<td>" + response.Data[i].Breed + "</td>";
                        tableData += "<td>" + peocedure + "</td>";
                        tableData += "<td>" + noofanimals + "</td></tr>";

                    }
                } else if (reportData.reportType == 11) {
                    tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                    tableHead += "<th>Category</th> <th>Species</th> <th>Breed</th><th>Surgery Name</th></tr>";
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
                        tableData += "<td>" + response.Data[i].Category + "</td>";
                        tableData += "<td>" + response.Data[i].Species + "</td>";
                        tableData += "<td>" + response.Data[i].Breed + "</td>";
                        tableData += "<td>" + surgery + "</td></tr>";
                    }
                } else if (reportData.reportType == 12) {
                    tableHead += "<tr><th>Monthly</th><th>Yearly</th> <th>Visit Date</th> <th>Name  </th> <th>Address</th>";
                    tableHead += "<th>Category</th> <th>Species</th> <th>Breed</th><th>Pregnant</th><th>PD Type</th>";
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
                    tableHead += "<th>Category</th> <th>Species</th><th>Breed</th><th>DateOfBirth</th><th>Gender</th><th>Weight</th>";
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
                    tableHead += "<th>Category</th> <th>Species</th><th>Breed</th><th>DateOfBirth</th><th>Gender</th><th>Weight</th>";
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
                    tableHead += "<th>Category</th> <th>Species</th><th>Breed</th><th>DateOfBirth</th><th>Gender</th><th>Weight</th>";
                    tableHead += "<th>Symptoms</th><th>Diagnosis</th><th>Treatment</th></tr>";
                    for (var i = 0; i < count; i++) {
                        var disease = response.Data[i].symptoms;
                        if (!(((disease.toLowerCase().includes("fever") && disease.toLowerCase().includes("diarrhea") && disease.toLowerCase().includes("mouth lesions"))) || ((disease.toLowerCase().includes("fever") && disease.toLowerCase().includes("diarrhoea") && disease.toLowerCase().includes("mouth lesions"))))) {

                            var jsonObject = JSON.parse(response.Data[i].treatment);
                            var treatments = getTreatment(jsonObject);
                            tableData += "<tr><td>" + (i + 1) + "</td>";
                            tableData += "<td>" + response.Data[i].Year + "</td>";
                            tableData += "<td>" + response.Data[i].visitDate + "</td>";
                            tableData += "<td>" + response.Data[i].firstName + ' ' + response.Data[i].lastName + "</td>";
                            tableData += "<td>" + response.Data[i].address + "</td>";
                            tableData += "<td>" + response.Data[i].category + "</td>";
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
                    tableHead += "<th>Category</th> <th>Species</th><th>Breed</th><th>DateOfBirth</th><th>Gender</th><th>Weight</th>";
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
                columnDefs: [{ orderable: false, targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] }],
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'pdf', 'colvis'],
                destroy: true
            });

        }
    });

}