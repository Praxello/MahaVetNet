<?php
$filename = "Farmers_" . date('Y-m-d h:i:s') . ".csv"; 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename="' . $filename . '";');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('firstname', 'lastname', 'Mobile number','gender(Male/Female)','Address','Aadhar number','Profession','city','Category'
));  
     //  $con = new mysqli('localhost','root','','MahaVetNet');
     //  $query = "SELECT type,tradeName,unit FROM medicine_master where branchId = 3391";  
     //  $result = mysqli_query($con, $query);  
     //  while($row = mysqli_fetch_assoc($result))  
     //  {  
     //       fputcsv($output, $row);  
     //  }  
      fclose($output);  
 ?>