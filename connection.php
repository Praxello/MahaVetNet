<?php
$serverName = 'localhost';
$username   = 'root';
$password   = '';
$databaseName = 'MahaVetNet';
$conn = new mysqli($serverName,$username,$password,$databaseName)or die(mysqli_error($conn));
?>
