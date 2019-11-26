<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 extract($_GET);
	
					  $jobQuery = mysqli_query($conn,"SELECT * FROM  animal_owner_master where branchid=$branchid order by ownerId desc");
						if($jobQuery!=null)
						{
							$academicAffected=mysqli_num_rows($jobQuery);
							if($academicAffected>0)
							{
								while($animalOwnerResult = mysqli_fetch_assoc($jobQuery))
									{
										$ownerId = $animalOwnerResult['ownerId'];
										$animalData = null;
											  $animalQuery = mysqli_query($conn,"SELECT * FROM  animal_master where ownerid=$ownerId");
													if($jobQuery!=null)
													{
														$animalAffected=mysqli_num_rows($animalQuery);
														if($animalAffected>0)
														{
																while($animalResult = mysqli_fetch_assoc($animalQuery))
																{
																	$animalData[] = $animalResult;
																}
														}
													}
										
										$records[]= array("AnimalOwner"=>$animalOwnerResult, "Animals"=> $animalData);
									}
							}
						}
		
					$response = array('Message'=>"All animal oweners fetched Successfully","Data"=>$records ,'Responsecode'=>200);	
	
	 print json_encode($response);
	  mysqli_close($conn);
?>