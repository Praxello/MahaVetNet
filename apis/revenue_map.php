<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);
if(isset($_POST['branchid'])){
if($branchid >= 100001 && $branchid < 200000){
    $sql = "SELECT branch,SUM(AInst) AInst,SUM(FAmt) FAmt,SUM(vds) vds FROM(
        SELECT bm.districtName branch, COUNT(DISTINCT(mm.doctorId)) AInst,0 FAmt,0 vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        INNER JOIN medication_master mm ON mm.branchId = bmm.childBranch
        WHERE bmm.branchId = $branchid AND mm.visitDate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY) 
        AND bm.branchId < 10000
        GROUP BY bm.districtName
            UNION
        SELECT bm.districtName branch,0 AInst,SUM(fm.feesAmount) FAmt,0 vds
        FROM branch_master bm INNER JOIN fees_master fm ON fm.branchId = bm.branchId
        WHERE bm.branchId
        IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)
        AND bm.branchId < 10000
        GROUP BY bm.districtName
            UNION
            SELECT bm.districtName branch,0 AInst,0 FAmt,COUNT(bm.branchId) vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid AND bm.branchId < 10000
        AND bm.isActive = 1 AND bm.latitude != 0
        AND bm.longitude !=0 GROUP BY bm.districtName
        ) CounTable GROUP BY CounTable.branch";
}else if($branchid >= 200001 && $branchid < 300000){
    $sql = "SELECT branch,SUM(AInst) AInst,SUM(FAmt) FAmt,SUM(vds) vds FROM(
        SELECT bm.blockName branch, COUNT(DISTINCT(mm.doctorId)) AInst,0 FAmt,0 vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        INNER JOIN medication_master mm ON mm.branchId = bmm.childBranch
        WHERE bmm.branchId = $branchid AND mm.visitDate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
        AND bm.branchId < 10000
        GROUP BY bm.blockName
            UNION
        SELECT bm.blockName branch,0 AInst,SUM(fm.feesAmount) FAmt,0 vds
        FROM branch_master bm INNER JOIN fees_master fm ON fm.branchId = bm.branchId
        WHERE bm.branchId
        IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)
        AND bm.branchId < 10000
        GROUP BY bm.blockName
            UNION
            SELECT bm.blockName branch,0 AInst,0 FAmt,COUNT(bm.branchId) vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid AND bm.branchId < 10000
        AND bm.isActive = 1 AND bm.latitude != 0
        AND bm.longitude !=0 GROUP BY bm.blockName
        ) CounTable GROUP BY CounTable.branch";
}else if($branchid >= 300001 && $branchid < 400000){//ddc
    $sql = "SELECT branch,SUM(AInst) AInst,SUM(FAmt) FAmt,SUM(vds) vds FROM(
        SELECT bm.branchName branch, COUNT(DISTINCT(mm.doctorId)) AInst,0 FAmt,0 vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        INNER JOIN medication_master mm ON mm.branchId = bmm.childBranch
        WHERE bmm.branchId = $branchid AND mm.visitDate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
        AND bm.branchId < 10000
        GROUP BY bm.branchName
            UNION
        SELECT bm.branchName branch,0 AInst,SUM(fm.feesAmount) FAmt,0 vds
        FROM branch_master bm INNER JOIN fees_master fm ON fm.branchId = bm.branchId
        WHERE bm.branchId
        IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)
        AND bm.branchId < 10000
        GROUP BY bm.branchName
            UNION
            SELECT bm.branchName branch,0 AInst,0 FAmt,COUNT(bm.branchId) vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid AND bm.branchId < 10000
        AND bm.isActive = 1 AND bm.latitude != 0
        AND bm.longitude !=0 GROUP BY bm.branchName
        ) CounTable GROUP BY CounTable.branch";
}else if($branchid >= 400001 && $branchid < 500000){//daho
    $sql = "SELECT branch,SUM(AInst) AInst,SUM(FAmt) FAmt,SUM(vds) vds FROM(
        SELECT bm.branchName branch, COUNT(DISTINCT(mm.doctorId)) AInst,0 FAmt,0 vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        INNER JOIN medication_master mm ON mm.branchId = bmm.childBranch
        WHERE bmm.branchId = $branchid AND mm.visitDate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
        AND bm.branchId < 10000
        GROUP BY bm.branchName
            UNION
        SELECT bm.branchName branch,0 AInst,SUM(fm.feesAmount) FAmt,0 vds
        FROM branch_master bm INNER JOIN fees_master fm ON fm.branchId = bm.branchId
        WHERE bm.branchId
        IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)
        AND bm.branchId < 10000
        GROUP BY bm.branchName
            UNION
            SELECT bm.branchName branch,0 AInst,0 FAmt,COUNT(bm.branchId) vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid AND bm.branchId < 10000
        AND bm.isActive = 1 AND bm.latitude != 0
        AND bm.longitude !=0 GROUP BY bm.branchName
        ) CounTable GROUP BY CounTable.branch";
}
else if($branchid >= 500001 && $branchid < 600000){
    $sql = "SELECT branch,SUM(AInst) AInst,SUM(FAmt) FAmt,SUM(vds) vds FROM(
        SELECT bm.centre_type branch, COUNT(DISTINCT(mm.doctorId)) AInst,0 FAmt,0 vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        INNER JOIN medication_master mm ON mm.branchId = bmm.childBranch
        WHERE bmm.branchId = $branchid AND mm.visitDate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
        AND bm.branchId < 10000
        GROUP BY bm.centre_type
            UNION
        SELECT bm.centre_type branch,0 AInst,SUM(fm.feesAmount) FAmt,0 vds
        FROM branch_master bm INNER JOIN fees_master fm ON fm.branchId = bm.branchId
        WHERE bm.branchId
        IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)
        AND bm.branchId < 10000
        GROUP BY bm.centre_type
            UNION
            SELECT bm.centre_type branch,0 AInst,0 FAmt,COUNT(bm.branchId) vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid AND bm.branchId < 10000
        AND bm.isActive = 1 AND bm.latitude != 0
        AND bm.longitude !=0 GROUP BY bm.centre_type
        ) CounTable GROUP BY CounTable.branch";
}else{
    $sql = "SELECT branch,SUM(AInst) AInst,SUM(FAmt) FAmt,SUM(vds) vds FROM(
        SELECT bm.centre_type branch, COUNT(DISTINCT(mm.doctorId)) AInst,0 FAmt,0 vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        INNER JOIN medication_master mm ON mm.branchId = bmm.childBranch
        WHERE bmm.branchId = $branchid AND mm.visitDate >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)
        AND bm.branchId < 10000
        GROUP BY bm.centre_type
            UNION
        SELECT bm.centre_type branch,0 AInst,SUM(fm.feesAmount) FAmt,0 vds
        FROM branch_master bm INNER JOIN fees_master fm ON fm.branchId = bm.branchId
        WHERE bm.branchId
        IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)
        AND bm.branchId < 10000
        GROUP BY bm.centre_type
            UNION
            SELECT bm.centre_type branch,0 AInst,0 FAmt,COUNT(bm.branchId) vds
        FROM branch_master bm
        INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
        WHERE bmm.branchId = $branchid AND bm.branchId < 10000
        AND bm.isActive = 1 AND bm.latitude != 0
        AND bm.longitude !=0 GROUP BY bm.centre_type
        ) CounTable GROUP BY CounTable.branch";
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
    $response = array('Message' => "Parameter Missing",'Responsecode' => 401);
}
}
else{
    $response = array('Message' => "Parameter Missing", 'Responsecode' => 401);
}
mysqli_close($conn);
exit(json_encode($response));
?>
