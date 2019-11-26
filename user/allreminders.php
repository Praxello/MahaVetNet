<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	  extract($_POST);
	
	if (isset($_POST['branchid']))
	{
		   $jobQuery = mysqli_query($conn,"select * from medication_master mm inner join animal_master am on mm.animalid=am.animalid inner join animal_owner_master aom on aom.ownerid = am.ownerid where mm.treatment REGEXP 'AIType\":\"Fresh|AIType\":\"Repeat' and mm.branchid = $branchid");
						if($jobQuery!=null)
						{
							$affected=mysqli_num_rows($jobQuery);
							if($affected>0)
							{
								while($medicationResult = mysqli_fetch_assoc($jobQuery))
									{
										$records[]=  array('ReminderType'=>'Artificial Insemination',  'animalId'=>$medicationResult['animalId'],'firstName'=>$medicationResult['firstName'],'ownerId'=>$medicationResult['ownerId'],'visitDate'=>$medicationResult['visitDate'],'breed'=>$medicationResult['breed'],'specie'=>$medicationResult['specie'],'gender'=>$medicationResult['gender'],'animalName'=>$medicationResult['animalName'],'lastName'=>$medicationResult['lastName'],'mobile'=>$medicationResult['mobile'],'sex'=>$medicationResult['sex'],'address'=>$medicationResult['address']) ;
									}
							}
						}
		
		

				//	$jobQuery = mysqli_query($conn,"select * from medication_master mm inner join animal_master am on mm.animalid=am.animalid inner join animal_owner_master aom on aom.ownerid = am.ownerid where mm.treatment REGEXP '\"AIPD|\"NSPD' and mm.doctorid in (select  um.doctorid  from user_master um join branch_master bm on bm.branchId = um.branchId inner join branch_mapper_master bmm on um.branchId = bmm.childBranch where bmm.branchId =$branchid)");
	$jobQuery = mysqli_query($conn,"select * from medication_master mm inner join animal_master am on mm.animalid=am.animalid inner join animal_owner_master aom on aom.ownerid = am.ownerid where mm.treatment REGEXP '\"AIPD|\"NSPD' and mm.branchid = $branchid");
									
					if($jobQuery!=null)
						{
							$affected=mysqli_num_rows($jobQuery);
							if($affected>0)
							{
								while($medicationResult = mysqli_fetch_assoc($jobQuery))
									{
										$records[]=  array('ReminderType'=>'Pregnancy Diagnosis',  'animalId'=>$medicationResult['animalId'],'firstName'=>$medicationResult['firstName'],'ownerId'=>$medicationResult['ownerId'],'visitDate'=>$medicationResult['visitDate'],'breed'=>$medicationResult['breed'],'specie'=>$medicationResult['specie'],'gender'=>$medicationResult['gender'],'animalName'=>$medicationResult['animalName'],'lastName'=>$medicationResult['lastName'],'mobile'=>$medicationResult['mobile'],'sex'=>$medicationResult['sex'],'address'=>$medicationResult['address']) ;
									}
							}
						}
				
				
				
					$jobQuery = mysqli_query($conn,"select * from medication_master mm inner join animal_master am on mm.animalid=am.animalid inner join animal_owner_master aom on aom.ownerid = am.ownerid where mm.treatment REGEXP 'TestReportSexOrgans\":\"[[a-z]|[A-Z]]' and  mm.branchid = $branchid");
						if($jobQuery!=null)
						{
							$affected=mysqli_num_rows($jobQuery);
							if($affected>0)
							{
								while($medicationResult = mysqli_fetch_assoc($jobQuery))
									{
										$records[]=  array('ReminderType'=>'Infertility',  'animalId'=>$medicationResult['animalId'],'firstName'=>$medicationResult['firstName'],'ownerId'=>$medicationResult['ownerId'],'visitDate'=>$medicationResult['visitDate'],'breed'=>$medicationResult['breed'],'specie'=>$medicationResult['specie'],'gender'=>$medicationResult['gender'],'animalName'=>$medicationResult['animalName'],'lastName'=>$medicationResult['lastName'],'mobile'=>$medicationResult['mobile'],'sex'=>$medicationResult['sex'],'address'=>$medicationResult['address']) ;
									}
							}
						}
				


					$jobQuery = mysqli_query($conn,"select * from vaccination_master mm inner join animal_master am on mm.animalid=am.animalid inner join animal_owner_master aom on aom.ownerid = am.ownerid where mm.isdeleted = 0 and   ");
						if($jobQuery!=null)
						{
							$affected=mysqli_num_rows($jobQuery);
							if($affected>0)
							{
								while($medicationResult = mysqli_fetch_assoc($jobQuery))
									{
										$records[]=  array('ReminderType'=>'Vaccination',  'animalId'=>$medicationResult['animalId'],'firstName'=>$medicationResult['firstName'],'ownerId'=>$medicationResult['ownerId'],'visitDate'=>$medicationResult['visitDate'],'breed'=>$medicationResult['breed'],'specie'=>$medicationResult['specie'],'gender'=>$medicationResult['gender'],'animalName'=>$medicationResult['animalName'],'lastName'=>$medicationResult['lastName'],'mobile'=>$medicationResult['mobile'],'sex'=>$medicationResult['sex'],'address'=>$medicationResult['address']) ;
									}
							}
						}


					$jobQuery = mysqli_query($conn,"select * from deworming_master mm inner join animal_master am on mm.animalid=am.animalid inner join animal_owner_master aom on aom.ownerid = am.ownerid where mm.isdeleted = 0 and    mm.branchid = $branchid");
						if($jobQuery!=null)
						{
							$affected=mysqli_num_rows($jobQuery);
							if($affected>0)
							{
								while($medicationResult = mysqli_fetch_assoc($jobQuery))
									{
										$records[]=  array('ReminderType'=>'Deworming',  'animalId'=>$medicationResult['animalId'],'firstName'=>$medicationResult['firstName'],'ownerId'=>$medicationResult['ownerId'],'visitDate'=>$medicationResult['visitDate'],'breed'=>$medicationResult['breed'],'specie'=>$medicationResult['specie'],'gender'=>$medicationResult['gender'],'animalName'=>$medicationResult['animalName'],'lastName'=>$medicationResult['lastName'],'mobile'=>$medicationResult['mobile'],'sex'=>$medicationResult['sex'],'address'=>$medicationResult['address']) ;
									}
							}
						}




				$response = array('Message'=>"All reminders fetched successfully".mysqli_error($conn),"Data"=>$records ,'Responsecode'=>200);	

	}
	else
	{
					$response = array('Message'=>"Parameter missing ".mysqli_error($conn),'Responsecode'=>403);	

		
	}
			
	 print json_encode($response);
	  mysqli_close($conn);
?>