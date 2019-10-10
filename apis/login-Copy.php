<?php
      include "../connection.php";
	  mysqli_set_charset($conn,'utf8');
	  $response=null;
	  $records=null;
	  $userData = null;
	 if(isset($_POST['usrname']) && isset($_POST['uuid']) && isset($_POST['passwrd']))
	 {
		extract($_POST);
		    $query = mysqli_query($conn,"select * from user_master where mobile='$usrname' and password='$passwrd' and isActive=1");
			if($query!=null)
			{
			$affected=mysqli_num_rows($query);
				if($affected>0)
				{
					$userEmail = null;
					   while($result = mysqli_fetch_assoc($query))
						{
							$userEmail=$result['email'];
							$userData = $result;
						}
						
				   //login is present now check if uuid is present in OTP TABLE and whether it is verified
					$uuidQuery = mysqli_query($conn,"select * from otp_master where uuid='$uuid' and mobile='$usrname'");
					if($uuidQuery!=null)
					{
						
						$recordPresentWithVerificationStatus = -1;
						$otpId = 0;
						$uuidAffected=mysqli_num_rows($uuidQuery);
						
						if($uuidAffected>0)
						{
								//uuid is present and device is registered properly 
								while($result = mysqli_fetch_assoc($query))
								{
								$records=$result; //final answer to send is here
								}
								
								while($uuidresult = mysqli_fetch_assoc($uuidQuery))
								{
								$recordPresentWithVerificationStatus = $uuidresult['isVerified'];
								$otpId = $uuidresult['otpId'];
								}
							
						}
					
							if($recordPresentWithVerificationStatus == -1) //no record present. proceed to insert into table
							{
								
									$deviceRregisterquery = mysqli_query($conn,"insert into user_devices(mobile,uuid,deviceType,model,imei) values( '$usrname','$uuid','$devicetype','$model','$imei')");
							if($deviceRregisterquery==1)
							{
										//now insert an entry in otp table 
											$otpQquery = mysqli_query($conn,"insert into otp_master(mobile,uuid,email) values( '$usrname','$uuid','$userEmail')");
											if($otpQquery==1)
											{
													//now select the newly registered uuid 
													$uuidInsertedquery = mysqli_query($conn,"select * from otp_master where uuid='$uuid'");
													$uuidInsertAffected=mysqli_num_rows($uuidInsertedquery);
													if($uuidInsertAffected>0)
													{
														$otpEntry = null;
														
														while($otpResult = mysqli_fetch_assoc($uuidInsertedquery))
														{
															$otpEntry=$otpResult['otpId'];
														}
														
														//send SMS now to user
														if($otpEntry!=null)
														{
														$otpEntry=base64_encode ($otpEntry)."*".$otpEntry;
													//	print($otpEntry);
														
														// Get cURL resource
														$curl = curl_init();
														// Set some options - we are passing in a useragent too here
														curl_setopt_array($curl, array(
														CURLOPT_RETURNTRANSFER => 1,
														CURLOPT_URL => "http://sms.hspsms.com/sendSMS?username=pvn222666&message=Your%20verification%20code%20is%20"."$otpEntry"."&sendername=ESMART&smstype=TRANS&numbers="."$usrname"."&apikey=4a096b9f-f599-413d-b804-ce39468cea90",
														CURLOPT_USERAGENT => 'Codular Sample cURL Request'
														));
													    // Send the request & save response to $resp
														$resp = curl_exec($curl);
														$json = json_decode($resp, true);
													//	print("http://sms.hspsms.com/sendSMS?username=pvn22666&message="."$otpEntry"."&sendername=ESMART&smstype=TRANS&numbers="."$usrname"."&apikey=3929a807-7696-4355-baf7-fc247332f09f");
														// Close request to clear up some resources
														curl_close($curl);
													  $response=array("Responsecode"=>200,"Message"=> "Verification code sent to registered mobile.");
							
														}
													}
											}
							}
							}
							else if ($recordPresentWithVerificationStatus == 0) //send existing otpid
							{
							  $response=array("Responsecode"=>200,"Message"=> "Device verification pending. Please use OTP to verify device.");
								
									//send SMS now to user


													/*if($otpId!=null)
														{
														$otpId=base64_encode ($otpId)."*".$otpId;
													//	print($otpEntry);
														
														// Get cURL resource
														$curl = curl_init();
														// Set some options - we are passing in a useragent too here
														curl_setopt_array($curl, array(
														CURLOPT_RETURNTRANSFER => 1,
														CURLOPT_URL => "http://sms.hspsms.com/sendSMS?username=pvn22666&message="."$otpId"."&sendername=ESMART&smstype=TRANS&numbers="."$usrname"."&apikey=3929a807-7696-4355-baf7-fc247332f09f",
														CURLOPT_USERAGENT => 'Codular Sample cURL Request'
														));
													    // Send the request & save response to $resp
														$resp = curl_exec($curl);
														$json = json_decode($resp, true);
													//	print("http://sms.hspsms.com/sendSMS?username=pvn22666&message="."$otpEntry"."&sendername=ESMART&smstype=TRANS&numbers="."$usrname"."&apikey=3929a807-7696-4355-baf7-fc247332f09f");
														// Close request to clear up some resources
														curl_close($curl);
														$records = array("Message"=>"Verification code sent to registered mobile.");
															
														}*/
															//$records=$result; //final answer to send is here
								//$records = array("Message"=>"Login Successfull","Responsecode"=>200);
							}
							else
							{
									//all verification is done . just send all user data
								$response=array("Data"=>$userData,"Responsecode"=>200,"Message"=> "Login Successfull");
							}
							
						
					}
						
			}
			else
			{
			$response=array("Message"=> "Wrong email-id or password!","Responsecode"=>401);
			}
		}
	}
	 else
	 {
		$response=array("Message"=> "Please check mobile number","Responsecode"=>500);
	 }
	 print json_encode($response);
?>