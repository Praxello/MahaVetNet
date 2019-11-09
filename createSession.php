<?php
 session_start();
 $branchId = $_GET['branchId'];
 $userId = $_GET['userId'];
 $username = $_GET['username'];
 $email = $_GET['email'];
 $center = $_GET['center'];
 $_SESSION['branchId'] =  $branchId;
 $_SESSION['userId'] =  $userId;
 $_SESSION['username'] =  $username;
 $_SESSION['email'] = $email;
 $_SESSION['center'] = $center;
header('Location:dashboard.php');
?>
