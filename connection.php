<?php
$serverName = 'localhost';
$username   = 'softclus_mvn';
$password   = 'Mvn@411005';
$databaseName = 'softclus_mvn';
$conn = new mysqli($serverName,$username,$password,$databaseName)or die(mysqli_error($conn));
?>