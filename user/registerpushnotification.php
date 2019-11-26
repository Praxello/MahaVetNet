<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 
	 if(isset($_POST['doctorid']) && isset($_POST['deviceid']) && isset($_POST['ostype']) && isset($_POST['appversion']))
	 {
	extract($_POST);
	
	$query = mysqli_query($conn,"insert into  user_gcm_apns_master(doctorid,deviceId,osType,appVersion) values($doctorid,'$deviceid','$ostype','$appversion')");
	
	
		if($query==1){
			$out = array('Message'=>"User registration successfull",'Responsecode'=>200);
			}
			else{
		  $out = array('Message'=>"User registration unsuccessfull".mysqli_error($conn),'Responsecode'=>403);	
			}
	 }
	 else
	 {
		$out=array("Message"=> "Check query parameters".mysqli_error($conn),"Responsecode"=>403);
	 }
	 print json_encode($out);
	  mysqli_close($conn);
?>