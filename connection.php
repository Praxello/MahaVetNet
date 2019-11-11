<?php
$serverName = 'localhost';
$username   = 'root';
$password   = '';
$databaseName = 'MahaVetNet_build1';
$conn = new mysqli($serverName,$username,$password,$databaseName)or die(mysqli_error($conn));
?>
