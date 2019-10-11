var farmers = new Map();
var animals_data = new Map();
var medicines = new Map();
var straw = new Map();
const data = {
    doctorid: 1,
    branchid: 3391
};


const userid = 1,
    branchid = 3391;




$('#loadfirstpage').on('click', function(e) {
    e.preventDefault();
    $('#farmerPage').show();
    $('#loadAnimalPage').hide();
});
const getFirstName = (firstName) => {
    const name = firstName.split(' ');
    return name[0];
}
const getLastName = (firstName) => {
    const name = firstName.split(' ');
    if (name.length > 1) {
        name.shift();
        return name.toString();
    } else {
        return '';
    }
}

// function addmedicine() {
//     $('#loadMedicinePage').show();
//     $('#farmerPage').hide();
//     loadMedicine(url, medicines, data.branchid);
// }

// function addstraw() {
//     $('#loadstrawpage').show();
//     $('#farmerPage').hide();
//     loadstraw(url, straw, data.branchid);
// }