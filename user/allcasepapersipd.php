<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
	  extract($_POST);
	 if(isset($_POST['animalid']))
	 {
		   $jobQuery = mysqli_query($conn,"SELECT * FROM  ipd_medication_master where animalid=$animalid");
						if($jobQuery!=null)
						{
							$affected=mysqli_num_rows($jobQuery);
							if($affected>0)
							{
								while($medicationResult = mysqli_fetch_assoc($jobQuery))
									{
										$medicationDate = $medicationResult['visitDate'];
										$feesData = null;
										$medicinesData = null;
											  $animalQuery = mysqli_query($conn,"SELECT * FROM  fees_master where animalid=$animalid and visitDate ='$medicationDate'");
													if($jobQuery!=null)
													{
														$animalAffected=mysqli_num_rows($animalQuery);
														if($animalAffected>0)
														{
																while($feesResult = mysqli_fetch_assoc($animalQuery))
																{
																	$feesData = $feesResult;
																}
														}
													}

											$animalQuery = mysqli_query($conn,"SELECT * FROM  ipd_prescribed_medicine_master pmm inner join medicine_master mm on pmm.medicineid=mm.medicineid where pmm.animalid=$animalid and pmm.visitDate ='$medicationDate'");
															if($jobQuery!=null)
													{
														$animalAffected=mysqli_num_rows($animalQuery);
														if($animalAffected>0)
														{
																while($feesResult = mysqli_fetch_assoc($animalQuery))
																{
																	$medicinesData[] = $feesResult;
																}
														}
													}

										$records[]= array("MedicationData"=>$medicationResult, "FeesData"=> $feesData ,"MedicineData"=>$medicinesData);
									}
							}
						}
	 }


					$response = array('Message'=>"All animal oweners fetched Successfully","Data"=>$records ,'Responsecode'=>200);

	 print json_encode($response);
	  mysqli_close($conn);
?>
