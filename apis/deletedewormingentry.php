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
	 $currentDate=date('Y-m-d H:i:s'); //Returns IST

	  if(isset($_POST['treatmentid']))
	 {
			$query = mysqli_query($conn,"update deworming_master set isdeleted = 1 where treatmentid=$treatmentid");

			$rowsAffected=mysqli_affected_rows($conn);
				//if($rowsAffected==1)
				{
					$feesTemp = "Cash-Deworming";
					$checkquery = mysqli_query($conn,"delete from  fees_master where animalId=$animalid and visitDate='$visitdate' and typeOfPayment = '$feesTemp'");

					  $academicQuery = mysqli_query($conn,"select * from  deworming_master where isdeleted=0 and branchid = $branchid");
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
					$response = array('Message'=>"Vaccination Deleted","Data"=>$records ,'Responsecode'=>200);
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
   mysqli_close($conn);
	 print json_encode($response);
?>
