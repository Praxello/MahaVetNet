const data = {
    branchid: $('#branchid').val()
};

var branchid_g = null;
branchid_g = data.branchid;
var branch = [];
var downloads = [];
var Remaining = [];
var apiData = [];
var chart, chartvar = 0;
var back_button = data.branchid;
var level1_data = {};
var level2_data = {};
var level3_data = {};
var level4_data = {};
var level = null;
const level_data = {};

function loadBranchLevel(branchid) {
    level_data.centretype = '';
    level_data.branchid = branchid;
    if (branchid >= 100001 && branchid < 200000) {
        level = 1;
    } else if (branchid >= 200001 && branchid < 300000) {
        level = 2;
    } else if (branchid >= 300001 && branchid < 500000) { //ddc
        level = 3;
    } else if (branchid >= 500001 && branchid < 600000) { //daho 
        level = 4;
    } else {
        level = 5;
    }
}
loadBranchLevel(data.branchid);

function loadMap(param) {
    branch = [];
    downloads = [];
    Remaining = [];
    apiData = [];
    $.ajax({
        url: url + 'dashboard_map.php',
        type: 'POST',
        data: { branchid: param },
        async: true,
        dataType: 'json',
        beforeSend: function() {},
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                var i;
                for (i = 0; i < count; i++) {
                    branch.push(response.Data[i].branch);
                    downloads.push(parseInt(response.Data[i].Downloads));
                    Remaining.push(parseInt(response.Data[i].remaining));
                }
                apiData.push({ name: 'App Downloads', data: downloads });
                apiData.push({ name: 'Not Downloads', data: Remaining });
            }
        },
        complete: function(response) {
            if (chartvar != 0) {
                chart.hideLoading();
            }
            loadData(apiData);
        }
    });
}
loadMap(data.branchid);

function fetchName(level_data) {
    chartvar = 1;
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: level_data,
        async: true,
        dataType: 'json',
        beforeSend: function() {
            chart.showLoading();
        },
        success: function(response) {
            if (response.Data != null) {
                branchid_g = response.Data;
            }
        },
        complete: function(response) {
            loadMap(branchid_g);
        }
    });
}

function loadData(apiData) {
    chart = Highcharts.chart('chartdiv1', {

        chart: {
            type: 'column'
        },
        title: {
            text: 'Applications Downloads'
        },
        xAxis: {
            categories: branch
        },
        loading: {
            hideDuration: 1000,
            showDuration: 1000
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Applications Downloads'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function() {
                            back_btn_val = this.category;
                            level_data.centretype = this.category;
                            level_data.branchid = branchid_g;
                            if (level == 1) {
                                level1_data.centretype = this.category;
                                level1_data.branchid = data.branchid;
                                level = 2;
                                fetchName(level_data);
                            } else if (level == 2) {
                                level2_data.centretype = level1_data.centretype;
                                level2_data.branchid = data.branchid;
                                level = 3;
                                level3_data.centretype = level_data.centretype;
                                level3_data.branchid = level_data.branchid;
                                fetchName(level_data);
                            } else if (level == 3) {
                                level = 4;
                                fetchName(level_data);
                            } else if (level == 4) {
                                level4_data.centretype = level_data.centretype;
                                level4_data.branchid = data.branchid;
                                level = 5;
                                fetchName(level_data);
                            } else {
                                level4_data.centretype = this.category;
                                level4_data.branchid = branchid_g;
                                fetchName(level_data);
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
                        if (level == 2) {
                            level = 1;
                            branchid_g = data.branchid;
                            loadMap(data.branchid);
                        } else if (level == 3) {
                            level = 2;
                            branchid_g = level2_data.branchid;
                            fetchName(level2_data);
                        } else if (level == 4) {
                            level = 3;
                            fetchName(level3_data);
                        } else {
                            level = 4;
                            fetchName(level4_data);
                        }
                    }
                }
            }
        },
        series: apiData
    });
}