<?php
 session_start();
 $branchId = $_GET['branchId'];
 $userId = $_GET['userId'];
 $_SESSION['branchId'] =  $branchId;
 $_SESSION['userId'] =  $userId;
header('Location:farmer.php');
?>
