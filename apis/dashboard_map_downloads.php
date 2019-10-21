<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
$response=null;
$records = null;
extract($_POST);

if(isset($_POST['branchid'])){
    $sql = "SELECT SUM(animalCount) animalCount,SUM(tagged) tagged,SUM(farmercount) farmercount,SUM(Total) Total,SUM(downloads) downloads,SUM(vd) vd,SUM(revenue) revenue,SUM(mobiles) mobiles
     FROM(
           SELECT COUNT(am.animalId) AS animalCount,0 tagged,0 farmercount,0 Total,0 downloads,0 vd,0 revenue,0 mobiles
           FROM branch_master bm
           INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
           INNER JOIN animal_master am ON am.ownerId = aom.ownerId
           WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)  
           AND bm.branchId < 10000
        UNION
            SELECT 0 animalCount,COUNT(am.animalId) tagged,0 farmercount,0 Total,0 downloads,0 vd,0 revenue,0 mobiles    
            FROM branch_master bm
            INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
            INNER JOIN animal_master am ON am.ownerId = aom.ownerId
            WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)  
            AND bm.branchId < 10000
            AND am.animalName regexp '^[0-9]{1,16}$'
        UNION
            SELECT 0 animalCount,0 tagged,COUNT(aom.ownerId) AS farmercount,0 Total,0 downloads,0 vd,0 revenue,0 mobiles
            FROM branch_master bm
            INNER JOIN animal_owner_master aom ON aom.branchId = bm.branchId
            INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
            WHERE bmm.branchId = $branchid
            AND bm.branchId < 10000
        UNION
            SELECT 0 animalCount,0 tagged,0 farmercount,COUNT(bm.branchId) Total,0 downloads,0 vd,0 revenue,0 mobiles  
            FROM branch_master bm 
            WHERE bm.branchId IN(SELECT bmm.childBranch 
                                 FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)  
            AND bm.branchId < 10000
        UNION
            SELECT 0 animalCount,0 tagged,0 farmercount,0 Total,COUNT(bm.branchId) downloads,0 vd,0 revenue ,0 mobiles 
            FROM branch_master bm 
            WHERE bm.branchId IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid) 
            AND bm.branchId  IN(SELECT branchId FROM otp_master) 
            AND bm.branchId < 10000
        UNION
            SELECT  0 animalCount,0 tagged,0 farmercount,0 Total,0 downloads ,COUNT(bm.branchId) vd,0 revenue,0 mobiles
            FROM branch_master bm INNER JOIN branch_mapper_master bmm ON bmm.childBranch = bm.branchId
            WHERE bmm.branchId = $branchid AND bm.branchId < 10000 AND bm.isActive = 1 
            AND bm.latitude != 0 AND bm.longitude !=0 
        UNION
            SELECT 0 animalCount,0 tagged,0 farmercount,0 Total,0 downloads ,0 vd,SUM(fm.feesAmount) revenue,0 mobiles
            FROM branch_master bm 
            INNER JOIN fees_master fm ON fm.branchId = bm.branchId 
            WHERE bm.branchId 
            IN(SELECT bmm.childBranch FROM branch_mapper_master bmm WHERE bmm.branchId = $branchid)
            AND bm.branchId < 10000
        UNION
            SELECT 0 animalCount,0 tagged,0 farmercount,0 Total,0 downloads ,0 vd,0 revenue,COUNT(DISTINCT(om.mobile)) mobiles
            FROM otp_master_farmer om
         ) CounTable";

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