<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 extract($_POST);
	 $flag = true;
	 $casePaperId = null;
	 $paymentReceiptId = null;

	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d'); //Returns IST

	 $insertCount=0;
	 //isset($_POST['latitude']) && isset($_POST['longitude']) &&
	 if( isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['doctorid']) && isset($_POST['visittype']) && isset($_POST['feestype']) && isset($_POST['fees']) && isset($_POST['nextvisitdate']) && isset($_POST['inoculation']) && isset($_POST['totalsamples']) &&  isset($_POST['diagnosis']) && isset($_POST['symptoms']) && isset($_POST['treatment']) && isset($_POST['animalid']) && isset($_POST['visitdate']) &&  isset($_POST['medicineids']) && isset($_POST['dosages']) && isset($_POST['instructions']) && isset($_POST['days']) && isset($_POST['presentcondition']))
	 {
		$medicinesValues = explode(",", $medicineids);
		$dosageValues = explode(",", $dosages);
		$instructionValues = explode(",", $instructions);
		$daysValues = explode(",", $days);
		$nameOfSamples = null;
		if	(isset($_POST['samplenames']))
		{
			$nameOfSamples = $samplenames;
		}

		//delete all rows mandatoryly
		 $checkquery = mysqli_query($conn,"delete from   medication_master where animalId=$animalid and visitDate='$visitdate'");
		//animalId, symptoms, diagnosis, treatment, typeOfInoculation, noOfSample, visitDate
    $sql1 = "INSERT INTO medication_master( doctorid, animalId, visitType, symptoms, diagnosis, treatment, typeOfInoculation, noOfSample, visitDate , presentcondition, samples, nextvisitdate,latitude,longitude) VALUES ($doctorid,$animalid,'$visittype','$symptoms','$diagnosis','$treatment','$inoculation',$totalsamples,'$visitdate', '$presentcondition','$nameOfSamples', '$nextvisitdate',$latitude,$longitude)";

      $query = mysqli_query($conn,$sql1);
					if($query==1)
					{

					}
					else
					{
						$response=array("Message"=> mysqli_error($conn),"Responsecode"=>501);
						$flag = false;
					}



			$checkquery = mysqli_query($conn,"delete from  fees_master where animalId=$animalid and visitDate='$visitdate'");

			$query = mysqli_query($conn,"INSERT INTO fees_master(doctorid,animalId, visitDate, feesAmount, typeOfPayment) VALUES ($doctorid,$animalid,'$visitdate','$fees','$feestype')");
					if($query==1)
					{

					}
					else
					{
						$response=array("Message"=> mysqli_error($conn),"Responsecode"=>502);
						$flag = false;
					}



			//now update next visit date
			$query = mysqli_query($conn,"update animal_master set lastVisitDate='$currentDate',nextVisitDate = '$nextvisitdate' where animalid=$animalid");
					if($query==1)
					{

					}
					else
					{
						$response=array("Message"=> mysqli_error($conn),"Responsecode"=>503);
						$flag = false;
					}


		//delete all rows mandatoryly
		 $checkquery = mysqli_query($conn,"delete from  prescribed_medicine_master where animalId=$animalid and visitDate='$visitdate'");



		$index=0;
		foreach($medicinesValues as $medicineEntry)
		{
		//	echo($medicineEntry);
			if(strlen($medicineEntry)>0 && $medicineEntry!=null)
			{
				$tempMed=$medicinesValues[$index];
				$tempInstruction=$instructionValues[$index];

					$query = mysqli_query($conn,"INSERT INTO prescribed_medicine_master VALUES ($animalid,'$tempMed','$dosageValues[$index]','$tempInstruction','$daysValues[$index]','$visitdate')");
					if($query==1)
					{
					   $insertCount++;
					}
					else
					{
						$response=array("Message"=> mysqli_error($conn),"Responsecode"=>504);
					$flag = false;
					}
			}
		$index++;
		}

			if($flag)
			{


			  $jobQuery = mysqli_query($conn,"SELECT * FROM  medication_master where animalid=$animalid");
						if($jobQuery!=null)
						{
							$affected=mysqli_num_rows($jobQuery);
							if($affected>0)
							{
								while($medicationResult = mysqli_fetch_assoc($jobQuery))
									{
										$medicationDate = $medicationResult['visitDate'];
										$feesData = null;
										$medicinesData = null;
											  $animalQuery = mysqli_query($conn,"SELECT * FROM  fees_master where animalid=$animalid and visitDate ='$medicationDate'");
													if($jobQuery!=null)
													{
														$animalAffected=mysqli_num_rows($animalQuery);
														if($animalAffected>0)
														{
																while($feesResult = mysqli_fetch_assoc($animalQuery))
																{
																	$feesData = $feesResult;
																	if ($medicationDate == $visitdate)
																	{
																		$casePaperId = $medicationResult['medicationId'];
																		$paymentReceiptId = $feesResult['feesId'];
																	}
																}
														}
													}

													$animalQuery = mysqli_query($conn,"SELECT * FROM  prescribed_medicine_master pmm inner join medicine_master mm on pmm.medicineid=mm.medicineid where pmm.animalid=$animalid and pmm.visitDate ='$medicationDate'");
													if($jobQuery!=null)
													{
														$animalAffected=mysqli_num_rows($animalQuery);
														if($animalAffected>0)
														{
																while($feesResult = mysqli_fetch_assoc($animalQuery))
																{
																	$medicinesData[] = $feesResult;
																}
														}
													}

										$records[]= array("MedicationData"=>$medicationResult, "FeesData"=> $feesData ,"MedicineData"=>$medicinesData);
									}
							}
						}
			$response=array("Message"=> "Data saved successfully","NewCasePaperId"=>$casePaperId,"NewPaymentReceiptId"=>$paymentReceiptId,"Data"=> $records,"Responsecode"=>200);
			}
	}
	 else
	 {
		$response=array("Message"=> "Check query parameters","Responsecode"=>403);
	 }
   mysqli_close($conn);
	 print json_encode($response);
?>
