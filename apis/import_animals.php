<?php
// Load the database configuration file
include_once '../connection.php';
$response = null;
    // Allowed mime types
    if(isset($_POST['branchId1']) && isset($_POST['doctorid'])){
   $branchId = $_POST['branchId1'];
   $ownerid = $_POST['doctorid'];
    $csvMimes =array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['animalfile']['name']) && in_array($_FILES['animalfile']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['animalfile']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['animalfile']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $animalName   = $line[0];
                $gender  = $line[1];
                $species  = $line[2];
                $breed = $line[3];
                $weight = $line[4];
                $birthdate = $line[5];
                $remark = $line[6];
              
            $sql = "INSERT INTO animal_master(ownerId,animalName,gender,specie,breed,weight,dateOfBirth,remarks) VALUES";              
            $sql .= "($ownerid,'$animalName','$gender','$species','$breed','$weight','$birthdate','$remark')";
            $query = mysqli_query($conn,$sql);                 
            }
            // Close opened CSV file
            fclose($csvFile);
            $response = array('Message'=>'Imported Successfully','ResponseCode'=>200);
        }else{
            $response = array('Message'=>'Error while uploading','ResponseCode'=>300);
        }
    }else{
        $response = array('Message'=>'Invalid File','ResponseCode'=>500);
    }
}else{
    $response = array('Message'=>'Parameter Missing','ResponseCode'=>500);
}
exit(json_encode($response));
?>