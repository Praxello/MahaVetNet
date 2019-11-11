var sym_branchId = null;
sym_branchId = data.branchid;
var chart8, chartvar8 = 0;
var symptom_setmapchart = [];
var symptoms_arr = [];
const loadsymptoms = (symptom_setmapchart) => {
    chart8 = Highcharts.chart('symptomschart', {
        chart: {
            type: 'packedbubble',
            height: '30%'
        },
        title: {
            text: 'Symptoms'
        },
        tooltip: {
            // headerFormat: '<b>{point.name}</b><br/>',
            useHTML: true,
            pointFormat: '<b>{point.name}:{point.y}</b> {point.value}'
        },
        plotOptions: {
            packedbubble: {
                minSize: '40%',
                maxSize: '120%',
                zMin: 0,
                zMax: 1000,
                layoutAlgorithm: {
                    splitSeries: false,
                    gravitationalConstant: 0.02
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}',
                    filter: {
                        property: 'y',
                        operator: '>',
                        value: 250
                    },
                    style: {
                        color: 'black',
                        textOutline: 'none',
                        fontWeight: 'normal'
                    }
                }
            }
        },
        series: symptoms_arr
    });

}
const symptoms = (param) => {
    symptom_setmapchart = [];
    symptoms_arr = [];
    $.ajax({
        url: url + 'loadsymptoms.php',
        type: 'POST',
        data: { branchId: param },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                var k = 1;
                for (var i in response.Data) {
                    k++;
                    if (k < 20) {
                        symptom_setmapchart.push({ name: i, value: parseInt(response.Data[i]) });
                        symptoms_arr.push({ name: i, data: symptom_setmapchart });
                        symptom_setmapchart = [];
                    }
                }
            }
        },
        complete: function(response) {
            if (chartvar8 != 0) {
                chart8.hideLoading();
            }
            loadsymptoms(symptoms_arr);
        }
    });
}
symptoms(data.branchid);
// loadsymptoms();