<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response1=null;
function getAlldata(){
include "../connection.php";
include 'getcount.php';
$tours = null;
$totalAi = null;
$Aitypefresh=null;
$Aityperepeat1 = null;
$Aityperepeat2 = null;
$calvesborn = null;
$vaccination = null;
$infertility =null;
$Deworming = null;
$cashregister = null;
$Castration = null;
$Operation = null;
$pregDignosis = null;
$inpatients = null;
$outpatients = null;
$daybook = null;
$response=null;
extract($_POST);
if(isset($_POST['branchId']) && isset($_POST['reportType']) && isset($_POST['year']) && isset($_POST['month'])){
    
        $operation = '"AIType":"Fresh';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";

        $jobQuery = mysqli_query($conn,$sql);
        if ($jobQuery != null) {
             $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
         $count = getCountOfYear($month,$year,1,$branchId);
        while($academicResults = mysqli_fetch_assoc($jobQuery))
         {
         $count++;
         $temp = $academicResults;
         $yearly = array('Year'=>$count);
         $total = array_merge($temp, $yearly);
         $Aitypefresh[] = $total;
         }
     } 
 }
   //Aitype repeat 1
        $operation = '"AIType":"Repeat 1';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,2,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $Aityperepeat1[] = $total;
            }
        } 
    }
    //end aitype repeat 1
    // aitype repeat 2
        $operation = '"AIType":"Repeat 2';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";

$jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
    $academicAffected = mysqli_num_rows($jobQuery);
    if ($academicAffected > 0) {
        $count = getCountOfYear($month,$year,3,$branchId);
     while($academicResults = mysqli_fetch_assoc($jobQuery))
        {
        $count++;
        $temp = $academicResults;
        $yearly = array('Year'=>$count);
        $total = array_merge($temp, $yearly);
        $Aityperepeat2[] = $total;
        }
    } 
}
     // end aitype repeat 2 
     //aitype total
        $operation = 'AIType":"[[a-z]|[A-Z]]';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
            $jobQuery = mysqli_query($conn,$sql);
            if ($jobQuery != null) {
                $academicAffected = mysqli_num_rows($jobQuery);
                if ($academicAffected > 0) {
                    $count = getCountOfYear($month,$year,4,$branchId);
                 while($academicResults = mysqli_fetch_assoc($jobQuery))
                    {
                    $count++;
                    $temp = $academicResults;
                    $yearly = array('Year'=>$count);
                    $total = array_merge($temp, $yearly);
                    $totalAi [] = $total;
                    }
                } 
            }
      //end aitype total
     
        //Calves Born
        $operation = 'CalfGender\":\"Male|CalfGender\":\"Female';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,5,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $calvesborn [] = $total;
            }
        } 
    }
        //Vaccination
        $sql = "SELECT vm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed,vm.cow,vm.bull,vm.calf,vm.buffalo,vm.redka,vm.goat,vm.sheep,vm.poultry,vm.batch
        FROM vaccination_master  vm 
            join animal_master am on vm.animalId = am.animalId 
            join animal_owner_master aom on am.ownerId = aom.ownerId 
            where vm.branchId = $branchId
            AND MONTH(vm.visitDate) = $month AND YEAR(vm.visitDate) = $year";
     $jobQuery = mysqli_query($conn,$sql);
     if ($jobQuery != null) {
         $academicAffected = mysqli_num_rows($jobQuery);
         if ($academicAffected > 0) {
             $count = getCountOfYear($month,$year,6,$branchId);
          while($academicResults = mysqli_fetch_assoc($jobQuery))
             {
             $count++;
             $temp = $academicResults;
             $yearly = array('Year'=>$count);
             $total = array_merge($temp, $yearly);
             $vaccination [] = $total;
             }
         } 
     }
     
        //infertility
        $operation = 'Probable Cause\":\"[[a-z]|[A-Z]]';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
     if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,7,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $infertility [] = $total;
            }
        } 
    }
     
        //Deworming
        $sql = "SELECT vm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed,vm.cow,vm.bull,vm.calf,vm.buffalo,vm.redka,vm.goat,vm.sheep,vm.poultry
        FROM deworming_master vm
            join animal_master am on vm.animalid = am.animalId 
            join animal_owner_master aom on am.ownerId = aom.ownerId 
            where vm.branchId = $branchId
            AND MONTH(vm.visitDate) = $month AND YEAR(vm.visitDate) = $year";
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,8,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $Deworming [] = $total;
            }
        } 
    }
    
        //cash register
        $sql = "SELECT fm.visitDate,fm.feesAmount,aom.firstName,aom.lastName,aom.mobile,aom.category,aom.address,fm.typeOfPayment
        FROM fees_master  fm 
            JOIN animal_master am ON fm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where fm.branchId = $branchId
            AND MONTH(fm.visitDate) = $month AND YEAR(fm.visitDate) = $year";
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,9,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $cashregister [] = $total;
            }
        } 
    }
   
        //Castration
        $operation = 'Procedure\":\"Closed|Procedure\":\"Open';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment  
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,10,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $Castration [] = $total;
            }
        } 
    }
     
        //Operation
        $operation = 'surgeryTypes\":\"[[a-z]|[A-Z]]';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples ,mm.treatment 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,11,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $Operation [] = $total;
            }
        } 
    }
    
        //Pregnancy Diagnosis
        $operation = 'NSPD|AIPD';
        $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
            if ($jobQuery != null) {
                $academicAffected = mysqli_num_rows($jobQuery);
                if ($academicAffected > 0) {
                    $count = getCountOfYear($month,$year,12,$branchId);
                 while($academicResults = mysqli_fetch_assoc($jobQuery))
                    {
                    $count++;
                    $temp = $academicResults;
                    $yearly = array('Year'=>$count);
                    $total = array_merge($temp, $yearly);
                    $pregDignosis [] = $total;
                    }
                } 
            }
   
            //inpatients
        $sql = "SELECT ipd.visitDate,aom.firstName,aom.lastName,aom.address,aom.category,am.specie,am.breed,am.dateOfBirth,am.gender,am.weight,ipd.symptoms,ipd.diagnosis,ipd.treatment,ipd.dischargeDate
        FROM ipd_medication_master ipd 
        INNER JOIN animal_master am ON am.animalId = ipd.animalId
        INNER JOIN animal_owner_master aom ON aom.ownerId = am.ownerId
        WHERE ipd.branchId = $branchId
        AND MONTH(ipd.visitDate) = $month AND YEAR(ipd.visitDate) = $year";
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,13,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $inpatients [] = $total;
            }
        } 
    }
    //outpatients
        $sql = "SELECT mm.visitDate , aom.firstName , aom.lastName,aom.address ,aom.category ,am.specie,  am.breed , mm.samples AS Samples,am.gender,am.dateOfBirth,am.weight,mm.symptoms,mm.diagnosis,mm.treatment 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year";
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,14,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $outpatients [] = $total;
            }
        } 
    }
    //day book
    
        $sql = "SELECT mm.visitDate , aom.firstName , aom.lastName,aom.address ,aom.category ,am.specie,  am.breed , mm.samples AS Samples,am.gender,am.dateOfBirth,am.weight,mm.symptoms,mm.diagnosis,mm.treatment
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId 
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year";
             if ($jobQuery != null) {
                $academicAffected = mysqli_num_rows($jobQuery);
                if ($academicAffected > 0) {
                    $count = getCountOfYear($month,$year,15,$branchId);
                 while($academicResults = mysqli_fetch_assoc($jobQuery))
                    {
                    $count++;
                    $temp = $academicResults;
                    $yearly = array('Year'=>$count);
                    $total = array_merge($temp, $yearly);
                    $daybook [] = $total;
                    }
                } 
            }
     //tour book
        $sql = "SELECT mm.visitDate , aom.firstName , aom.lastName,aom.address ,aom.category ,am.specie,  am.breed , mm.samples AS Samples,am.gender,am.dateOfBirth,am.weight,mm.symptoms,mm.diagnosis,mm.treatment
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            where mm.branchId = $branchId AND mm.visitType = 'Tour'
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year";
            $jobQuery = mysqli_query($conn,$sql);
            if ($jobQuery != null) {
                $academicAffected = mysqli_num_rows($jobQuery);
                if ($academicAffected > 0) {
                    $count = getCountOfYear($month,$year,16,$branchId);
                 while($academicResults = mysqli_fetch_assoc($jobQuery))
                    {
                    $count++;
                    $temp = $academicResults;
                    $yearly = array('Year'=>$count);
                    $total = array_merge($temp, $yearly);
                    $tours[] = $total;
                    }
                } 
            }
}
$response = array('Message' => "Data Loaded successfull", "aitypefresh"=>$Aitypefresh,"Aityperepeat1"=>$Aityperepeat1,"Aityperepeat2"=>$Aityperepeat2,"TotalAi" => $totalAi,"Tours" => $tours,"vaccination"=> $vaccination ,"infertility"=> $infertility ,"Deworming"=>$Deworming,"cashregister"=>$cashregister,"Castration"=>$Castration,"Operation"=>$Operation,"inpatients"=>$inpatients,"pregDignosis"=> $pregDignosis,"outpatients"=>$outpatients,"daybook"=>$daybook,'Responsecode' => 200);
return $response;
}
$response1 = getAlldata();
mysqli_close($conn);
exit(json_encode($response1));
?>