<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	  extract($_POST);
	
	if (isset($_POST['branchid']))
	{
		   $jobQuery = mysqli_query($conn,"SELECT * FROM   service_apply_master sam inner join animal_owner_master aom on sam.ownerid = aom.ownerid inner join government_benefit_master gbm on sam.serviceid =  gbm.benefitid where aom.branchid = $branchid and sam.isactive=1");
						if($jobQuery!=null)
						{
							$affected=mysqli_num_rows($jobQuery);
							if($affected>0)
							{
								while($medicationResult = mysqli_fetch_assoc($jobQuery))
									{
										$records[]= $medicationResult;
									}
							}
						}
		
					$response = array('Message'=>"All data fetched Successfully".mysqli_error($conn),"Data"=>$records ,'Responsecode'=>200);	

	}
	else
	{
					$response = array('Message'=>"Parameter missing ".mysqli_error($conn),'Responsecode'=>403);	

		
	}
			
	 print json_encode($response);
	  mysqli_close($conn);
?>