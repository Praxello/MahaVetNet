<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if (isset($_POST['usrname']) && isset($_POST['passwrd'])) {
$sql = "SELECT * FROM  branch_master WHERE username='$usrname' AND password='$passwrd' AND isActive=1";
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            while ($academicResults = mysqli_fetch_assoc($jobQuery)) {
                $branchid=$academicResults['branchId'];
                $sql1 ="SELECT doctorId FROM user_master WHERE branchId=$branchid";
                $jobQuery1 = mysqli_query($conn,$sql1);
                if ($jobQuery1 != null)
                {
                    $academicAffected1 = mysqli_num_rows($jobQuery1);
                    if ($academicAffected1 > 0)
                    {
                        $academicResults1 = mysqli_fetch_assoc($jobQuery1);
                        $records['userId']=$academicResults1['doctorId'];
                        $records['branchId']=$branchid;
                        $response = array('Message' => "Login Successfully", "Data" => $records, 'Responsecode' => 200);
                        break;
                    }
                    else {
                      $response = array('Message' => "No user present/ Invalid username or password", "Data" => $records, 'Responsecode' => 401);
                    }
                }
                else {
                $response = array('Message' => "No user present/ Invalid username or password", "Data" => $records, 'Responsecode' => 401);
                }
            }
        } else {
            $response = array('Message' => "No user present/ Invalid username or password", "Data" => $records, 'Responsecode' => 401);
        }
    }
}else{
    $response = array('Message' => "Parameter Missing", "Data" => $records, 'Responsecode' => 500);
}
mysqli_close($conn);
exit(json_encode($response));
?>
