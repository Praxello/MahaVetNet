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

	  if(isset($_POST['postid']) && isset($_POST['userid']) && isset($_POST['comment']))
	 {
		   $tempCOmment = mysqli_real_escape_string($conn,$comment);

			$query = mysqli_query($conn,"insert into academic_master_comments(postid,userid,comment,commentDateTime) values ($postid,$userid,'$tempCOmment','$currentDate')");

			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					  $academicQuery = mysqli_query($conn,"select * from  academic_master_comments where postid=$postid");
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
					$response = array('Message'=>"Comment post successfully","CommentsData"=>$records ,'Responsecode'=>200);
				}
				else
				{
					$response = array('Message'=>mysqli_error($conn)."Message failed",'Responsecode'=>403);
				}
	}
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
   mysqli_close($conn);
	 print json_encode($response);
?>
