var de_branchId = null;
de_branchId = data.branchid;
var de_total_branches = [];
var de_numberofVaccination = [];
var de_numberofDeworming = [];
var de_setmapchart = [];
var chart7, chartvar7 = 0;
const loadDewormData = (de_setmapchart) => {
    chart7 = Highcharts.chart('dewormingmap', {

        chart: {
            type: 'column'
        },
        title: {
            text: 'Vaccination | Deworming'
        },
        xAxis: {
            categories: de_total_branches
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total of V | D'
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
                            fetchmapid_1(this.category, de_branchId);
                        }
                    }
                }
            }
        },
        series: de_setmapchart
    });
}
const loadvaccinations_1 = (param) => {
    de_total_branches = [];
    de_numberofVaccination = [];
    de_numberofDeworming = [];
    de_setmapchart = [];
    $.ajax({
        url: url + 'fetch_deworm_vaccination.php',
        type: 'POST',
        data: { branchid: param },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                var i;
                for (i = 0; i < count; i++) {
                    de_total_branches.push(response.Data[i].branch);
                    de_numberofVaccination.push(parseInt(response.Data[i].vaccination));
                    de_numberofDeworming.push(parseInt(response.Data[i].deworm));
                }
                de_setmapchart.push({ name: 'Vaccination', data: de_numberofVaccination });
                de_setmapchart.push({ name: 'Deworming', data: de_numberofDeworming });
            }
        },
        complete: function(response) {
            if (chartvar7 != 0) {
                chart7.hideLoading();
            }
            loadDewormData(de_setmapchart);
        }
    });
}
loadvaccinations_1(data.branchid);

const fetchmapid_1 = (branch, branchId) => {
    chartvar7 = 1;
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: { centretype: branch, branchid: branchId },
        async: true,
        dataType: 'json',
        beforeSend: function() {
            chart7.showLoading();
        },
        success: function(response) {
            if (response.Data != null) {
                de_branchId = response.Data;
            }
        },
        complete: function(response) {
            loadvaccinations_1(de_branchId);
        }
    });
}