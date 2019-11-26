<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $academicCaseLikes = null;
	 $academicCaseComments = null;
	 $masterRecord= null;
	 extract($_POST);
	 	  if(isset($_POST['userid']))
		  {
			  
			  			  $jobQuery = mysqli_query($conn,"select * from  academic_master  where postid =3269 order by postDateTime desc");
						if($jobQuery!=null)
						{
							$academicAffected=mysqli_num_rows($jobQuery);
							if($academicAffected>0)
							{
								while($academicResults = mysqli_fetch_assoc($jobQuery))
									{
										$caseData = null;
										$caseId = $academicResults['postId'];
										$caseData=$academicResults;//mail result added
										$likeCount = 0;
										//taking out likes now
											$userIds = null;
											$academicQuery = mysqli_query($conn,"select count(*) from  academic_master_likes where postid=$caseId");
						
											if($academicQuery!=null)
											{
											$academicAffected=mysqli_num_rows($academicQuery);
												if($academicAffected>0)
												{
													while($academicResults = mysqli_fetch_assoc($academicQuery))
													{
														$likeCount=$academicResults['count(*)'];
													}
												}
											}
						
									$isLiked = false;
									
									$userIdQuery = mysqli_query($conn,"select * from  academic_master_likes where userid=$userid and postid=$caseId");
						
									if($userIdQuery!=null)
									{
									$userAffected=mysqli_num_rows($userIdQuery);
									if($userAffected>0)
									{
									while($userResults = mysqli_fetch_assoc($userIdQuery))
									{
										$isLiked = true;
									}
									}
									}
									
									$likesData =  array("Likes"=>$likeCount,"isLiked"=>$isLiked);	
									
									
									
									//Academics comments ***********************************
								  $commentsData = null;
								  $academicQuery = mysqli_query($conn,"select * from  academic_master_comments where postid=$caseId");
								  if($academicQuery!=null)
									{
										$academicAffected=mysqli_num_rows($academicQuery);
										if($academicAffected>0)
										{
											while($academicResults = mysqli_fetch_assoc($academicQuery))
											{
											$commentsData[]=$academicResults;
											}
										}
									}
									
									$isBookmarked = false;
									//**************Bookmarks *****************
									$userIdQuery = mysqli_query($conn,"select  * from  academic_master_bookmark where userId=$userid and postid=$caseId");
						
									if($userIdQuery!=null)
									{
									$userAffected=mysqli_num_rows($userIdQuery);
									if($userAffected>0)
									{
										while($userResults = mysqli_fetch_assoc($userIdQuery))
										{
											$isBookmarked = true;
										}	
									}
									}
									
									
									$masterRecord[] = array("CaseData"=>$caseData,"LikeData"=>$likesData, "CommentsData"=>$commentsData, "IsBookMarked"=>$isBookmarked);	
					     			
										
										
									}
							}
						}
		
		
		
					$response = array('Message'=>"Academics fetched Successfully","Data"=>$masterRecord ,'Responsecode'=>200);	
		  }
		else
		{
			$response=array("Message"=> "Parameters missing","Responsecode"=>403);
		}
		
	
	 print json_encode($response);
	  mysqli_close($conn);
?>