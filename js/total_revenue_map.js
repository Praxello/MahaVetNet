var re_branchId = null;
re_branchId = data.branchid;
var re_regions = [];
var revenueAmt = [];
var re_regionsData = [];
var chart4,chartvar4=0;
const loadRevenueData = (re_regionsData) => {
      chart4=Highcharts.chart('totalRevenue', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Total Revenue'
        },
        xAxis: {
            categories: re_regions,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Revenue (Rs)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Rs</b></td></tr>',
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
                            fetchbranch(this.category, re_branchId);
                        }
                    }
                }
            }
        },
        series: re_regionsData
    });
}
const loadTotalRevenue = (param) => {
    re_regions = [];
    revenueAmt = [];
    re_regionsData = [];
    $.ajax({
        url: url + 'revenue_map.php',
        type: 'POST',
        data: { branchid: param },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                for (var i = 0; i < count; i++) {
                    re_regions.push(response.Data[i].branch);
                    revenueAmt.push(parseFloat(response.Data[i].FAmt));
                }
                re_regionsData.push({ name: 'Total Revenue', data: revenueAmt });
            }
        },
        complete: function(response) {
          if(chartvar4!=0){
            chart4.hideLoading();
          }
            loadRevenueData(re_regionsData);
        }
    });
}
loadTotalRevenue(data.branchid);

const fetchbranch = (branch, branchId) => {
   chartvar4=1;
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: { centretype: branch, branchid: branchId },
        async: true,
        dataType: 'json',
        beforeSend: function() {
            chart4.showLoading();
            // console.log("ok1");
        },
        success: function(response) {
            if (response.Data != null) {
                re_branchId = response.Data;
            }
        },
        complete: function(response) {
            loadTotalRevenue(re_branchId);
        }
    });
}
