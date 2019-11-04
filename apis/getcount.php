<?php
function getCountOfYear($month,$year,$reportType,$branchId){
    include "../connection.php";
    $day = 1;
    $day1 = 31;
    $yearvar = $year;
    $april_month = 4;
    $output = 0;
    if($month < 4){
        $yearvar = $year - 1;
    }
    if($month == 4){
        $to = strftime("%F", strtotime($year."-".($month)."-".$day1));
    }else{
        $to = strftime("%F", strtotime($year."-".($month-1)."-".$day1));
    }
    $from = strftime("%F", strtotime($yearvar."-".$april_month."-".$day));
   
    if($reportType == 1){
        $operation = '"AIType":"Fresh';
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'
            AND mm.treatment REGEXP  '$operation'";
    }else if($reportType == 2){
        $operation = '"AIType":"Repeat 1';
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 3){
        $operation = '"AIType":"Repeat 2';
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 4){
        $operation = 'AIType":"[[a-z]|[A-Z]]';
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 5){
        //Calves Born
        $operation = 'CalfGender\":\"Male|CalfGender\":\"Female';
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'
            AND mm.treatment REGEXP '$operation'";
    }else if($reportType == 6){
        //Vaccination
        $sql = "SELECT count(*) c
        FROM vaccination_master  vm 
            join animal_master am on vm.animalId = am.animalId 
            join animal_owner_master aom on am.ownerId = aom.ownerId 
            where vm.branchId = $branchId
            AND vm.visitDate = BETWEEN '$from' AND '$to'";
    }
    else if($reportType == 7){
        //infertility
        $operation = 'Probable Cause\":\"[[a-z]|[A-Z]]';
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 8){
        //Deworming
        $sql = "SELECT count(*) c
        FROM deworming_master vm
            join animal_master am on vm.animalid = am.animalId 
            join animal_owner_master aom on am.ownerId = aom.ownerId 
            where vm.branchId = $branchId
            AND vm.visitDate BETWEEN '$from' AND '$to'";
    }
    else if($reportType == 9){
        //cash register
        $sql = "SELECT count(*) c
        FROM fees_master  fm 
            JOIN animal_master am ON fm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where fm.branchId = $branchId
            AND fm.visitDate BETWEEN '$from' AND '$to'";
    }
    else if($reportType == 10){
        //Castration
        $operation = 'Procedure\":\"Closed|Procedure\":\"Open';
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 11){
        //Operation
        $operation = 'surgeryTypes\":\"[[a-z]|[A-Z]]';
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 12){
        //Pregnancy Diagnosis
        $operation = 'NSPD|AIPD';
        $sql = "SELECT  count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'
            AND mm.treatment REGEXP '$operation'";
    }
    else if($reportType == 13){
        $sql = "SELECT count(*) c
        FROM ipd_medication_master ipd 
        INNER JOIN animal_master am ON am.animalId = ipd.animalId
        INNER JOIN animal_owner_master aom ON aom.ownerId = am.ownerId
        WHERE ipd.branchId = $branchId
        AND ipd.visitDate BETWEEN '$from' AND '$to'";
    }
    else if($reportType == 14){
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'";
    }
    else if($reportType == 15){
        $sql = "SELECT count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND mm.visitDate BETWEEN '$from' AND '$to'";
    }
    else if($reportType == 16){
        $sql = "SELECT  count(*) c
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId AND mm.visitType = 'Tour'
            AND mm.visitDate BETWEEN '$from' AND '$to'";
    }
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $academicResults = mysqli_fetch_assoc($jobQuery);
            $output=  $academicResults['c'];
            if($output == '0') {
                $output = 0;
            }
        } else {
            $output = 0;
        }
    }else{
        $output = 0;
    }
    return $output;
}
?>