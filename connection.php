<?php
$serverName = 'localhost';
$username   = 'root';
$password   = '';
$databaseName = 'Mahavetnet_production';
$conn = new mysqli($serverName,$username,$password,$databaseName)or die(mysqli_error($conn));
?>
