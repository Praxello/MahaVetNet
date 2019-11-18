<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if (isset($_POST['contact'])) {
$sql = "SELECT um.mobile,bm.centre_type,bm.branchId FROM user_master um INNER JOIN branch_master bm ON um.branchId = bm.branchId WHERE um.mobile like '%$contact%'";
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            while ($academicResults = mysqli_fetch_assoc($jobQuery)) {
                $records[] = $academicResults;
            }
            $response = array('Message' => "Data Laoded", "Data" => $records, 'Responsecode' => 200);
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
