<?php
  header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 $visitId=null;
	 extract($_POST);

	 date_default_timezone_set("Asia/Kolkata");
	 $currentDate=date('Y-m-d H:i:s'); //Returns IST
	  if( isset($_POST['gender']) && isset($_POST['userid']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['profession']) && isset($_POST['mobile']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['address']) && isset($_POST['landmark']) && isset($_POST['branchid']))
	 {

 $categorytemp = null;
 $adharidtemp = null;
 if(isset($_POST['category']) && isset($_POST['adharid']))
 {
	 $categorytemp = $category;
	 $adharidtemp = $adharid;

 }
		   $tempaddress = mysqli_real_escape_string($conn,$address);
 $sql = "insert into animal_owner_master(doctorid,firstName, LastName,profession, mobile, city, state, country, address, sex, accCreationDate,branchid, category,adharid) values ($userid,'$firstname','$lastname','$profession','$mobile','$city','Maharashtra','India','$tempaddress','$gender','$currentDate',$branchid,'$categorytemp','$adharidtemp')";
			$query = mysqli_query($conn,$sql);

			$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
				{
					$owner_id = $conn->insert_id;
					  $academicQuery = mysqli_query($conn,"SELECT * FROM  animal_owner_master WHERE ownerId=$owner_id");
						if($academicQuery!=null)
						{
							$academicAffected=mysqli_num_rows($academicQuery);
							if($academicAffected>0)
							{
								$academicResults = mysqli_fetch_array($academicQuery);
								$records=$academicResults;
							}
						}
					$response = array('Message'=>"Animal Owner added Successfully","Data"=>$records,'Responsecode'=>200);
				}
				else
				{
					$response = array('Message'=>mysqli_error($conn)." failed",'Responsecode'=>500);
				}
	 }
	 else
	 {
		$response=array("Message"=> "Parameters missing","Responsecode"=>403);
	 }
   mysqli_close($conn);
print json_encode($response);
?>
