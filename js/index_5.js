var animal_branchId = null;
animal_branchId = data.branchid;
var animal_branches = [];
var numberofAnimals = [];
var numberofFarmers = [];
var animalsFarmers = [];

const loadFarmerAnimals = (animalsFarmers) => {
    Highcharts.chart('farmersanimalDiv', {

        chart: {
            type: 'column'
        },
        title: {
            text: 'Animals | Farmers'
        },
        xAxis: {
            categories: animal_branches
        },
        yAxis: {
            min: 0,
            title: {
                text: 'animals/farmers'
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
                        click: function(e) {
                            // alert('Category: ' + this.category + ', value: ' + this.y);
                            e.preventDefault();
                            loadAnimalId(this.category, animal_branchId);
                        }
                    }
                }
            }
        },
        series: animalsFarmers
    });
}
const load_animals_farmers = (param) => {
    animal_branches = [];
    numberofAnimals = [];
    numberofFarmers = [];
    animalsFarmers = [];
    $.ajax({
        url: url + 'dashboard_animals.php',
        type: 'POST',
        data: { branchid: param },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                var count = response.Data.length;
                var i;
                for (i = 0; i < count; i++) {
                    animal_branches.push(response.Data[i].branch);
                    numberofAnimals.push(parseInt(response.Data[i].animalCount));
                    numberofFarmers.push(parseInt(response.Data[i].farmercount));
                }
                animalsFarmers.push({ name: 'Animals', data: numberofAnimals });
                animalsFarmers.push({ name: 'Farmers', data: numberofFarmers });

            }
        },
        complete: function(response) {
            loadFarmerAnimals(animalsFarmers);
        }
    });
}
load_animals_farmers(data.branchid);

const loadAnimalId = (branch, branchId) => {
    $.ajax({
        url: url + 'getbranchId.php',
        type: 'POST',
        data: { centretype: branch, branchid: branchId },
        async: true,
        dataType: 'json',
        success: function(response) {
            if (response.Data != null) {
                animal_branchId = response.Data;
            }
        },
        complete: function(response) {
            load_animals_farmers(animal_branchId);
        }
    });
}