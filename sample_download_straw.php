<?php
$filename = "straw_" . date('Y-m-d h:i:s') . ".csv"; 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename="' . $filename . '";');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('straw number'));  
      fclose($output);  
 ?>