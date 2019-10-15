<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	 $NewReord=null;

	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d H:i:s'); //Returns IST

	  if(isset($_POST['userid']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['posttype']))
	 {
		   $tempTitle = mysqli_real_escape_string($conn,$title);
		   $tempDesc= mysqli_real_escape_string($conn,$description);
		   $tempConclusion= mysqli_real_escape_string($conn,$conclusion);

			$query = mysqli_query($conn,"insert into academic_master(postby,title,description,posttype,postdatetime,conclusion) values ($userid,'$tempTitle','$tempDesc','$posttype','$currentDate','$tempConclusion')");

			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					  $academicQuery = mysqli_query($conn,"select * from  academic_master where postby=$userid order by postdatetime");
						if($academicQuery!=null)
						{
							$academicAffected=mysqli_num_rows($academicQuery);
							if($academicAffected>0)
							{
								while($academicResults = mysqli_fetch_assoc($academicQuery))
									{
										$records[]=$academicResults;
										$NewReord = $academicResults;
									}
							}
						}
					$response = array('Message'=>"Academic Marked Successfully","Data"=>$records ,"NewRecord"=>$NewReord,'Responsecode'=>200);
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
   mysqli_close($conn);
	 print json_encode($response);
?>
