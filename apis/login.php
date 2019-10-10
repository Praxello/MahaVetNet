<?php
      include "../connection.php";
	  mysqli_set_charset($conn,'utf8');
	  $response=null;
	  $records=null;
	  $userData = null;
	  $userEmail = null;
	  $userMobile = null;
	  $userFirstname = null;
	  $userDeviceModel = null;
	  $userOTP = null;
	  $loggedIdBranchId  = 0;
	  $centre_type = null;
	  
	  if(isset($_POST['usrname']) && isset($_POST['uuid']) && isset($_POST['passwrd']))
	 {
		extract($_POST);
		
		//taking out model first
		$userDeviceModel = $model;
	                $tempDeviceModel = mysqli_real_escape_string($conn,$model);
		
		
		    $query = mysqli_query($conn,"select * from branch_master where username='$usrname' and password='$passwrd' and isActive=1");
			if($query!=null)
			{
			$affected=mysqli_num_rows($query);
				if($affected>0)
				{
					
					$userEmail = null;

					   while($result = mysqli_fetch_assoc($query))
						{
							$loggedIdBranchId=$result['branchId'];
							$centre_type = $result['centre_type'];
						}
						
					
					$userQuery = mysqli_query($conn,"SELECT * FROM  user_master where branchid =$loggedIdBranchId limit 1");
						if($userQuery!=null)
						{
					
							$affected=mysqli_num_rows($userQuery);
							if($affected>0)
							{
					
								while($result = mysqli_fetch_assoc($userQuery))
									{
										$userEmail=$result['email'];
										$userMobile = $result['mobile'];
										$userFirstname = $result['fullName'];
										$userData = $result;
										$userData['centre_type'] = $centre_type;
									}
							}
						}
						
				   //login is present now check if uuid is present in OTP TABLE and whether it is verified
					$uuidQuery = mysqli_query($conn,"select * from otp_master where uuid='$uuid' and branchId=$loggedIdBranchId");
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
								$otpEntry=base64_encode ($otpId)."*".$otpId;
								$userOTP = $otpEntry;
								}
							
						}
					
							if($recordPresentWithVerificationStatus == -1) //no record present. proceed to insert into table
							{
							
									$deviceRregisterquery = mysqli_query($conn,"insert into user_devices(mobile,uuid,deviceType,model,imei) values( '$userMobile','$uuid','$devicetype','$tempDeviceModel ','$imei')");
							if($deviceRregisterquery==1)
							{
										//now insert an entry in otp table 
											$otpQquery = mysqli_query($conn,"insert into otp_master(mobile,uuid,email,branchid) values( '$userMobile','$uuid','$userEmail',$loggedIdBranchId)");
											if($otpQquery==1)
											{
													//now select the newly registered uuid 
													$uuidInsertedquery = mysqli_query($conn,"select * from otp_master where uuid='$uuid' and isVerified=0");
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
														
														$userOTP = $otpEntry;
														// Get cURL resource
														$curl = curl_init();
														// Set some options - we are passing in a useragent too here
														curl_setopt_array($curl, array(
														CURLOPT_RETURNTRANSFER => 1,
												//		CURLOPT_URL => "http://sms.hspsms.com/sendSMS?username=pvn222666&message=Your%20verification%20code%20is%20"."$otpEntry"."&sendername=ESMART&smstype=TRANS&numbers="."$usrname"."&apikey=4a096b9f-f599-413d-b804-ce39468cea90",
														CURLOPT_URL => "http://sms.indiatext.in/api/mt/SendSMS?user=mahavetnet&password=MahaVetNet2266&senderid=MAHVET&channel=Trans&DCS=0&flashsms=0&number="."$userMobile"."&text="."Your%20verification%20code%20is%20"."$otpEntry"."&route=35",
													  CURLOPT_USERAGENT => 'Codular Sample cURL Request'
														));
													    // Send the request & save response to $resp
														$resp = curl_exec($curl);
														$json = json_decode($resp, true);
													//	print("http://sms.hspsms.com/sendSMS?username=pvn22666&message="."$otpEntry"."&sendername=ESMART&smstype=TRANS&numbers="."$usrname"."&apikey=3929a807-7696-4355-baf7-fc247332f09f");
														// Close request to clear up some resources
														curl_close($curl);
													  $response=array("Responsecode"=>200,"Message"=> "Verification code sent to registered Mobile and Email");
							
							
							
												//Sending Email AS WELL now
							
							$to      = $userEmail;

$subject = "MAHAVETNET - New Mobile Registration";
$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional
.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <style type="text/css">
    .choose-link, .choose-link:visited, .choose-link:hover  {text-decoration: none; color:#fff;}
    @media only screen and (max-width: 10000px) {
    .emailer-main{ margin:0 auto;}
    }
    @media only screen and (max-width: 600px) {
    .emailer-main{ width:100% !important; }
    .headlogo img{width:100% }
    }
</style>
</head>

<body>
    <table class="emailer-main" border="0" align="center" cellpadding="0" cellspacing="0" style="border
:solid 1px #ccc; width:600px;">
        <tr>
            <td height="40" align="left" valign="middle" bgcolor="#000" style="border-bottom:solid 1px #ccc;">
                <table border="0" align="left" cellpadding="0" cellspacing="0">
                    <tr>
                            <td align="right" class="headlogo" valign="bottom" style="padding-left:10px;"><img src="http://esmartsolution.in/pottercoup/logo.png" border="0" />
                            </td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr>
                    <td align="left" valign="top" style="padding-left:20px; padding-top:20px; color:#363636; padding-bottom:10px; line-height:12px; font-size:14px; padding-right:20px; font-family:Arial, Helvetica, sans-serif;">Dear '.$userFirstname.'  
                    </td>
                </tr>
        <tr>
            <td align="left" valign="top" style="padding-left:20px; padding-top:10px; color:#363636; padding-bottom:15px; line-height:12px; font-size:14px; padding-right:20px; font-family:Arial, Helvetica, sans-serif;">
                Your one time password for MAHAVETNET application is : '.$userOTP.'
            </td>
			
        </tr>
		     <tr>
		 <td align="left" valign="top" style="padding-left:20px; padding-top:10px; color:#363636; padding-bottom:15px; line-height:12px; font-size:14px; padding-right:20px; font-family:Arial, Helvetica, sans-serif;">
                New Mobile Details  : '.$userDeviceModel.'
            </td>
			     </tr>
        <td style="padding:3px 0 15px 20px;  color:#363636; font-size:14px;  font-family:Arial, Helvetica, sans-serif;">
                    Regards
                    </td>
        <tr>
                <td align="left" valign="top" style="padding:10px 15px; background:#3B4851; font-family:Arial, Helvetica, sans-serif; color:#fff; font-size:14px;">&copy; '.date("Y").' MAHAVETNET All rights reserved</td>
              </tr>
    </table>
</body>
</html>';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: mahavetnet@praxello.com' . "\r\n";
mail($to, $subject, $message, $headers);
							
							
							
														}
													}
											}
							}
							}
							else if ($recordPresentWithVerificationStatus == 0) //send existing otpid
							{
								
								
								
							$to      = $userEmail;
$subject = "MAHAVETNET - New Mobile Registration";
$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional
.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <style type="text/css">
    .choose-link, .choose-link:visited, .choose-link:hover  {text-decoration: none; color:#fff;}
    @media only screen and (max-width: 10000px) {
    .emailer-main{ margin:0 auto;}
    }
    @media only screen and (max-width: 600px) {
    .emailer-main{ width:100% !important; }
    .headlogo img{width:100% }
    }
</style>
</head>

<body>
    <table class="emailer-main" border="0" align="center" cellpadding="0" cellspacing="0" style="border
:solid 1px #ccc; width:600px;">
        <tr>
            <td height="40" align="left" valign="middle" bgcolor="#000" style="border-bottom:solid 1px #ccc;">
                <table border="0" align="left" cellpadding="0" cellspacing="0">
                    <tr>
                            <td align="right" class="headlogo" valign="bottom" style="padding-left:10px;"><img src="http://esmartsolution.in/pottercoup/logo.png" border="0" />
                            </td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr>
                    <td align="left" valign="top" style="padding-left:20px; padding-top:20px; color:#363636; padding-bottom:10px; line-height:12px; font-size:14px; padding-right:20px; font-family:Arial, Helvetica, sans-serif;">Dear '.$result['fullName'].'  
                    </td>
                </tr>
        <tr>
            <td align="left" valign="top" style="padding-left:20px; padding-top:10px; color:#363636; padding-bottom:15px; line-height:12px; font-size:14px; padding-right:20px; font-family:Arial, Helvetica, sans-serif;">
                Your one time password for MAHAVETNET application is : '.$userOTP.'
            </td>
			
        </tr>
		<tr>
		 <td align="left" valign="top" style="padding-left:20px; padding-top:10px; color:#363636; padding-bottom:15px; line-height:12px; font-size:14px; padding-right:20px; font-family:Arial, Helvetica, sans-serif;">
                New Mobile Details  : '.$userDeviceModel.'
            </td>
		</tr>
        <td style="padding:3px 0 15px 20px;  color:#363636; font-size:14px;  font-family:Arial, Helvetica, sans-serif;">
                    Regards
                    </td>
        <tr>
                <td align="left" valign="top" style="padding:10px 15px; background:#3B4851; font-family:Arial, Helvetica, sans-serif; color:#fff; font-size:14px;">&copy; '.date("Y").' MAHAVETNET All rights reserved</td>
              </tr>
    </table>
</body>
</html>';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: mahavetnet@praxello.com' . "\r\n";
mail($to, $subject, $message, $headers);
								
								
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
					else
					{
								$response = array('Message'=>mysqli_error($conn)." No data to change",'Responsecode'=>200);	
			
					}
			}
			else
			{
			$response=array("Message"=> "Wrong username or password! or contact IT hub","Responsecode"=>401);
			}
		}
	}
	 else
	 {
		$response=array("Message"=> "Please check institure login and password from IT hub","Responsecode"=>500);
	 }
	 print json_encode($response);
?>