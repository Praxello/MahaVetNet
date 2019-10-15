<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 extract($_POST);
	 $out=null;
	 $selectedCustomerId=null;

	  if( isset($_POST['mobile']) && isset($_POST['designation']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['district']) && isset($_POST['blockname']) && isset($_POST['centername']) && isset($_POST['branchid']) && isset($_POST['password']) && isset($_POST['birthdate']))
		{
		  date_default_timezone_set("Asia/Kolkata");
		  $currentDate=date('Y-m-d H:i:s'); //Returns IST
		  $tempAddress = mysqli_real_escape_string($conn,$address);

	     	$qry = mysqli_query($conn,"select * from user_master where email='$email' or mobile='$mobile'");
			$affected=mysqli_num_rows($qry);
			//echo $mobile; echo $query;exit;
			if($affected>0){
				$out = array('Message'=>"Mobile or Email already registered",'Responsecode'=>401);
			}else{
			$query = mysqli_query($conn,"insert into user_master(designation,firstName,lastname,mobile,email,birthDate,district,blockname,centername,branchid,address,signupDate,password,isActive)  values('$designation','$firstname','$lastname','$mobile','$email','$birthdate','$district','$blockname','$centername',$branchid,'$tempAddress','$currentDate','$password',1)");
				if($query==1)
				{
				$query = mysqli_query($conn,"select * from user_master where mobile='$mobile'");
				$affected=mysqli_num_rows($query);
			    $records;
				if($affected>0)
					{
						while($result = mysqli_fetch_assoc($query))
						{
							$records=$result;
						}
				    		$out=array("Responsecode"=>200,"Message"=>"User registration successful. Please proceed to login");
					}
				}
				else
				{
					$out = array('Message'=>mysqli_error($conn),'Responsecode'=>401);
				}
			}
	 }
	 else
	 {
		$out=array("Message"=> "Parameter Missing!","Responsecode"=>403);
	 }
mysqli_close($conn);
	 print json_encode($out);
?>
