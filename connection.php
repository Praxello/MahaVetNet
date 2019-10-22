<?php
$serverName = 'localhost';
$username   = 'root';
$password   = '';
$databaseName = 'Maha';
$conn = new mysqli($serverName,$username,$password,$databaseName)or die(mysqli_error($conn));
?>
