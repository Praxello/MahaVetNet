<?php
include "../connection.php";
mysqli_set_charset($conn,'utf8');
$response=null;
$records=null;

extract($_POST);
if(isset($_POST['medicineId']))
{
$sql = "DELETE FROM medicine_master WHERE medicineId=$medicineId";
$query = mysqli_query($conn,$sql);
$rowsAffected=mysqli_affected_rows($conn);
if($query==1){
$response = array('Message'=>"Medicine Removed Successfully",'Responsecode'=>200);	
}else{
    $response = array('Message'=>"No data to update",'Responsecode'=>100);	
}
}
 else
{
	$response=array("Message"=> "Parameters missing","Responsecode"=>403);
}
mysqli_close($conn);
print json_encode($response);
?>