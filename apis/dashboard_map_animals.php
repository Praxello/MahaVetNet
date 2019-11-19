<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if($branchid >= 100001 && $branchid < 200000){
    $sql = "SELECT branch,SUM(PD) PD,SUM(AI) AI,SUM(Inf) Inf,SUM(CB) CB FROM(
        SELECT bm.districtName branch,0 PD,count(bm.branchId) AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.districtName
        UNION
        SELECT bm.districtName branch,count(bm.branchId) PD,0 AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'NSPD|AIPD' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.districtName
        UNION
        SELECT bm.districtName branch,0 PD,0 AI,count(bm.branchId) Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'Probable Cause\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.districtName
        UNION
        SELECT bm.districtName branch,0 PD,0 AI,0 Inf, count(bm.branchId) CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'CalfGender\":\"Male|CalfGender\":\"Female' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.districtName) CounTable
        GROUP BY CounTable.branch";
}else if($branchid >= 200001 && $branchid < 300000){
    $sql = "SELECT branch,SUM(PD) PD,SUM(AI) AI,SUM(Inf) Inf,SUM(CB) CB FROM(
        SELECT bm.blockName branch,0 PD,count(bm.branchId) AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.blockName
        UNION
        SELECT bm.blockName branch,count(bm.branchId) PD,0 AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'NSPD|AIPD' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.blockName
        UNION
        SELECT bm.blockName branch,0 PD,0 AI,count(bm.branchId) Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'Probable Cause\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.blockName
        UNION
        SELECT bm.blockName branch,0 PD,0 AI,0 Inf, count(bm.branchId) CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'CalfGender\":\"Male|CalfGender\":\"Female' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.blockName) CounTable
        GROUP BY CounTable.branch";
}else if($branchid >= 300001 && $branchid < 500000){//ddc
    $sql = "SELECT branch,SUM(PD) PD,SUM(AI) AI,SUM(Inf) Inf,SUM(CB) CB FROM(
        SELECT bm.branchName branch,0 PD,count(bm.branchId) AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.branchName
        UNION
        SELECT bm.branchName branch,count(bm.branchId) PD,0 AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'NSPD|AIPD' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.branchName
        UNION
        SELECT bm.branchName branch,0 PD,0 AI,count(bm.branchId) Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'Probable Cause\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.branchName
        UNION
        SELECT bm.branchName branch,0 PD,0 AI,0 Inf, count(bm.branchId) CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'CalfGender\":\"Male|CalfGender\":\"Female' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.branchName) CounTable
        GROUP BY CounTable.branch";
}else if($branchid >= 500001 && $branchid < 600000){//daho 
    $sql = "SELECT branch,SUM(PD) PD,SUM(AI) AI,SUM(Inf) Inf,SUM(CB) CB FROM(
        SELECT bm.centre_type branch,0 PD,count(bm.branchId) AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid
        GROUP BY bm.centre_type
        UNION
        SELECT bm.centre_type branch,count(bm.branchId) PD,0 AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'NSPD|AIPD' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.centre_type
        UNION
        SELECT bm.centre_type branch,0 PD,0 AI,count(bm.branchId) Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'Probable Cause\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid
        GROUP BY bm.centre_type
        UNION
        SELECT bm.centre_type branch,0 PD,0 AI,0 Inf, count(bm.branchId) CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'CalfGender\":\"Male|CalfGender\":\"Female' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.centre_type) CounTable
        GROUP BY CounTable.branch";
}else{
    $sql = "SELECT branch,SUM(PD) PD,SUM(AI) AI,SUM(Inf) Inf,SUM(CB) CB FROM(
        SELECT bm.centre_type branch,0 PD,count(bm.branchId) AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid
        GROUP BY bm.centre_type
        UNION
        SELECT bm.centre_type branch,count(bm.branchId) PD,0 AI,0 Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'NSPD|AIPD' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.centre_type
        UNION
        SELECT bm.centre_type branch,0 PD,0 AI,count(bm.branchId) Inf,0 CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'Probable Cause\":\"[[a-z]|[A-Z]]' AND bm.branchId < 10000
        AND bmm.branchId = $branchid
        GROUP BY bm.centre_type
        UNION
        SELECT bm.centre_type branch,0 PD,0 AI,0 Inf, count(bm.branchId) CB
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'CalfGender\":\"Male|CalfGender\":\"Female' AND bm.branchId < 10000
        AND bmm.branchId = $branchid 
        GROUP BY bm.centre_type) CounTable
        GROUP BY CounTable.branch";
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