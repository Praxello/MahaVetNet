<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $loggedInBranchId = 0;
	 extract($_POST);
	  
	  if(isset($_POST['uuid']) && isset($_POST['otp']))
	 {
		 //create original otp number 
		 $otpPieces = explode("*", $otp);
		 
		 $decryptedOtpNumber=$otpPieces[1];
		 //print($decryptedOtpNumber);
			$query = mysqli_query($conn,"update otp_master set isVerified=1 where uuid='$uuid' and otpId=".$decryptedOtpNumber);
			 $rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					
					//getting this data out now
					  $loginQuery = mysqli_query($conn,"select * from otp_master where uuid='$uuid' and otpId=".$decryptedOtpNumber);
					if($loginQuery!=null)
					{
						$loginaffected=mysqli_num_rows($loginQuery);
						if($loginaffected>0)
						{
							   while($result = mysqli_fetch_assoc($loginQuery))
							{
								$userEmail=$result['email'];
								$loggedInBranchId = $result['branchId'];
								
									//now fetch data against this email and send to user
									
							    $userDetailsQuery = mysqli_query($conn,"select * from user_master um inner join branch_master bm on um.branchId=bm.branchId where bm.branchId=$loggedInBranchId and bm.isActive=1 limit 1");
						
									if($userDetailsQuery!=null)
									{
											$userDetailffected=mysqli_num_rows($userDetailsQuery);
											if($userDetailffected>0)
											{
												   while($result = mysqli_fetch_assoc($userDetailsQuery))
												   {
													   $records = $result;
												   }
											}
									}
							}
						}	
				}
					$response = array('Data' =>$records,'Message'=>"Mobile verification successfull. Proceed to login!",'Responsecode'=>200);	
				}
				else
				{
					$response = array('Message'=>mysqli_error($conn)."Already verified or Invalid OTP",'Responsecode'=>200);	
				}
				if($query==null)
				{
					$response = array('Message'=>"Invalid OTP or Unregistered mobile",'Responsecode'=>403);	
				}		
	 }
	 else
	 {
		$response=array("Message"=> "OTP missing","Responsecode"=>403);
	 }

	 print json_encode($response);
?>