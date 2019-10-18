<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if($branchid >= 100001 && $branchid < 200000){
    $sql = "SELECT branch,SUM(Total) AS Total,SUM(downloads) AS Downloads,SUM(remaining) AS remaining FROM(
        SELECT bm.districtName AS branch,COUNT(bm.branchId) Total,0 downloads,0 remaining  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)  AND bm.branchId < 10000 GROUP BY bm.districtName
        UNION
        SELECT bm.districtName AS branch,0 Total,COUNT(bm.branchId) downloads,0 remaining  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId  IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.districtName
        UNION
        SELECT  bm.districtName AS branch,0 Total,0 downloads,COUNT(bm.branchId) remaining FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId NOT IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.districtName) countTable 
        GROUP BY countTable.branch";
}else if($branchid >= 200001 && $branchid < 300000){
    $sql = "SELECT branch,SUM(Total) AS Total,SUM(downloads) AS Downloads,SUM(remaining) AS remaining FROM(
        SELECT bm.blockName AS branch,COUNT(bm.branchId) Total,0 downloads,0 remaining  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)  AND bm.branchId < 10000 GROUP BY bm.blockName
        UNION
        SELECT bm.blockName AS branch,0 Total,COUNT(bm.branchId) downloads,0 remaining  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId  IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.blockName
        UNION
        SELECT  bm.blockName AS branch,0 Total,0 downloads,COUNT(bm.branchId) remaining FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId NOT IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.blockName) countTable 
        GROUP BY countTable.branch";
}else if($branchid >= 300001 && $branchid < 400000){//ddc
    $sql = "SELECT branch,SUM(Total) AS Total,SUM(downloads) AS Downloads,SUM(remaining) AS remaining FROM(
        SELECT bm.branchName AS branch,COUNT(bm.branchId) Total,0 downloads,0 remaining FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId < 10000 GROUP BY bm.branchName 
        UNION
        SELECT bm.branchName AS branch,0 Total,COUNT(bm.branchId) downloads,0 remaining FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.branchName 
        UNION 
        SELECT bm.branchName AS branch,0 Total,0 downloads,COUNT(bm.branchId) remaining FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId NOT IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.branchName) countTable 
        GROUP BY countTable.branch";
}else if($branchid >= 400001 && $branchid < 500000){//daho 
    $sql = "SELECT branch,SUM(Total) AS Total,SUM(downloads) AS Downloads,SUM(remaining) AS remaining FROM(
        SELECT bm.branchName AS branch,COUNT(bm.branchId) Total,0 downloads,0 remaining FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId < 10000 GROUP BY bm.branchName 
        UNION
        SELECT bm.branchName AS branch,0 Total,COUNT(bm.branchId) downloads,0 remaining FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.branchName 
        UNION 
        SELECT bm.branchName AS branch,0 Total,0 downloads,COUNT(bm.branchId) remaining FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId NOT IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.branchName) countTable 
        GROUP BY countTable.branch";
}
else if($branchid >= 500001 && $branchid < 600000){
    $sql = "SELECT branch,SUM(Total) AS Total,SUM(downloads) AS Downloads,SUM(remaining) AS remaining FROM(
        SELECT bm.centre_type AS branch,COUNT(bm.branchId) Total,0 downloads,0 remaining  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)  AND bm.branchId < 10000 GROUP BY bm.centre_type
        UNION
        SELECT bm.centre_type AS branch,0 Total,COUNT(bm.branchId) downloads,0 remaining  FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId  IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.centre_type
        UNION
        SELECT  bm.centre_type AS branch,0 Total,0 downloads,COUNT(bm.branchId) remaining FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId NOT IN(SELECT branchId FROM otp_master) AND bm.branchId < 10000 GROUP BY bm.centre_type) countTable 
        GROUP BY countTable.branch";
}else{
    $sql = "SELECT bm.branchName,COUNT(bm.branchId) AS Total FROM branch_master bm WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) AND bm.branchId < 10000 GROUP BY bm.branchName";
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