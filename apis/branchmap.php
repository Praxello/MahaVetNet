<?php
function branchId($branchid,$centretype){
    include "../connection.php";
    $branch=0;
if($branchid >= 100001 && $branchid < 200000){
    $sql = "SELECT bm.branchId FROM branch_master bm WHERE bm.centretype LIKE '$centretype' AND bm.branchId > 200000 AND bm.branchId < 300000";
    }else if($branchid >= 200001 && $branchid < 300000){
        $sql = "SELECT bm.branchId FROM branch_master bm WHERE bm.centretype LIKE '$centretype' AND bm.branchId > 300000 AND bm.branchId < 500000";
    }
    else if($branchid >= 300001 && $branchid < 400000)//ddc login
    {
        $sql = "SELECT bm.branchId FROM branch_master bm WHERE bm.centretype LIKE '$centretype' AND bm.branchId > 500000 AND bm.branchId < 600000";
    }else if($branchid >= 400001 && $branchid < 500000){//daho login
        $sql = "SELECT bm.branchId FROM branch_master bm WHERE bm.centre_type LIKE '$centretype' AND bm.branchId > 0 AND bm.branchId < 10000";
    }
    else{
        $sql = "SELECT bm.branchId FROM branch_master bm WHERE bm.centretype LIKE '$centretype' AND bm.branchId > 400000 AND bm.branchId < 500000"; 
    }
    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
          $academicResults = mysqli_fetch_assoc($jobQuery);
          $branch = $academicResults['branchId'];
          return  $branch;
        } else {
            return $branch;
        }
    }else{
        return $branch;
}
}
?>