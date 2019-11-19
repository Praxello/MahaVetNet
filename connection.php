<?php
$serverName = 'localhost';
$username   = 'root';
$password   = '';
$databaseName = 'Mahavetnet2';
$conn = new mysqli($serverName,$username,$password,$databaseName)or die(mysqli_error($conn));
?>
