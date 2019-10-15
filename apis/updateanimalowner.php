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
	  if( isset($_POST['gender']) && isset($_POST['ownerid']) &&  isset($_POST['userid']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['profession']) && isset($_POST['mobile']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['address']) && isset($_POST['landmark']) && isset($_POST['branchid']))
	 {
		 $categorytemp = null;
 $adharidtemp = null;
 if(isset($_POST['category']) && isset($_POST['adharid']))
 {
	 $categorytemp = $category;
	 $adharidtemp = $adharid;

 }
			$query = mysqli_query($conn,"update animal_owner_master set sex='$gender', firstName='$firstname', LastName='$lastname', mobile='$mobile', category='$categorytemp', adharid='$adharidtemp' where ownerid=$ownerid");

			$rowsAffected=mysqli_affected_rows($conn);
				if($query==1)
				{
					  $academicQuery = mysqli_query($conn,"select * from  animal_owner_master where branchid=$branchid");
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
					$response = array('Message'=>"Animal Owner updated Successfully","Data"=>$records ,'Responsecode'=>200);
				}
				else
				{
					$response = array('Message'=> "No data to change".mysqli_error($conn),'Responsecode'=>200);
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
   mysqli_close($conn);
	 print json_encode($response);
?>
