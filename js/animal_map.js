var g_branchid = null;
g_branchid = data.branchid;
var numberofbranch = [];
var numberofPD = [];
var numberofAI = [];
var numberofInf = [];
var numberofCB = [];
var seriesData = [];
var chart3,chartvar3=0;
const loadMapData = (seriesData) => {
    chart3=Highcharts.chart('animaldiv', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'AI | PD | CB | IS'
        },
        xAxis: {
            categories: numberofbranch,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'AI | PD | CB |IS'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            //alert('Category: ' + this.category + ', value: ' + this.y);
                            getbranchid(this.category, g_branchid);
                        }
                    }
                }
            }
        },
        series: seriesData
    });
}
const loadanimalData = (param) => {
    numberofbranch = [];
    numberofPD = [];
    numberofAI = [];
    numberofInf = [];
    numberofCB = [];
    seriesData = [];
    $.ajax({
        url: url + 'dashboard_map_animals.php',
        type: 'POST',
        data: { branchid: param },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                var i;
                for (i = 0; i < count; i++) {
                    numberofbranch.push(response.Data[i].branch);
                    numberofPD.push(parseInt(response.Data[i].PD));
                    numberofAI.push(parseInt(response.Data[i].AI));
                    numberofInf.push(parseInt(response.Data[i].Inf));
                    numberofCB.push(parseInt(response.Data[i].CB));
                }

                seriesData.push({ name: 'Artificial Insemination', data: numberofAI });
                seriesData.push({ name: 'Pregnancy Diagnosis', data: numberofPD });
                seriesData.push({ name: 'Calves Born', data: numberofCB });
                seriesData.push({ name: 'Infertility & Sterility', data: numberofInf });
            }
        },
        complete: function(response) {
          if(chartvar3!=0){
            chart3.hideLoading();
          }
            loadMapData(seriesData);
        }
    });
}
loadanimalData(data.branchid);

const getbranchid = (branch, branchId) => {
     chartvar3=1;
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: { centretype: branch, branchid: branchId },
        async: true,
        dataType: 'json',
        beforeSend: function() {
            chart3.showLoading();
            // console.log("ok1");
        },
        success: function(response) {
            if (response.Data != null) {
                g_branchid = response.Data;
            }
        },
        complete: function(response) {
            loadanimalData(g_branchid);
        }
    });
}
