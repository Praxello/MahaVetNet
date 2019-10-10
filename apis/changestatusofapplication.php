<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	  
	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d H:i:s'); //Returns IST	
	
	  if(isset($_POST['applicationid']))
	 {
			$query = mysqli_query($conn,"update service_apply_master set completionDateTime= '$currentDate', isactive=0 where isactive=1 and  applicationid = $applicationid");
		
			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					$response = array('Message'=>"Application marked as completed",'Responsecode'=>200);	
				}
				else
				{
					$response = array('Message'=>"Application already marked completed",'Responsecode'=>200);	
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
	 print json_encode($response);
?>