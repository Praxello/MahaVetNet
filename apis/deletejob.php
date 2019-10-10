<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	  
	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d H:i:s'); //Returns IST	
	
	  if(isset($_POST['jobid']))
	 {
			$query = mysqli_query($conn,"delete from jobs_master where jobid=$jobid");
		
			$rowsAffected=mysqli_affected_rows($conn);
				//if($rowsAffected==1)
				{
					  $academicQuery = mysqli_query($conn,"select * from  jobs_master");
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
					$response = array('Message'=>"Job Deleted","Data"=>$records ,'Responsecode'=>200);	
				}
				
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
	 print json_encode($response);
?>