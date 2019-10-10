<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	 extract($_POST);
	 $out=null;
	  
	  if( isset($_POST['visitdate']) && isset($_POST['animalid']))
		{
		 	
				$query = mysqli_query($conn,"update animal_master set nextvisitdate='$visitdate' where animalid=$animalid");
				$rowsAffected=mysqli_affected_rows($conn);
				if($rowsAffected==1)
					{	
					
				    	$out=array("Data" =>$records, "Responsecode"=>200,"Message"=>" Visit date updated");
					}
					else
					{
				    		$out=array("Data" =>$records, "Responsecode"=>200,"Message"=>" No data to change");
					}
	 }
	 else
	 {
		$out=array("Message"=> "Parameter Missing!","Responsecode"=>403);
	 }

	 print json_encode($out);
?>