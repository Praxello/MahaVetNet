<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);
	
	 if(isset($_POST['userid']))
	 {
	 				
					  $visitQuery = mysqli_query($conn,"select * from  visit_master where userid=$userid");
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
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
	 print json_encode($response);
?>