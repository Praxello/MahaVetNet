<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
include 'getcount.php';
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if(isset($_POST['branchId']) && isset($_POST['reportType']) && isset($_POST['year']) && isset($_POST['month']) ){
    if($reportType == 1){
        $operation = '"AIType":"Fresh';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP  '$operation' ";
    }else if($reportType == 2){
        $operation = '"AIType":"Repeat 1';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 3){
        $operation = '"AIType":"Repeat 2';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 4){
        $operation = 'AIType":"[[a-z]|[A-Z]]';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 5){
        //Calves Born
        $operation = 'CalfGender\":\"Male|CalfGender\":\"Female';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    }else if($reportType == 6){
        //Vaccination
        $sql = "SELECT vm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed,vm.cow,vm.bull,vm.calf,vm.buffalo,vm.redka,vm.goat,vm.sheep,vm.poultry,vm.batch
        FROM vaccination_master  vm 
            join animal_master am on vm.animalId = am.animalId 
            join animal_owner_master aom on am.ownerId = aom.ownerId 
            where vm.branchId = $branchId
            AND MONTH(vm.visitDate) = $month AND YEAR(vm.visitDate) = $year";
    }
    else if($reportType == 7){
        //infertility
        $operation = 'Probable Cause\":\"[[a-z]|[A-Z]]';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 8){
        //Deworming
        $sql = "SELECT vm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed,vm.cow,vm.bull,vm.calf,vm.buffalo,vm.redka,vm.goat,vm.sheep,vm.poultry
        FROM deworming_master vm
            join animal_master am on vm.animalid = am.animalId 
            join animal_owner_master aom on am.ownerId = aom.ownerId 
            where vm.branchId = $branchId
            AND MONTH(vm.visitDate) = $month AND YEAR(vm.visitDate) = $year";
    }
    else if($reportType == 9){
        //cash register
        $sql = "SELECT fm.visitDate,fm.feesAmount,aom.firstName,aom.lastName,aom.mobile,aom.category,aom.address,fm.typeOfPayment
        FROM fees_master  fm 
            JOIN animal_master am ON fm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where fm.branchId = $branchId
            AND MONTH(fm.visitDate) = $month AND YEAR(fm.visitDate) = $year";
    }
    else if($reportType == 10){
        //Castration
        $operation = 'Procedure\":\"Closed|Procedure\":\"Open';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 11){
        //Operation
        $operation = 'surgeryTypes\":\"[[a-z]|[A-Z]]';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 12){
        //Pregnancy Diagnosis
        $operation = 'NSPD|AIPD';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 13){
        $sql = "SELECT ipd.visitDate,aom.firstName,aom.lastName,aom.address,aom.category,am.specie,am.breed,am.dateOfBirth,am.gender,am.weight,ipd.symptoms,ipd.diagnosis,ipd.treatment,ipd.dischargeDate
        FROM ipd_medication_master ipd 
        INNER JOIN animal_master am ON am.animalId = ipd.animalId
        INNER JOIN animal_owner_master aom ON aom.ownerId = am.ownerId
        WHERE ipd.branchId = $branchId
        AND MONTH(ipd.visitDate) = $month AND YEAR(ipd.visitDate) = $year";
    }
    else if($reportType == 14){
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year";
    }
    else if($reportType == 16){
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId AND mm.visitType = 'Tour'
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year";
    }
    
    $jobQuery = mysqli_query($conn,$sql);
    // echo $sql;
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,$reportType,$branchId);
            while($academicResults = mysqli_fetch_assoc($jobQuery))
                    {
                        $count++;
                        $temp = $academicResults;
                        $yearly = array('Year'=>$count);
                        $total = array_merge($temp, $yearly);
                        $records[] = $total;
                      
                    }
          $response = array('Message' => "Data Loaded successfull", "Data" => $records, 'Responsecode' => 200);
        } else {
            $response = array('Message' => "Data is not Available", 'Responsecode' => 401);
        }
    }else{
    $response = array('Message' => "Parameter Missing1", 'Responsecode' => 401);
}
}else{
    $response = array('Message' => "Parameter Missing", 'Responsecode' => 401);
}
mysqli_close($conn);
exit(json_encode($response));
?>