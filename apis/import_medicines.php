<?php
// Load the database configuration file
include_once '../connection.php';
$response = null;
    // Allowed mime types
    if(isset($_POST['branchId'])){
   $branchId = $_POST['branchId'];
    $csvMimes =array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $type   = $line[0];
                $tradeName  = $line[1];
                $unit  = $line[2];
            
            $sql = "INSERT INTO medicine_master(type,tradeName,unit,branchId) VALUES";              
            $sql .= "('$type','$tradeName','$unit','$branchId')";
            $query = mysqli_query($conn,$sql);                 
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
            $response = array('Message'=>'Imported Successfully','ResponseCode'=>200);
        }else{
            $qstring = '?status=err';
            $response = array('Message'=>'Error while uploading','ResponseCode'=>300);
        }
    }else{
        $qstring = '?status=invalid_file';
        $response = array('Message'=>'Invalid File','ResponseCode'=>500);
    }
}else{
    $response = array('Message'=>'Parameter Missing','ResponseCode'=>500);
}
exit(json_encode($response));
?>