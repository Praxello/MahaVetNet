<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);

	  if(isset($_POST['straw_number'])  && isset($_POST['branchid']))
	 {
		$sql = "INSERT INTO  straw_details (straw_number,branchId) values('$straw_number',$branchid)";
			$query = mysqli_query($conn,$sql);

			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
                    $sql_1 = "SELECT * FROM  straw_details where  straw_number = '$straw_number' and branchId='$branchid'";
                    $jobQuery = mysqli_query($conn,$sql_1);
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
					$response = array('Message'=>"Straw added successfully" ,'Data'=>$records,'Responsecode'=>200);
				}
				else
				{
					$response = array('Message'=>"No data to update",'Responsecode'=>500);
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
     }
     mysqli_close($conn);
	 print json_encode($response);
?>
