<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if(isset($_POST['from']) && isset($_POST['upto']) && isset($_POST['branchId'])){
    $sql = "SELECT mm.medicationId,am.animalName,am.specie,am.breed,aom.firstName,aom.lastName,aom.mobile,aom.address,mm.visitDate FROM medication_master mm INNER JOIN animal_master am ON am.animalId = mm.animalId INNER JOIN animal_owner_master aom ON am.ownerId = aom.ownerId
    WHERE mm.visitDate BETWEEN '$from' AND '$upto' AND mm.branchId = $branchId";
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
          while($academicResults = mysqli_fetch_assoc($jobQuery)){
            $records[] = $academicResults;
          }
         
          $response = array('Message' => "Data Loaded successfull", "Data" => $records, 'Responsecode' => 200);
        } else {
            $response = array('Message' => "No user present/ Invalid username or password", "Data" => $records, 'Responsecode' => 401);
        }
    }else{
    $response = array('Message' => "Parameter Missing", 'Responsecode' => 401);
}
}else{
    $response = array('Message' => "Parameter Missing", 'Responsecode' => 401);
}
mysqli_close($conn);
exit(json_encode($response));
?>