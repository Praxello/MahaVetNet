<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	  
	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d H:i:s'); //Returns IST	
	
	 if(isset($_POST['userid']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['conferenceDateTime']))
	 {
			$query = mysqli_query($conn,"insert into conference_master(userid,title,description,conferenceDateTime) values ($userid,'$title','$description','$conferenceDateTime')");
		
			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					  $academicQuery = mysqli_query($conn,"select * from  conference_master where isactive=1");
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
		
					$response = array('Message'=>"Conference Marked Successfully","Data"=>$records ,'Responsecode'=>200);	
				}
				else
				{
					$response = array('Message'=>mysqli_error($conn)." failed",'Responsecode'=>403);	
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
	 print json_encode($response);
?>