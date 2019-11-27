var re_branchId = null;
re_branchId = data.branchid;
var re_regions = [];
var revenueAmt = [];
var re_regionsData = [];
var chart4, chartvar4 = 0;

var t_level1_data = {};
var t_level2_data = {};
var t_level3_data = {};
var t_level4_data = {};
var t_level = null;
const t_level_data = {};

function t_loadBranchLevel(branchid) {
    t_level_data.centretype = '';
    t_level_data.branchid = branchid;
    if (branchid >= 100001 && branchid < 200000) {
        t_level = 1;
    } else if (branchid >= 200001 && branchid < 300000) {
        t_level = 2;
    } else if (branchid >= 300001 && branchid < 500000) { //ddc
        t_level = 3;
    } else if (branchid >= 500001 && branchid < 600000) { //daho 
        t_level = 4;
    } else {
        t_level = 5;
    }
}
t_loadBranchLevel(data.branchid);
const loadRevenueData = (re_regionsData) => {
    chart4 = Highcharts.chart('totalRevenue', {
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
                            // fetchbranch(this.category, re_branchId);
                            t_level_data.centretype = this.category;
                            t_level_data.branchid = re_branchId;
                            if (t_level == 1) {
                                t_level1_data.centretype = this.category;
                                t_level1_data.branchid = data.branchid;
                                t_level = 2;
                                fetchbranch(t_level_data);
                            } else if (level == 2) {
                                t_level2_data.centretype = t_level1_data.centretype;
                                t_level2_data.branchid = data.branchid;
                                t_level = 3;
                                t_level3_data.centretype = t_level_data.centretype;
                                t_level3_data.branchid = t_level_data.branchid;
                                fetchbranch(t_level_data);
                            } else if (t_level == 3) {
                                t_level = 4;
                                fetchbranch(t_level_data);
                            } else if (t_level == 4) {
                                t_level4_data.centretype = t_level_data.centretype;
                                t_level4_data.branchid = data.branchid;
                                t_level = 5;
                                fetchbranch(t_level_data);
                            } else {
                                t_level4_data.centretype = this.category;
                                t_level4_data.branchid = branchid_g;
                                fetchbranch(t_level_data);
                            }
                        }
                    }
                }
            }
        },
        exporting: {
            buttons: {
                viewData: {
                    x: -90,
                    text: 'Back',
                    onclick: function() {
                        if (t_level == 2) {
                            t_level = 1;
                            re_branchId = data.branchid;
                            loadTotalRevenue(data.branchid);
                        } else if (t_level == 3) {
                            t_level = 2;
                            branchid_g = t_level2_data.branchid;
                            fetchbranch(t_level2_data);
                        } else if (t_level == 4) {
                            t_level = 3;
                            fetchbranch(t_level3_data);
                        } else {
                            t_level = 4;
                            fetchbranch(t_level4_data);
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
            if (chartvar4 != 0) {
                chart4.hideLoading();
            }
            loadRevenueData(re_regionsData);
        }
    });
}
loadTotalRevenue(data.branchid);

const fetchbranch = (load_data) => {
    chartvar4 = 1;
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: load_data,
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