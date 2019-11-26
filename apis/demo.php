<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
$temp=null;
$branch = null;
$temp_1=null;
$temp_2=null;
$dispencery=null;
$regions = null;
$blocks = null;
extract($_POST);
    $sql = "SELECT districtName FROM branch_master bm WHERE bm.branchId < 6000 GROUP BY districtName";
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            while ($academicResults = mysqli_fetch_assoc($jobQuery)) {
                $regions[] = $academicResults['districtName'];
                $districtName = $academicResults['districtName'];
                $sql_1 = "SELECT blockName FROM branch_master bm WHERE bm.branchId < 6000 AND districtName =  '$districtName' GROUP BY blockName";
                $jobQuery_1 = mysqli_query($conn,$sql_1);
                $blocks = null;
                if ($jobQuery_1 != null) {
                    $academicAffected_1 = mysqli_num_rows($jobQuery_1);
                    if ($academicAffected_1 > 0) {
                        while ($academicResults_1 = mysqli_fetch_assoc($jobQuery_1)) {
                            $blocks[] = $academicResults_1['blockName']; 
                            $blockName = $academicResults_1['blockName'];
                    $sql_2 = "SELECT branchName,blockName FROM branch_master bm WHERE bm.branchId < 6000 AND blockName =  '$blockName' GROUP BY branchName";
                    $jobQuery_2 = mysqli_query($conn,$sql_2);
                    $branch = null;
                if ($jobQuery_2 != null) {
                    $academicAffected_2 = mysqli_num_rows($jobQuery_2);
                    if ($academicAffected_2 > 0) {
                        while ($academicResults_2 = mysqli_fetch_assoc($jobQuery_2)) {
                            $branch[] = $academicResults_2; 
                            $branchName = $academicResults_2['branchName'];
                            //dispencery
                    $sql_3 = "SELECT centre_type,branchId FROM branch_master bm WHERE bm.branchId < 6000 AND branchName = '$branchName' GROUP BY centre_type";
                    $jobQuery_3 = mysqli_query($conn,$sql_3);
                    $dispencery = null;
                if ($jobQuery_3 != null) {
                    $academicAffected_3 = mysqli_num_rows($jobQuery_3);
                    if ($academicAffected_3 > 0) {
                        while ($academicResults_3 = mysqli_fetch_assoc($jobQuery_3)) {
                            $dispencery[] = $academicResults_3; 
                        }
                    $temp_2[] = array($branchName => $dispencery);
                    }
                }
                //end dispencery
                        }
                    $temp_1[] = array($blockName => $branch);
                    }
                }
                }
                    $temp[] = array($districtName => $blocks);
                    }
                }
            }
            $response = array('Message' => "Data Loaded successfull", "Regions"=>$regions,'Blocks'=>$temp,'Taluka'=>$temp_1, 'Dispencery'=>$temp_2,'Responsecode' => 200);
        } else {
            $response = array('Message' => "No user present/ Invalid username or password", "Data" => $records, 'Responsecode' => 401);
        }
    }else{
    $response = array('Message' => "Parameter Missing", "Data" => $records, 'Responsecode' => 401);
}
mysqli_close($conn);
exit(json_encode($response));
?>

