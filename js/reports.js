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
            if (response.Data != null) {
                console.log(response.Data);
            }
        }
    });

}