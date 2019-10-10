<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	 $message = null;
	 $flag = false;
	  
	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d H:i:s'); //Returns IST	
	
	  if(isset($_POST['postid']) && isset($_POST['userid']))
	 {
			$query = mysqli_query($conn,"insert into academic_master_bookmark(postid,userid) values ($postid,$userid)");
		
			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					$message = "You bookmarked the post";	
					$flag = true;
				}
				else
				{
					// now just dislike it
					$query = mysqli_query($conn,"delete from academic_master_bookmark where postid=$postid and userid=$userid");
					$message = "You unmarked the post";	
				}
						
						$userIds = null;
						$userIdQuery = mysqli_query($conn,"select userId from  academic_master_bookmark where postid=$postid");
						
						if($userIdQuery!=null)
						{
							$userAffected=mysqli_num_rows($userIdQuery);
							if($userAffected>0)
							{
								while($userResults = mysqli_fetch_assoc($userIdQuery))
									{
										$userIds[]=$userResults['userId'];
									}
							}
						}
							
							$response = array('Message'=>$message,"UserIds"=>$userIds,"IsBookMarked"=>$flag,'Responsecode'=>200);	
				
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
	 print json_encode($response);
?>