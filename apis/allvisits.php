<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	
				
					  $visitQuery = mysqli_query($conn,"select * from user_master inner join visit_master where user_master.userId=visit_master.userId");
						if($visitQuery!=null)
						{
							
							$visitAffected=mysqli_num_rows($visitQuery);
							if($visitAffected>0)
							{
								while($visitResult = mysqli_fetch_assoc($visitQuery))
									{
										$records[]=$visitResult;
									}
							}
						}
					$response = array('Message'=>"Visits Fetched Successfully","Visits"=>$records ,'Responsecode'=>200);	
	
	 print json_encode($response);
?>