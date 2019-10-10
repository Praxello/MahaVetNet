<?php
include "../connection.php";
mysqli_set_charset($conn,'utf8');
$response=null;
$records=null;
$visitId=null;
extract($_POST);
if(isset($_POST['tradeName']) && isset($_POST['unit']) && isset($_POST['type']) && isset($_POST['medicineId']))
{
$sql = "UPDATE  medicine_master SET tradeName='$tradeName', unit='$unit', type='$type' WHERE medicineId=$medicineId";
$query = mysqli_query($conn,$sql);
$rowsAffected=mysqli_affected_rows($conn);
if($query==1){
$response = array('Message'=>"Medicine updated Successfully",'Responsecode'=>200);	
}else{
    $response = array('Message'=>"No data to update",'Responsecode'=>200);	
}
}
 else
{
	$response=array("Message"=> "Parameters missing","Responsecode"=>403);
}
print json_encode($response);
?>