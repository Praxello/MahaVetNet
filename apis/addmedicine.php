<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);

	  if(isset($_POST['tradename']) && isset($_POST['type']) && isset($_POST['unit']) && isset($_POST['branchid']))
	 {

			$query = mysqli_query($conn,"insert into medicine_master (type,tradename,unit,branchid,category) values('$type','$tradename','$unit',$branchid,1)");

			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{

					  $jobQuery = mysqli_query($conn,"SELECT * FROM  medicine_master where  type = '$type' and tradename='$tradename' and unit ='$unit' and branchid=$branchid");
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
					$response = array('Message'=>"Medicine added successfully","Data"=>$records ,'Responsecode'=>200);
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
