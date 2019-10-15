<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
   include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $mappingRecords=null;
	 $proudctRecords=null;
	 $vendorRecords=null;
	 $advertisementRecords=null;


					$query = mysqli_query($conn,"SELECT * FROM advertisement_master");
						if($query!=null)
						{
							$Affected=mysqli_num_rows($query);
							if($Affected>0)
							{
								while($results = mysqli_fetch_assoc($query))
									{
										$advertisementRecords[]=$results;
									}
							}
						}

					  $query = mysqli_query($conn,"SELECT * FROM product_master where isactive=1");
						if($query!=null)
						{
							$Affected=mysqli_num_rows($query);
							if($Affected>0)
							{
								while($results = mysqli_fetch_assoc($query))
									{
										$proudctRecords[]=$results;
									}
							}
						}


					$query = mysqli_query($conn,"SELECT * FROM vendor_master where isactive=1");
						if($query!=null)
						{
							$Affected=mysqli_num_rows($query);
							if($Affected>0)
							{
								while($results = mysqli_fetch_assoc($query))
									{
										$vendorRecords[]=$results;
									}
							}
						}


						$query = mysqli_query($conn,"SELECT * FROM product_vendor_mapper_master where isactive=1");
						if($query!=null)
						{
							$Affected=mysqli_num_rows($query);
							if($Affected>0)
							{
								while($results = mysqli_fetch_assoc($query))
									{
										$mappingRecords[]=$results;
									}
							}
						}

					$response = array('Message'=>"All data fetched Successfully","Advertisements"=>$advertisementRecords, "Vendors"=>$vendorRecords,"Products"=>$proudctRecords, "Mapping"=> $mappingRecords ,'Responsecode'=>200);
mysqli_close($conn);
	 print json_encode($response);
?>
