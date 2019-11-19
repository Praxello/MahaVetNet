<?php
 session_start();
 $branchId = $_GET['branchId'];
 $userId = $_GET['userId'];
 $username = $_GET['username'];
 $email = $_GET['email'];
 $center = $_GET['center'];
 $designation = $_GET['designation'];
 $_SESSION['branchId'] =  $branchId;
 $_SESSION['userId'] =  $userId;
 $_SESSION['username'] =  $username;
 $_SESSION['email'] = $email;
 $_SESSION['center'] = $center;
 $_SESSION['designation'] =  $designation;
header('Location:dashboard.php');
?>
