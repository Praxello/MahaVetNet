<?php
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);

	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d'); //Returns IST
	  if(isset($_POST['animalid']) && isset($_POST['weight']) && isset($_POST['ownerid']) && isset($_POST['animalname']) && isset($_POST['gender']) && isset($_POST['specie']) && isset($_POST['breed']) && isset($_POST['birthdate']) && isset($_POST['remarks']) && isset($_POST['isbreedable']) && isset($_POST['milk']))
	 {

		 $isbreedabletemp = 0;
		 $milktemp = 0;
		if(isset($_POST['isbreedable']) && isset($_POST['milk']))
 		{
			$isbreedabletemp = $isbreedable;
			$milktemp = $milk;
		}
			$query = mysqli_query($conn,"update  animal_master set animalName='$animalname', gender='$gender', specie='$specie', breed='$breed',weight=$weight, dateOfBirth='$birthdate', remarks='$remarks', isbreedable=$isbreedabletemp, milk=$milktemp where animalid=$animalid");

			$rowsAffected=mysqli_affected_rows($conn);
				if($query==1)
				{
					  $academicQuery = mysqli_query($conn,"select * from  animal_master");
						if($academicQuery!=null)
						{
							$academicAffected=mysqli_num_rows($academicQuery);
							if($academicAffected>0)
							{
								while($academicResults = mysqli_fetch_assoc($academicQuery))
									{
										$records[]=$academicResults;
									}
							}
						}
					$response = array('Message'=>"Animal updated Successfully","Data"=>$records ,'Responsecode'=>200);
				}
				else
				{
					$response = array('Message'=>"No data to update",'Responsecode'=>200);
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
   mysqli_close($conn);
	 print json_encode($response);
?>
