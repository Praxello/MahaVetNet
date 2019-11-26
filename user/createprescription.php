<?php
      include "connection.php";
	  mysqli_set_charset($conn,'utf8');
	  $response=null;
	 extract($_POST);
	
	 $insertCount=0;
	 
	 if(isset($_POST['patientid']) && isset($_POST['date']) &&  isset($_POST['medicine']) && isset($_POST['morning']) && isset($_POST['afternoon']) && isset($_POST['night']) && isset($_POST['instruction'])&& isset($_POST['days']))
	 {
		$typeValues = explode(",", $type);
		$medicinesValues = explode(",", $medicine);
		$morningValues = explode(",", $morning);
		$afternoonValues = explode(",", $afternoon);
		$nightValues = explode(",", $night);
		$instructionValues = explode(",", $instruction);
		$daysValues = explode(",", $days);
		
		
		//delete all rows mandatoryly
		 $checkquery = mysqli_query($conn,"delete from  prescription_medicine_master where patientId=$patientid and visitDate='$date'");
		
		
		
		$index=0;
		foreach($medicinesValues as $medicineEntry)
		{
		//	echo($medicineEntry);
			if(strlen($medicineEntry)>0 && $medicineEntry!=null)
			{
				$tempMed=$medicinesValues[$index];
				$tempType=$typeValues[$index];
				$tempInstruction=$instructionValues[$index];
				
					$query = mysqli_query($conn,"INSERT INTO prescription_medicine_master VALUES ($patientid,'$date','$tempType','$tempMed', '$morningValues[$index]', '$afternoonValues[$index]', '$nightValues[$index]','$tempInstruction' , '$daysValues[$index]' )");
					if($query==1)
					{
								
					   $insertCount++;
					}
					else
					{	
						$response=array("Message"=> mysqli_error($conn),"Responsecode"=>500);					
					}
			}	
		$index++;			
		}

	}
	 else
	 {
		$response=array("Message"=> "Check query parameters","Responsecode"=>403);
	 }
	 print json_encode($response);
	  mysqli_close($conn);
?>