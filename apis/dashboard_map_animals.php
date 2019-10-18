<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if($branchid >= 100001 && $branchid < 200000){
    $sql = "SELECT  branch,SUM(animals) animals,SUM(cases) cases,SUM(AI) AI FROM( 
        SELECT bm.districtName branch,COUNT(am.animalId) animals,0 cases,0 AI 
        FROM branch_master bm INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId 
        INNER JOIN animal_master am ON am.ownerId = aom.ownerId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid 
        GROUP BY bm.districtName 
        UNION 
        SELECT bm.districtName branch,0 animals,COUNT(bm.branchId) cases,0 AI 
        FROM branch_master bm 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE bmm.branchId = $branchid GROUP BY bm.districtName
        UNION
        SELECT bm.districtName branch,0 animals,0 cases,count(bm.branchId) AI
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
        AND bmm.branchId = $branchid 
        GROUP BY bm.districtName) counTable 
        GROUP BY counTable.branch";
}else if($branchid >= 200001 && $branchid < 300000){
    $sql = "SELECT  branch,SUM(animals) animals,SUM(cases) cases,SUM(AI) AI FROM( 
        SELECT bm.blockName branch,COUNT(am.animalId) animals,0 cases,0 AI 
        FROM branch_master bm INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId 
        INNER JOIN animal_master am ON am.ownerId = aom.ownerId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid 
        GROUP BY bm.blockName 
        UNION 
        SELECT bm.blockName branch,0 animals,COUNT(bm.branchId) cases,0 AI 
        FROM branch_master bm 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE bmm.branchId = $branchid GROUP BY bm.blockName
        UNION
        SELECT bm.blockName branch,0 animals,0 cases,count(bm.branchId) AI
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
        AND bmm.branchId = $branchid 
        GROUP BY bm.blockName) counTable 
        GROUP BY counTable.branch";
}else if($branchid >= 300001 && $branchid < 400000){//ddc
    $sql = "SELECT  branch,SUM(animals) animals,SUM(cases) cases,SUM(AI) AI FROM( 
        SELECT bm.branchName branch,COUNT(am.animalId) animals,0 cases,0 AI 
        FROM branch_master bm INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId 
        INNER JOIN animal_master am ON am.ownerId = aom.ownerId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid 
        GROUP BY bm.branchName 
        UNION 
        SELECT bm.branchName branch,0 animals,COUNT(bm.branchId) cases,0 AI 
        FROM branch_master bm 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE bmm.branchId = $branchid GROUP BY bm.branchName
        UNION
        SELECT bm.branchName branch,0 animals,0 cases,count(bm.branchId) AI
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
        AND bmm.branchId = $branchid 
        GROUP BY bm.branchName) counTable 
        GROUP BY counTable.branch";
}else if($branchid >= 400001 && $branchid < 500000){//daho 
    $sql = "SELECT  branch,SUM(animals) animals,SUM(cases) cases,SUM(AI) AI FROM( 
        SELECT bm.centre_type branch,COUNT(am.animalId) animals,0 cases,0 AI 
        FROM branch_master bm INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId 
        INNER JOIN animal_master am ON am.ownerId = aom.ownerId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid 
        GROUP BY bm.centre_type 
        UNION 
        SELECT bm.centre_type branch,0 animals,COUNT(bm.branchId) cases,0 AI 
        FROM branch_master bm 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE bmm.branchId = $branchid 
        GROUP BY bm.centre_type
        UNION
        SELECT bm.centre_type branch,0 animals,0 cases,count(bm.branchId) AI
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
        AND bmm.branchId = $branchid 
        GROUP BY bm.centre_type) counTable 
        GROUP BY counTable.branch";
}else{
    $sql = "SELECT  branch,SUM(animals) animals,SUM(cases) cases,SUM(AI) AI FROM( 
        SELECT bm.centre_type branch,COUNT(am.animalId) animals,0 cases,0 AI 
        FROM branch_master bm INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId 
        INNER JOIN animal_master am ON am.ownerId = aom.ownerId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid 
        GROUP BY bm.centre_type 
        UNION 
        SELECT bm.centre_type branch,0 animals,COUNT(bm.branchId) cases,0 AI 
        FROM branch_master bm 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE bmm.branchId = $branchid
         GROUP BY bm.centre_type
        UNION
        SELECT bm.centre_type branch,0 animals,0 cases,count(bm.branchId) AI
        FROM branch_master bm 
        INNER JOIN user_master um ON um.branchId = bm.branchId 
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId 
        INNER JOIN medication_master mm ON mm.doctorId = um.doctorId 
        WHERE mm.treatment REGEXP 'AIType\":\"[[a-z]|[A-Z]]' 
        AND bmm.branchId = $branchid 
        GROUP BY bm.centre_type) counTable 
        GROUP BY counTable.branch";
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