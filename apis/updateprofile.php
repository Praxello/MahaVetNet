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

	  if(isset($_POST['doctorid']) && isset($_POST['branchid']) && isset($_POST['mobile']) && isset($_POST['designation']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['birthdate']))
		{
		  date_default_timezone_set("Asia/Kolkata");
		  $currentDate=date('Y-m-d H:i:s'); //Returns IST
		  $tempAddress = mysqli_real_escape_string($conn,$address);
		  $tempDesignation = mysqli_real_escape_string($conn,$designation);

	    /* 	$qry = mysqli_query($conn,"select * from user_master where email='$mobile'");
			$affected=mysqli_num_rows($qry);
			//echo $mobile; echo $query;exit;
			if($affected>0){
				$out = array('Message'=>"Email already registered",'Responsecode'=>401);

			}
			else*/
			{

			$query = mysqli_query($conn,"update user_master set designation = '$tempDesignation',fullname='$fullname',email='$email',birthDate='$birthdate',address='$tempAddress',mobile='$mobile' where doctorid =$doctorid");
				if($query==1)
				{
				$query = mysqli_query($conn,"select * from user_master um inner join branch_master bm on um.branchId=bm.branchId where bm.branchId=$branchid and bm.isActive=1 limit 1");
				$affected=mysqli_num_rows($query);
			    $records;
				if($affected>0)
					{
						while($result = mysqli_fetch_assoc($query))
						{
							$records=$result;
						}
				    		$out=array("Responsecode"=>200,"Message"=>"Profile updated successfully",'Data'=>$records);
					}
				}
				else
				{
					$out = array('Message'=>mysqli_error($conn),'Data'=>$records,'Responsecode'=>401);
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
