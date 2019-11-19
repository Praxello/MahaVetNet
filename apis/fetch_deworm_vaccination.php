<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if($branchid >= 100001 && $branchid < 200000){
    $sql = "SELECT branch,SUM(vaccination) vaccination,SUM(deworm) deworm FROM(
        SELECT bm.districtName branch,SUM(mm.cow + mm.bull + mm.buffalo + mm.redka + mm.calf + mm.goat + mm.sheep + mm.poultry) vaccination,0 deworm
        FROM vaccination_master mm 
         INNER JOIN branch_master bm ON bm.branchId = mm.branchId
         INNER JOIN branch_mapper_master bmm ON bm.branchId = bmm.childBranch WHERE bmm.branchId = $branchid AND bm.branchId < 10000
         GROUP BY bm.districtName
         UNION
         SELECT bm.districtName branch,0 vaccination,SUM(dwm.cow + dwm.bull + dwm.buffalo + dwm.redka + dwm.calf + dwm.goat + dwm.sheep + dwm.poultry) deworm 
        FROM deworming_master dwm
        INNER JOIN branch_master bm ON bm.branchId = dwm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid
        AND bm.branchId < 10000
        GROUP BY bm.districtName)CounTable GROUP BY CounTable.branch";
}else if($branchid >= 200001 && $branchid < 300000){
    $sql = "SELECT branch,SUM(vaccination) vaccination,SUM(deworm) deworm FROM(
        SELECT bm.blockName branch,SUM(mm.cow + mm.bull + mm.buffalo + mm.redka + mm.calf + mm.goat + mm.sheep + mm.poultry) vaccination,0 deworm
        FROM vaccination_master mm 
         INNER JOIN branch_master bm ON bm.branchId = mm.branchId
         INNER JOIN branch_mapper_master bmm ON bm.branchId = bmm.childBranch WHERE bmm.branchId = $branchid AND bm.branchId < 10000
         GROUP BY bm.blockName
         UNION
         SELECT bm.blockName branch,0 vaccination,SUM(dwm.cow + dwm.bull + dwm.buffalo + dwm.redka + dwm.calf + dwm.goat + dwm.sheep + dwm.poultry) deworm 
        FROM deworming_master dwm
        INNER JOIN branch_master bm ON bm.branchId = dwm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid
        AND bm.branchId < 10000
        GROUP BY bm.blockName)CounTable GROUP BY CounTable.branch";
}else if($branchid >= 300001 && $branchid < 500000){//ddc
    $sql = "SELECT branch,SUM(vaccination) vaccination,SUM(deworm) deworm FROM(
        SELECT bm.branchName branch,SUM(mm.cow + mm.bull + mm.buffalo + mm.redka + mm.calf + mm.goat + mm.sheep + mm.poultry) vaccination,0 deworm
        FROM vaccination_master mm 
         INNER JOIN branch_master bm ON bm.branchId = mm.branchId
         INNER JOIN branch_mapper_master bmm ON bm.branchId = bmm.childBranch WHERE bmm.branchId = $branchid AND bm.branchId < 10000
         GROUP BY bm.branchName
         UNION
         SELECT bm.branchName branch,0 vaccination,SUM(dwm.cow + dwm.bull + dwm.buffalo + dwm.redka + dwm.calf + dwm.goat + dwm.sheep + dwm.poultry) deworm 
        FROM deworming_master dwm
        INNER JOIN branch_master bm ON bm.branchId = dwm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid
        AND bm.branchId < 10000
        GROUP BY bm.branchName)CounTable GROUP BY CounTable.branch";
}else if($branchid >= 500001 && $branchid < 600000){//daho 
    $sql = "SELECT branch,SUM(vaccination) vaccination,SUM(deworm) deworm FROM(
        SELECT bm.centre_type branch,SUM(mm.cow + mm.bull + mm.buffalo + mm.redka + mm.calf + mm.goat + mm.sheep + mm.poultry) vaccination,0 deworm
        FROM vaccination_master mm 
         INNER JOIN branch_master bm ON bm.branchId = mm.branchId
         INNER JOIN branch_mapper_master bmm ON bm.branchId = bmm.childBranch WHERE bmm.branchId = $branchid AND bm.branchId < 10000
         GROUP BY bm.centre_type
         UNION
         SELECT bm.centre_type branch,0 vaccination,SUM(dwm.cow + dwm.bull + dwm.buffalo + dwm.redka + dwm.calf + dwm.goat + dwm.sheep + dwm.poultry) deworm 
        FROM deworming_master dwm
        INNER JOIN branch_master bm ON bm.branchId = dwm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid
        AND bm.branchId < 10000
        GROUP BY bm.centre_type)CounTable GROUP BY CounTable.branch";
}else{
    $sql = "SELECT branch,SUM(vaccination) vaccination,SUM(deworm) deworm FROM(
        SELECT bm.centre_type branch,SUM(mm.cow + mm.bull + mm.buffalo + mm.redka + mm.calf + mm.goat + mm.sheep + mm.poultry) vaccination,0 deworm
        FROM vaccination_master mm 
         INNER JOIN branch_master bm ON bm.branchId = mm.branchId
         INNER JOIN branch_mapper_master bmm ON bm.branchId = bmm.childBranch WHERE bmm.branchId = $branchid AND bm.branchId < 10000
         GROUP BY bm.centre_type
         UNION
         SELECT bm.centre_type branch,0 vaccination,SUM(dwm.cow + dwm.bull + dwm.buffalo + dwm.redka + dwm.calf + dwm.goat + dwm.sheep + dwm.poultry) deworm 
        FROM deworming_master dwm
        INNER JOIN branch_master bm ON bm.branchId = dwm.branchId
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid
        AND bm.branchId < 10000
        GROUP BY bm.centre_type)CounTable GROUP BY CounTable.branch";
}
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
mysqli_close($conn);
exit(json_encode($response));
?>