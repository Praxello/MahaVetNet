<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;

					  $jobQuery = mysqli_query($conn,"SELECT * FROM list_of_values_master");
						if($jobQuery!=null)
						{
							$academicAffected=mysqli_num_rows($jobQuery);
							if($academicAffected>0)
							{
								while($academicResults = mysqli_fetch_assoc($jobQuery))
									{
										$records=$academicResults;
									}
							}
						}

					$response = array('Message'=>"All patients fetched Successfully","Data"=>$records ,'Responsecode'=>200);
   mysqli_close($conn);
	 print json_encode($response);
?>
