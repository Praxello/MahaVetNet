<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
include "branchmap.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
$temp=null;
$regions = null;
$regions1 = null;
$region = null;
$blocks = null;
extract($_POST);
if($branchid >= 100001 && $branchid < 200000){
    $sql = "SELECT districtName,blockName,branchName,centre_type FROM branch_master bm WHERE bm.branchId < 6000";
}
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            while ($academicResults = mysqli_fetch_assoc($jobQuery)) {
                $regionName = $academicResults['districtName'];
                $blockName = $academicResults['blockName'];
                if(isset($regions["$regionName"])){
                  $blocks = $regions["$regionName"];
                  $blocks[] = $blockName;
                  $regions["$regionName"] =  $blocks;
                 }else{
                    $blocks[] = $blockName;
                    $regions["$regionName"] =  $blocks;
                     
                    
                 }
                
            }
          
            // $records['region'] = $regions;
            // $records['blocks'] = $blocks;
            // $records['blocks2'] = $regions1;
            $records[] = $regions;
           
            $response = array('Message' => "Data Loaded successfull", "Data" => $records, 'Responsecode' => 200);
        } else {
            $response = array('Message' => "No user present/ Invalid username or password", "Data" => $records, 'Responsecode' => 401);
        }
    }else{
    $response = array('Message' => "Parameter Missing", "Data" => $records, 'Responsecode' => 401);
}
mysqli_close($conn);
exit(json_encode($response));
?>

