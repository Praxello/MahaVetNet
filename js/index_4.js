var cat_branchId = null;
cat_branchId = data.branchid;
var total_branches = [];
var numberofCastration = [];
var numberofVaccination = [];
var numberofIPD = [];
var numberofDeworming = [];
var setmapchart = [];
var chart1, chartvar1 = 0;
const loadCatData = (setmapchart) => {
    chart1 = Highcharts.chart('castrationDiv', {

        chart: {
            type: 'column'
        },
        title: {
            text: 'Castration | IPD '
        },
        xAxis: {
            categories: total_branches
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total of C | I '
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
                            fetchmapid(this.category, cat_branchId);
                        }
                    }
                }
            }
        },
        series: setmapchart
    });
}
const loadvaccinations = (param) => {
    total_branches = [];
    numberofCastration = [];
    numberofVaccination = [];
    numberofIPD = [];
    numberofDeworming = [];
    setmapchart = [];
    $.ajax({
        url: url + 'castration_map.php',
        type: 'POST',
        data: { branchid: param },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                var i;
                for (i = 0; i < count; i++) {
                    total_branches.push(response.Data[i].branch);
                    numberofCastration.push(parseInt(response.Data[i].Castration));
                    //numberofVaccination.push(parseInt(response.Data[i].vaccination));
                    numberofIPD.push(parseInt(response.Data[i].IPD));
                    //numberofDeworming.push(parseInt(response.Data[i].deworm));
                }

                setmapchart.push({ name: 'Castration', data: numberofCastration });
                //setmapchart.push({ name: 'Vaccination', data: numberofVaccination });
                setmapchart.push({ name: 'IPD', data: numberofIPD });
                //setmapchart.push({ name: 'Deworming', data: numberofDeworming });
            }
        },
        complete: function(response) {
            if (chartvar1 != 0) {
                chart1.hideLoading();
            }
            loadCatData(setmapchart);
        }
    });
}
loadvaccinations(data.branchid);

const fetchmapid = (branch, branchId) => {
    chartvar1 = 1;
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: { centretype: branch, branchid: branchId },
        async: true,
        dataType: 'json',
        beforeSend: function() {
            chart1.showLoading();
            // console.log("ok1");
        },
        success: function(response) {
            if (response.Data != null) {
                cat_branchId = response.Data;
            }
        },
        complete: function(response) {
            loadvaccinations(cat_branchId);
        }
    });
}