<?php
     include "../connection.php";
	 mysqli_set_charset($conn,'utf8');
	 $response=null;
	 $records=null;
    extract($_POST);
    if(isset($_POST['branchid'])){
        $sql = "SELECT * FROM  medicine_master where branchId = $branchid";
        $jobQuery = mysqli_query($conn,$sql);
        if($jobQuery!=null)
        {
            $academicAffected=mysqli_num_rows($jobQuery);
            if($academicAffected>0)
            {
                while($academicResults = mysqli_fetch_assoc($jobQuery))
                    {
                        $records[]=$academicResults;
                    }
            }
        }
    $response = array('Message'=>"All medicines fetched Successfully","Data"=>$records ,'Responsecode'=>200);	
    }else{
        $response = array('Message'=>"Parameter missing","Data"=>$records ,'Responsecode'=>500);
    }				 
print json_encode($response);
?>