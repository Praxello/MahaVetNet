<?php
   include "../connection.php";
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	if(isset($_POST['animalid']) && isset($_POST['medicineids']) && isset($_POST['visitdate']) && isset($_POST['batchnumber']) && isset($_POST['vaccineexpirydate']) && isset($_POST['ownerid']) && isset($_POST['totalanimals'])
  && isset($_POST['wastagequantity']) && isset($_POST['fees']) && isset($_POST['treatmentid']) && isset($_POST['goat']) && isset($_POST['cow'])&& isset($_POST['bull'])&& isset($_POST['calf'])&& isset($_POST['buffalo'])
  && isset($_POST['redka']) && isset($_POST['sheep']) && isset($_POST['poultry']))
	 {
     $medicineids = implode(",",$medicineids);
 		   $tempMedicineEntry = mysqli_real_escape_string($conn,$medicineids);
		   $tempBatch = mysqli_real_escape_string($conn,$batchnumber);

			$feesTemp = "Cash-Vaccination";
		  $checkquery = mysqli_query($conn,"delete from  fees_master where animalId=$animalid and visitDate='$visitdate' and typeOfPayment like '%Vaccination%'") or die(mysqli_error($conn));


      // $sql1= "INSERT INTO fees_master(doctorid,animalId, visitDate, feesAmount, typeOfPayment) VALUES ($doctorid,$animalid,$visitdate,$fees,$feesTemp)";
			// $query = mysqli_query($conn,$sql1) or die(mysqli_error($conn));

			$query = mysqli_query($conn,"update vaccination_master set medicineids= '$tempMedicineEntry',visitdate='$visitdate', vaccineexpirydate='$vaccineexpirydate', totalanimals = '$totalanimals', wastagequantity='$wastagequantity', fees='$fees',cow='$cow',bull='$bull',calf='$calf',buffalo='$buffalo',redka='$redka',sheep='$sheep',goat='$goat',poultry='$poultry',batch='$batchnumber' where treatmentid = $treatmentid") or die(mysqli_error($conn));

			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					$response = array('Message'=>"Vaccine record added successfully","Data"=>$records ,'Responsecode'=>200);
				}
				else
				{
					$response = array('Message'=>mysqli_error($conn)." No data to change",'Responsecode'=>200);
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
   mysqli_close($conn);
	 print json_encode($response);
?>
