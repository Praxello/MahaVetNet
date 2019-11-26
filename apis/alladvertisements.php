<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $mediumAd=null;
	 $smallerAd=null;
	 
	 $versionNo = 0;
	 extract($_POST);
	 	
	  if(isset($_POST['version_code']) && isset($_POST['branchid']))
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
			  	$jobQuery = mysqli_query($conn,"SELECT * FROM advertisement_mapping amm INNER JOIN advertisement_master am ON amm.addId = am.adId WHERE amm.branchId IN(SELECT branch_mapper_master.branchId FROM branch_mapper_master WHERE branch_mapper_master.childBranch = $branchid)");
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
		  				$jobQuery = mysqli_query($conn,"SELECT * FROM advertisement_mapping amm INNER JOIN advertisement_master am ON amm.addId = am.adId");
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
	  mysqli_close($conn);
	 print json_encode($response);  
?>