<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	  
	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d H:i:s'); //Returns IST	
	
	  if(isset($_POST['postid']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['posttype']))
	 {
		   $tempTitle = mysqli_real_escape_string($conn,$title);
		   $tempDesc= mysqli_real_escape_string($conn,$description);
		   $tempConclusion= mysqli_real_escape_string($conn,$conclusion);
		
		    $queryString = "update academic_master set title='$tempTitle', description = '$tempDesc',posttype='$posttype', conclusion='$tempConclusion' where postid=$postid";
			
			$query = mysqli_query($conn, $queryString);
		
			$rowsAffected=mysqli_affected_rows($conn);
		//	print($queryString);
				if($rowsAffected == 1)
				{
					  $academicQuery = mysqli_query($conn,"select * from  academic_master");
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
		
					$response = array('Message'=>"Academic Case Updated Successfully","Data"=>$records ,'Responsecode'=>200);	
				}
				else
				{
					$response = array('Message'=>mysqli_error($conn)." No data to change",'Responsecode'=>403);	
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
	 print json_encode($response);
	  mysqli_close($conn);
?>