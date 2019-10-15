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

	  if(isset($_POST['commentid']) && isset($_POST['postid']))
	 {
			$query = mysqli_query($conn,"delete from academic_master_comments where commentid=$commentid");

			$rowsAffected=mysqli_affected_rows($conn);
				//if($rowsAffected==1)
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
					$response = array('Message'=>"Comment Deleted","CommentsData"=>$records ,'Responsecode'=>200);
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
   mysqli_close($conn);
	 print json_encode($response);
?>
