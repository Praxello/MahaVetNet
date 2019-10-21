<?php
 session_start();
 $branchId = $_GET['branchId'];
 $userId = $_GET['userId'];
 $username = $_GET['username'];
 $_SESSION['branchId'] =  $branchId;
 $_SESSION['userId'] =  $userId;
 $_SESSION['username'] =  $username;
header('Location:dashboard.php');
?>
