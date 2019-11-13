<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('asia/kolkata');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/./Classes/PHPExcel.php';
include "../connection.php";
include 'getcount.php';
// extract($_POST);
if(isset($_REQUEST['branchId'])  && isset($_REQUEST['year']) && isset($_REQUEST['month']) && isset($_REQUEST['email'])){
    $branchId =$_REQUEST['branchId'];
    $year = $_REQUEST['year'];
    $month = $_REQUEST['month'];
    $email = $_REQUEST['email'];
    // $branchId =3248;
    // $year = 2019;
    // $month = '09';
$date = $year.'-'.$month.'-01';
$date1 = $year.'-'.$month.'-31';
// Create new PHPExcel object

function getTreatment($json){
    $treatment = [];
    if(array_key_exists('ArtificialInsemination', $json)){
       if($json['ArtificialInsemination']['AIType']!=''){
        array_push($treatment,'ArtificialInsemination');
       }
    }
    if(array_key_exists('Castration', $json)){
        if($json['Castration']['NoOfAnimals']!=''){
         array_push($treatment,'Castration');
        }
     }
     if(array_key_exists('Delivery', $json)){
        if($json['Delivery']['CalfGender']!=''){
         array_push($treatment,'Delivery');
        }
     }
     if(array_key_exists('Infertility', $json)){
        if($json['Infertility']['Probable Cause']!=''){
         array_push($treatment,'Infertility');
        }
     }
     if(array_key_exists('Other', $json)){
        if($json['Other']['Treatment']!=''){
         array_push($treatment,'Other');
        }
     }
     if(array_key_exists('Pregnancy', $json)){
        if($json['Pregnancy']['AI-TYPE']!=''){
         array_push($treatment,'Pregnancy');
        }
     }
     if(array_key_exists('Surgery', $json)){
        if($json['Surgery']['Surgery Name']!=''){
         array_push($treatment,'Surgery');
        }
     }
     if(array_key_exists('Treatment', $json)){
        if($json['Treatment']['System']!=''){
         array_push($treatment,'Treatment');
        }
     }
  return implode(" ",$treatment);
}
$objPHPExcel = new PHPExcel();

// Set properties
// $objPHPExcel->getProperties()->setCreator("");
// $objPHPExcel->getProperties()->setLastModifiedBy("");
// $objPHPExcel->getProperties()->setTitle("");
// $objPHPExcel->getProperties()->setSubject("");
// $objPHPExcel->getProperties()->setDescription("");
//Artificial Inseminations Fresh
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Artificial Inseminations Fresh');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Artificial Inseminations Fresh");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Scheme");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Straw Number");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "AIType");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Status of Reproductive Organ");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Stage of Oestrus");
// Add some data

$Aitypefresh = null;
$operation = '"AIType":"Fresh';
$sql = "SELECT bm.centre_type,mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.animalName,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
    AND mm.treatment REGEXP '$operation'";

$jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
$academicAffected = mysqli_num_rows($jobQuery);
if ($academicAffected > 0) {
 $count = getCountOfYear($month,$year,1,$branchId);
while($academicResults = mysqli_fetch_assoc($jobQuery))
 {
 $count++;
 $temp = $academicResults;
 $yearly = array('Year'=>$count);
 $total = array_merge($temp, $yearly);
 $Aitypefresh[] = $total;
 }
} 
}
if($Aitypefresh!=null){
    $count= count($Aitypefresh);
    $objPHPExcel->getActiveSheet()->setCellValue('B1', $Aitypefresh[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $treatment = json_decode($Aitypefresh[$i]["treatment"],true);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $Aitypefresh[$i]["Year"])
     ->setCellValue('C' . $cell, $Aitypefresh[$i]["Visit_Date"])
     ->setCellValue('D' . $cell, $Aitypefresh[$i]["FirstName"].' '.$Aitypefresh[$i]["LastName"])
     ->setCellValue('E' . $cell, $Aitypefresh[$i]["ownerAddress"])
     ->setCellValue('F' . $cell, $Aitypefresh[$i]["Category"])
     ->setCellValue('G' . $cell, $Aitypefresh[$i]["animalName"])
     ->setCellValue('H' . $cell, $Aitypefresh[$i]["Species"])
     ->setCellValue('I' . $cell, $Aitypefresh[$i]["Breed"])
     ->setCellValue('J' . $cell, $treatment['ArtificialInsemination']['Scheme'])
     ->setCellValue('K' . $cell, $treatment['ArtificialInsemination']['StrawNo'])
     ->setCellValue('L' . $cell, $treatment['ArtificialInsemination']['AIType'])
     ->setCellValue('M' . $cell, $treatment['ArtificialInsemination']['Status of reproductive organ'])
     ->setCellValue('N' . $cell, $treatment['ArtificialInsemination']['Stage of Oestrus']);
}
}//end for add data
//Artificial Inseminations Repeat 1
$objPHPExcel->createSheet(1);
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle('Artificial Inseminations Repeat1');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Artificial Inseminations Repeat 1");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Scheme");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Straw Number");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "AIType");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Status of Reproductive Organ");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Stage of Oestrus");

//adding data
$Aityperepeat1 = null;
$operation = '"AIType":"Repeat 1';
$sql = "SELECT bm.centre_type,mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.animalName,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
    AND mm.treatment REGEXP '$operation'";

$jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
$academicAffected = mysqli_num_rows($jobQuery);
if ($academicAffected > 0) {
 $count = getCountOfYear($month,$year,2,$branchId);
while($academicResults = mysqli_fetch_assoc($jobQuery))
 {
 $count++;
 $temp = $academicResults;
 $yearly = array('Year'=>$count);
 $total = array_merge($temp, $yearly);
 $Aityperepeat1[] = $total;
 }
} 
}
if($Aityperepeat1!=null){
    $count= count($Aityperepeat1);
    $objPHPExcel->getActiveSheet()->setCellValue('B1', $Aityperepeat1[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $treatment = json_decode($Aityperepeat1[$i]["treatment"],true);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $Aityperepeat1[$i]["Year"])
     ->setCellValue('C' . $cell, $Aityperepeat1[$i]["Visit_Date"])
     ->setCellValue('D' . $cell, $Aityperepeat1[$i]["FirstName"].' '.$Aityperepeat1[$i]["LastName"])
     ->setCellValue('E' . $cell, $Aityperepeat1[$i]["ownerAddress"])
     ->setCellValue('F' . $cell, $Aityperepeat1[$i]["Category"])
     ->setCellValue('G' . $cell, $Aityperepeat1[$i]["animalName"])
     ->setCellValue('H' . $cell, $Aityperepeat1[$i]["Species"])
     ->setCellValue('I' . $cell, $Aityperepeat1[$i]["Breed"])
     ->setCellValue('J' . $cell, $treatment['ArtificialInsemination']['Scheme'])
     ->setCellValue('K' . $cell, $treatment['ArtificialInsemination']['StrawNo'])
     ->setCellValue('L' . $cell, $treatment['ArtificialInsemination']['AIType'])
     ->setCellValue('M' . $cell, $treatment['ArtificialInsemination']['Status of reproductive organ'])
     ->setCellValue('N' . $cell, $treatment['ArtificialInsemination']['Stage of Oestrus']);
}
}//end for add data
//Artificial Inseminations Repeat 1
$objPHPExcel->createSheet(2);
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->setTitle('Artificial Inseminations Repeat2');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Artificial Inseminations Repeat 2");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Scheme");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Straw Number");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "AIType");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Status of Reproductive Organ");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Stage of Oestrus");
//add data
$Aityperepeat2 = null;
$operation = '"AIType":"Repeat 2';
$sql = "SELECT bm.centre_type,mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.animalName,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
    AND mm.treatment REGEXP '$operation'";

$jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
$academicAffected = mysqli_num_rows($jobQuery);
if ($academicAffected > 0) {
$count = getCountOfYear($month,$year,3,$branchId);
while($academicResults = mysqli_fetch_assoc($jobQuery))
{
$count++;
$temp = $academicResults;
$yearly = array('Year'=>$count);
$total = array_merge($temp, $yearly);
$Aityperepeat2[] = $total;
}
} 
}
if($Aityperepeat2!=null){
    $count= count($Aityperepeat2);
    $objPHPExcel->getActiveSheet()->setCellValue('B1', $Aityperepeat2[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $treatment = json_decode($Aityperepeat2[$i]["treatment"],true);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $Aityperepeat2[$i]["Year"])
     ->setCellValue('C' . $cell, $Aityperepeat2[$i]["Visit_Date"])
     ->setCellValue('D' . $cell, $Aityperepeat2[$i]["FirstName"].' '.$Aityperepeat2[$i]["LastName"])
     ->setCellValue('E' . $cell, $Aityperepeat2[$i]["ownerAddress"])
     ->setCellValue('F' . $cell, $Aityperepeat2[$i]["Category"])
     ->setCellValue('G' . $cell, $Aityperepeat2[$i]["animalName"])
     ->setCellValue('H' . $cell, $Aityperepeat2[$i]["Species"])
     ->setCellValue('I' . $cell, $Aityperepeat2[$i]["Breed"])
     ->setCellValue('J' . $cell, $treatment['ArtificialInsemination']['Scheme'])
     ->setCellValue('K' . $cell, $treatment['ArtificialInsemination']['StrawNo'])
     ->setCellValue('L' . $cell, $treatment['ArtificialInsemination']['AIType'])
     ->setCellValue('M' . $cell, $treatment['ArtificialInsemination']['Status of reproductive organ'])
     ->setCellValue('N' . $cell, $treatment['ArtificialInsemination']['Stage of Oestrus']);
}
}//end for add data
//Total Artificial Inseminations
$objPHPExcel->createSheet(3);
$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->setTitle('Total Artificial Inseminations');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Total Artificial Inseminations");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Scheme");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Straw Number");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "AIType");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Status of Reproductive Organ");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Stage of Oestrus");
//add some data
$totalAi = null;
$operation = 'AIType":"[[a-z]|[A-Z]]';
$sql = "SELECT bm.centre_type,mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.animalName,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
    AND mm.treatment REGEXP '$operation'";

    $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,4,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $totalAi[] = $total;
            }
        } 
    }
    if($totalAi!=null){
        $response = $totalAi;
        $count= count($response);
        $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
        $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
        $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
    for ($i = 0; $i < $count; $i++) {
        $cell = $i + 5;
        $treatment = json_decode($response[$i]["treatment"],true);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
         ->setCellValue('B' . $cell, $response[$i]["Year"])
         ->setCellValue('C' . $cell, $response[$i]["Visit_Date"])
         ->setCellValue('D' . $cell, $response[$i]["FirstName"].' '.$response[$i]["LastName"])
         ->setCellValue('E' . $cell, $response[$i]["ownerAddress"])
         ->setCellValue('F' . $cell, $response[$i]["Category"])
         ->setCellValue('G' . $cell, $response[$i]["animalName"])
         ->setCellValue('H' . $cell, $response[$i]["Species"])
         ->setCellValue('I' . $cell, $response[$i]["Breed"])
         ->setCellValue('J' . $cell, $treatment['ArtificialInsemination']['Scheme'])
         ->setCellValue('K' . $cell, $treatment['ArtificialInsemination']['StrawNo'])
         ->setCellValue('L' . $cell, $treatment['ArtificialInsemination']['AIType'])
         ->setCellValue('M' . $cell, $treatment['ArtificialInsemination']['Status of reproductive organ'])
         ->setCellValue('N' . $cell, $treatment['ArtificialInsemination']['Stage of Oestrus']);
    }
    }//end for add data
//Calves Born
$objPHPExcel->createSheet(4);
$objPHPExcel->setActiveSheetIndex(4);
$objPHPExcel->getActiveSheet()->setTitle('Calves Born');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Calves Born");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Scheme");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Straw Number");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "Calf Birth Date");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Calf Gender");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "AI Date");
$objPHPExcel->getActiveSheet()->SetCellValue('O4', "AI Type");
$objPHPExcel->getActiveSheet()->SetCellValue('P4', "Calf Details");
//add data
$calvesborn = null;
$operation = 'CalfGender\":\"Male|CalfGender\":\"Female';
$sql = "SELECT bm.centre_type,mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.animalName,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
    AND mm.treatment REGEXP '$operation'";
    
$jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
$academicAffected = mysqli_num_rows($jobQuery);
if ($academicAffected > 0) {
    $count = getCountOfYear($month,$year,5,$branchId);
 while($academicResults = mysqli_fetch_assoc($jobQuery))
    {
    $count++;
    $temp = $academicResults;
    $yearly = array('Year'=>$count);
    $total = array_merge($temp, $yearly);
    $calvesborn[] = $total;
    }
} 
}
if($calvesborn!=null){
    $response =  $calvesborn;
    $count= count($response);
    $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $treatment = json_decode($response[$i]["treatment"],true);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $response[$i]["Year"])
     ->setCellValue('C' . $cell, $response[$i]["Visit_Date"])
     ->setCellValue('D' . $cell, $response[$i]["FirstName"].' '.$response[$i]["LastName"])
     ->setCellValue('E' . $cell, $response[$i]["ownerAddress"])
     ->setCellValue('F' . $cell, $response[$i]["Category"])
     ->setCellValue('G' . $cell, $response[$i]["animalName"])
     ->setCellValue('H' . $cell, $response[$i]["Species"])
     ->setCellValue('I' . $cell, $response[$i]["Breed"])
     ->setCellValue('J' . $cell, $treatment['Delivery']['Scheme'])
     ->setCellValue('K' . $cell, $treatment['Delivery']['StrawNo'])
     ->setCellValue('L' . $cell, $treatment['Delivery']['CalfBDate'])
     ->setCellValue('M' . $cell, $treatment['Delivery']['CalfGender'])
     ->setCellValue('N' . $cell, $treatment['Delivery']['AIDate'])
     ->setCellValue('O' . $cell, $treatment['Delivery']['AI-TYPE'])
     ->setCellValue('P' . $cell, $treatment['Delivery']['CalfDetails']);
}
}//end for add data
//Vaccination
$objPHPExcel->createSheet(5);
$objPHPExcel->setActiveSheetIndex(5);
$objPHPExcel->getActiveSheet()->setTitle('Vaccination');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Vaccination");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Batch No.");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Cow");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Bull");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Calf");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Buffalo");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Redka");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "Goat");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Sheep");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Poultry");
//add data
$vaccination = null;
$sql = "SELECT bm.centre_type,vm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed,am.animalName,vm.cow,vm.bull,vm.calf,vm.buffalo,vm.redka,vm.goat,vm.sheep,vm.poultry,vm.batch
FROM vaccination_master  vm 
    join animal_master am on vm.animalId = am.animalId 
    join animal_owner_master aom on am.ownerId = aom.ownerId
    JOIN branch_master bm ON bm.branchId = vm.branchId
    where vm.branchId = $branchId
    AND MONTH(vm.visitDate) = $month AND YEAR(vm.visitDate) = $year";
$jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
 $academicAffected = mysqli_num_rows($jobQuery);
 if ($academicAffected > 0) {
     $count = getCountOfYear($month,$year,6,$branchId);
  while($academicResults = mysqli_fetch_assoc($jobQuery))
     {
     $count++;
     $temp = $academicResults;
     $yearly = array('Year'=>$count);
     $total = array_merge($temp, $yearly);
     $vaccination[] = $total;
     }
 } 
}

if($vaccination!=null){
    $response =  $vaccination;
    $count= count($response);
    $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $response[$i]["Year"])
     ->setCellValue('C' . $cell, $response[$i]["Visit_Date"])
     ->setCellValue('D' . $cell, $response[$i]["FirstName"].' '.$response[$i]["LastName"])
     ->setCellValue('E' . $cell, $response[$i]["ownerAddress"])
     ->setCellValue('F' . $cell, $response[$i]["batch"])
     ->setCellValue('G' . $cell, $response[$i]["cow"])
     ->setCellValue('H' . $cell, $response[$i]["bull"])
     ->setCellValue('I' . $cell, $response[$i]["calf"])
     ->setCellValue('J' . $cell, $response[$i]["buffalo"])
     ->setCellValue('K' . $cell, $response[$i]["redka"])
     ->setCellValue('L' . $cell, $response[$i]["goat"])
     ->setCellValue('M' . $cell, $response[$i]["sheep"])
     ->setCellValue('N' . $cell, $response[$i]["poultry"]);
}
}//end for add data
//Infertility
$objPHPExcel->createSheet(6);
$objPHPExcel->setActiveSheetIndex(6);
$objPHPExcel->getActiveSheet()->setTitle('Infertility');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Calves Born");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Probable Cause");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Finding Reproductive Organ");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "Treatment Suggested");
//add data
$infertility = null;
$operation = 'Probable Cause\":\"[[a-z]|[A-Z]]';
        $sql = "SELECT bm.centre_type,mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.animalName,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
        FROM medication_master  mm 
            JOIN animal_master am ON mm.animalId = am.animalId 
            JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
            JOIN branch_master bm ON bm.branchId = mm.branchId
            where mm.branchId = $branchId
            AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
            AND mm.treatment REGEXP '$operation'";
             $jobQuery = mysqli_query($conn,$sql);
     if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,7,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $infertility[] = $total;
            }
        } 
    }
    if($infertility!=null){
        $response =  $infertility;
        $count= count($response);
        $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
        $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
        $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
    for ($i = 0; $i < $count; $i++) {
        $cell = $i + 5;
        $treatment = json_decode($response[$i]["treatment"],true);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
         ->setCellValue('B' . $cell, $response[$i]["Year"])
         ->setCellValue('C' . $cell, $response[$i]["Visit_Date"])
         ->setCellValue('D' . $cell, $response[$i]["FirstName"].' '.$response[$i]["LastName"])
         ->setCellValue('E' . $cell, $response[$i]["ownerAddress"])
         ->setCellValue('F' . $cell, $response[$i]["Category"])
         ->setCellValue('G' . $cell, $response[$i]["animalName"])
         ->setCellValue('H' . $cell, $response[$i]["Species"])
         ->setCellValue('I' . $cell, $response[$i]["Breed"])
         ->setCellValue('J' . $cell, $treatment['Infertility']['Probable Cause'])
         ->setCellValue('K' . $cell, $treatment['Infertility']['Findings of Reproductive Organ'])
         ->setCellValue('L' . $cell, $treatment['Infertility']['Treatment Suggested']);
    }
    }//end for add data

//Deworming
$objPHPExcel->createSheet(7);
$objPHPExcel->setActiveSheetIndex(7);
$objPHPExcel->getActiveSheet()->setTitle('Deworming');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Deworming");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Cow");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Bull");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Calf");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Buffalo");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Redka");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "Goat");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Sheep");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Poultry");
//add data
$Deworming = null;
$sql = "SELECT bm.centre_type,vm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.specie AS Species,  am.breed AS Breed,vm.cow,vm.bull,vm.calf,vm.buffalo,vm.redka,vm.goat,vm.sheep,vm.poultry,am.animalName
FROM deworming_master vm
    join animal_master am on vm.animalid = am.animalId 
    join animal_owner_master aom on am.ownerId = aom.ownerId
    JOIN branch_master bm ON bm.branchId = vm.branchId
    where vm.branchId = $branchId
    AND MONTH(vm.visitDate) = $month AND YEAR(vm.visitDate) = $year";
$jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
 $academicAffected = mysqli_num_rows($jobQuery);
 if ($academicAffected > 0) {
     $count = getCountOfYear($month,$year,8,$branchId);
  while($academicResults = mysqli_fetch_assoc($jobQuery))
     {
     $count++;
     $temp = $academicResults;
     $yearly = array('Year'=>$count);
     $total = array_merge($temp, $yearly);
     $Deworming[] = $total;
     }
 } 
}

if($Deworming!=null){
    $response =  $Deworming;
    $count= count($response);
    $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $response[$i]["Year"])
     ->setCellValue('C' . $cell, $response[$i]["Visit_Date"])
     ->setCellValue('D' . $cell, $response[$i]["FirstName"].' '.$response[$i]["LastName"])
     ->setCellValue('E' . $cell, $response[$i]["ownerAddress"])
     ->setCellValue('F' . $cell, $response[$i]["animalName"])
     ->setCellValue('G' . $cell, $response[$i]["cow"])
     ->setCellValue('H' . $cell, $response[$i]["bull"])
     ->setCellValue('I' . $cell, $response[$i]["calf"])
     ->setCellValue('J' . $cell, $response[$i]["buffalo"])
     ->setCellValue('K' . $cell, $response[$i]["redka"])
     ->setCellValue('L' . $cell, $response[$i]["goat"])
     ->setCellValue('M' . $cell, $response[$i]["sheep"])
     ->setCellValue('N' . $cell, $response[$i]["poultry"]);
}
}//end for add data
//Cash Register
$objPHPExcel->createSheet(8);
$objPHPExcel->setActiveSheetIndex(8);
$objPHPExcel->getActiveSheet()->setTitle('Cash Register');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Cash Register");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Fees");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Payment Type");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Mobile");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Cast");

$cashregister = null;
$sql = "SELECT bm.centre_type,fm.visitDate,fm.feesAmount,aom.firstName,aom.lastName,aom.mobile,aom.category,aom.address,fm.typeOfPayment,am.animalName
FROM fees_master  fm 
    JOIN animal_master am ON fm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = fm.branchId
    where fm.branchId = $branchId
    AND MONTH(fm.visitDate) = $month AND YEAR(fm.visitDate) = $year";
            $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,9,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
            $cashregister[] = $total;
            }
        }
    }

    if($cashregister!=null){
        $response =  $cashregister;
        $count= count($response);
        $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
        $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
        $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
    for ($i = 0; $i < $count; $i++) {
        $cell = $i + 5;
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
         ->setCellValue('B' . $cell, $response[$i]["Year"])
         ->setCellValue('C' . $cell, $response[$i]["visitDate"])
         ->setCellValue('D' . $cell, $response[$i]["firstName"].' '.$response[$i]["lastName"])
         ->setCellValue('E' . $cell, $response[$i]["address"])
         ->setCellValue('F' . $cell, $response[$i]["feesAmount"])
         ->setCellValue('G' . $cell, $response[$i]["typeOfPayment"])
         ->setCellValue('H' . $cell, $response[$i]["mobile"])
         ->setCellValue('I' . $cell, $response[$i]["category"]);
    }
    }//end for add data

//Castrations
$objPHPExcel->createSheet(9);
$objPHPExcel->setActiveSheetIndex(9);
$objPHPExcel->getActiveSheet()->setTitle('Castrations');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Castrations");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Procedure");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "NoOfAnimals");
 //Castration
 $Castration = null;
 $operation = 'Procedure\":\"Closed|Procedure\":\"Open';
 $sql = "SELECT bm.centre_type,mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.animalName,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
 FROM medication_master  mm 
     JOIN animal_master am ON mm.animalId = am.animalId 
     JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
     JOIN branch_master bm ON bm.branchId = mm.branchId
     where mm.branchId = $branchId
     AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
     AND mm.treatment REGEXP '$operation'";

$jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
 $academicAffected = mysqli_num_rows($jobQuery);
 if ($academicAffected > 0) {
     $count = getCountOfYear($month,$year,10,$branchId);
  while($academicResults = mysqli_fetch_assoc($jobQuery))
     {
     $count++;
     $temp = $academicResults;
     $yearly = array('Year'=>$count);
     $total = array_merge($temp, $yearly);
     $Castration[] = $total;
     }
 } 
}

if($Castration!=null){
    $response =  $Castration;
    $count= count($response);
    $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $treatment = json_decode($response[$i]["treatment"],true);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $response[$i]["Year"])
     ->setCellValue('C' . $cell, $response[$i]["Visit_Date"])
     ->setCellValue('D' . $cell, $response[$i]["FirstName"].' '.$response[$i]["LastName"])
     ->setCellValue('E' . $cell, $response[$i]["ownerAddress"])
     ->setCellValue('F' . $cell, $response[$i]["Category"])
     ->setCellValue('G' . $cell, $response[$i]["animalName"])
     ->setCellValue('H' . $cell, $response[$i]["Species"])
     ->setCellValue('I' . $cell, $response[$i]["Breed"])
     ->setCellValue('J' . $cell, $treatment['Castration']['Procedure'])
     ->setCellValue('K' . $cell, $treatment['Castration']['NoOfAnimals']);
}
}//end for add data
//Operations
$objPHPExcel->createSheet(10);
$objPHPExcel->setActiveSheetIndex(10);
$objPHPExcel->getActiveSheet()->setTitle('Operations');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Operations");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Surgery Name");
//add data
$Operation = null;
$operation = 'surgeryTypes\":\"[[a-z]|[A-Z]]';
$sql = "SELECT bm.centre_type,mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.animalName,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
    AND mm.treatment REGEXP '$operation'";

     $jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
$academicAffected = mysqli_num_rows($jobQuery);
if ($academicAffected > 0) {
    $count = getCountOfYear($month,$year,11,$branchId);
 while($academicResults = mysqli_fetch_assoc($jobQuery))
    {
    $count++;
    $temp = $academicResults;
    $yearly = array('Year'=>$count);
    $total = array_merge($temp, $yearly);
    $Operation[] = $total;
    }
} 
}
if($Operation!=null){
    $response =  $Operation;
    $count= count($response);
    $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $treatment = json_decode($response[$i]["treatment"],true);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $response[$i]["Year"])
     ->setCellValue('C' . $cell, $response[$i]["Visit_Date"])
     ->setCellValue('D' . $cell, $response[$i]["FirstName"].' '.$response[$i]["LastName"])
     ->setCellValue('E' . $cell, $response[$i]["ownerAddress"])
     ->setCellValue('F' . $cell, $response[$i]["Category"])
     ->setCellValue('G' . $cell, $response[$i]["animalName"])
     ->setCellValue('H' . $cell, $response[$i]["Species"])
     ->setCellValue('I' . $cell, $response[$i]["Breed"])
     ->setCellValue('J' . $cell, $treatment['Surgery']['Surgery Name']);
   
}
}//end for add data
//Pregancy Dignosis
$objPHPExcel->createSheet(11);
$objPHPExcel->setActiveSheetIndex(11);
$objPHPExcel->getActiveSheet()->setTitle('Pregancy Dignosis');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Pregancy Dignosis");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "Pregnant");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "PD Type");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "Scheme");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "StrawNo");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Expected Delivery Date");
$objPHPExcel->getActiveSheet()->SetCellValue('O4', "Results");
$objPHPExcel->getActiveSheet()->SetCellValue('P4', "AI Date");
$objPHPExcel->getActiveSheet()->SetCellValue('Q4', "AI-Type");
$objPHPExcel->getActiveSheet()->SetCellValue('R4', "Pregancy Tenure");
//add data
$pregDignosis=null;
$operation = 'NSPD|AIPD';
$sql = "SELECT bm.centre_type,mm.visitDate AS Visit_Date , aom.firstName AS FirstName, aom.lastName AS LastName,aom.address AS ownerAddress,aom.category AS Category ,am.animalName,am.specie AS Species,  am.breed AS Breed, mm.samples AS Samples,mm.treatment 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year
    AND mm.treatment REGEXP '$operation'";
     $jobQuery = mysqli_query($conn,$sql);
    if ($jobQuery != null) {
        $academicAffected = mysqli_num_rows($jobQuery);
        if ($academicAffected > 0) {
            $count = getCountOfYear($month,$year,12,$branchId);
         while($academicResults = mysqli_fetch_assoc($jobQuery))
            {
            $count++;
            $temp = $academicResults;
            $yearly = array('Year'=>$count);
            $total = array_merge($temp, $yearly);
           $pregDignosis[] = $total;
            }
        } 
    }

    if($pregDignosis!=null){
        $response =  $pregDignosis;
        $count= count($response);
        $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
        $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
        $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
    for ($i = 0; $i < $count; $i++) {
        $cell = $i + 5;
        $treatment = json_decode($response[$i]["treatment"],true);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
         ->setCellValue('B' . $cell, $response[$i]["Year"])
         ->setCellValue('C' . $cell, $response[$i]["Visit_Date"])
         ->setCellValue('D' . $cell, $response[$i]["FirstName"].' '.$response[$i]["LastName"])
         ->setCellValue('E' . $cell, $response[$i]["ownerAddress"])
         ->setCellValue('F' . $cell, $response[$i]["Category"])
         ->setCellValue('G' . $cell, $response[$i]["animalName"])
         ->setCellValue('H' . $cell, $response[$i]["Species"])
         ->setCellValue('I' . $cell, $response[$i]["Breed"])
         ->setCellValue('J' . $cell, $treatment['Pregnancy']['Pregnant'])
         ->setCellValue('K' . $cell, $treatment['Pregnancy']['PD Type'])
         ->setCellValue('L' . $cell, $treatment['Pregnancy']['Scheme'])
         ->setCellValue('M' . $cell, $treatment['Pregnancy']['StrawNo'])
         ->setCellValue('N' . $cell, $treatment['Pregnancy']['Expected Delivery Date'])
         ->setCellValue('O' . $cell, $treatment['Pregnancy']['Results'])
         ->setCellValue('P' . $cell, $treatment['Pregnancy']['AIDate'])
         ->setCellValue('Q' . $cell, $treatment['Pregnancy']['AI-TYPE'])
         ->setCellValue('R' . $cell, $treatment['Pregnancy']['Pregnancy Tenure']);
    }
    }//end for add data
//Inpatients
$objPHPExcel->createSheet(12);
$objPHPExcel->setActiveSheetIndex(12);
$objPHPExcel->getActiveSheet()->setTitle('Inpatients');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Inpatients");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Admission Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "DateOfBirth");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Gender");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "Weight");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Symptoms");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Diagnosis");
$objPHPExcel->getActiveSheet()->SetCellValue('O4', "Treatment");
$objPHPExcel->getActiveSheet()->SetCellValue('P4', "Discharge Date");
//add data
$inpatients=null;
$sql = "SELECT bm.centre_type, ipd.visitDate,aom.firstName,aom.lastName,aom.address,aom.category,am.specie,am.breed,am.dateOfBirth,am.gender,am.weight,ipd.symptoms,ipd.diagnosis,ipd.treatment,ipd.dischargeDate,am.animalName
FROM ipd_medication_master ipd 
INNER JOIN animal_master am ON am.animalId = ipd.animalId
INNER JOIN animal_owner_master aom ON aom.ownerId = am.ownerId
JOIN branch_master bm ON bm.branchId = ipd.branchId
WHERE ipd.branchId = $branchId
AND MONTH(ipd.visitDate) = $month AND YEAR(ipd.visitDate) = $year";
 $jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
$academicAffected = mysqli_num_rows($jobQuery);
if ($academicAffected > 0) {
    $count = getCountOfYear($month,$year,13,$branchId);
 while($academicResults = mysqli_fetch_assoc($jobQuery))
    {
    $count++;
    $temp = $academicResults;
    $yearly = array('Year'=>$count);
    $total = array_merge($temp, $yearly);
    $inpatients[] = $total;
    }
} 
}
if($inpatients!=null){
    $response =  $inpatients;
    $count= count($response);
    $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $treatment = json_decode($response[$i]["treatment"],true);
    $object = getTreatment($treatment);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $response[$i]["Year"])
     ->setCellValue('C' . $cell, $response[$i]["visitDate"])
     ->setCellValue('D' . $cell, $response[$i]["firstName"].' '.$response[$i]["lastName"])
     ->setCellValue('E' . $cell, $response[$i]["address"])
     ->setCellValue('F' . $cell, $response[$i]["category"])
     ->setCellValue('G' . $cell, $response[$i]["animalName"])
     ->setCellValue('H' . $cell, $response[$i]["specie"])
     ->setCellValue('I' . $cell, $response[$i]["breed"])
     ->setCellValue('J' . $cell, $response[$i]["dateOfBirth"])
     ->setCellValue('K' . $cell, $response[$i]["gender"])
     ->setCellValue('L' . $cell, $response[$i]["weight"])
     ->setCellValue('M' . $cell, $response[$i]["symptoms"])
     ->setCellValue('N' . $cell, $response[$i]["diagnosis"])
     ->setCellValue('O' . $cell,  $object)
     ->setCellValue('P' . $cell, $response[$i]["dischargeDate"]);
   
}
}//end for add data
//Outpatients
$objPHPExcel->createSheet(13);
$objPHPExcel->setActiveSheetIndex(13);
$objPHPExcel->getActiveSheet()->setTitle('Outpatients');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Outpatients");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "DateOfBirth");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Gender");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "Weight");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Symptoms");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Diagnosis");
$objPHPExcel->getActiveSheet()->SetCellValue('O4', "Treatment");
//add data
$outpatients=null;
$sql = "SELECT bm.centre_type,mm.visitDate , aom.firstName , aom.lastName,aom.address ,aom.category ,am.specie,  am.breed , mm.samples AS Samples,am.gender,am.dateOfBirth,am.weight,mm.symptoms,mm.diagnosis,mm.treatment,am.animalName 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year";
 $jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
$academicAffected = mysqli_num_rows($jobQuery);
if ($academicAffected > 0) {
    $count = getCountOfYear($month,$year,14,$branchId);
 while($academicResults = mysqli_fetch_assoc($jobQuery))
    {
    $count++;
    $temp = $academicResults;
    $yearly = array('Year'=>$count);
    $total = array_merge($temp, $yearly);
    $outpatients[] = $total;
    }
} 
}
if($outpatients!=null){
    $response =  $outpatients;
    $count= count($response);
    $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $treatment = json_decode($response[$i]["treatment"],true);
    $object = getTreatment($treatment);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $response[$i]["Year"])
     ->setCellValue('C' . $cell, $response[$i]["visitDate"])
     ->setCellValue('D' . $cell, $response[$i]["firstName"].' '.$response[$i]["lastName"])
     ->setCellValue('E' . $cell, $response[$i]["address"])
     ->setCellValue('F' . $cell, $response[$i]["category"])
     ->setCellValue('G' . $cell, $response[$i]["animalName"])
     ->setCellValue('H' . $cell, $response[$i]["specie"])
     ->setCellValue('I' . $cell, $response[$i]["breed"])
     ->setCellValue('J' . $cell, $response[$i]["dateOfBirth"])
     ->setCellValue('K' . $cell, $response[$i]["gender"])
     ->setCellValue('L' . $cell, $response[$i]["weight"])
     ->setCellValue('M' . $cell, $response[$i]["symptoms"])
     ->setCellValue('N' . $cell, $response[$i]["diagnosis"])
     ->setCellValue('O' . $cell, $object);
}
}//end for add data
//Day Book
$objPHPExcel->createSheet(14);
$objPHPExcel->setActiveSheetIndex(14);
$objPHPExcel->getActiveSheet()->setTitle('Day Book');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Day Book");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "DateOfBirth");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Gender");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "Weight");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Symptoms");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Diagnosis");
$objPHPExcel->getActiveSheet()->SetCellValue('O4', "Treatment");

//add data
$daybook=null;
$sql = "SELECT bm.centre_type,mm.visitDate , aom.firstName , aom.lastName,aom.address ,aom.category ,am.specie,  am.breed , mm.samples AS Samples,am.gender,am.dateOfBirth,am.weight,mm.symptoms,mm.diagnosis,mm.treatment,am.animalName 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year";
 $jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
$academicAffected = mysqli_num_rows($jobQuery);
if ($academicAffected > 0) {
    $count = getCountOfYear($month,$year,15,$branchId);
 while($academicResults = mysqli_fetch_assoc($jobQuery))
    {
    $count++;
    $temp = $academicResults;
    $yearly = array('Year'=>$count);
    $total = array_merge($temp, $yearly);
    $daybook[] = $total;
    }
} 
}
if($daybook!=null){
    $response =  $daybook;
    $count= count($response);
    $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
    $j=0;
for ($i = 0; $i < $count; $i++) {
    $cell = $j + 5;
    $disease = strtolower($response[$i]["symptoms"]);
    if((strpos($disease,"fever") !== false && strpos($disease,"diarrhea") !==false) || (strpos($disease,"fever") !== false && strpos($disease,"mouth lesions") !==false) || (strpos($disease,"diarrhea") !==false && strpos($disease,"mouth lesions") !==false)) {
    $treatment = json_decode($response[$i]["treatment"],true);
    $object = getTreatment($treatment);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $response[$i]["Year"])
     ->setCellValue('C' . $cell, $response[$i]["visitDate"])
     ->setCellValue('D' . $cell, $response[$i]["firstName"].' '.$response[$i]["lastName"])
     ->setCellValue('E' . $cell, $response[$i]["address"])
     ->setCellValue('F' . $cell, $response[$i]["category"])
     ->setCellValue('G' . $cell, $response[$i]["animalName"])
     ->setCellValue('H' . $cell, $response[$i]["specie"])
     ->setCellValue('I' . $cell, $response[$i]["breed"])
     ->setCellValue('J' . $cell, $response[$i]["dateOfBirth"])
     ->setCellValue('K' . $cell, $response[$i]["gender"])
     ->setCellValue('L' . $cell, $response[$i]["weight"])
     ->setCellValue('M' . $cell, $response[$i]["symptoms"])
     ->setCellValue('N' . $cell, $response[$i]["diagnosis"])
     ->setCellValue('O' . $cell,$object);
     $j++;
    }
}
}//end for add data
//Tour Book
$objPHPExcel->createSheet(15);
$objPHPExcel->setActiveSheetIndex(15);
$objPHPExcel->getActiveSheet()->setTitle('Tour Book');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Center :');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Title :");
$objPHPExcel->getActiveSheet()->SetCellValue('B2', "Tour Book");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "From :");
$objPHPExcel->getActiveSheet()->SetCellValue('C3', "To :");
$objPHPExcel->getActiveSheet()->SetCellValue('A4', "Monthly");
$objPHPExcel->getActiveSheet()->SetCellValue('B4', "Yearly");
$objPHPExcel->getActiveSheet()->SetCellValue('C4', "Visit Date");
$objPHPExcel->getActiveSheet()->SetCellValue('D4', "Name");
$objPHPExcel->getActiveSheet()->SetCellValue('E4', "Address");
$objPHPExcel->getActiveSheet()->SetCellValue('F4', "Category");
$objPHPExcel->getActiveSheet()->SetCellValue('G4', "Animal Name");
$objPHPExcel->getActiveSheet()->SetCellValue('H4', "Species");
$objPHPExcel->getActiveSheet()->SetCellValue('I4', "Breed");
$objPHPExcel->getActiveSheet()->SetCellValue('J4', "DateOfBirth");
$objPHPExcel->getActiveSheet()->SetCellValue('K4', "Gender");
$objPHPExcel->getActiveSheet()->SetCellValue('L4', "Weight");
$objPHPExcel->getActiveSheet()->SetCellValue('M4', "Symptoms");
$objPHPExcel->getActiveSheet()->SetCellValue('N4', "Diagnosis");
$objPHPExcel->getActiveSheet()->SetCellValue('O4', "Treatment");

//add data
$tourbook=null;
$sql = "SELECT bm.centre_type,mm.visitDate , aom.firstName , aom.lastName,aom.address ,aom.category ,am.specie,  am.breed , mm.samples AS Samples,am.gender,am.dateOfBirth,am.weight,mm.symptoms,mm.diagnosis,mm.treatment,am.animalName 
FROM medication_master  mm 
    JOIN animal_master am ON mm.animalId = am.animalId 
    JOIN animal_owner_master aom ON am.ownerId = aom.ownerId 
    JOIN branch_master bm ON bm.branchId = mm.branchId
    where mm.branchId = $branchId AND mm.visitType = 'Tour'
    AND MONTH(mm.visitDate) = $month AND YEAR(mm.visitDate) = $year";
 $jobQuery = mysqli_query($conn,$sql);
if ($jobQuery != null) {
$academicAffected = mysqli_num_rows($jobQuery);
if ($academicAffected > 0) {
    $count = getCountOfYear($month,$year,16,$branchId);
 while($academicResults = mysqli_fetch_assoc($jobQuery))
    {
    $count++;
    $temp = $academicResults;
    $yearly = array('Year'=>$count);
    $total = array_merge($temp, $yearly);
    $tourbook[] = $total;
    }
} 
}
if($tourbook!=null){
    $response =  $tourbook;
    $count= count($response);
    $objPHPExcel->getActiveSheet()->setCellValue('B1',  $response[0]["centre_type"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B3',$date);
    $objPHPExcel->getActiveSheet()->setCellValue('D3',$date1);
for ($i = 0; $i < $count; $i++) {
    $cell = $i + 5;
    $treatment = json_decode($response[$i]["treatment"],true);
    $object = getTreatment($treatment);
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $cell, $i+1)
     ->setCellValue('B' . $cell, $response[$i]["Year"])
     ->setCellValue('C' . $cell, $response[$i]["visitDate"])
     ->setCellValue('D' . $cell, $response[$i]["firstName"].' '.$response[$i]["lastName"])
     ->setCellValue('E' . $cell, $response[$i]["address"])
     ->setCellValue('F' . $cell, $response[$i]["category"])
     ->setCellValue('G' . $cell, $response[$i]["animalName"])
     ->setCellValue('H' . $cell, $response[$i]["specie"])
     ->setCellValue('I' . $cell, $response[$i]["breed"])
     ->setCellValue('J' . $cell, $response[$i]["dateOfBirth"])
     ->setCellValue('K' . $cell, $response[$i]["gender"])
     ->setCellValue('L' . $cell, $response[$i]["weight"])
     ->setCellValue('M' . $cell, $response[$i]["symptoms"])
     ->setCellValue('N' . $cell, $response[$i]["diagnosis"])
     ->setCellValue('O' . $cell, $object);
}
}//end for add data
$filename = "mpr_reports_" . date('Y-m-d h:i:s') . ".xls"; 
$path = dirname(__FILE__) . '/./Classes/'.$filename;
header('Content-Type: application/vnd.oasis.opendocument.spreadsheet');
header('Content-Disposition: attachment;filename="' . $filename . '";');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save($path);
$objWriter->save('php://output');


//   // EDIT THE 2 LINES BELOW AS REQUIRED
  $email_to = $email;
  $email_subject = 'Monthly Progressive Report';


  $email_from = 'mpr-report@mahavetnet.com'; // required
  


  $content = file_get_contents($path);
 $content = chunk_split(base64_encode($content));
 $eol = "\r\n";
  //attachment  
  $separator = md5(time());
// create email headers
$headers  = 'MIME-Version: 1.0' . "\r\n";
// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "Content-Type: multipart/mixed;boundary=\"" . $separator . "\"" . $eol;
$headers .= "From:".$email_from."\r\n";
$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
$headers .= "This is a MIME encoded message." . $eol;
// $headers .= 'Content-Type: application/vnd.oasis.opendocument.spreadsheet' . "\r\n";
// $headers .= 'Content-Disposition: attachment; filename='. $path .'' . "\r\n";
// $headers = 'From: '.$email_to."\r\n".'Reply-To: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion();
// attachment
$body  = "--" . $separator . $eol;
$body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
$body .= "Content-Transfer-Encoding: base64" . $eol;
$body .= "Content-Disposition: attachment" . $eol;
$body .= $content . $eol;
$body .= "--" . $separator . "--";
if(@mail($email_to, $email_subject, $body, $headers)){
 unlink($path);
 }

// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'OpenDocument');
//  $objWriter->save('report.xls');
}else{
    echo 'Parameter missing';
}
exit;
?>