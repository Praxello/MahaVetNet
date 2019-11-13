<?php 
// include "reportsnew.php";
// $branchId =3248;
// $year = 2019;
// $month = '09';
// $response = getAlldata($branchId,$year,$month);
// function getTreatment($json){
//     $treatment = [];
//     if(array_key_exists('ArtificialInsemination', $json)){
//        if($json['ArtificialInsemination']['AIType']!=''){
//         array_push($treatment,'ArtificialInsemination');
//        }
//     }
//     if(array_key_exists('Castration', $json)){
//         if($json['Castration']['NoOfAnimals']!=''){
//          array_push($treatment,'Castration');
//         }
//      }
//      if(array_key_exists('Delivery', $json)){
//         if($json['Delivery']['CalfGender']!=''){
//          array_push($treatment,'Delivery');
//         }
//      }
//      if(array_key_exists('Infertility', $json)){
//         if($json['Infertility']['Probable Cause']!=''){
//          array_push($treatment,'Infertility');
//         }
//      }
//      if(array_key_exists('Other', $json)){
//         if($json['Other']['Treatment']!=''){
//          array_push($treatment,'Other');
//         }
//      }
//      if(array_key_exists('Pregnancy', $json)){
//         if($json['Pregnancy']['AI-TYPE']!=''){
//          array_push($treatment,'Pregnancy');
//         }
//      }
//      if(array_key_exists('Surgery', $json)){
//         if($json['Surgery']['Surgery Name']!=''){
//          array_push($treatment,'Surgery');
//         }
//      }
//      if(array_key_exists('Treatment', $json)){
//         if($json['Treatment']['System']!=''){
//          array_push($treatment,'Treatment');
//         }
//      }
//   return implode(" ",$treatment);
// }
// if($response["aitypefresh"]!=null){
//     echo count($response["aitypefresh"]);
//     for($i=0;$i<count($response["aitypefresh"]);$i++){
//         $a =  json_decode($response["aitypefresh"][$i]["treatment"],true);
//         $c = getData($a);
//         echo $c;
//         // if(array_key_exists('ArtificialInsemination', $a)){
//         //  echo ($i+1).'</br>';
//         //  echo $a['ArtificialInsemination']['AIType'].'<br>';
//         // }else{
//         //     echo '0';
//         // }
//     }
  
    
// }
// if($response["vaccination"]==null){
//     echo $response["Message"];
// }
$a = 'How are you?';

if (strpos($a, 'are1') !== false) {
    echo 'true';
}
$array = array(0 => 100, "color" => "red");
print_r(array_keys($array));

$array = array("blue", "red", "green", "blue", "blue");
print_r(array_keys($array, "blue"));

$array = array("color" => array("blue", "red", "green"),
               "size"  => array("small", "medium", "large"));
print_r(array_key($array[0]));

// include "../connection.php";
// include 'getcount.php';

// $Aitypefresh = null;
// $operation = '"AIType":"Fresh';
// $sql = "SELECT mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
// FROM medication_master  mm 
//     JOIN animal_master am ON mm.animalId = am.animalId 
//     JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
//     where mm.branchId = $branchId
//     AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
//     AND mm.treatment REGEXP '$operation'";

// $jobQuery = mysqli_query($conn,$sql);
// if ($jobQuery != null) {
//      $academicAffected = mysqli_num_rows($jobQuery);
// if ($academicAffected > 0) {
//  $count = getCountOfYear($month,$year,1,$branchId);
// while($academicResults = mysqli_fetch_assoc($jobQuery))
//  {
//  $count++;
//  $temp = $academicResults;
//  $yearly = array('Year'=>$count);
//  $total = array_merge($temp, $yearly);
//  $Aitypefresh[] = $total;
//  }
// } 
// }

// if($Aitypefresh!=null){
//     $count= count($Aitypefresh);
//     echo $count;
//     echo $Aitypefresh[2]["ownerAddress"];
//    // echo $response["aitypefresh"][$i]["Category"];
// for ($i = 0; $i < $count; $i++) {
//     // $cell = $i + 5;
//     // $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
//     //  ->setCellValue('B' . $cell, $response[$i]["Year"])
//     //  ->setCellValue('C' . $cell, $response[$i]["Visit_Date"])
//     //  ->setCellValue('D' . $cell, $response[$i]["FirstName"].' '.$response[$i]["LastName"])
//     //  ->setCellValue('E' . $cell, $response[$i]["ownerAddress"])
//     //  ->setCellValue('F' . $cell, $response[$i]["Category"])
//     //  ->setCellValue('G' . $cell, 'YES');
// }
// }
?>