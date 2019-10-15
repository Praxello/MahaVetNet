<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);


	if(isset($_POST['animalid']) && isset($_POST['medicineids']) && isset($_POST['visitdate']) && isset($_POST['batchnumber']) && isset($_POST['vaccineexpirydate']) && isset($_POST['ownerid']) && isset($_POST['totalanimals']) && isset($_POST['wastagequantity']) && isset($_POST['fees']) && isset($_POST['doctorid']) && isset($_POST['branchid']) && isset($_POST['goat']) && isset($_POST['cow'])&& isset($_POST['bull'])&& isset($_POST['calf'])&& isset($_POST['buffalo'])&& isset($_POST['redka']) && isset($_POST['sheep']) && isset($_POST['poultry']) )
	 {
      $medicineids = implode(",",$medicineids);
 		  $tempMedicineEntry = mysqli_real_escape_string($conn,$medicineids);

			$tempBatch = mysqli_real_escape_string($conn,$batchnumber);


			$query = mysqli_query($conn,"insert into vaccination_master(medicineids,visitdate, vaccineexpirydate,ownerid, totalanimals, wastagequantity, fees, doctorid, branchid,cow,bull,calf,buffalo,redka,sheep,goat,poultry,batch,animalid) values ('$tempMedicineEntry','$visitdate', '$vaccineexpirydate',$ownerid, '$totalanimals', '$wastagequantity', '$fees', $doctorid, $branchid,$cow,$bull,$calf,$buffalo,$redka,$sheep,$goat,$poultry,'$tempBatch',$animalid)");

			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
          $last_id = mysqli_insert_id($conn);
					$feesTemp = "Cash-Vaccination";
					$checkquery = mysqli_query($conn,"delete from  fees_master where animalId=$animalid and visitDate='$visitdate' and typeOfPayment like '%Vaccination%'");

					 $query = mysqli_query($conn,"INSERT INTO fees_master(doctorid,animalId, visitDate, feesAmount, typeOfPayment) VALUES ($doctorid,$animalid,'$visitdate','$fees','$feesTemp')");

					  // $academicQuery = mysqli_query($conn,"select * from  vaccination_master where branchid=$branchid");
						// if($academicQuery!=null)
						// {
						// 	$academicAffected=mysqli_num_rows($academicQuery);
						// 	if($academicAffected>0)
						// 	{
						// 		while($academicResults = mysqli_fetch_assoc($academicQuery))
						// 			{
						// 				$records[]=$academicResults;
						// 			}
						// 	}
						// }
					$response = array('Message'=>"Vaccine record added successfully","Data"=>$records ,'Responsecode'=>200,'RowId'=>$last_id);
				}
				else
				{
					$response = array('Message'=>mysqli_error($conn)." failed",'Responsecode'=>500);
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
   mysqli_close($conn);
	 print json_encode($response);
?>
