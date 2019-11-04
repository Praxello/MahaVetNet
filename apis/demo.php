<?php 
   include "../connection.php";
$year = 1980;
$month = 9;
$day = 5;
$output = 0;
$date = strftime("%F", strtotime($year."-".($month-1)."-".$day));


    $sql = "SELECT  count(*) c
    FROM medication_master  mm 
        JOIN animal_master am ON mm.animalId = am.animalId 
        JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
        where mm.branchId = 3248 AND mm.visitType = 'Tour'
        AND mm.visitDate BETWEEN '2019-10-01' AND '2019-10-31'";

$jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
    $academicAffected = mysqli_num_rows($jobQuery);
    if ($academicAffected > 0) {
        $academicResults = mysqli_fetch_assoc($jobQuery);
        $output=  $academicResults['c'];
    } else {
        $output = 0;
    }
}else{
    $output = 0;
}
echo $output;
?>