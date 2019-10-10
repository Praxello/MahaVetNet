<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 extract($_POST);
	 
	if(isset($_POST['branchid']))
	 {
 					  $academicQuery = mysqli_query($conn,"select * from  vaccination_master where branchid=$branchid and isdeleted=0");
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
					$response = array('Message'=>"Vaccine record added successfully","Data"=>$records ,'Responsecode'=>200);	
				
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
	 print json_encode($response);
?>