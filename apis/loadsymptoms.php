<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
$symptomsDict = null;
extract($_POST);
if(isset($_POST['branchId'])) {
$sql = "SELECT bm.districtName,mm.symptoms FROM branch_master bm 
INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
INNER JOIN medication_master mm ON mm.branchId = bm.branchId
WHERE bmm.branchId = $branchId AND LENGTH(mm.symptoms) > 2
AND bm.branchId < 10000";
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            while ($academicResults = mysqli_fetch_assoc($jobQuery)) {
               $completeSymptoms = $academicResults['symptoms'];
               $symptomArr = explode(",", $completeSymptoms);
               if(count($symptomArr)>0){
                for($i=0;$i<count($symptomArr);$i++){
                    $singleSymptom =  strtoupper($symptomArr[$i]);
                    if(strlen($singleSymptom)>2){
                        if(isset($symptomsDict["$singleSymptom"])){
                           $count = $symptomsDict["$singleSymptom"];
                           $count = $count+1;
                          $symptomsDict["$singleSymptom"] = $count ;
                        }else{
                            $symptomsDict["$singleSymptom"] = 1;
                        }
                    }
                } 
               
               }
            }
            arsort($symptomsDict);
            $response = array('Message' => "loaded data", "Data" => $symptomsDict, 'Responsecode' => 500);
        } else {
            $response = array('Message' => "No user present/ Invalid username or password", "Data" => $symptomsDict, 'Responsecode' => 401);
        }
    }
}else{
    $response = array('Message' => "Parameter Missing", "Data" => $symptomsDict, 'Responsecode' => 500);
}
mysqli_close($conn);
exit(json_encode($response));
?>
