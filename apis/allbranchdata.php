<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	  extract($_POST);
	
		   $jobQuery = mysqli_query($conn,"SELECT * FROM  branch_master where isactive=1 order by branchid");
						if($jobQuery!=null)
						{
							$affected=mysqli_num_rows($jobQuery);
							if($affected>0)
							{
								while($medicationResult = mysqli_fetch_assoc($jobQuery))
									{
										$records[]= $medicationResult;
									}
							}
						}
		
					$response = array('Message'=>"All Branch fetched Successfully".mysqli_error($conn),"Data"=>$records ,'Responsecode'=>200);	
	
	 print json_encode($response);
?>