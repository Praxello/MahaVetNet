var ownerid = null;
const loadAnimals = param => {
    ownerid = param;
    $('#doctorid').val(param);
    param = param.toString();
    $('#farmerPage').hide();
    $('#loadAnimalPage').show();
    if (farmers.has(param)) {
        const animalOwner = farmers.get(param);
        const animals = animalOwner.Animals;
        if (animals != null) {
            animals_data.clear();
            var count = animals.length;
            for (var i = 0; i < count; i++) {
                animals_data.set(animals[i].animalId, animals[i]);
            }
            animal_list(animals_data);
        } else {
            animals_data.clear();
            animal_list(animals_data);
        }
    }
}

const animal_list = (animals_data) => {
    $('.animal-table').dataTable().fnDestroy();
    $('.animal-data').empty();
    var responseData = '';
    for (let k of animals_data.keys()) {
        let animalData = animals_data.get(k);
        ownerid = animalData.ownerId;
        responseData += "<tr>";
        responseData += "<td>" + animalData.animalName + "</td>";
        responseData += "<td>" + animalData.breed + "</td>";
        responseData += "<td>" + animalData.gender + "</td>";
        responseData += "<td><address>" + animalData.specie + "</address></td>";
        responseData += "<td><code>" + animalData.weight + "</code></td>";
        responseData += "<td><div class='btn-group' role='group' aria-label='Basic example'>";
        responseData += '<button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit_animal(' + k + ')"><i class="fa fa-edit"></i>';
        // responseData += '</button><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>';
        responseData += "</div></td></tr>";
    }
    $('.animal-data').html(responseData);
    $('.animal-table').dataTable({
        searching: true,
        retrieve: true,
        bPaginate: $('tbody tr').length > 10,
        order: [],
        columnDefs: [{ orderable: false, targets: [0, 1, 2, 3, 4, 5] }],
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf'],
        destroy: true
    });
}

const edit_animal = param => {
    param = param.toString();
    if (animals_data.has(param)) {
        const animal = animals_data.get(param);
        $('#animalId').val(param);
        $('#ownerid').val(animal.ownerId);
        $('#edit_animalname').val(animal.animalName);
        $('#edit_species').val(animal.specie);
        $('#edit_breed').val(animal.breed);
        $('#edit_weight').val(animal.weight);
        // $('#edit_age').val(animal.animalName);
        $('#edit_birthdate').val(animal.dateOfBirth);
        $('#edit_remarks').val(animal.remarks);
        if (animal.gender == 'Male') {
            $("#a_male").prop('checked', true);
        } else if (animal.gender == 'Female') {
            $("#a_female").prop('checked', true);
        }
        $('#edit_animalModal').modal();
    }
}

$('#addnewanimal').on('submit', function(e) {
    e.preventDefault();
    var year = $('#year').val();
    if (year == '') {
        year = '';
    }
    var animalData = {
        gender: $("input[name='animal_optradio']:checked").val(),
        ownerid: ownerid,
        animalname: $('#animalname').val(),
        specie: $('#species').val(),
        breed: $('#breed').val(),
        weight: $('#weight').val(),
        age: $('#age').val(),
        year: year,
        remarks: $('#remarks').val(),
        birthdate: $('#birthdate').val()
    };
    $.ajax({
        url: url + 'addanimal.php',
        type: 'POST',
        data: animalData,
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Responsecode == 200) {
                if (response.NewAnimal != null) {
                    animals_data.set(response.NewAnimal.animalId, response.NewAnimal);
                }
                $('#addnewanimal')[0].reset();
                $('#animalModal').modal('toggle');
                animal_list(animals_data);
            }
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
});

$('#edit_animal').on('submit', function(e) {
    e.preventDefault();
    var year = $('#edit_year').val();
    if (year == '') {
        year = '';
    }
    var animalData = {
        animalid: $('#animalId').val(),
        gender: $("input[name='eanimal_optradio']:checked").val(),
        ownerid: $('#ownerid').val(),
        animalname: $('#edit_animalname').val(),
        specie: $('#edit_species').val(),
        breed: $('#edit_breed').val(),
        weight: $('#edit_weight').val(),
        age: $('#edit_age').val(),
        year: year,
        remarks: $('#edit_remarks').val(),
        birthdate: $('#edit_birthdate').val(),
        isbreedable: 0,
        milk: 0
    };
    var animalData_set = {
        animalid: $('#animalId').val(),
        gender: $("input[name='eanimal_optradio']:checked").val(),
        ownerid: $('#ownerid').val(),
        animalName: $('#edit_animalname').val(),
        specie: $('#edit_species').val(),
        breed: $('#edit_breed').val(),
        weight: $('#edit_weight').val(),
        age: $('#edit_age').val(),
        year: year,
        remarks: $('#edit_remarks').val(),
        birthdate: $('#edit_birthdate').val(),
        isbreedable: 0,
        milk: 0
    };
    $.ajax({
        url: url + 'updateanimal.php',
        type: 'POST',
        data: animalData,
        dataType: 'json',
        beforeSend: function() {
            $("#wait").css("display", "block");
        },
        success: function(response) {
            if (response.Responsecode == 200) {
                animals_data.set(animalData_set.animalid.toString(), animalData_set);
                $('#edit_animal')[0].reset();
                $('#edit_animalModal').modal('toggle');
                animal_list(animals_data);
            }
        },
        complete: function(data) {
            $("#wait").css("display", "none");
        }
    });
});