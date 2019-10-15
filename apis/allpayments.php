<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	  extract($_GET);

	 if(isset($_GET['doctorid']))
	 {
 $jobQuery = mysqli_query($conn,"SELECT * FROM fees_master feesm inner join animal_master anim on anim.animalId=feesm.animalid inner join animal_owner_master ownm on anim.ownerId = ownm.ownerid where feesm.doctorid = $doctorid order by feesm.visitdate desc");

		//	 $jobQuery = mysqli_query($conn,"SELECT * FROM fees_master feesm inner join animal_master anim on anim.animalId=feesm.animalid inner join animal_owner_master ownm on anim.ownerId = ownm.ownerid order by feesm.visitdate desc");
						if($jobQuery!=null)
						{
							$academicAffected=mysqli_num_rows($jobQuery);
							if($academicAffected>0)
							{
								while($academicResults = mysqli_fetch_assoc($jobQuery))
									{
										$records[]=$academicResults;
									}
							}
						}
							$response = array('Message'=>"Transactions fetched Successfully","Data"=>$records ,'Responsecode'=>200);
	}
	 else
	 {
		$response=array("Message"=> "Check query parameters","Responsecode"=>403);
	 }

mysqli_close($conn);
	 print json_encode($response);
?>
