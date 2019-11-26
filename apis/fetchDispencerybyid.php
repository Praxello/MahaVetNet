<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
  include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 extract($_POST);

	if(isset($_POST['branchid']))
	 {
 					  $academicQuery = mysqli_query($conn,"SELECT * FROM branch_mapper_master bmm inner join branch_master bm on bm.branchId= bmm.childBranch WHERE bmm.branchId=$branchid");
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
   mysqli_close($conn);
	 print json_encode($response);
?>
