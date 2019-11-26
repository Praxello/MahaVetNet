<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
  include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 extract($_POST);


 					  $academicQuery = mysqli_query($conn,"SELECT DISTINCT(year(visitDate)) as year FROM medication_master WHERE year(visitDate) >0");
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
					$response = array('Message'=>"record fetch successfully","Data"=>$records ,'Responsecode'=>200);


   mysqli_close($conn);
	 print json_encode($response);
?>
