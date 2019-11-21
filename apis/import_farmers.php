<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include "../connection.php";
mysqli_set_charset($conn, 'utf8');
// Load the database configuration file
$response = null;
    // Allowed mime types
if(isset($_POST['branchId']) && isset($_POST['ownerid'])){
   $branchId = $_POST['branchId'];
   $ownerid = $_POST['ownerid'];
    $csvMimes =array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            // echo $_FILES['file']['name'];
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                // echo $line[0];
                $fname   = $line[0];
                $lname  = $line[1];
                $contactNumber  = $line[2];
                $gender = $line[3];
                $contactAddress = $line[4];
                $aadhar = $line[5];
                $profession = $line[6];
                $city = $line[7];
                $state = 'Maharashtra';
                $country = 'India';
                $category = $line[8];
            $sql = "INSERT INTO animal_owner_master(doctorId,firstName,lastName,profession,mobile,city,state,country,address,sex,branchId,category,adharId) VALUES";
            $sql .= "($ownerid,'$fname','$lname','$profession','$contactNumber','$city','$state','$country','$contactAddress','$gender',$branchId,'$category','$aadhar')";
            $query = mysqli_query($conn,$sql);
            // echo $sql;
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
