var g_branchid = null;
g_branchid = data.branchid;
var numberofbranch = [];
var numberofanimals = [];
var numberofcases = [];
var numberofai = [];
var seriesData = [];

const loadMapData = (seriesData) => {
    Highcharts.chart('animaldiv', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: numberofbranch,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rainfall (mm)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
    numberofanimals = [];
    numberofcases = [];
    numberofai = [];
    seriesData = [];
    $.ajax({
        url: 'apis/dashboard_map_animals.php',
        type: 'POST',
        data: { branchid: param },
        async: false,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                var i;
                for (i = 0; i < count; i++) {
                    numberofbranch.push(response.Data[i].branch);
                    numberofanimals.push(parseInt(response.Data[i].animals));
                    numberofcases.push(parseInt(response.Data[i].cases));
                    numberofai.push(parseInt(response.Data[i].AI));
                }
                seriesData.push({ name: 'Animals', data: numberofanimals });
                seriesData.push({ name: 'Cases', data: numberofcases });
                seriesData.push({ name: 'Artificial Insemination', data: numberofai });
            }
        },
        complete: function(response) {
            loadMapData(seriesData);
        }
    });
}
loadanimalData(data.branchid);

const getbranchid = (branch, branchId) => {
    $.ajax({
        url: 'apis/getbranchId.php',
        type: 'POST',
        data: { centretype: branch, branchid: branchId },
        async: false,
        dataType: 'json',
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