<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 $newlyCreatedAnimal=null;
	 extract($_POST);

	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d'); //Returns IST
	  if(isset($_POST['weight']) && isset($_POST['ownerid']) && isset($_POST['animalname']) && isset($_POST['gender']) && isset($_POST['specie']) && isset($_POST['breed']) && isset($_POST['birthdate']) && isset($_POST['remarks']) )
	 {
		 $isbreedabletemp = 0;
		 $milktemp = 0;

		if(isset($_POST['isbreedable']) && isset($_POST['milk']))
 		{
			$isbreedabletemp = $isbreedable;
			$milktemp = $milk;
		}

		$sql = "insert into animal_master(ownerId, animalName, gender, specie, breed,weight, dateOfBirth, remarks, firstVisitDate, lastVisitDate, nextVisitDate, isbreedable,milk) values ($ownerid,'$animalname','$gender','$specie','$breed',$weight,'$birthdate','$remarks','$currentDate','$currentDate','$currentDate', $isbreedabletemp, $milktemp)";
			$query = mysqli_query($conn,$sql);

			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					  $academicQuery = mysqli_query($conn,"select * from  animal_master where ownerId=$ownerid");
						if($academicQuery!=null)
						{
							$academicAffected=mysqli_num_rows($academicQuery);
							if($academicAffected>0)
							{
								while($academicResults = mysqli_fetch_assoc($academicQuery))
									{
										$records[]=$academicResults;
										if($academicResults['animalName'] == $animalname && ($academicResults['specie'] == $specie) && ($academicResults['breed'] == $breed) && ($academicResults['dateOfBirth'] == $birthdate))
										{
											$newlyCreatedAnimal = $academicResults;
										}
									}
							}
						}
					$response = array('Message'=>"Animal added Successfully","Data"=>$records,'NewAnimal'=>$newlyCreatedAnimal ,'Responsecode'=>200);
				}
				else
				{
					$response = array('Message'=>mysqli_error($conn)." failed",'Query'=>$sql,'Responsecode'=>500);
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
   mysqli_close($conn);
	 print json_encode($response);
?>
