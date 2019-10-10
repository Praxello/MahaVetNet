<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	  
	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d H:i:s'); //Returns IST	
	
	  if(isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['branchid']))
	 {
			$query = mysqli_query($conn,"update branch_master set latitude=$latitude,longitude=$longitude where branchid=$branchid");
		
			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					$response = array('Message'=>"Branch location marked successfully",'Responsecode'=>200);	
				}
				else
				{
					$response = array('Message'=>"Location update failed",'Responsecode'=>200);	
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
	 print json_encode($response);
?>