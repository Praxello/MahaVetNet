<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if(isset($_POST['branchid'])){
    $sql = "SELECT SUM(castration) castration,SUM(vaccination) vaccination,SUM(operations) operations,SUM(IPD) IPD,SUM(deworming) deworming FROM(
        SELECT count(*) castration,0 vaccination,0 operations,0 IPD,0 deworming
    FROM medication_master mm 
    WHERE treatment REGEXP 'Procedure\":\"Closed|Procedure\":\"Open' 
    AND doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                     INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = $branchid)
        UNION
        SELECT 0 castration,COUNT(*) vaccination,0 operations,0 IPD,0 deworming FROM vaccination_master mm 
    WHERE  doctorid IN (SELECT  um.doctorid  FROM user_master um 
                        JOIN branch_master bm ON bm.branchId = um.branchId 
                        INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = $branchid)
        UNION
        SELECT 0 castration, 0 vaccination,COUNT(*) operations,0 IPD,0 deworming 
    FROM medication_master mm 
    WHERE treatment REGEXP 'surgeryTypes\":\"[[a-z]|[A-Z]]' 
    AND doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                     INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = $branchid)
        UNION
        SELECT 0 castration, 0 vaccination,0 operations,0 IPD,COUNT(*) deworming  FROM deworming_master mm 
    WHERE  doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                        INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = $branchid)
        UNION
        SELECT 0 castration, 0 vaccination,0 operations,COUNT(*) IPD,0 deworming FROM ipd_medication_master mm 
    WHERE doctorid IN (SELECT  um.doctorid  FROM user_master um JOIN branch_master bm ON bm.branchId = um.branchId 
                       INNER JOIN branch_mapper_master bmm ON um.branchId = bmm.childBranch WHERE bmm.branchId = $branchid)
    )counTable";

    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            while ($academicResults = mysqli_fetch_assoc($jobQuery)) {
                $records[] = $academicResults;
            }
            $response = array('Message' => "Data Loaded successfull", "Data" => $records, 'Responsecode' => 200);
        } else {
            $response = array('Message' => "No user present/ Invalid username or password", "Data" => $records, 'Responsecode' => 401);
        }
    }else{
    $response = array('Message' => "Parameter Missing", "Data" => $records, 'Responsecode' => 401);
}
}
else{
    $response = array('Message' => "Parameter Missing", 'Responsecode' => 401);
}
mysqli_close($conn);
exit(json_encode($response));
?>