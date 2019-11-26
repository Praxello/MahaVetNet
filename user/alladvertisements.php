<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $mediumAd=null;
	 $smallerAd=null;
	 
	 $versionNo = 0;
	 extract($_POST);
	 $branchId = 0;
	 $doctorId = 0;
	 
	 if(isset($_POST['version_code']))
	  {
	//	echo($version_code);
		  $versionNo = $version_code;
		  if($versionNo < 15)
		  {
			  //show error code
			$response = array('Message'=>"Please update your application","Data"=>$records ,'Responsecode'=>600);	
		  }
		  else
		  {
			  	$jobQuery = mysqli_query($conn,"SELECT * FROM  advertisement_master");
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
		
		  $jobQuery = mysqli_query($conn,"SELECT * FROM  advertisement_master");
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
					$response = array('Message'=>"All ads fetched Successfully","Data"=>$records ,'Responsecode'=>200);	
	
			  
		  }
	  }
	  else
	  {
		  				$jobQuery = mysqli_query($conn,"SELECT * FROM  advertisement_master");
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
		
		  $jobQuery = mysqli_query($conn,"SELECT * FROM  advertisement_master");
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
					$response = array('Message'=>"All ads fetched Successfully","Data"=>$records ,'Responsecode'=>200);	
	  }
	
	 print json_encode($response);
	  mysqli_close($conn);
?>