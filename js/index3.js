const data = {
    branchid: $('#branchid').val()
};

var branchid_g = null;
branchid_g = data.branchid;
var branch = [];
var downloads = [];
var Remaining = [];
var apiData = [];

function loadMap(param) {
    console.log(param);
    branch = [];
    downloads = [];
    Remaining = [];
    apiData = [];
    $.ajax({
        url: 'apis/dashboard_map.php',
        type: 'POST',
        data: { branchid: param },
        async: false,
        dataType: 'json',
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
            loadData(apiData);
        }
    });
}
loadMap(data.branchid);

function fetchName(param, branchid) {
    console.log(param + ' -' + branchid);
    $.ajax({
        url: 'apis/getbranchId.php',
        type: 'POST',
        data: { centretype: param, branchid: branchid },
        async: false,
        dataType: 'json',
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
    Highcharts.chart('chartdiv1', {

        chart: {
            type: 'column'
        },
        title: {
            text: 'Applications Downloads'
        },
        xAxis: {
            categories: branch
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
                            // alert('Category: ' + this.category + ', value: ' + this.y);
                            fetchName(this.category, branchid_g);
                        }
                    }
                }
            }
        },
        series: apiData
    });
}