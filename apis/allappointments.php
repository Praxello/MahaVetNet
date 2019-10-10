
<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 extract($_POST);
	 date_default_timezone_set("Asia/Kolkata");
	 if(isset($_POST['branchid']) && isset($_POST['visitdate']))
	 {
	 $currentDate=date('Y-m-d'); //Returns IST	
	 $date1 = strtotime('$visitdate');
	// print($date1);

	
	$date1=date_create($currentDate);
    $date2=date_create($visitdate);	
	$columnName = "anim.nextVisitDate = '$visitdate'";
	$diff=date_diff($date1,$date2);
	$daysGap = $diff->format("%R%a days");
	//print("asd asd ".$daysGap);
	
	if($daysGap < 0)
	{
	$columnName = "anim.lastvisitdate = '$visitdate'";
	}
	
	if($daysGap == 0)
	{
	$columnName = "anim.lastvisitdate = '$visitdate'  and ownm.branchid=$branchid or anim.nextvisitdate = '$visitdate'";
	}
	
//$queryString ="select * from user_master um INNER JOIN animal_owner_master ownm on um.doctorId = ownm.doctorId inner JOIN  animal_master anim  on anim.ownerId = ownm.ownerid where ".$columnName." and um.doctorId=$doctorid";
	
$queryString ="select * from  animal_owner_master ownm inner JOIN  animal_master anim  on anim.ownerId = ownm.ownerid where ".$columnName." and ownm.branchid=$branchid";
	
//$queryString ="select * animal_owner_master ownm inner JOIN  animal_master anim  on anim.ownerId = ownm.ownerid where ".$columnName;

		   $query = mysqli_query($conn,$queryString);
		   if($query!=null)
						{
							$academicAffected=mysqli_num_rows($query);
							if($academicAffected>0)
							{
								while($academicResults = mysqli_fetch_assoc($query))
									{
										$records[]=$academicResults;
									//	if ($academicResults['doctorId'] == $doctorid)
										//{
										//$records[]=$academicResults;
									//	}
									}
										$response = array('Message'=>"Appointment fetched Successfully","Data"=>$records ,'Responsecode'=>200);	
							}
							else
							{
									$response = array('Message'=>"No Appointments for today","Data"=>$records ,'Responsecode'=>200);	
							}
						}
	 }
	 else
	 {
		 				$response = array('Message'=>"Parameter missing","Data"=>$records ,'Responsecode'=>403);	
	 }
				
	 print json_encode($response);
?>