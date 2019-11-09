var revenue_branchId = null;
revenue_branchId = data.branchid;
var regions = [];
var activeInstitues = [];
var revenueAmt = [];
var vdsmarked = [];
var regionsData = [];
var chart5,chartvar5=0;
const loadAiData = (regionsData) => {
    chart5=Highcharts.chart('totalVds', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Active Institues/Total VD Marked'
        },
        xAxis: {
            categories: regions,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Active Institues/VD'
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
                            loadbranchId(this.category, revenue_branchId);
                        }
                    }
                }
            }
        },
        series: regionsData
    });
}
const loadAi = (param) => {
    regions = [];
    activeInstitues = [];
    vdsmarked = [];
    regionsData = [];
    $.ajax({
        url: url + 'revenue_map.php',
        type: 'POST',
        data: { branchid: param },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                var i, totalAi = 0;
                for (i = 0; i < count; i++) {
                    //for total of active institues
                    totalAi += parseInt(response.Data[i].AInst);
                    regions.push(response.Data[i].branch);
                    activeInstitues.push(parseInt(response.Data[i].AInst));
                    vdsmarked.push(parseInt(response.Data[i].vds));
                }
                regionsData.push({ name: 'Active Institutes', data: activeInstitues });
                regionsData.push({ name: 'Total VD Marked', data: vdsmarked });
                $('#totalAi').html(totalAi);
            }
        },
        complete: function(response) {
          if(chartvar5!=0){
            chart5.hideLoading();
          }
            loadAiData(regionsData);
        }
    });
}
loadAi(data.branchid);

const loadbranchId = (branch, branchId) => {
  chartvar5=1;
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: { centretype: branch, branchid: branchId },
        async: true,
        dataType: 'json',
        beforeSend: function() {
            chart5.showLoading();
            // console.log("ok1");
        },
        success: function(response) {
            if (response.Data != null) {
                revenue_branchId = response.Data;
            }
        },
        complete: function(response) {
            loadAi(revenue_branchId);
        }
    });
}
